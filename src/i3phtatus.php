<?php
$shortopts  = "";
$shortopts .= "h::"; // help
$shortopts .= "c:"; // config

$options = getopt($shortopts);

$load = sys_getloadavg();

if ( isset($options["c"]) ) {
    $config_file = $options["c"];
}
else {
    $config_file = getenv("HOME") . "/.i3/i3phtatus.conf.php";
}

if ( file_exists($config_file) ) {
    require_once($config_file);
}
else {
    die( sprintf("Config file \"%s\" not found!\n",$config_file) );
}

foreach (glob( dirname(__FILE__) . "/modules/*.php" ) as $module_file) { require_once($module_file); }

$module_tmp = array();

while(true){
    $output = array();
    foreach ($config["modules"] as $module_name => $module_options) {
        $output[] = call_user_func("module_".$module_name, $module_options);
    }
    echo implode($config["separator"], $output) . "\n";
    usleep($config["refresh"] * 1000);
}

?>