<?php

$help  = "i3phtatus is a replacement for i3status and outputs data in JSON format, compatible with i3bar\n\n";
$help .= "Options:\n";
$help .= "-c <config_file>  Allows using a specified config file instead of the default ~/.i3/i3phtatus.conf.php\n";

$shortopts  = "";
$shortopts .= "h::"; // help
$shortopts .= "c:"; // config

$options = getopt($shortopts);

if ( isset($options["h"]) ) {
    die($help);
}
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
    die( sprintf("Config file \"%s\" not found!\n\n%s",$config_file, $help) );
}

foreach (glob( dirname(__FILE__) . "/modules/*.php" ) as $module_file) { require_once($module_file); }

$module_tmp = array();
echo '{ "version": 1 }' . "\n";
echo "[\n";
while(true){
    $output = array();
    foreach ($config["modules"] as $module_name => $module_options) {
        $output[] = json_encode(call_user_func("module_".$module_options["module"], $module_options));
    }
    echo "[". implode(",", $output) ."],\n";
    usleep($config["refresh"] * 1000);
}

?>
