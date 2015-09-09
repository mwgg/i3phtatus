<?php
    $config = array(
        "refresh" => 1000,
        "separator" => " | ",
        "modules" => array(
//          "cmus" => array(),
//          "metar" => array(
//              "icao" => "UUWW",
//              "refresh" => "600"
//          ),
            "uname" => array(
                "mode" => "r"
            ),
            "load" => array(
                "mode" => 0
            ),
            "clock" => array(
                "format" => "D d M y H:i:s",
                "timezone" => "Europe/Moscow"
            )
        )
    );
?>
