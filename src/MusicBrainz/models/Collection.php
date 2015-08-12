<?php

namespace MusicBrainz\models;
use MusicBrainz\MusicBrainz;

/**
 * @property string $id
 * @property string $name
 * @property string $editor
 * @property string $type
 * @property string $entityType
 * @property integer $releaseCount
 */
class Collection extends ParserModel
{
    public function config()
    {
        return [
            'entity-type' => 'entityType',
            'release-count' => 'releaseCount',
        ];
    }
}
