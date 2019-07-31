<?php include_once "../controllers/Product.php"; ?>
<? include "../templates/menu.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Работа с файлами</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
			<link rel="stylesheet" href="/my_shop/public/css/styles.css" type="text/css" media="all">
</head>
<body>

<?php
$id = $_GET['id'];
countViews($connect, $id, 'goods');
$good = getOne($connect, $id, 'goods');
?>

<div class='goodsWrapItem'>
				
                    <div class="wrapGoodImgItem">
                        <a href="item.php?photo=<?= $good['bigPhoto'] ?>&id=<?= $good['id'] ?>"><img class='goodImg'src="<?= $good['bigPhoto'] ?>"></a>
                    </div>
					<div class="wrapGoodInfo">
					<div class='goodsNameFull'><?= $good['nameFull']; ?></div>
                    <div class='goodsPriceItem'><?= $good['price'] ?><b>&#8381;</b></div>
                    <div class='goodsParam'><span><b>Состав: </b></span><?= $good['param']?></div>
                    <div class='goodsWeightItem'><span><b>Вес: </b></span><?= $good['weight']?> гр./порцию</div>
					<?php if ($good['discount']>0) {
					echo('<div class="stickerItem"><img class="stickerImgItem" src="/my_shop/public/css/star.png"><span class="stickerTextItem">'.$good['discount'].'%</span><div class="explain">    блюдо со скидкой дня '.$good['discount'].'%</div></div>');
				};
				if ($good['stickerFit']==1) {
					echo('<div class="stickerItem"><img class="stickerImgItem" src="/my_shop/public/css/star.png"><span class="stickerTextItem">Fit!</span> <div class="explain">     блюдо с низкой калорийностью</div></div>');
				};
				if ($good['stickerHit']==1) {
					echo('<div class="stickerItem"><img class="stickerImgItem" src="/my_shop/public/css/star.png"><span class="stickerTextItem">Hit!</span><div class="explain">    популярное блюдо</div></div>');
				};?>
					</div>
					<div class="btnWrapItem">
                    <input type='button' class='addToBasket btn' value='Дoбавить в корзину' onclick="addToBasket(<?= $good[id] ?>)" data-id='<?= $good[id] ?>'>
                    <input type='button' class='deleteToBasket btn' value='Удалить из корзины' onclick="deleteToBasket(<?= $good[id] ?>)" data-id='<?= $good[id] ?>'>
					</div>
                </div>



<script src='../js/my.js'></script>;
</body>
</html>
