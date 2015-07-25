<?php

namespace MusicBrainz\models;

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

    const artistAllowed = [
        self::recordings,
        self::releases,
        self::releasegroups,
        self::works,
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
        self::variousartists, // This doesn't have any dependency, even if it is only valid in a inc=releases request
        self::aliases,
        self::annotation,
        self::tags,
        self::ratings,
        self::usertags => [
            self::authRequired => true
        ],
        self::userratings => [
            self::authRequired => true
        ]


    ];

    //TODO Allowed includes arrays for all entity types
}