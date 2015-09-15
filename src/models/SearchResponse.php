<?php

namespace undefinedstudio\MusicBrainz\models;

/**
 * @property string $created
 * @property integer $count
 * @property integer $offset
 *
 * @property Recording[] $recordings
 *
 *
 *
 *
 *
 *
 * @property integer $artistCount
 * @property integer $artistOffset
 * @property Artist[] $artists
 *
 * @property integer $eventCount
 * @property integer $eventOffset
 * @property Event[] $events
 *
 * @property integer $instrumentCount
 * @property integer $instrumentOffset
 * @property Instrument[] $instruments
 *
 * @property integer $labelCount
 * @property integer $labelOffset
 * @property Label[] $labels
 *
 * @property integer $placeCount
 * @property integer $placeOffset
 * @property Place[] $places
 *
 * @property integer $releaseCount
 * @property integer $releaseOffset
 * @property Release[] $releases
 *
 * @property integer $releaseGroupCount
 * @property integer $releaseGroupOffset
 * @property ReleaseGroup[] $releaseGroups
 *
 * @property integer $workCount
 * @property integer $workOffset
 * @property Work[] $works
 *
 */
class SearchResponse extends ParserModel
{
    public function config()
    {
        return [
            /*
            'artist-count' => 'artistCount',
            'artist-offset' => 'artistOffset',
            'artists' => [
                'class' => Artist::class,
                'multiple' => true
            ],

            'event-count' => 'eventCount',
            'event-offset' => 'eventOffset',
            'events' => [
                'class' => Event::class,
                'multiple' => true
            ],

            'instrument-count' => 'instrumentCount',
            'instrument-offset' => 'instrumentOffset',
            'instruments' => [
                'class' => Instrument::class,
                'multiple' => true
            ],

            'label-count' => 'labelCount',
            'label-offset' => 'labelOffset',
            'labels' => [
                'class' => Label::class,
                'multiple' => true
            ],

            'place-count' => 'placeCount',
            'place-offset' => 'placeOffset',
            'places' => [
                'class' => Place::class,
                'multiple' => true
            ],

            'recording-count' => 'recordingCount',
            'recording-offset' => 'recordingOffset',
            'recordings' => [
                'class' => Recording::class,
                'multiple' => true
            ],

            'release-count' => 'releaseCount',
            'release-offset' => 'releaseOffset',
            'releases' => [
                'class' => Release::class,
                'multiple' => true
            ],

            'release-group-count' => 'releaseGroupCount',
            'release-group-offset' => 'releaseGroupOffset',
            'release-groups' => [
                'class' => ReleaseGroup::class,
                'multiple' => true
            ],

            'work-count' => 'workCount',
            'work-offset' => 'workOffset',
            'works' => [
                'class' => Work::class,
                'multiple' => true
            ],*/
            'recordings' => [
                'class' => Recording::class,
                'multiple' => true
            ],
            'releases' => [
                'class' => Release::class,
                'multiple' => true
            ],
            'artists' => [
                'class' => Release::class,
                'multiple' => true
            ],
        ];
    }
}
