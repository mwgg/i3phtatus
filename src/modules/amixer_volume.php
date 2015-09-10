<?php
    function module_amixer_volume($module_options) {
        $amixer_output = array();
        $amixer_exec = exec("amixer | grep 'Front Left: Playback'", $amixer_output);
        $percent = substr( $amixer_output[0], strpos($amixer_output[0], "[")+1, strpos($amixer_output[0], "]")-strpos($amixer_output[0], "[")-1 );
        return array(
            "full_text" => $percent
        );
    }
?>
