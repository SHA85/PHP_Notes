<?php
    // 2021-08-19T19:20:30Z

    echo "Hello Singapore Time to UTC(GMT)<br/>";
    //echo gmdate('Y-m-d H:i:s', strtotime("2014-06-26 12:00:00"));
    $time = '2015-10-02 16:34:00+08';
    $date = DateTime::createFromFormat('Y-m-d H:i:s+O', $time);
    // print $date->format('Y-m-d H:i:s') . PHP_EOL;
    // echo "<br/>";
    // $date->setTimeZone(new DateTimeZone('Asia/Singapore'));
    // print $date->format('Y-m-d H:i:s O') . PHP_EOL;
    // echo "<br/>";
    $date->setTimeZone(new DateTimeZone('Etc/UTC'));
    print $date->format('Y-m-d\TH:i:s\Z') . PHP_EOL;
    echo "<br/>";


    /* 
     * https://www.aos.wisc.edu/~hopkins/aos100/z-time.htm
     * https://www.utctime.net/z-time-now
     * 
     * Ref Since the collection and exchange of weather information are of international concern, 
     * use of a single, systematic time keeping scheme is a necessity. By international agreement, 
     * the reported times for essentially all meteorological reports are given according to 
     * Universal Coordinated Time (UTC), which has replaced the previously used Greenwich Mean Time (GMT). 
     * GMT time is also referred to as "Z" or, phonetically, "Zulu" time, for the letter identifying that time zone 
     * centered on the Greenwich Prime Meridian (See the time zone labels 
     * along the top of the accompanying World Map of Time Zones).  
     * Essentially all the maps that you will encounter in this course will be identified in Z time.
     * 
     * This document focuses upon how to convert from your local civil time to Z time, and vice versa. 
     * Before we can compare the local time that we normally use in our everyday lives with Z or UTC times,
     * we will need to look at the concept of civil time zones. 
    */
?>