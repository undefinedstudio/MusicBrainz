<?php

namespace MusicBrainz\models;

/**
 * @property string $id
 * @property string $title
 * @property string $primaryType
 * @property string $firstReleaseDate
 * @property string $disambiguation
 * @property array $secondaryTypes
 * @property ArtistCredit[] $artistCredits
 */
class ReleaseGroup extends ParserModel
{
    public function config()
    {
        return [
            'primary-type' => 'primaryType',
            'secondary-types' => 'secondaryTypes',
            'first-release-date' => 'firstReleaseDate',
            'artist-credit' => [
                'name' => 'artistCredits',
                'class' => ArtistCredit::class,
                'multiple' => true
            ],
        ];
    }
}
