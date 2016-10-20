<?php

    function module_metar($module_options)
    {
        global $module_tmp;
        if (!isset($module_tmp['metar'][$module_options['icao']]['updated']) ||
                (time() - $module_tmp['metar'][$module_options['icao']]['updated']) > $module_options['refresh']) {
            $url = 'http://tgftp.nws.noaa.gov/data/observations/metar/stations/'.strtoupper($module_options['icao']).'.TXT';
            $metar = file_get_contents($url);
            $module_tmp['metar'][$module_options['icao']]['updated'] = time();
            if ($metar !== false) {
                $metar = explode("\n", $metar);
                $module_tmp['metar'][$module_options['icao']]['metar'] = $metar[1];
            } else {
                $module_tmp['metar'][$module_options['icao']]['metar'] = 'METAR N/A';
            }
        }

        return array(
            'full_text' => $module_tmp['metar'][$module_options['icao']]['metar'],
        );
    }
