<?php

include_once "../models/Model.php";
$from = 0;
$limit = 8;
if (!empty($_GET['from'])) {
    $from = $_GET['from'];
}
if (!empty($_GET['limit'])) {
    $limit = $_GET['limit'];
}

$goods = getGroup($connect, 'goods', $from, $limit);

echo json_encode($goods);