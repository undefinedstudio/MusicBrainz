<?php

namespace MusicBrainz\models;

/**
 * @property string $type
 * @property string $disambiguation
 * @property string $description
 * @property string $name
 * @property string $id
 * @property string $annotation
 * @property Alias[] $aliases
 * @property Tag[] $tags
 * @property UserTag[] $userTags
 */
class Instrument extends ParserModel
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
