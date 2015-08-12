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
    const releaseGroup = 'release-group';
    const series = 'series';
    const work = 'work';
    const url = 'url';
    const place = 'place';

    const rating = 'rating';
    const tag = 'tag';
    const collection = 'collection';

    const disc = 'discid';
    const isrc = 'isrc';
    const iswc = 'iswc';

    const modelMap = [
        self::area => Area::class,
        self::artist => Artist::class,
        self::event => Event::class,
        self::instrument => Instrument::class,
        self::label => Label::class,
        self::recording => Recording::class,
        self::release => Release::class,
        self::releaseGroup => ReleaseGroup::class,
        self::series => Series::class,
        self::work => Work::class,
        self::url => Url::class,
        self::place => Place::class,
        self::rating => Rating::class,
        self::tag => Tag::class,
        //self::collection => Collection::class,
        self::disc => Disc::class,
        self::isrc => Isrc::class,
        self::iswc => Iswc::class,
    ];

    const nonMBIDFormat = [
        self::disc,
        self::isrc,
        self::iswc
    ];

}