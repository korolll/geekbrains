<?php
include_once "../models/Model.php";

if (isset($_POST['getAllGoods'])) {
	$goods = renderAllGoods($connect);
        echo json_encode($goods); // возвращаем данные ответом, преобразовав в JSON-строку
        exit; // останавливаем дальнейшее выполнение скрипта
        mysqli_close($connect);
}


if (isset($_POST['addNewGood'])) {
	addNewGood($connect);
        exit; // останавливаем дальнейшее выполнение скрипта
        mysqli_close($connect);
}

if (isset($_POST['scanDirLoadFiles'])) {
	scanDirLoadFiles($connect);
        exit; // останавливаем дальнейшее выполнение скрипта
        mysqli_close($connect);
}

if ($_POST['edit']) {
	$id = trim(strip_tags($_POST['id']));
	$good = getOne($connect, $id, 'goods');
	$nameFull = trim(strip_tags($_POST['nameFull']));
    $nameShort = translit(trim(strip_tags($_POST['nameFull'])));
    $param = strip_tags($_POST['param']);
    $price = (int)trim(strip_tags($_POST['price']));
    $weight = (int)trim(strip_tags($_POST['weight']));
    $discount = (int)trim(strip_tags($_POST['discount']));
	if($_POST['stickerFit']=='on') {
		$stickerFit = '1';
	} else {
		$stickerFit = '0';
	};
	
    if($_POST['stickerHit']=='on') {
		$stickerHit = '1';
	} else {
		$stickerHit = '0';
	};
    $filePath = $_FILES['userfile']['tmp_name'];
    $fileName = translit($_FILES['userfile']['name']);
    $type = $_FILES['userfile']['type'];
    $size = $_FILES['userfile']['size'];
    if ($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif') {
        if ($size > 0 and $size < 1000000) {
            if (copy($filePath, '../public/' . DIR_BIG . $fileName)) {
                $type = explode('/', $_FILES['userfile']['type'])[1];
                changeImage(220, 117, '../public/' . DIR_BIG . $fileName, '../public/' . DIR_SMALL . $fileName, $type);
                if (isset($_POST['edit'])) {
                    $id = (int)trim(strip_tags($_POST['id']));
                    goods_edit($connect, $id, $nameShort, $nameFull, $price, $param, DIR_BIG . $fileName, DIR_SMALL . $fileName, $weight, $discount, $stickerFit, $stickerHit);
					//echo (true); // возвращаем данные ответом, преобразовав в JSON-строку
					exit; // останавливаем дальнейшее выполнение скрипта
					mysqli_close($connect);
                } 
                $message = "<h3>Файл успешно загружен на сервер</h3>";
            } else {
                $message = "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>";
                exit;
            }
        } else {
            $message = "<b>Ошибка - картинка превышает 1 Мб.</b>";
        }
    } else {
        $message = "<b>Картинка не подходит по типу! Картинка должна быть в формате JPEG, PNG или GIF</b>";
    }

}

if (isset($_POST['renderAdminAjax'])) {
	$goods = getAll($connect, 'goods');
        echo json_encode($goods); // возвращаем данные ответом, преобразовав в JSON-строку
        exit; // останавливаем дальнейшее выполнение скрипта
        mysqli_close($connect);
}

if (isset($_POST['deleteGoodid'])) {
    $id = $_POST['deleteGoodid'];
	$good = getOne($connect, $id, 'goods');
        $sql = "DELETE FROM `goods` WHERE id=$id";
        $res = mysqli_query($connect, $sql);
        echo (true); // возвращаем данные ответом, преобразовав в JSON-строку
        exit; // останавливаем дальнейшее выполнение скрипта
        mysqli_close($connect);
}

?>
