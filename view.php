<?php
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$name = $_GET['name'];
$file = "gallery_img/big/". $name;

echo $twig->render('view.tpl', ['file' => $file, 'name' => $name]);
