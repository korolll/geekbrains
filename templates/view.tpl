{% include 'layouts/header.tpl' %}
<div id="main">
    <div class="post_title"><h3><a class="title" href="index.php">Моя галерея</a> / <a class="title" href="#">{{name}}</a></h3></div>
    <div class="gallery">
        <a rel="gallery" class="photo" href="#"><img src="{{file}}" alt="" /></a>
    </div>
</div>
{% include 'layouts/footer.tpl' %}