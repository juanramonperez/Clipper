<div class="portlet category-<?php print $tid; ?> ui-widget ui-widget-content ui-helper-clearfix">
	<div class="portlet-header ui-widget-header">
		<span class="category-title"><?php print $title; ?></span>
		<span class="category-actions">
			<input type="text" class="spinner" size="2" maxlength="2" name="spinner-<?php print $tid; ?>" value="<?php print $weight; ?>" />
			<span class="ui-icon ui-icon-minusthick"></span>
		</span>
	</div>
	<div class="portlet-content">
		<div class="news-content">
			<div class="news-add-item">
				<a href="#">Agregar</a>
			</div>			
			<?php foreach ($news as $key => $noticia) : ?>
				<?php print theme('admin_news_item', $noticia); ?>
			<?php endforeach; ?>
		</div>	
	</div>
</div>