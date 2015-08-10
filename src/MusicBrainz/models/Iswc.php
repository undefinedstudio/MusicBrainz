<?php

namespace MusicBrainz\models;

/**
 * @property integer $workOffset
 * @property integer $workCount
 * @property Work[] $works
 * @property Alias[] $aliases
 */
class Iswc extends ParserModel
{
    public function config()
    {
        return [
            'work-offset' => 'workOffset',
            'work-count' => 'workCount',
            'works' => [
                'class' => Work::class,
                'multiple' => true
            ],
            'aliases' => [
                'class' => Alias::class,
                'multiple' => true
            ],
        ];
    }
}
