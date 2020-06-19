<?php


/*
|----------------------------------------------------------------------
|   Autoloader classes and dependencies of application
|----------------------------------------------------------------------
*/

require_once __DIR__.'/../vendor/autoload.php';



/*
|-------------------------------------------------------
|    Require bootstrap of Application
|-------------------------------------------------------
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

dd($app->get(Jan\Contracts\Http\Kernel::class));

dd($app);

/*
|-------------------------------------------------------
|    Check instance of Kernel
|-------------------------------------------------------
*/

// $kernel = $app->get(Jan\Contracts\Http\Kernel::class);

$kernel = new \Jan\Kernel(__DIR__ . '/../');
$kernel->handle();


/*
|-------------------------------------------------------
|    Get Response
|-------------------------------------------------------
*/


//$response = $kernel->handle(
//    $request = \Jan\Component\Http\Request::fromGlobals()
//);



/*
|-------------------------------------------------------
|    Send all headers to navigator
|-------------------------------------------------------
*/

//$response->send();


/*
|-------------------------------------------------------
|    Terminate
|-------------------------------------------------------
*/

// $kernel->terminate($request, $response);

