<?php
?>
<?php print render($page['header']); ?>  
<!--mainConteiner-->
<div id="mainConteiner">

    <!--header-->
    <?php if (!$is_intranet): ?>
    <div id="header">
      <?php print $customer_header; ?>
    </div>
    <?php endif; ?>
    <!--END header-->

    <!--contentConteiner-->
    <div id="contentConteiner">      
      <?php if ($page['sidebar_first']): ?>
        <div id="navLeftSecciones" class="sidebar">
          <?php print render($page['sidebar_first']); ?>
        </div>
      <?php endif; ?>
      
      <div id="contentSeccionesDetail">       
        <div id="center">
          <div id="squeeze">
            <div class="right-corner">
              <div class="left-corner">
                <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
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
                <?php print render($page['help']); ?>
                <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
                <div class="clearfix">
                  <?php print render($page['content']); ?>
                </div>
                <?php print $feed_icons ?>          
        </div></div></div></div> <!-- /.left-corner, /.right-corner, /#squeeze, /#center -->      
      </div>
      
      <?php if ($page['sidebar_second']): ?>
        <div id="navRightSecciones" class="sidebar">
          <?php print render($page['sidebar_second']); ?>
        </div>
      <?php endif; ?>      
    </div>
    <!--End contentConteiner-->


    <!--footer-->
    <div id="footer">
      <?php print render($page['footer']); ?>
      <?php print $footer_text; ?>
    </div>
    <!--END footer-->


</div>
<!--End mainConteiner-->
