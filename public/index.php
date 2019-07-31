<?php include_once "../controllers/Product.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Catalog</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


</head>
<body>
<?php include "../templates/menu.php"; ?>
<main>
    <div class='goodsTable'>
    </div>
    <div>
        <button class="loader" onclick="getItems()" style="width: 200px">More</button>
    </div>
    <footer>
        <? include "../templates/footer.php"; ?>
    </footer>
    <script src='../js/my.js' defer></script>
    <script>
        var from = 0;
        var limit = 8;
        $(document).ready(function () {
           getItems();
        });

        // load from db
        function getItems() {
            var ajaxRequest = $.get("../controllers/Ajax.php?from=" + from + '&limit=' + limit, function (json) {
                let data = JSON.parse(json);
                if (data.length < limit) {
                    $('.loader').hide();
                }
                $.each(data, function (i, value) {
                    append(value);
                });
            }).fail(function (error) {
                console.log(error);
            });

            from = from + limit;
        }

        // append to div
        function append(data) {
            let item = itemTemplate(data);
            $('.goodsTable').append(item);
        }

        // return sticker template
        function stickerTemplate(good) {
            if (good['discount'] > 0) {
                return "<div class='sticker'><img class='stickerImg' src='css/star.png'><span class='stickerTextFit'>" + good['discount'] + "%</span></div>";
            }
            if (good['stickerFit'] == 1) {
                return "<div class='sticker'><img class='stickerImg' src='css/star.png'><span class='stickerTextFit'>Fit!</span></div>";
            }
            if (good['stickerHit'] == 1) {
                return "<div class='sticker'><img class='stickerImg' src='css/star.png'><span class='stickerTextFit'>Hit!</span></div>";
            }
            return '';
        }

        // return href template
        function hrefTemplate(good) {
            return '<a href="item.php?photo=' + good['bigPhoto'] + '&id=' + good['id'] + '"><img class="goodImg" src="' + good['miniPhoto'] + '"></a>';
        }

        // return single good template
        function itemTemplate(good) {
            let sticker = stickerTemplate(good);
            let href = hrefTemplate(good);

            let template =
            "<div class='goodsWrap js'>" + sticker +
                "<div class='wrapGoodImg'>" + href + "</div>" +
                "<div class='wrapGoodInfo'>" +
                "<div class='goodsNameFull'>" + good['nameFull'] + "</div>" +
                "<div class='goodsPrice'>" + good['price'] + "<b>&#8381;</b></div>" +
            "<div class='goodsParam'><span><b>Состав: </b></span>" + good['param'] + "</div></div>" +
            "<div class='btnWrap'>" +
                "<input type='button' class='addToBasket btn' value='Дoбавить в корзину' " +
            "onclick='addToBasket(" + good['id'] + ")' data-id='" + good['id'] + "'>" +
                "<input type='button' class='deleteToBasket btn' value='Удалить из корзины' " +
            "onclick='deleteToBasket(" + good['id'] + ")' data-id='" + good['id'] + "'>" +
                "</div></div>";

            return template;
        }
    </script>
</main>
</body>
</html>