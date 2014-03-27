<div class="wrapper">
    <div class="content">
      <!--header-->
      <?php if (!$is_intranet): ?>
      <div class="header">
        <?php print $customer_header; ?>
      </div>
      <?php endif; ?>
      <!--END header-->

      <div class="page-content">
        <a id="main-content"></a>
        <?php if ($tabs): ?><div id="tabs-wrapper" class="clearfix"><?php endif; ?>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?>
          <!--<h1<?php print $tabs ? ' class="with-tabs"' : '' ?>><?php print $title ?></h1>-->
        <?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php if ($tabs): ?><?php print render($tabs); ?></div><?php endif; ?>
        <?php print render($tabs2); ?>
        <?php print $messages; ?>
        <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
        <div class="clearfix">
          <?php print render($page['content']); ?>
        </div>
      </div>   
    </div>

    <!--footer-->
    <div id="footer">
      <?php print render($page['footer']); ?>
      <?php print $footer_text; ?>
    </div>
    <!--END footer-->
</div>
<!--End mainConteiner-->
