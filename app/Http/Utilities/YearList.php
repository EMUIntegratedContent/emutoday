<?php
namespace Emutoday\Http\Utilities;

class YearList
{
    protected static $yearList = [
        "2020"                              => "2020",
        "2019"                              => "2019",
    "2018"                              => "2018",
        "2017"                              => "2017",
    "2016"                              => "2016",
        "2015"                              => "2015",
    "2014"                              => "2014",
        "2013"                              => "2013",
    "2012"                              => "2012",
        "2011"                              => "2011",
    "2010"                              => "2010"

    ];

    public static function all()
    {
        return static::$yearList;
    }

}
