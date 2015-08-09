<?php

namespace MusicBrainz\models;

/**
 * @property Release[] $releases
 * @property integer $sectors
 * @property string $id
 * @property integer $offsetCount
 * @property array $offsets
 */
class Disc extends ParserModel
{
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
