<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$mb = new \MusicBrainz\MusicBrainz();
$mb->setUserAgent('EternityMBLibrary', '0.0.1', 'luca.horn@gmail.com');
//var_dump($mb->isValidEntityType('artist'));

//$test = new \MusicBrainz\CallOptions();
//var_dump($test->get());

$co = new \MusicBrainz\models\CallOptions();
$co->authRequired = false;
/** @var \MusicBrainz\models\Artist $data */
$data = $mb->lookup(\MusicBrainz\models\EntityType::artist, '5b11f4ce-a62d-471e-81fc-a69a8278c7da', [\MusicBrainz\models\Includes::releasegroups]);
var_dump($data);


