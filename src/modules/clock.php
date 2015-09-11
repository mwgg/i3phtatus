<?php
    function module_clock($module_options)
    {
        date_default_timezone_set($module_options['timezone']);

        return array(
            'full_text' => date($module_options['format'], time()),
        );
    }
