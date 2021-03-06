<?php

define('LARAVEL_START', microtime(true));
define('SBADMIN',  '../resources/views/sb-admin/');
define('ADMIN_PATH',  '/admin');
define('VIEW_PATH',  '../resources/views/');
define('URL_SITO',  'http://birdbeta.it');
/*define('MAIL_USERNAME',  'andrea.digiuliantonio@gmail.com');
define('MAIL_PASSWORD',  'ChV1Jb8D');*/

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Include The Compiled Class File
|--------------------------------------------------------------------------
|
| To dramatically increase your application's performance, you may use a
| compiled class file which contains all of the classes commonly used
| by a request. The Artisan "optimize" is used to create this file.
|
*/

$compiledPath = __DIR__.'/cache/compiled.php';

if (file_exists($compiledPath)) {
    require $compiledPath;
}
