<?php

namespace undefinedstudio\MusicBrainz\models;

/**
 * @property integer $length
 * @property string $number
 * @property string $id
 * @property string $title
 * @property Recording $recording
 * @property ArtistCredit[] $artistCredit
 */
class Track extends ParserModel
{
    public function config()
    {
        return [
            'recording' => [
                'class' => Recording::class
            ],
            'artist-credit' => [
                'name' => 'artistCredit',
                'class' => ArtistCredit::class,
                'multiple' => true
            ],
        ];
    }
}
