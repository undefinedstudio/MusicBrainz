<?php

namespace MusicBrainz\models;

class LifeSpan extends ParserModel
{
    public $ended;
    public $begin;
    public $end;

    public function parseData($data) {
        $this->ended = $data->ended;
        $this->begin = $data->begin;
        $this->end = $data->end;
    }
}
