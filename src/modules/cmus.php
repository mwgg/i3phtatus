<?php
    function module_cmus_sec2min($seconds) {
        $hours = floor($seconds / (60 * 60));
        $divisor_for_minutes = $seconds % (60 * 60);
        $minutes = floor($divisor_for_minutes / 60);
        $divisor_for_seconds = $divisor_for_minutes % 60;
        $seconds = ceil($divisor_for_seconds);
        if ($hours > 0) {
            return $hours .":". sprintf('%02d', $minutes) .":". sprintf('%02d', $seconds);
        }
        else {
            return sprintf('%02d', $minutes) .":". sprintf('%02d', $seconds);
        }
    }

    function module_cmus($module_options) {
        $module_output = "";
        $cmus_status = "";
        $artist = "";
        $title = "";
        $pos = "0:0";
        $dur = "0:0";
        $cmus_exec = exec("cmus-remote -Q", $cmus_status);
        foreach($cmus_status as $line) {
            if (substr($line, 0, 8) == "position") {
                $pos = module_cmus_sec2min(substr($line, 9));
            }           
            if (substr($line, 0, 8) == "duration") {
                $dur = module_cmus_sec2min(substr($line, 9));
            }
            if (substr($line, 0, 6) == "status") {
                $status = substr($line, 7);
            }
            elseif (substr($line, 0, 9) == "tag title") {
                $title = substr($line, 10);
            }
            elseif (substr($line, 0, 10) == "tag artist") {
                $artist = substr($line, 11);
            }
        }
        if ( $status == "stopped" ) {
            $module_output = "◾ ";
        }
        elseif ( $status == "paused" ) {
            $module_output = "▮▮ ";
        }
        elseif ( $status == "playing" ) {
            $module_output = "▶ ";
        }
        $module_output .= "[". $pos ."/". $dur ."] ". $artist ." - ". $title;
        return $module_output;
    }
?>
