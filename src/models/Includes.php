<?php

namespace undefinedstudio\MusicBrainz\models;

use undefinedstudio\MusicBrainz\Utilities;
use ReflectionClass;
use Exception;

abstract class Includes
{
    const authRequired = 'authRequired';
    const dependencyRequired = 'dependencyRequired';
    const includeEverything = 'includeEverything';
    const includes = 'includes';
    const entityTypes = 'entityTypes';

    const artists = 'artists';
    const labels = 'labels';
    const recordings = 'recordings';
    const releases = 'releases';
    const releaseGroups = 'release-groups';
    const works = 'works';
    const collections = 'collections';

    const discs = 'discids';
    const media = 'media';
    const isrcs = 'isrcs';
    const artistCredits = 'artist-credits';
    const variousArtists = 'various-artists';
    const aliases = 'aliases';
    const annotation = 'annotation';
    const tags = 'tags';
    const rating = 'ratings';
    const userTags = 'user-tags';
    const userRating = 'user-ratings';

    const includeDependencies = [
        /*
         * MusicBrainz::Server::WebService::Validator
         *
        our %extra_inc = (
            'recordings' => [ qw( artist-credits puids isrcs ) ],
            'releases' => [ qw( artist-credits discids media type status ) ],
            'release-groups' => [ qw( artist-credits type ) ],
            'works' => [ qw( artist-credits ) ],
        );
        */
        self::artistCredits => [
            self::recordings,
            self::releases,
            self::releaseGroups,
            self::works
        ],
        self::isrcs => [
            self::recordings
        ],
        self::discs => [
            self::releases
        ],
        self::media => [
            self::releases
        ]
    ];

    const authDependencies = [
        self::userRating,
        self::userTags
    ];

    const workRules = [
        self::aliases => [],
        self::annotation => [],
        self::tags => [],
        self::rating => [],
        self::userTags => [
            self::authRequired => true
        ],
        self::userRating => [
            self::authRequired => true
        ]
    ];

    static function validate($entityType, $includes, CallOptions $options, $callType)
    {
        if (!count($includes)) {
            return $includes;
        }

        $modelMap = EntityType::modelMap;
        if (!isset($modelMap[$entityType])) {
            throw new Exception("No model map found for " . $entityType . " EntityType.");
        }

        $className = $modelMap[$entityType];
        $config = call_user_func($className . '::includes');
        $config = $config[$callType];
        $includeDependencies = self::includeDependencies;
        $authDependencies = self::authDependencies;
        $includeMap = EntityType::includeMap;

        if (in_array(self::includeEverything, $includes)) {
            $includes = $config;
        }

        foreach ($includes as $include) {
            // If a match is not found, it means the include required is not allowed for the entityType
            if (!in_array($include, $config)) {
                throw new Exception("The '" . $include . "' include is not valid for the '" . $entityType . "' EntityType.");
            }
            if (in_array($include, $authDependencies)) {
                $options->authRequired = true;
                if (!$options->isHttpAuthDoable()) {
                    throw new Exception("Authentication is required by the '" . $include . "' include for the '" . $entityType ."' EntityType.");
                }
            }
            // If a match is also found in the include dependencies
            if (array_key_exists($include, $includeDependencies)) {
                $dependenciesRequired = [];
                foreach ($includeDependencies[$include] as $includeDependency) {
                    if (in_array($includeDependency, $includes)) {
                        continue 2;
                    }
                    if (in_array($includeDependency, $config)) {
                        $dependenciesRequired[] = $includeDependency;
                    }
                }
                if (array_key_exists($entityType, $includeMap) && in_array($includeMap[$entityType], $includeDependencies[$include])) {
                    continue;
                }
                if (count($dependenciesRequired)) {
                    throw new Exception("The '" . $include . "' include is not valid for
                        the '" . $entityType ."' EntityType unless you specity one of the
                        following includes: " . implode(', ', $dependenciesRequired) . ".");
                }
                throw new Exception("The '" . $include . "' include is not valid for the '" . $entityType ."' EntityType.");
            }
        }

        return $includes;
    }
}