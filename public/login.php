<?php include_once "../controllers/User.php"; ?>
<? include "../templates/menu.php"; ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Вход на сайт</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css" type="text/css" media="all">
</head>
<body>
<div id="container">
    <div class="leftblock">
    </div>
    <div class="content">
        <?
        if (isset($_SESSION[login]) && isset($_SESSION[pass])) {
            echo "Приветствую вас " . $_SESSION[login];
        } else {
            echo "<h1>Вход на сайт</h1><hr>";
            echo $message ? $message : ""; ?>
            <form method="post">
                <p>Логин: <input type="text" name="login" maxlength="30" placeholder="Введите Логин" autofocus required>
                </p>
                <p>Пароль: <input type="password" minlength="2" name="pass" placeholder="Введите Пароль" required></p>
                <input type="submit" name="enter" value="Войти">
            </form>
        <? } ?>;
    </div>
    <footer>
        <?php include "../templates/footer.php"; ?>
    </footer>
</div>
<script src='../js/my.js' defer></script>
</body>
</html>