<?php
namespace Emutoday\Http\Utilities;

class PageTemplates
{
    protected static $pageTemplates = [
        "EMU Today Home"                              => "homeemutoday",
        "News Home"                                   => "homenews",
        "Student Profile Home"                        => "homestudent",
        "Magazine Home"                               => "homemagazine"
    ];

    public static function all()
    {
        return static::$pageTemplates;
    }

}
