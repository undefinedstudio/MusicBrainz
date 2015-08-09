<?php

namespace MusicBrainz\models;

/**
 * @property integer $trackCount
 * @property integer $position
 * @property string $format
 * @property string $title
 * @property Disc[] $discs
 */
class Media extends ParserModel
{
    public function config()
    {
        return [
            'track-count' => 'trackCount',
            'discs' => [
                'class' => Disc::class,
                'multiple' => true
            ],
        ];
    }
}
