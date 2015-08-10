<?php

namespace MusicBrainz\models;

/**
 * @property integer $length
 * @property string $number
 * @property string $id
 * @property string $title
 * @property Recording $recording
 */
class Track extends ParserModel
{
    public function config()
    {
        return [
            'recording' => [
                'class' => Recording::class
            ],
        ];
    }
}
