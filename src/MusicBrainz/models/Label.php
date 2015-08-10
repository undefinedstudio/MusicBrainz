<?php

namespace MusicBrainz\models;

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
