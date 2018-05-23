<?php
namespace Enaylal;

/**
 * Class Form
 *
 * Gestion des get/post
 *
 * @package Enaylal
 */
class Form
{

    public function get($name)
    {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }
        return null;
    }


    public function post($name)
    {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }
        return null;
    }

    public function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}