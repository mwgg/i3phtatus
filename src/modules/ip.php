<?php
    function module_ip($module_options) {
        global $config;
        $ip_output = "";
        $ip_exec = exec("ip addr show dev ". $module_options["interface"] ." 2> /dev/null | grep 'inet ' | awk '{ print $2 }'", $ip_output);
        if ( isset($ip_output[0]) ) {
            return array(
                "full_text" => $module_options["interface"] .": ". $ip_output[0],
                "color" => $config["color_good"]
            );
        }
        else {
            return array(
                "full_text" => $module_options["interface"],
                "color" => $config["color_bad"]
            );
        }
    }
?>
