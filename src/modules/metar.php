<?php
    function module_metar($module_options) {
        global $module_tmp;
        if ( !isset($module_tmp["metar"]["updated"]) || (time() - $module_tmp["metar"]["updated"]) > $module_options["refresh"] ) {
            $url = "http://weather.noaa.gov/pub/data/observations/metar/stations/".strtoupper($module_options["icao"]).".TXT";
            $metar = file_get_contents($url);
            $module_tmp["metar"]["updated"] = time();
            if ( $metar !== false ) {
                $metar = explode("\n", $metar);
                $module_tmp["metar"]["metar"] = $metar[1];
            }
            else {
                $module_tmp["metar"]["metar"] = "METAR N/A";
            }
        }
        return array(
            "full_text" => $module_tmp["metar"]["metar"]
        );
    }
?>
