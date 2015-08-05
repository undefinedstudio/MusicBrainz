<?php

namespace MusicBrainz\models;

use ReflectionClass;
use Exception;

abstract class Includes
{
    const authRequired = 'authRequired';
    const dependencyRequired = 'dependencyRequired';

    const artists = 'artists';
    const labels = 'labels';
    const recordings = 'recordings';
    const releases = 'releases';
    const releasegroups = 'release-groups';
    const works = 'works';

    const discids = 'discids';
    const media = 'media';
    const isrcs = 'isrcs';
    const artistcredits = 'artist-credits';
    const variousartists = 'various-artists';
    const aliases = 'aliases';
    const annotation = 'annotation';
    const tags = 'tags';
    const ratings = 'ratings';
    const usertags = 'user-tags';
    const userratings = 'user-ratings';

    const artistRules = [
        self::recordings => [],
        self::releases => [],
        self::releasegroups => [],
        self::works => [],
        self::discids => [
            self::dependencyRequired => [
                self::releases
            ]
        ],
        self::media => [
            self::dependencyRequired => [
                self::releases
            ]
        ],
        self::isrcs => [
            self::dependencyRequired => [
                self::recordings
            ]
        ],
        self::artistcredits => [
            self::dependencyRequired => [
                self::releases,
                self::releasegroups,
                self::recordings,
                self::works
            ]
        ],
        self::variousartists => [], // This doesn't have any dependency, even if it is only valid in a inc=releases request
        self::aliases => [],
        self::annotation => [],
        self::tags => [],
        self::ratings => [],
        self::usertags => [
            self::authRequired => true
        ],
        self::userratings => [
            self::authRequired => true
        ]
    ];

    //TODO Allowed includes arrays for all entity types

    static function validate($entityType, $includes, CallOptions $options)
    {
        if (!count($includes)) {
            return true;
        }
        $thisRef = new ReflectionClass(self::class);
        $includeRules = $thisRef->getConstant($entityType . 'Rules');
        foreach ($includes as $include) {
            // If a rule is not found, it means the include required is not allowed for the entityType
            if (!isset($includeRules[$include])) {
                throw new Exception("The '" . $include . "' include is not valid for the '" . $entityType ."' EntityType.");
            }
            // If the rule is not an array, it means the include required is good to go
            if (!count($includeRules[$include])) {
                continue;
            }
            // If the rules requires dependencies
            if (isset($includeRules[$include][self::dependencyRequired])) {
                foreach ($includeRules[$include][self::dependencyRequired] as $i => $dependencyRequired) {
                    if (!in_array($dependencyRequired, $includes)) {
                        throw new Exception("The '" . $dependencyRequired . "' include is required by the '" . $include . "' include for the '" . $entityType ."' EntityType.");
                    } else {
                        break;
                    }
                }
            }

            if (isset($includeRules[$include][self::authRequired]) && $includeRules[$include][self::authRequired]) {
                $options->authRequired = true;
                if (!$options->isHttpAuthDoable()) {
                    throw new Exception("Authentication is required by the '" . $include . "' include for the '" . $entityType ."' EntityType.");
                }
            }
        }
        return true;
    }
}