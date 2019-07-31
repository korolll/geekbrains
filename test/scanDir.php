<?php include_once "../models/Model.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Catalog</title>
	</head>

<?php 

$images = array_slice(scandir('img_original'), 2);

foreach ($images as $image) {
	$imagRe= iconv("cp1251", "UTF-8", $image);
	$fileName = translit($imagRe);
	$arr[] = $fileName;
	
	if(copy('img_original/'.$image, DIR_BIG.$fileName)){
			$type = explode('.', $fileName)[1];
			$nameShort = explode('.', $fileName)[0];
			
			//220/117  600/320
            changeImage(220, 117, DIR_BIG.$fileName, DIR_SMALL.$fileName, $type);
            if(isset($_POST['edit'])){
                $id = (int)trim(strip_tags($_POST['id']));
                goods_edit($connect, $id, $nameShort, $nameFull, $price, $param, DIR_BIG.$fileName, DIR_SMALL.$fileName);
                
            }else{
                goods_new($connect, $nameShort, $nameFull, $price, $param, DIR_BIG.$fileName, DIR_SMALL.$fileName);
                
            }

            $message = "<h3>Файл успешно загружен на сервер</h3>";
        }
	
}

?>