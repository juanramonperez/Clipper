<div class="news-item new-<?php print $nid ?> status-<?php print $status; ?> vote-<?php print $vote; ?> image-<?php print $image; ?>">
	<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
	<span class="news-title"><?php print $title; ?>
		<span class="news-medio">
			<?php print $medio; ?> <span class="date-<?php print $date_class; ?>"><?php print $date; ?></span>
		</span>
	</span>
	<span class="news-actions">
		<span class="ui-icon ui-image"></span>
		<span class="ui-icon ui-vote"></span>
		<a href="<?php $link; ?>" class="ctools-use-modal">
			<span class="ui-icon ui-icon-circle-zoomin"></span>
		</a>
		<span class="ui-icon ui-icon-circle-close"></span>
	</span>
</div>