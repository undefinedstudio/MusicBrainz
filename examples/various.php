<?php


require dirname(__DIR__) . '/vendor/autoload.php';

$mb = new \MusicBrainz\MusicBrainz();
$mb->setUserAgent('EternityMBLibrary', '0.0.1', 'luca.horn@gmail.com');
//var_dump($mb->isValidEntityType('artist'));

//$test = new \MusicBrainz\CallOptions();
//var_dump($test->get());

$co = new \MusicBrainz\CallOptions();
$co->authRequired = false;
$json = $mb->call('artist/53b106e7-0cc6-42cc-ac95-ed8d30a3a98e', [], $co);
var_dump($json);