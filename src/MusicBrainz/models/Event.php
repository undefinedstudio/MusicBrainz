<?php

namespace MusicBrainz\models;

/**
 * @property string $time
 * @property string $id
 * @property LifeSpan $lifeSpan
 * @property string $disambiguation
 * @property string $type
 * @property string $name
 * @property boolean $cancelled
 * @property string[] $setlist
 * @property Alias[] $aliases
 * @property string $annotation
 * @property Tag[] $tags
 * @property Rating $rating
 * @property UserTag[] $userTags
 * @property UserRating $userRating
 */
class Event extends ParserModel
{
    public function config()
    {
        return [
            'life-span' => [
                'name' => 'lifeSpan',
                'class' => LifeSpan::class,
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
