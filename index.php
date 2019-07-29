<?php
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);




$dir1 = "gallery_img/small";
$dir2 = "gallery_img/big";
//
$files1 = array_slice(scandir($dir1), 2);
$files2 = array_slice(scandir($dir2), 2);

echo $twig->render('index.tpl', ['data' => $files2, 'dir2' => $dir2, 'dir1' => $dir1]);
