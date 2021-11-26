<?php

namespace App\Helpers;

class UploadsFile
{
    public static $uploadsPath = array(
        'profile_photo'=>'/uploads/profile'
    );

    public static function getUploadsPath($paths)
    {
        return public_path().self::$uploadsPath[$paths];
    }
}
