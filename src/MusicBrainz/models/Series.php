<?php

namespace MusicBrainz\models;

/**
 * @property string $id
 * @property string $name
 * @property string $disambiguation
 * @property string $type
 * @property Alias[] $aliases
 * @property Tag[] $tags
 * @property UserTag[] $userTags
 */
class Series extends ParserModel
{
    public function config()
    {
        return [
            'aliases' => [
                'class' => Alias::class,
                'multiple' => true
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
