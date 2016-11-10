<?php
namespace Emutoday\Http\Utilities;

class PageTemplates
{
    protected static $pageTemplates = [
        "home-emutoday" => "EMU Today Home",
        // "home-student" => "Student Profile", // DISABLED
        // "home-news" => "News Home", // DISABLED
    ];

    public static function all()
    {
        return static::$pageTemplates;
    }

}
