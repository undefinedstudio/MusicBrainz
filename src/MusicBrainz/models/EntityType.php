<?php

namespace MusicBrainz\models;

abstract class EntityType
{
    const area = 'area';
    const artist = 'artist';
    const event = 'event';
    const instrument = 'instrument';
    const label = 'label';
    const recording = 'recording';
    const release = 'release';
    const releasegroup = 'release-group';
    const series = 'series';
    const work = 'work';
    const url = 'url';

    const rating = 'rating';
    const tag = 'tag';
    const collection = 'collection';

    const discid = 'discid';
    const isrc = 'isrc';
    const iswc = 'iswc';

    const modelMap = [
        self::area => Area::class,
        self::artist => Artist::class,
        self::work => Work::class,
        self::event => Event::class,
        self::instrument => Instrument::class,
        // TODO: all other models
    ];
}