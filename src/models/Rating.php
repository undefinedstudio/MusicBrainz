<?php

namespace undefinedstudio\MusicBrainz\models;

/**
 * @property float $value
 * @property integer $votesCount
 */
class Rating extends ParserModel
{
    public function config()
    {
        return [
            'votes-count' => 'votesCount',
        ];
    }


}
