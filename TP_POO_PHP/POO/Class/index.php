<?php

use App\Application;
use App\Autoloader;

define('ROOT', dirname(__DIR__) . '/Class');

require ROOT. "./Autoloader.php";

//require "./Autoloader.php"; marche aussi tout seul sans le define

Autoloader::register();

Application::demarrer();

