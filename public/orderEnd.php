<?php include_once "../controllers/Admin.php"; ?>
<? include "../templates/menu.php"; ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Спасибо!</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/my_shop/public/css/styles.css" type="text/css" media="all">
</head>
<body>
<main>

        <div><h1>Спасибо за Ваш заказ</h1></div>
        <div class="orderTableEnd">
		<script>
$(document).ready(function() {
	renderOrderEnd();
});
</script>
		</div>
    
    <footer>
        <? include "../templates/footer.php"; ?>
    </footer>

<script src='../js/my.js'></script>
</main>
</body>
</html>