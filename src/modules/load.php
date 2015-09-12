<?php

    /**
     * Returns average system load.
     * Mode 0 for avg over 1 min, Mode 1 for 5 min, Mode 2 for 15 min,
     * Mode "all" for all three.
     */
    function module_load($module_options)
    {
        $module_output = '';
        $load = sys_getloadavg();
        if ($module_options['mode'] === 'all') {
            $module_output = $load[0].'/'.$load[1].'/'.$load[2];
        } else {
            $module_output = (string) $load[$module_options['mode']];
        }

        return array(
            'full_text' => $module_output,
        );
    }
