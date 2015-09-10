<?php
    function module_amixer_volume($module_options) {
        $module_output = "";
        $amixer_output = array();
        $amixer_exec = exec("amixer | grep 'Front Left: Playback'", $amixer_output);
        $percent = substr( $amixer_output[0], strpos($amixer_output[0], "[")+1, strpos($amixer_output[0], "]")-strpos($amixer_output[0], "[")-1 );
        if ( $module_options["mode"] === "percent" ) {
            $module_output = $percent;
        }
        elseif ( $module_options["mode"] === "bar" ) {
            $percent = str_replace("%", "", $percent);
            $bars = $percent * $module_options["width"] / 100;
            $module_output = "-". str_pad("", $bars, "|") . str_pad("", $module_options["width"] - $bars, " ") ."-";
        }
        return array(
            "full_text" => $module_output
        );
    }
?>
