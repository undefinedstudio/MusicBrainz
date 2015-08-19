<?php

namespace undefinedstudio\MusicBrainz\models;
use undefinedstudio\MusicBrainz\MusicBrainz;

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
    public static function includes()
    {
        return [
            MusicBrainz::CALL_TYPE_LOOKUP => [
                Includes::aliases,
                Includes::annotation,
                Includes::tags,
                Includes::userTags,
                // These actually do nothing.
                Includes::releases,
                Includes::media,
                Includes::discs,
                Includes::artistCredits,
            ],
            MusicBrainz::CALL_TYPE_BROWSE => [
                Includes::aliases,
                Includes::annotation,
                Includes::tags,
                Includes::userTags
            ],
            MusicBrainz::CALL_TYPE_SEARCH => [],
        ];
    }

    public static function links()
    {
        return [
            EntityType::release
        ];
    }

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
