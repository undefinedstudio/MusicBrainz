<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use undefinedstudio\MusicBrainz\models\EntityType;
use undefinedstudio\MusicBrainz\MusicBrainz;
use undefinedstudio\MusicBrainz\models\Includes;

$mb = new MusicBrainz();
$mb->setUserAgent('EternityMBLibrary', '0.0.1', 'luca.horn@gmail.com');

$query = '"House by the Sea"';

$data = $mb->search(EntityType::recording, $query);

var_dump($data);
