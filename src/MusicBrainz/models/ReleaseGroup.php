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
 * @property Release[] $releases
 * @property Alias[] $aliases
 * @property string $annotation
 * @property Tag[] $tags
 * @property Rating $rating
 * @property UserRating $userRating
 * @property UserTag[] $userTags
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
            'releases' => [
                'class' => Release::class,
                'multiple' => true
            ],
            'tags' => [
                'class' => Tag::class,
                'multiple' => true
            ],
            'rating' => [
                'class' => Rating::class
            ],
            'user-rating' => [
                'name' => 'userRating',
                'class' => UserRating::class,
            ],
            'user-tags' => [
                'name' => 'userTags',
                'class' => UserTag::class,
                'multiple' => true
            ],
        ];
    }
}
