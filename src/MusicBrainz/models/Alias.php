<?php

namespace MusicBrainz\models;

/**
 * @property string $type
 * @property string $primary
 * @property string $name
 * @property string $sortName
 * @property string $locale
 */
class Alias extends ParserModel
{
    public function config()
    {
        return [
            'sort-name' => 'sortName',
        ];
    }


}
