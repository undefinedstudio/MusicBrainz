<?php

namespace undefinedstudio\MusicBrainz\models;
use undefinedstudio\MusicBrainz\MusicBrainz;

/**
 * @property string $id
 * @property string $sortName
 * @property Area $area
 * @property array $ipis
 * @property integer $labelCode
 * @property LifeSpan $lifeSpan
 * @property string $country
 * @property string $disambiguation
 * @property string $type
 * @property string $name
 *
 * @property Release[] $releases
 * @property Alias[] $aliases
 * @property string $annotation
 * @property Tag[] $tags
 * @property Rating $rating
 * @property UserTag[] $userTags
 * @property UserRating $userRating
 */
class Label extends ParserModel
{
    public static function includes()
    {
        return [
            MusicBrainz::CALL_TYPE_LOOKUP => [
                Includes::releases,
                Includes::aliases,
                Includes::annotation,
                Includes::tags,
                Includes::userTags,
                Includes::rating,
                Includes::userRating,
                Includes::media,
                Includes::artistCredits,
                Includes::discs
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
            EntityType::release
        ];
    }

    public function config()
    {
        return [
            'label-code' => 'labelCode',
            'sort-name' => '$sortName',
            'life-span' => [
                'name' => 'lifeSpan',
                'class' => LifeSpan::class
            ],
            'area' => [
                'class' => Area::class,
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
