<?php

    function module_uname($module_options)
    {
        return array(
            'full_text' => php_uname($module_options['mode']),
        );
    }
