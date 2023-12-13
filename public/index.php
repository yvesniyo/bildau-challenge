<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// load composer dependencies
require '../vendor/autoload.php';

// Load our custom routes
require_once '../routes/web.php';

use Pecee\SimpleRouter\SimpleRouter;



echo SimpleRouter::start();