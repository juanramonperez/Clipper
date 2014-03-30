<?php if (!empty($relacionadas)) : ?>
<div class="toggle-related-items" article="<?php print $article_id; ?>">
	<a href="#" style="color: <?php print $colores['link_color'] ?>">[Ver misma noticia en otros medios]</a>
</div>
<div class="related-items" article="<?php print $article_id; ?>">
	<?php foreach ($relacionadas as $key => $relacionada) : ?>
		<?php print $relacionada; ?>
	<?php endforeach; ?>
</div>
<?php endif; ?>