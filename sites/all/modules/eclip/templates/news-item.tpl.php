<div class="noticia clearfix <?php $imagen ? print 'con-imagen' : print 'sin-imagen'; ?>">
	<?php if($imagen && $show_image) : ?>
		<div class="image" style="<?php print $style_image; ?>">
			<img src="<?php print $imagen ?>" style="<?php print $style_img; ?>"/>
		</div>
	<?php endif; ?>	
	<div class="title">
		<a href="<?php print url($link, array('absolute' => TRUE)); ?>" style="<?php print $style_title; ?>"><?php print $titulo; ?></a>
	</div>	
	<div class="medio-fecha"><strong style="<?php print $style_medio_fecha; ?>"><?php print $medio; ?> - <?php print $fecha; ?></strong></div>
	<?php if(!$email): ?>
	<div class"relacionadas"><?php print theme('news_related', array('article_id' => $article_id, 'colores' => $colores)); ?></div>
	<?php endif; ?>
	<div class="description" style="<?php print $style_description; ?>"><?php print $bajada ?></div>	
</div>