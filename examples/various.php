<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use MusicBrainz\MusicBrainz;
use MusicBrainz\models\Includes;


$mb = new MusicBrainz();
$mb->setUserAgent('EternityMBLibrary', '0.0.1', 'luca.horn@gmail.com');

/** @var \MusicBrainz\models\Artist $data */
$data = $mb->lookup(
    \MusicBrainz\models\EntityType::release,
    '7382162d-6b74-35f5-a5fc-a2b365991b7c',
    [
        Includes::isrcs,
        Includes::recordings
    ]);

var_dump($data);
