<?php

namespace MusicBrainz\models;

/**
 * @property Recording[] $recordingList
 */
class Isrc extends ParserModel
{
    //TODO: There is a bug when calling the Music Brainz webservice with the json format option, at the moment only the xml format works
    //http://tickets.musicbrainz.org/browse/MBS-7921

    public function config()
    {
        return [
            'recording-list' => [
                'name' => 'recordingList',
                'class' => Recording::class,
                'multiple' => true
            ],
        ];
    }
}
