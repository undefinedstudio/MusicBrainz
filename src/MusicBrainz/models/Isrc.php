<?php

namespace MusicBrainz\models;

/**
 * @property Recording[] $recordingList
 */
class Isrc extends ParserModel
{
    // TODO: wait for the bugfix
    // There is a critical bug when calling the Music Brainz webservice with the json format option.
    // Only the xml format works at the moment.
    // Reference: http://tickets.musicbrainz.org/browse/MBS-7921

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
