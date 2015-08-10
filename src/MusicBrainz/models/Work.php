<?php

namespace MusicBrainz\models;

/**
 * @property string $title
 * @property string $id
 * @property array $attributes
 * @property string $disambiguation
 * @property array $iswcIds
 * @property string $language
 * @property string $type
 *
 * @property Alias[] $aliases
 * @property string $annotation
 * @property Tag[] $tags
 * @property Rating $rating
 * @property UserRating $userRating
 * @property UserTag[] $userTags
 */
class Work extends ParserModel
{
    public function config()
    {
        return [
            'iswcs' => 'iswcIds',
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
                'class' => UserRating::class
            ],
            'user-tags' => [
                'name' => 'userTags',
                'class' => UserTag::class,
                'multiple' => true
            ]
        ];
    }
}
