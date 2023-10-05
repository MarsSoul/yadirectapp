<?php

namespace App\Core;

class Routes {

    public static $routes = [

    //web :

        ['GET', '/', 'HomeController@index'],
        ['POST', '/uploadReport', 'FormController@uploadReport'],
        ['GET', '/report/([0-9]+)', 'ReportController@view'],

    ];
}