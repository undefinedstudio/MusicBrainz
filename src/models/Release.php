<?php

namespace undefinedstudio\MusicBrainz\models;
use undefinedstudio\MusicBrainz\MusicBrainz;

/**
 * @property string $id
 * @property string $title
 * @property string $asin
 * @property string $barcode
 * @property string $disambiguation
 * @property Media[] $media
 * @property string $packaging
 * @property string $quality
 * @property string $date
 * @property string $status
 * @property string $country
 * @property string $annotation
 * @property ReleaseGroup $releaseGroup
 * @property ReleaseEvent[] $releaseEvents
 * @property TextRepresentation[] $textRepresentation
 * @property ArtistCredit[] $artistCredits
 * @property CoverArtArchive $coverArtArchive
 * @property LabelInfo $labelInfo
 * @property Alias[] $aliases
 * @property Tag[] $tags
 * @property Rating $rating
 * @property UserRating $userRating
 * @property UserTag[] $userTags
 * @property Collection[] $collections
 */
class Release extends ParserModel
{
    public static function includes()
    {
        return [
            MusicBrainz::CALL_TYPE_LOOKUP => [
                Includes::artists,
                Includes::labels,
                Includes::recordings,
                Includes::releaseGroups,
                Includes::aliases,
                Includes::tags,
                Includes::userTags,
                Includes::rating,
                Includes::userRating,
                Includes::collections,
                Includes::artistCredits,
                Includes::discs,
                Includes::media,
                Includes::annotation,
                Includes::isrcs
            ],
            MusicBrainz::CALL_TYPE_BROWSE => [
                Includes::aliases,
                Includes::artistCredits,
                Includes::labels,
                Includes::recordings,
                Includes::discs,
                Includes::releaseGroups,
                Includes::media,
                Includes::annotation,
                Includes::isrcs,
            ],
            MusicBrainz::CALL_TYPE_SEARCH => [],
        ];
    }

    public static function links()
    {
        return [
            EntityType::area,
            EntityType::artist,
            EntityType::label,
            EntityType::recording,
            EntityType::releaseGroup,
            EntityType::track,
        ];
    }

    public function config()
    {
        return [
            'release-events' => [
                'name' => 'releaseEvents',
                'class' => ReleaseEvent::class,
                'multiple' => true
            ],
            'text-representation' => [
                'name' => 'textRepresentation',
                'class' => TextRepresentation::class
            ],
            'media' => [
                'class' => Media::class,
                'multiple' => true
            ],
            'label-info' => [
                'name' => 'labelInfo',
                'class' => LabelInfo::class,
                'multiple' => true
            ],
            'artist-credit' => [
                'name' => 'artistCredits',
                'class' => ArtistCredit::class,
                'multiple' => true
            ],
            'cover-art-archive' => [
                'name' => 'coverArtArchive',
                'class' => CoverArtArchive::class,
            ],
            'release-group' => [
                'name' => 'releaseGroup',
                'class' => ReleaseGroup::class,
            ],
            'aliases' => [
                'class' => Alias::class,
                'multiple' => true
            ],
            'tags' => [
                'class' => Tag::class,
                'multiple' => true
            ],
            'rating' => [
                'class' => Rating::class,
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
            'collections' => [
                'class' => Collection::class,
                'multiple' => true
            ],
        ];
    }
}
