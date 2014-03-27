<div class="category">
	<div class="category-title" style="color: <?php print $colores['category_color']; ?>"><?php print $titulo; ?></div>
	<div class="category-content">
		<?php foreach ($noticias as $key => $noticia) : ?>
			<?php print theme('news_item', $noticia); ?>
		<?php endforeach; ?>
	</div>
</div>