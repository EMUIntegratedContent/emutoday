<?php
namespace Emutoday\Http\Utilities;

class SeasonList
{
    protected static $seasonList = [
    "Spring"=>"Spring",
    "Summer"=>"Summer",
    "Fall"=>"Fall",
    "Winter"=>"Winter",
    "Other"=>"Other"
    ];

    public static function all()
    {
        return static::$seasonList;
    }

}
