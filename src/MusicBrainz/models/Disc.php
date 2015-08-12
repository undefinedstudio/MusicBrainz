<?php

namespace MusicBrainz\models;
use MusicBrainz\MusicBrainz;

/**
 * @property Release[] $releases
 * @property integer $sectors
 * @property string $id
 * @property integer $offsetCount
 * @property array $offsets
 */
class Disc extends ParserModel
{
    public static function includes()
    {
        return [
            MusicBrainz::CALL_TYPE_LOOKUP => [
                Includes::artists,
                Includes::labels,
                Includes::recordings,
                Includes::releaseGroups,
                Includes::artistCredits,
                Includes::aliases,
                Includes::isrcs
            ],
            MusicBrainz::CALL_TYPE_BROWSE => [],
            MusicBrainz::CALL_TYPE_SEARCH => [],
        ];
    }

    public function config()
    {
        return [
            'offset-count' => 'offsetCount',
            'releases' => [
                'class' => Release::class,
                'multiple' => true
            ],
        ];
    }
}
