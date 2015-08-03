<?php

namespace MusicBrainz\models;

class Artist extends ParserModel
{
    public $id;
    public $name;
    public $sortName;
    public $type;
    public $disambiguation;
    public $country;
    /**
     * Numbers assigned to each Interested Party in musical rights management.
     * @var array
     * @link https://musicbrainz.org/doc/IPI
     */
    public $ipis;
    /**
     * @var Area
     */
    public $area;
    /**
     * @var Area
     */
    public $beginArea;
    /**
     * @var Area
     */
    public $endArea;
    /**
     * @var LifeSpan;
     */
    public $lifeSpan;

    public function parseData($data) {
        $this->id = $data->id;
        $this->name = $data->name;
        $this->sortName = $data->{'sort-name'};
        $this->type = $data->type;
        $this->disambiguation = $data->disambiguation;
        $this->country = $data->country;
        $this->ipis = $data->ipis;
        $this->area = Area::create($data->area);
        $this->beginArea = Area::create($data->begin_area);
        $this->endArea = Area::create($data->end_area);
        $this->lifeSpan = LifeSpan::create($data->{'life-span'});
    }
}
