<?php


/*
 * Here you can define your own helper functions.
 * Make sure to use the `function_exists` check to not declare the function twice.
 */

if (!function_exists('config')) {
    function config(string $key): mixed
    {

        $cfg = array_merge( ['documentai' =>
            require  __DIR__ . '/../config/documentai.php'],  []
        );

        return data_get($cfg, $key);
    }
}
