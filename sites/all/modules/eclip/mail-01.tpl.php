<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="main-template eclip-01 view">
  <div class="main-template-inner">
    <div class="main-left">
      <div class="main-left-inner">
        <div class="zone-1"><?php isset($node->nid) ? print views_embed_view('front_get_categories', 'default', 1, $node->nid) : ''; ?></div>
        <div class="zone-2"><?php isset($node->nid) ? print views_embed_view('front_get_categories', 'default', 2, $node->nid) : ''; ?></div>
        <div class="zone-3"><?php isset($node->nid) ? print views_embed_view('front_get_categories', 'default', 3, $node->nid) : ''; ?></div>
      </div>      
    </div>
    <div class="main-right">
      <div class="main-right-inner">
        <div class="zone-4"><?php isset($node->nid) ? print views_embed_view('front_get_categories', 'default', 4, $node->nid) : ''; ?></div>
        <div class="zone-5"><?php isset($node->nid) ? print views_embed_view('front_get_categories', 'default', 5, $node->nid) : ''; ?></div>
        <div class="zone-6"><?php isset($node->nid) ? print views_embed_view('front_get_categories', 'default', 6, $node->nid) : ''; ?></div>
        <div class="zone-7"><?php isset($node->nid) ? print views_embed_view('front_get_categories', 'default', 7, $node->nid) : ''; ?></div>
      </div>        
    </div>
    <div class="clear-both"></div>
  </div>
</div>s