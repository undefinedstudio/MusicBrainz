<?php

namespace MusicBrainz\models;

/**
 * @property string $id
 * @property string $name
 * @property string $sortName
 * @property string $type
 * @property string $disambiguation
 * @property string $country
 * @property array $ipis musical rights management numbers ({@link https://musicbrainz.org/doc/IPI Documentation}).
 * @property Area $area
 * @property Area $beginArea
 * @property Area $endArea
 * @property LifeSpan $lifeSpan
 * @property Recording[] $recordings
 * @property Release[] $releases
 * @property ReleaseGroup[] $releaseGroups
 * @property Alias[] $aliases
 * @property string $annotation
 * @property Tag[] $tags
 * @property Rating $rating
 * @property UserRating $userRating
 * @property UserTag[] $userTags
 */
class Artist extends ParserModel
{
    public function config()
    {
        return [
            'sort-name' => 'sortName',
            'area' => [
                'class' => Area::class
            ],
            'begin_area' => [
                'name' => 'beginArea',
                'class' => Area::class
            ],
            'end_area' => [
                'name' => 'endArea',
                'class' => Area::class
            ],
            'life-span' => [
                'name' => 'lifeSpan',
                'class' => LifeSpan::class
            ],
            'recordings' => [
                'class' => Recording::class,
                'multiple' => true
            ],
            'releases' => [
                'class' => Release::class,
                'multiple' => true
            ],
            'release-groups' => [
                'name' => 'releaseGroups',
                'class' => ReleaseGroup::class,
                'multiple' => true
            ],
            'works' => [
                'class' => Work::class,
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
