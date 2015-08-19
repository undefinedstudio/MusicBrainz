<?php

namespace undefinedstudio\MusicBrainz\models;

/**
 * @property integer $trackCount
 * @property integer $trackOffset
 * @property integer $position
 * @property string $format
 * @property string $title
 * @property Disc[] $discs
 * @property Track[] $tracks
 */
class Media extends ParserModel
{
    public function config()
    {
        return [
            'track-count' => 'trackCount',
            'track-offset' => 'trackOffset',
            'discs' => [
                'class' => Disc::class,
                'multiple' => true
            ],
            'tracks' => [
                'class' => Track::class,
                'multiple' => true
            ],
        ];
    }
}
