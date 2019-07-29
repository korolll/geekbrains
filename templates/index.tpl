{% include 'layouts/header.tpl' %}
<div id="main">
    <div class="post_title"><h3><a class="title" href="#">Моя галерея</a></h3></div>
    <div class="gallery">
		{% for item in data %}
		<a rel="gallery" class="photo" href="view.php?name={{item}}"><img src="{{dir1}}/{{item}}"
		alt="" /></a>
		{% endfor %}
    </div>
</div>
{% include 'layouts/footer.tpl' %}