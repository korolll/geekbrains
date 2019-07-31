<?php
require_once "../config/database.php";

function goodsBasket_new($connect, $Id, $nameShort, $nameFull, $price, $param, $weight, $bigPhoto, $miniPhoto, $count, $discount)
{
    $t = "INSERT INTO basket (Id, nameShort, nameFull, price, param, weight, bigPhoto, miniPhoto, count, discount) VALUES ('%s', '%s', '%s', '%s','%s','%s','%s','%s','%s','%s')";

    $query = sprintf($t, $Id, mysqli_real_escape_string($connect, $nameShort), mysqli_real_escape_string($connect, $nameFull), mysqli_real_escape_string($connect, $price), mysqli_real_escape_string($connect, $param), mysqli_real_escape_string($connect, $weight), mysqli_real_escape_string($connect, $bigPhoto), mysqli_real_escape_string($connect, $miniPhoto), mysqli_real_escape_string($connect, $count), mysqli_real_escape_string($connect, $discount));

    $result = mysqli_query($connect, $query);

    if (!$result) {
        die(mysqli_error($connect));
    }

    return true;
}

function goodsBasket_all($connect)
{
    $query = "SELECT * FROM basket order by id";
    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    $n = mysqli_num_rows($result);
    $goods = array();

    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $goods[] = $row;
    }

    return $goods;
}

function goodsBasket_get($connect, $id)
{
    $query = sprintf("SELECT * FROM basket where id=%d", (int)$id);
    $result = mysqli_query($connect, $query);
    if (!$result)
        die(mysqli_error($connect));
    $good = mysqli_fetch_assoc($result);
    return $good;
}

function goodsBasket_delete($connect, $id)
{
    $id = (int)$id;

    if ($id == 0)
        return false;

    $query = sprintf("DELETE FROM basket where id='%d'", $id);
    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    return mysqli_affected_rows($connect);
}

function goodsBasket_deleteAll($connect)
{
    $query = sprintf("TRUNCATE `basket`");
    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    return mysqli_affected_rows($connect);

}

function goodsBasket_edit($connect, $id, $nameShort, $nameFull, $price, $param, $bigPhoto, $miniPhoto)
{
    $id = (int)$id;

    $sql = "UPDATE basket SET nameShort='%s', nameFull='%s', price='%s',param='%s',bigPhoto='%s',miniPhoto='%s' WHERE id='%d'";

    $query = sprintf($sql, mysqli_real_escape_string($connect, $nameShort), mysqli_real_escape_string($connect, $nameFull), mysqli_real_escape_string($connect, $price), mysqli_real_escape_string($connect, $param), mysqli_real_escape_string($connect, $bigPhoto), mysqli_real_escape_string($connect, $miniPhoto), $id);


    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    return mysqli_affected_rows($connect);
}


function countGoodsOrder($connect)
{
    $query = "SELECT sum(`count`) AS count FROM `basket`";
    $result = mysqli_query($connect, $query);
    if (!$result)
        die(mysqli_error($connect));
    $countOrder = mysqli_fetch_assoc($result);
    return $countOrder['count'];
}

function sumGoodsOrder($connect)
{
    $query = "SELECT sum(`count`*`price`) AS sum FROM `basket`";
    $result = mysqli_query($connect, $query);
    if (!$result)
        die(mysqli_error($connect));
    $sumOrder = mysqli_fetch_assoc($result);
    return $sumOrder['sum'];
}

function sumGoodsOrderDiscount($connect)
{
    $query = "SELECT sum(`count`*`price`*(100-`discount`)/100) AS sumDiscount FROM `basket`";
    $result = mysqli_query($connect, $query);
    if (!$result)
        die(mysqli_error($connect));
    $sumOrder = mysqli_fetch_assoc($result);
    return floor($sumOrder['sumDiscount']);
}

function countOneGoodsOrder($connect, $id)
{
    $query = sprintf("SELECT `count`  FROM `basket` WHERE id='%d'", (int)$id);
    $result = mysqli_query($connect, $query);
    if (!$result)
        die(mysqli_error($connect));
    $countOneOrder = mysqli_fetch_assoc($result);
    return $countOneOrder['count'];
}

function sumOneGoodsOrder($connect, $id)
{
    $query = sprintf("SELECT sum(`count`*`price`) AS sum FROM `basket` WHERE id='%d'", (int)$id);
    $result = mysqli_query($connect, $query);
    if (!$result)
        die(mysqli_error($connect));
    $sumOneOrder = mysqli_fetch_assoc($result);
    return $sumOneOrder['sum'];
}

function renderBasketModal($connect) {

    $query = "SELECT * FROM basket order by id";
    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    $n = mysqli_num_rows($result);
    $goods = array();

    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $goods[] = $row;
    }
    return $goods;          
}

function orderTotalSum($connect)
{
    $query = "SELECT sum(`count`*`price`) AS sum FROM `basket`";
    $result = mysqli_query($connect, $query);
    if (!$result)
        die(mysqli_error($connect));
    $orderTotalSum = mysqli_fetch_assoc($result);
    return $orderTotalSum['sum'];
}

function clientInfo($connect) {
    $query = "SELECT * FROM basket order by id";
    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    $n = mysqli_num_rows($result);
    $goods = array();

    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $goods[] = $row;
    }
    return $goods;          
}


function getClientInfo_all($connect)
{
    $query = "SELECT * FROM clientInfo";
    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    $n = mysqli_num_rows($result);
    $goods = array();

    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $goods[] = $row;
    }

    return $goods;
}

function clientInfo_new($connect, $timeOrder, $name, $phone, $discountCard, $persons, $pay, $money, $address, $comment, $delivery, $desiredTime)
{
    $t = "INSERT INTO clientInfo (timeOrder, name, phone, discountCard, persons, pay, money, address, comment, delivery, desiredTime) VALUES ('%s', '%s', '%s', '%s','%s','%s','%s','%s','%s','%s','%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $timeOrder), mysqli_real_escape_string($connect, $name), mysqli_real_escape_string($connect, $phone), mysqli_real_escape_string($connect, $discountCard), mysqli_real_escape_string($connect, $persons), mysqli_real_escape_string($connect, $pay), mysqli_real_escape_string($connect, $money), mysqli_real_escape_string($connect, $address), mysqli_real_escape_string($connect, $comment), mysqli_real_escape_string($connect, $delivery), mysqli_real_escape_string($connect, $desiredTime));

    $result = mysqli_query($connect, $query);

    if (!$result) {
        die(mysqli_error($connect));
    }

    return true;
}


function clientInfo_edit($connect, $timeOrder, $name, $phone, $discountCard, $persons, $pay, $money, $address, $comment, $delivery, $desiredTime) {
	
    
    $sql = "UPDATE clientInfo SET timeOrder='%s', name='%s', phone='%s',discountCard='%s',persons='%s',pay='%s', money='%s' ,address='%s' ,comment='%s', delivery='%s', desiredTime='%s'";

    $query = sprintf($sql, mysqli_real_escape_string($connect, $timeOrder), mysqli_real_escape_string($connect, $name), mysqli_real_escape_string($connect, $phone), mysqli_real_escape_string($connect, $discountCard), mysqli_real_escape_string($connect, $persons), mysqli_real_escape_string($connect, $pay), mysqli_real_escape_string($connect, $money),  mysqli_real_escape_string($connect, $address), mysqli_real_escape_string($connect, $comment), mysqli_real_escape_string($connect, $delivery), mysqli_real_escape_string($connect, $desiredTime));


    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    return mysqli_affected_rows($connect);
};

function clientInfo_editDelivery($connect,$delivery) {
	
    $sql = "UPDATE clientInfo SET delivery='%s'";

    $query = sprintf($sql, mysqli_real_escape_string($connect, $delivery));


    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    return mysqli_affected_rows($connect);
}

function newOrderToManager ($connect, $idClient, $idGood, $count)
{
	$query = "INSERT INTO orderToManager (idClient, idGood, count) VALUES ($idClient, $idGood, $count)";
	$result = mysqli_query($connect, $query);
    return true;
}


function getInfoOrderToManager($connect) {

    $query = "select * from orderToManager  
	inner join clientInfo on orderToManager.idClient = clientInfo.id 
    inner join goods on orderToManager.idGood = goods.id";
	
    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    $n = mysqli_num_rows($result);
    $goods = array();

    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $goods[] = $row;
    }
    return $goods;          
}

