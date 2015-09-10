<?php
    function module_battery($module_options) {
        global $config;
        $module_output = "";
        $status = array();
        $charge_now = array();
        $charge_full = array();
        $status_exec = exec("cat /sys/class/power_supply/BAT0/status", $status);
        $charge_now_exec = exec("cat /sys/class/power_supply/BAT0/charge_now", $charge_now);
        $charge_full_exec = exec("cat /sys/class/power_supply/BAT0/charge_full", $charge_full);

        if ( $status[0] === "Full" ) {
            $percent = 100;
            $color = $config["color_good"];
        }
        else {
            $percent = round($charge_now[0] * 100 / $charge_full[0]);
        }

        if ( $status[0] === "Discharging" && $percent > 10 ) {
            $color = $config["color_warn"];
        }
        if ( $status[0] === "Discharging" && $percent < 10 ) {
            $color = $config["color_bad"];
        }
        elseif ( $status[0] === "Charging" ) {
            $color = $config["color_good"];
        }

        if ( $module_options["mode"] === "percent" ) {
            $module_output = $percent ."%";
        }
        elseif ( $module_options["mode"] === "bar" ) {
            $bars = $percent * $module_options["width"] / 100;
            $module_output = "-". str_pad("", $bars, "|") . str_pad("", floor($module_options["width"]) - floor($bars), " ") ."-";
        }
        return array(
            "full_text" => $module_output,
            "color" => $color
        );
    }
?>
