<?php

namespace MusicBrainz;

use ReflectionClass;

class Utilities
{
    public static function isValidEntityType($entityType)
    {
        $constants = self::getClassConstants(EntityType::class);
        return array_key_exists($entityType, $constants);
    }

    public static function isValidCallType($callType)
    {
        $constants = self::getClassConstants(CallType::class);
        return array_key_exists($callType, $constants);
    }

    public static function isValidMbid($mbid)
    {
        return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $mbid);
    }

    public static function getClassConstants($class) {
        $reflectionClass = new ReflectionClass($class);
        return $reflectionClass->getConstants();
    }
}