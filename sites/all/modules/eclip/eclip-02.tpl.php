<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php if($op == 'view') :// el clip se esta viendo (no esta siendo editado)?>
<div class="main-template eclip-02 view">
  <div class="main-template-inner">
    <div class="main-left">
      <div class="main-left-inner">
        <div class="zone-1"><?php isset($node->nid) ? print views_embed_view('front_get_categories', 'default', 1, $node->nid) : ''; ?></div>
      </div>      
    </div>
    <div class="main-right">
      <div class="main-right-inner">
        <div class="zone-2"><?php isset($node->nid) ? print views_embed_view('front_get_categories', 'default', 2, $node->nid) : ''; ?></div>
      </div>        
    </div>
    <div class="main-bottom clear-both">
        <div class="zone-3"><?php isset($node->nid) ? print views_embed_view('front_get_categories', 'default', 3, $node->nid) : ''; ?></div>
    </div>
  </div>
</div>
<?php else: ?>
<div class="main-template eclip-02">
  <div class="main-template-inner">
    <div class="main-left">
      <div class="main-left-inner">
        <div class="clipper-placeholder zone-1"><span class="zone-label">Zone 01</span><?php isset($node->nid) ? print views_embed_view('helper_get_categories', 'default', 1, $node->nid) : ''; ?></div>
      </div>      
    </div>
    <div class="main-right">
      <div class="main-right-inner">
        <div class="clipper-placeholder zone-2"><span class="zone-label">Zone 02</span><?php isset($node->nid) ? print views_embed_view('helper_get_categories', 'default', 2, $node->nid) : ''; ?></div>
      </div>        
    </div>
    <div class="main-bottom clear-both">
        <div class="clipper-placeholder zone-3"><span class="zone-label">Zone 03</span><?php isset($node->nid) ? print views_embed_view('helper_get_categories', 'default', 3, $node->nid) : ''; ?></div>
    </div>
  </div>
</div>
<?php endif; ?>