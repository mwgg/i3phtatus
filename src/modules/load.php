<?php
    /**
     *
     * Returns average system load.
     * Mode 0 for avg over 1 min, Mode 1 for 5 min, Mode 2 for 15 min,
     * Mode "all" for all three.
     *
     */
    function module_load($module_options) {
        $load = sys_getloadavg();
        if ($module_options["mode"] == "all") {
            return $load[0] ."/". $load[1] ."/". $load[2];
        }
        else {
            return $load[$module_options["mode"]];
        }
    }
?>
