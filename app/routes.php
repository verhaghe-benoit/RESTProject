<?php

use Enaylal\Routing\Router;

$router->get('/', 'FriendController@index');


/*
 * Groupe de chemin pour les utilisateurs
 */

/*
 * pour la methode put, il faut envoyer les données en json et être en method PUT
 */


$router->group('/users', function(Router $router) {
    $router->get('/', 'UserController@index');
    $router->get('/{id}','UserController@single');
    $router->put('/{id}/edit','UserController@edit');
    $router->delete('/{id}/delete','UserController@delete');
    $router->put('/create','UserController@create');
});

$router->group('/friends', function(Router $router) {
    $router->get('/', 'FriendController@friends');
    $router->get('/{id}','FriendController@single');
    $router->delete('/{id1}/{id2}/delete','FriendController@delete');
});

$router->group('/publications', function(Router $router) {
    $router->get('/', 'PublicationController@publications');
    $router->get('/{id}','PublicationController@single');
    $router->delete('/{id}/delete','PublicationController@delete');
    $router->put('/create','PublicationController@create');
});

$router->group('/comments', function(Router $router) {
    $router->get('/', 'CommentController@comments');
    $router->get('/{id}','CommentController@single');
    $router->delete('/{id}/delete','CommentController@delete');
    $router->put('/create','CommentController@create');
});

$router->group('/friendrequest', function(Router $router) {
    $router->get('/', 'FriendRequestController@friendRequest');
    $router->get('/{id}','FriendRequestController@single');
    $router->delete('/{id1}/{id2}/delete','FriendRequestController@delete');
});
