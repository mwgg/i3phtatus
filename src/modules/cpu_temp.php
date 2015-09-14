<?php

    function module_cpu_temp($module_options)
    {
        global $config;
        $temp_output = array();
        $ip_exec = exec('cat /sys/class/thermal/thermal_zone0/temp', $temp_output);
        if (isset($temp_output[0])) {
            $temp = floor($temp_output[0] / 1000);
            if ($temp >= $module_options['alert']) {
                $color = $config['color_bad'];
            } else {
                $color = $config['color_good'];
            }
        } else {
            $temp = 'N/A';
        }

        return array(
            'full_text' => $temp,
            'color' => $color,
        );
    }
