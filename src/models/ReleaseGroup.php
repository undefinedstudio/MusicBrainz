<?php

namespace undefinedstudio\MusicBrainz\models;
use undefinedstudio\MusicBrainz\MusicBrainz;

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
    public static function includes()
    {
        return [
            MusicBrainz::CALL_TYPE_LOOKUP => [
                Includes::artists,
                Includes::releases,
                Includes::artistCredits,
                Includes::aliases,
                Includes::annotation,
                Includes::tags,
                Includes::userTags,
                Includes::rating,
                Includes::userRating,
                Includes::discs,
                Includes::media
            ],
            MusicBrainz::CALL_TYPE_BROWSE => [
                Includes::aliases,
                Includes::artistCredits,
                Includes::annotation,
                Includes::tags,
                Includes::userTags,
                Includes::rating,
                Includes::userRating,
            ],
            MusicBrainz::CALL_TYPE_SEARCH => [],
        ];
    }

    public static function links()
    {
        return [
            EntityType::artist,
            EntityType::release
        ];
    }

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
