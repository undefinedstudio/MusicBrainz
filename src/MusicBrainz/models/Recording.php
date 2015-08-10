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
 * @property Release[] $releases
 * @property Alias[] $aliases
 * @property string $annotation
 * @property Tag[] $tags
 * @property Rating $rating
 * @property UserTag[] $userTags
 * @property UserRating $userRating
 *
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
            'releases' => [
                'class' => Release::class,
                'multiple' => true
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
            'user-tags' => [
                'name' => 'userTags',
                'class' => UserTag::class,
                'multiple' => true
            ],
            'user-rating' => [
                'name' => 'userRating',
                'class' => UserRating::class,
            ],
        ];
    }


}
