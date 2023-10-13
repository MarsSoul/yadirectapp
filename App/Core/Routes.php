<?php

namespace App\Core;

class Routes {

    public static $routes = [

    //web :

        ['GET', '/', 'HomeController@index'],
        ['POST', '/uploadReport', 'FormController@uploadReport'],
        ['GET', '/report/([0-9]+)', 'ReportController@showReport'],
        ['GET', '/campaigns/([0-9]+)', 'ReportController@showCampaigns'],
        ['GET', '/adGroups/([0-9]+)/([^/]+)', 'ReportController@showAdGroups'],
        ['GET', '/ads/([0-9]+)/([0-9]+)/([^/]+)', 'ReportController@showAds'],

        ['GET', '/report/delete/([0-9]+)/([a-zA-Z0-9_]+)', 'DeleteReportController@deleteReport'],
    ];
}