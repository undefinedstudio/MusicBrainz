<?php

namespace MusicBrainz\models;
use MusicBrainz\MusicBrainz;

/**
 * @property Recording[] $recordingList
 */
class Isrc extends ParserModel
{
    // TODO: wait for the bugfix
    // There is a critical bug when calling the Music Brainz webservice with the json format option.
    // Only the xml format works at the moment.
    // Reference: http://tickets.musicbrainz.org/browse/MBS-7921

    public static function includes()
    {
        return [
            MusicBrainz::CALL_TYPE_LOOKUP => [
                Includes::artists,
                Includes::releases,
                Includes::isrcs,
                Includes::artistCredits,
                Includes::aliases,
                Includes::tags,
                Includes::userTags,
                Includes::rating,
                Includes::userRating,
                Includes::media,
                Includes::discs,
            ],
            MusicBrainz::CALL_TYPE_BROWSE => [],
            MusicBrainz::CALL_TYPE_SEARCH => [],
        ];
    }

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
