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
$data = $mb->lookup(\MusicBrainz\models\EntityType::artist, 'ad102038-c2a1-4c6b-856f-f671254de54f', [\MusicBrainz\models\Includes::artistcredits, \MusicBrainz\models\Includes::releases,]);
var_dump($data);
