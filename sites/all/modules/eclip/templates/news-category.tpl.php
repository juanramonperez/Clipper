<div class="category" style="padding-bottom:20px;">
	<div class="category-title" style="<?php print $style_title_category; ?>"><?php print $titulo; ?></div>
	<div class="category-content">
		<?php foreach ($noticias as $key => $noticia) : ?>
			<?php print theme('news_item', $noticia); ?>
		<?php endforeach; ?>
	</div>
</div>