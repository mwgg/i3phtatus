<?php
    $config = array(
        "refresh" => 1000,
        "color_good" => "#00ff00",
        "color_bad" => "#ff0000",
        "modules" => array(
//          "cmus" => array(
//              "module" => "cmus"
//          ),
//          "metar" => array(
//              "module" => "metar",
//              "icao" => "UUWW",
//              "refresh" => "600"
//          ),
//          "uname" => array(
//              "module" => "uname",
//              "mode" => "r"
//          ),
            "wlp1s0" => array(
                "module" => "ip",
                "interface" => "wlp1s0"
            ),
            "enp0s20u1" => array(
                "module" => "ip",
                "interface" => "enp0s20u1"
            ),
            "tun0" => array(
                "module" => "ip",
                "interface" => "tun0"
            ),
            "amixer_volume" => array(
                "module" => "amixer_volume",
                "mode" => "percent"
            ),
            "amixer_volume_bar" => array(
                "module" => "amixer_volume",
                "mode" => "bar",
                "width" => 10
            ),
            "load" => array(
                "module" => "load",
                "mode" => 0,
                "label" => "load: "
            ),
            "clock" => array(
                "module" => "clock",
                "format" => "D d M y H:i:s",
                "timezone" => "Europe/Moscow"
            )
        )
    );
?>
