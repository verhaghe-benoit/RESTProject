<?php

use Enaylal\Routing\Router;

/*
 * Groupe de chemin pour les utilisateurs
 */

/*
 * pour la methode put, il faut envoyer les données en json et être en method PUT
 */


$router->group('/users', function(Router $router) {
    $router->get('/', 'UserController@index');
    $router->get('/{id}','UserController@single');
    $router->get('/{id}/friends', 'FriendController@user_friend');
    $router->get('/{id}/publications', 'PublicationController@user_publication');
    $router->get('/{id}/request', 'FriendRequestController@requested');
    $router->put('/{id}/edit','UserController@edit');
    $router->delete('/{id}/delete','UserController@delete');
    $router->post('/create','UserController@create');
    $router->post('/login','UserController@postLogin');
    $router->post('/password','UserController@postPassword');
});



$router->group('/friends', function(Router $router) {
    $router->get('/', 'FriendController@friends');
    $router->get('/{id}','FriendController@single');
    $router->delete('/{id1}/{id2}/delete','FriendController@delete');
    $router->post('/create','FriendController@create');
});

$router->group('/publications', function(Router $router) {
    $router->get('/', 'PublicationController@publication');
    $router->get('/{id}','PublicationController@single');
    $router->delete('/{id}/delete','PublicationController@delete');
    $router->post('/create','PublicationController@create');
    $router->put('/{id}/edit','PublicationController@edit');
});

$router->group('/comments', function(Router $router) {
    $router->get('/', 'CommentController@comments');
    $router->get('/{id}','CommentController@single');
    $router->delete('/{id}/delete','CommentController@delete');
    $router->post('/create','CommentController@create');
    $router->put('/{id}/edit','CommentController@edit');
    $router->get('/publications/{id}','CommentController@getCommentPublication');
});

$router->group('/friendrequest', function(Router $router) {
    $router->get('/', 'FriendRequestController@friendRequest');
    $router->get('/{id}','FriendRequestController@single');
    $router->delete('/{id1}/{id2}/delete','FriendRequestController@delete');
    $router->post('/create','FriendRequestController@create');
});
