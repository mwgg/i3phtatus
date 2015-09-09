<?php
    function module_clock($module_options) {
	date_default_timezone_set($module_options["timezone"]);
        return date($module_options["format"], time());
    }
?>
