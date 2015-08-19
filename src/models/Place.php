<?php

namespace undefinedstudio\MusicBrainz\models;
use undefinedstudio\MusicBrainz\MusicBrainz;

/**
 * @property string $id
 * @property string $name
 * @property string $disambiguation
 * @property string $address
 * @property string $type
 * @property Area $area
 * @property Coordinates $coordinates
 * @property LifeSpan $lifeSpan
 */
class Place extends ParserModel
{
    public static function includes()
    {
        return [
            MusicBrainz::CALL_TYPE_LOOKUP => [
                Includes::aliases,
                Includes::annotation,
                Includes::tags,
                Includes::userTags
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
            EntityType::area
        ];
    }

    public function config()
    {
        return [
            'area' => [
                'class' => Area::class,
            ],
            'coordinates' => [
                'class' => Coordinates::class,
            ],
            'life-span' => [
                'name' => 'lifeSpan',
                'class' => LifeSpan::class,
            ],
        ];
    }
}
