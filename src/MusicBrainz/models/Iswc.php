<?php

namespace MusicBrainz\models;
use MusicBrainz\MusicBrainz;

/**
 * @property integer $workOffset
 * @property integer $workCount
 * @property Work[] $works
 * @property Alias[] $aliases
 */
class Iswc extends ParserModel
{
    public static function includes()
    {
        return [
            MusicBrainz::CALL_TYPE_LOOKUP => [
                Includes::artists,
                Includes::aliases,
                Includes::artistCredits,
                Includes::tags,
                Includes::userTags,
                Includes::rating,
                Includes::userRating,
            ],
            MusicBrainz::CALL_TYPE_BROWSE => [],
            MusicBrainz::CALL_TYPE_SEARCH => [],
        ];
    }

    public function config()
    {
        return [
            'work-offset' => 'workOffset',
            'work-count' => 'workCount',
            'works' => [
                'class' => Work::class,
                'multiple' => true
            ],
            'aliases' => [
                'class' => Alias::class,
                'multiple' => true
            ],
        ];
    }
}
