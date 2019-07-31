<?php
require_once "../config/database.php";

function getAll($connect, $table, $orderby = 'id')
{
    $query = "SELECT * FROM {$table} order by {$orderby} desc";
    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    $n = mysqli_num_rows($result);
    $res = array();

    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $res[] = $row;
    }

    return $res;
}

function getGroup($connect, $table, $from, $limit, $orderby = 'id')
{
    $query = "SELECT * FROM {$table} order by {$orderby} desc limit {$limit} offset {$from}";
    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    $n = mysqli_num_rows($result);
    $res = array();

    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $res[] = $row;
    }

    return $res;
}

function getOne($connect, $id, $table)
{
    $query = sprintf("SELECT * FROM {$table} where id=%d", (int)$id);
    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    $res = mysqli_fetch_assoc($result);

    return $res;
}


function deleteGoods($connect, $id, $table)
{
    $id = (int)$id;

    if ($id == 0)
        return false;

    $query = sprintf("DELETE FROM {$table} where id='%d'", $id);
    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    return mysqli_affected_rows($connect);
}


function newProduct($connect, $name, $description, $src, $small_src, $price)
{

    $t = "INSERT INTO goods (name, description, src, small_src, price) VALUES ('%s','%s','%s','%s','%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $name), mysqli_real_escape_string($connect, $description), mysqli_real_escape_string($connect, $src), mysqli_real_escape_string($connect, $small_src), mysqli_real_escape_string($connect, $price));

    $result = mysqli_query($connect, $query);

    if (!$result) {
        die(mysqli_error($connect));
    }

    return true;
}

function editProduct($connect, $id, $name, $description, $src, $small_src, $price)
{
    $id = (int)$id;

    $sql = "UPDATE goods SET name='%s',description='%s',src='%s',small_src='%s',price='%s' WHERE id='%d'";

    $query = sprintf($sql, mysqli_real_escape_string($connect, $name), mysqli_real_escape_string($connect, $description), mysqli_real_escape_string($connect, $src), mysqli_real_escape_string($connect, $small_src), mysqli_real_escape_string($connect, $price), $id);

    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    return mysqli_affected_rows($connect);
}

function newComment($connect, $fio, $email, $text)
{

    $t = "INSERT INTO comment (fio, email, text) VALUES ('%s','%s','%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $fio), mysqli_real_escape_string($connect, $email), mysqli_real_escape_string($connect, $text));

    $result = mysqli_query($connect, $query);

    if (!$result) {
        die(mysqli_error($connect));
    } else {
        header("Location: ../public/guestbook.php");
    }
}

function newImage($connect, $name, $src, $small_src, $size)
{
    $name = trim($name);

    if ($name == '')
        return False;

    $t = "INSERT INTO images (name, src, small_src, size) VALUES ('%s','%s','%s','%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $name), mysqli_real_escape_string($connect, $src), mysqli_real_escape_string($connect, $small_src), mysqli_real_escape_string($connect, $size));

    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    return true;
}

function countViews($connect, $id, $table)
{

    $sql = "UPDATE {$table} SET `views`= `views`+1 WHERE id=$id";
    mysqli_query($connect, $sql);
}

function newUser($connect, $name, $login, $email, $pass)
{

    $t = "INSERT INTO users (name, login, email, pass) VALUES ('%s','%s','%s','%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $name), mysqli_real_escape_string($connect, $login), mysqli_real_escape_string($connect, $email), mysqli_real_escape_string($connect, $pass));

    $result = mysqli_query($connect, $query);

    if (!$result) {
        die(mysqli_error($connect));
    }

    return true;
}

function newTempOrder($connect, $id_good, $name, $price, $count, $login = null)
{

    $t = "INSERT INTO temp_orders (id_good, name, price, count, login) VALUES ('%s','%s','%s','%s','%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $id_good), mysqli_real_escape_string($connect, $name), mysqli_real_escape_string($connect, $price), mysqli_real_escape_string($connect, $count), mysqli_real_escape_string($connect, $login));

    $result = mysqli_query($connect, $query);

    if (!$result) {
        die(mysqli_error($connect));
    }

    return true;
}

function editTempOrder($connect, $id, $count)
{
    $id = (int)$id;

    $sql = "UPDATE temp_orders SET count='%d' WHERE id_good='%d'";

    $query = sprintf($sql, mysqli_real_escape_string($connect, $count), $id);

    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    return mysqli_affected_rows($connect);
}

function getOneTemp($connect, $id, $table)
{
    $query = sprintf("SELECT * FROM {$table} where id_good=%d", (int)$id);
    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    $res = mysqli_fetch_assoc($result);

    return $res;
}


function goods_new($connect, $nameShort, $nameFull, $price, $param, $bigPhoto, $miniPhoto)
{
    $t = "INSERT INTO goods (nameShort, nameFull, price, param, bigPhoto, miniPhoto) VALUES ('%s', '%s','%s','%s','%s','%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $nameShort), mysqli_real_escape_string($connect, $nameFull), mysqli_real_escape_string($connect, $price), mysqli_real_escape_string($connect, $param), mysqli_real_escape_string($connect, $bigPhoto), mysqli_real_escape_string($connect, $miniPhoto));

    $result = mysqli_query($connect, $query);

    if (!$result) {
        die(mysqli_error($connect));
    }

    return true;
}

function addNewGood($connect)
{
    $query = "INSERT INTO `goods` (`id`, `nameShort`, `nameFull`, `price`, `param`, `bigPhoto`, `miniPhoto`, `weight`, `discount`, `stickerFit`, `stickerHit`, `views`) VALUES (NULL, '', '', '', '', '', '', '', '', '', '', '');";

    $result = mysqli_query($connect, $query);

    if (!$result) {
        die(mysqli_error($connect));
    }

    return true;
}

function goods_all($connect)
{
    $query = "SELECT * FROM goods order by id desc";
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

function goods_get($connect, $id)
{
    $query = sprintf("SELECT * FROM goods where id=%d", (int)$id);
    $result = mysqli_query($connect, $query);
    if (!$result)
        die(mysqli_error($connect));
    $good = mysqli_fetch_assoc($result);
    return $good;
}

function goods_delete($connect, $id)
{
    $id = (int)$id;

    if ($id == 0)
        return false;

    $query = sprintf("DELETE FROM goods where id='%d'", $id);
    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    return mysqli_affected_rows($connect);
}

function goods_edit($connect, $id, $nameShort, $nameFull, $price, $param, $bigPhoto, $miniPhoto, $weight, $discount, $stickerFit, $stickerHit)
{
    $id = (int)$id;

    $sql = "UPDATE goods SET nameShort='%s', nameFull='%s', price='%s',param='%s',bigPhoto='%s',miniPhoto='%s', weight='%s', discount='%s', stickerFit='%s', stickerHit='%s' WHERE id='%d'";

    $query = sprintf($sql, mysqli_real_escape_string($connect, $nameShort), mysqli_real_escape_string($connect, $nameFull), mysqli_real_escape_string($connect, $price), mysqli_real_escape_string($connect, $param), mysqli_real_escape_string($connect, $bigPhoto), mysqli_real_escape_string($connect, $miniPhoto), mysqli_real_escape_string($connect, $weight), mysqli_real_escape_string($connect, $discount), mysqli_real_escape_string($connect, $stickerFit), mysqli_real_escape_string($connect, $stickerHit), $id);


    $result = mysqli_query($connect, $query);

    if (!$result)
        die(mysqli_error($connect));

    return mysqli_affected_rows($connect);
}

function translit($string)
{
    $translit = array(
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ы' => 'y', 'ъ' => '', 'ь' => '', 'э' => 'eh', 'ю' => 'yu', 'я' => 'ya');

    return str_replace(' ', '_', strtr(mb_strtolower($string, 'utf-8'), $translit));
}

function changeImage($h, $w, $src, $newsrc, $type)
{
    $newimg = imagecreatetruecolor($h, $w);
    switch ($type) {
        case 'jpeg':
            $img = imagecreatefromjpeg($src);
            imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
            imagejpeg($newimg, $newsrc);
            break;
        case 'png':
            $img = imagecreatefrompng($src);
            imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
            imagepng($newimg, $newsrc);
            break;
        case 'gif':
            $img = imagecreatefromgif($src);
            imagecopyresampled($newimg, $img, 0, 0, 0, 0, $h, $w, imagesx($img), imagesy($img));
            imagegif($newimg, $newsrc);
            break;
    }
}


function renderAllGoods($connect)
{
    $query = "SELECT * FROM goods";
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

function renderAdminAjax($connect)
{
    $query = "SELECT * FROM goods";
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

function scanDirLoadFiles($connect)
{

    $images = array_slice(scandir('../public/loadFiles'), 2);

    foreach ($images as $image) {
        $nameRecodRu = iconv("cp1251", "UTF-8", $image);
        $nameFull = explode('.', $nameRecodRu)[0];
        $fileName = translit($nameRecodRu);
        $nameShort = explode('.', $fileName)[0];
        $arr[] = $fileName;

        if (copy('../public/loadFiles/' . $image, '../public/' . DIR_BIG . $fileName)) {
            $type = explode('.', $fileName)[1];
            changeImage(220, 117, '../public/' . DIR_BIG . $fileName, '../public/' . DIR_SMALL . $fileName, $type);
            goods_new($connect, $nameShort, $nameFull, $price, $param, DIR_BIG . $fileName, DIR_SMALL . $fileName);
        }
    }
}
