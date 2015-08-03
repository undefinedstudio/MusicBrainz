<?php

namespace MusicBrainz\models;

class Area extends ParserModel
{
    public $id;
    public $name;
    public $sortName;
    public $disambiguation;
    /**
     * Iso 3166-1 Codes
     * @var array
     */
    public $iso1;
    /**
     * Iso 3166-2 Codes
     * @var array
     */
    public $iso2;
    /**
     * Iso 3166-3 Codes
     * @var array
     */
    public $iso3;

    public function parseData($data) {
        $this->id = $data->id;
        $this->name = $data->name;
        $this->sortName = $data->{'sort-name'};
        $this->disambiguation = $data->disambiguation;
        $this->iso1 = $data->iso_3166_1_codes;
        $this->iso2 = $data->iso_3166_2_codes;
        $this->iso3 = $data->iso_3166_3_codes;
    }
}
