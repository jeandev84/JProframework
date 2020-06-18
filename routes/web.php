<?php

class_alias('Jan\\Component\\Routing\\Route', 'Route');


Route::get('/', 'HomeController@index', 'home');
Route::get('/contact', 'HomeController@contact', 'contact');

Route::get('/foo', function () {
    echo 'Foo!';
});

Route::get('/post/{id}/{slug}', 'PostController@show', 'post.show');

