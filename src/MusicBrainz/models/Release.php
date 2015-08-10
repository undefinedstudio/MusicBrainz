<?php

namespace MusicBrainz\models;

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
 */
class Release extends ParserModel
{
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
        ];
    }
}
