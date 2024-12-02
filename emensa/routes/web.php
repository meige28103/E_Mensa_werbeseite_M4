<?php
/**
 * Mapping of paths to controllers.
 * Note, that the path only supports one level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as expected
 */

return array(
    '/'             => "HomeController@index",
    "/demo"         => "DemoController@demo",
    '/dbconnect'    => 'DemoController@dbconnect',
    '/debug'        => 'HomeController@debug',
    '/error'        => 'DemoController@error',
    '/requestdata'   => 'DemoController@requestdata',

    // Erstes Beispiel:
    '/xyz' => 'ExampleController@m4_6a_queryparameter',
    '/m4_7a' => 'ExampleController@m4_7a_queryparameter',
    '/m4_7b' => 'ExampleController@m4_7b_kategorie',
    '/m4_7c' => 'ExampleController@m4_7c_gericht',
    '/m4_7d' => 'ExampleController@m4_7d_layout'

);