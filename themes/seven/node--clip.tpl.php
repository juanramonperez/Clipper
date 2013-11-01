<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php
     print theme('eclip-01', array('op' => 'view', 'node' => $node));
  ?>

</div>
