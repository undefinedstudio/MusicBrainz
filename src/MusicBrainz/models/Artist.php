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
            ]
        ];
    }
}
