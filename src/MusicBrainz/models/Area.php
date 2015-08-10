<?php

namespace MusicBrainz\models;

/**
 * @property string $id
 * @property string $name
 * @property string $sortName
 * @property string $disambiguation
 * @property string $type
 * @property string $annotation
 * @property LifeSpan $lifeSpan
 * @property Tag[] $tags
 * @property UserTag[] $userTags
 * @property array $iso1 Iso 3166-1 Codes
 * @property array $iso2 Iso 3166-2 Codes
 * @property array $iso3 Iso 3166-3 Codes
 */
class Area extends ParserModel
{
    public function config()
    {
        return [
            'sort-name' => 'sortName',
            'iso_3166_1_codes' => 'iso1',
            'iso_3166_2_codes' => 'iso2',
            'iso_3166_3_codes' => 'iso3',
            'life-span' => [
                'name' => 'lifeSpan',
                'class' => LifeSpan::class
            ],
            'tags' => [
                'class' => Tag::class,
                'multiple' => true
            ],
            'user-tags' => [
                'name' => 'userTags',
                'class' => UserTag::class,
                'multiple' => true
            ],
        ];
    }
}
