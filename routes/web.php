<?php

/**
 * This file contains all the routes for the project
 */

use Pecee\SimpleRouter\SimpleRouter;


\Pecee\SimpleRouter\SimpleRouter::setDefaultNamespace('App\\Controllers');


SimpleRouter::get('/', "HomeController@home");

SimpleRouter::get('/reports', "ReportsController@getAll");
SimpleRouter::put('/reports/{reportId}', "ReportsController@resolve");
SimpleRouter::put('/reports/block/{reportId}', "ReportsController@block");
