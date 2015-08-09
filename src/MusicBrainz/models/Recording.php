<?php

namespace MusicBrainz\models;

/**
 * @property string $id
 * @property string $title
 * @property integer $video
 * @property integer $length
 * @property string $disambiguation
 * @property array $isrcsIds
 * @property ArtistCredit[] $artistCredits
 */
class Recording extends ParserModel
{
    public function config()
    {
        return [
            'isrcs' => 'isrcsIds',
            'artist-credit' => [
                'name' => 'artistCredits',
                'class' => ArtistCredit::class,
                'multiple' => true
            ],
        ];
    }


}
