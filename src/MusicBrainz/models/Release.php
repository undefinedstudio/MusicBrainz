<?php

namespace MusicBrainz\models;

/**
 * @property string $id
 * @property string $title
 * @property string $asin
 * @property string $barcode
 * @property string $disambiguation
 * @property string $packaging
 * @property string $quality
 * @property string $date
 * @property string $status
 * @property string $country
 * @property ReleaseEvent[] $releaseEvents
 * @property TextRepresentation[] $textRepresentation
 */
class Release extends ParserModel
{
    public function config()
    {
        return [
            'release-events' => [
                'name' => 'releaseEvents',
                'class' => ReleaseEvent::class,
                'multiple' => true
            ],
            'text-representation' => [
                'name' => 'textRepresentation',
                'class' => TextRepresentation::class
            ]
        ];
    }
}
