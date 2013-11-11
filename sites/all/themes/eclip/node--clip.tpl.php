<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?> data-limit="<?php isset($node->field_limite['und'][0]['value']) ? print $node->field_limite['und'][0]['value'] : print '5' ?>">
    <?php 
    $args = array(
        'op' => 'view', 
        'node' => $node, 
        'imagen' => $imagen, 
        'destacados1' => $destacados1, 
        'destacados2' => $destacados2
    );
    print theme($template, $args);
    ?>
</div>