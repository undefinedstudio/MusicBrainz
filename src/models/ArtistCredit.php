<?php

namespace undefinedstudio\MusicBrainz\models;

/**
 * @property string $joinphrase
 * @property string $name
 * @property Artist $artist
 */
class ArtistCredit extends ParserModel
{
    public function config()
    {
        return [
            'artist' => [
                'class' => Artist::class,
            ]
        ];
    }
}
