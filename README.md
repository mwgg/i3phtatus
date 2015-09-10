# i3phtatus
i3phtatus is an easily extensible i3status replacement meant for i3bar, written in PHP.

<p align="center">
  <img alt="i3phtatus" src="https://i.imgur.com/6GGURq0.png" />
</p>

##Usage

Replace your current "status_command" setting in `~/.i3/config` with i3phtatus:

`status_command php /opt/i3phtatus/i3phtatus.php`

By default, i3phtatus will expect the config file to be at `~/.i3/i3phtatus.conf.php`. If you wish to specify a different location, use the `-c` flag:

`status_command php /opt/i3phtatus/i3phtatus.php -c ~/my_i3phtatus.conf.php`

##Configuration

Configuration is stored in a PHP array. There you can configure the refresh rate (in milliseconds before the information is updated), "good" and "bad" colors for modules requiring colored output, as well as individual modules options.

Modules are displayed in the same order as they appear in the config. Unnecessary modules may simply be commented out or removed from the config file.

```php
"wlp1s0" => array(
    "module" => "ip",
    "interface" => "wlp1s0"
)
```

"Key" for a particular module may be anything, as long as they are all unique. Each module config section must have at least the "module" parameter, which corresponds to the function name of a particular module. Some modules require additional parameters.

##Writing modules

Modules are PHP functions, their names must be prefixed with `module_` and they are automatically loaded from the *modules* subfolder. Each module function shall accept one argument, containing the module options, as specified in the config file.

```php
function module_uname($module_options) {
    return array(
        "full_text" => php_uname($module_options["mode"])
    );
}
```

All modules must return an array with at least a `full_text` element, containing the desired output. Should it be necessary to color the output, an element `color` should be added, containing a hex value. Standard "good" and "bad" colors are defined in the config file and may be referenced by adding the `$config` variable to the function scope:

```php
function module_awesome_stuff($module_options) {
    global $config;
    return array(
        "full_text" => "my awesome module",
        "color" => $config["color_good"]
    );
}
```

Should a module require storing temporary data (such as last refresh time for modules that pull remote data and don't need to do so every second), a global array called `$module_tmp` may be used:

```php
   ...
   global $module_tmp;
   $module_tmp["awesome_stuff"]["last_update"] = time();
   ...
`
``

##Pronunciation guide

<p align="center">
  <img alt="Phtatus" src="https://i.imgur.com/NZ7qKDv.png" />
</p>

