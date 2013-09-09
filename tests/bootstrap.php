<?php

use Den\Autoloader;

$root = dirname(__FILE__) . "/../";

require "{$root}vendor/Den/Autoloader.php";

new Autoloader(array(
    $root,
    $root . "vendor"
));
