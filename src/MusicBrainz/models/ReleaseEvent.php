<?php

namespace MusicBrainz\models;

/**
 * @property Area $area
 * @property string $date
 */
class ReleaseEvent extends ParserModel
{
    public function config()
    {
        return [
            'area' => [
                'class' => Area::class
            ]
        ];
    }
}
