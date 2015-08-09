<?php

namespace MusicBrainz\models;

/**
 * @property string $title
 * @property string $id
 * @property array $attributes
 * @property string $disambiguation
 * @property array $iswcIds
 * @property string $language
 * @property string $type
 */
class Work extends ParserModel
{
    public function config()
    {
        return [
            'iswcs' => 'iswcIds',
        ];
    }
}
