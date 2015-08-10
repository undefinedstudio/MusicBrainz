<?php

namespace MusicBrainz\models;

/**
 * @property Label $label
 * @property string $catalogNumber
 */
class LabelInfo extends ParserModel
{
    public function config()
    {
        return [
            'catalog-number' => 'catalogNumber',
            'label' => [
                'class' => Label::class
            ],
        ];
    }
}
