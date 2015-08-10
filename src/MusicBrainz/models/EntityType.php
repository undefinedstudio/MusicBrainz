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
        self::releasegroup => ReleaseGroup::class,
        //self::series => Serie::class,
        self::work => Work::class,
        //self::url => Url::class,
        self::rating => Rating::class,
        self::tag => Tag::class,
        //self::collection => Collection::class,
        self::disc => Disc::class,
        self::isrc => Isrc::class,
        //self::iswc => Iswc::class,
    ];
}