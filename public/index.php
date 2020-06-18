<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../routes/web.php';


$request = \Jan\Component\Http\Request::fromGlobals();

$dispatcher = new \Jan\Foundation\RouteDispatcher($request);
$dispatcher->setControllerNamespace('App\\Controllers');
$response = $dispatcher->callAction();


/*
if(! $route['target'] instanceof Closure)
{
    $route['target'] = str_replace('@', '::', 'App\\Controllers\\'. $route['target']);
}

call_user_func_array($route['target'], $route['matches']);


echo '<h2>Generator Path</h2>';

$href = Route::router()->generate('post.show', ['id' => 5, 'slug' => 'article-4']);
echo '<a href="'. $href .'">show</a>';


echo '<h2>Route</h2>';
dump($route);


echo '<h2>Routes</h2>';
dump(Route::router()->routes());
*/