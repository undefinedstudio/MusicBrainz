<?php

namespace undefinedstudio\MusicBrainz\models;
use undefinedstudio\MusicBrainz\MusicBrainz;

/**
 * @property string $time
 * @property string $id
 * @property LifeSpan $lifeSpan
 * @property string $disambiguation
 * @property string $type
 * @property string $name
 * @property boolean $cancelled
 * @property string $setlist
 *
 * @property Alias[] $aliases
 * @property string $annotation
 * @property Tag[] $tags
 * @property Rating $rating
 * @property UserTag[] $userTags
 * @property UserRating $userRating
 */
class Event extends ParserModel
{
    public static function includes()
    {
        return [
            MusicBrainz::CALL_TYPE_LOOKUP => [
                Includes::aliases,
                Includes::annotation,
                Includes::tags,
                Includes::userTags,
                Includes::rating,
                Includes::userRating,
            ],
            MusicBrainz::CALL_TYPE_BROWSE => [
                Includes::aliases,
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
            EntityType::area,
            EntityType::artist,
            EntityType::place
        ];
    }

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
