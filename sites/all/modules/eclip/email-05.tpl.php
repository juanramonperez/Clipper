<?php
$colores['title_font']        = '"Trebuchet MS", Helvetica, Arial';
$colores['title_size']        = '20px';
$colores['title_weight']      = 'Bold';
$colores['title_decoration']  = 'none';
?>

<p><?php print t('Si Ud. no ve este correo correctamente presione <a href="!link">aquí<a>', array('!link' => url('clip/' . $url_prefix . '/' . $node->nid, array('absolute' => TRUE)))); ?></p>
<table style="width: 913px; background-color: <?php print $colores['background_color_inner'] ?>; border-spacing: 0px; border-collapse: collapse;">
  <thead>
    <tr><th style="border-collapse: collapse; border-spacing: 0px; padding: 0px"><?php print $header; ?></th></tr>    
  </thead>
  <tbody>
    <tr style="border-top: 1px solid <?php print $colores['liston_header'] ?>">
      <td>
        <table style="width: 100%; border-spacing: 0px;">
          <tbody>
            <tr>
              <td style="width: 370px; vertical-align: top; padding: 15px 15px;">
                <?php print _theme_destacado($destacados, 0, 1, $colores); ?>
              </td>              
              <td style="width: 270px; vertical-align: top; padding: 15px 15px;">
                <?php $colores['title_size'] = '18px'; ?>
                <?php print _theme_destacado($destacados, 1, 1, $colores); ?>             
              </td>   
              <td style="width: 270px; vertical-align: top; padding: 15px 15px;">
                <?php print _theme_destacado($destacados, 2, 1, $colores); ?>
                <p style="text-align: right;"><?php print l(t('[+noticias]'), 'clip/' . $url_prefix . '/' . $node->nid, array('absolute' => TRUE, 'attributes' => array('style' => 'color:' . $colores['link_color'] . '; text-decoration:' . $colores['title_decoration'] . '; font-family
  :' . $colores['title_font']))) ?></p>                  
              </td>  
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr style="height: 20px;"><td></td></tr>
    <tr style="border-top: 1px solid <?php print $colores['borde_zona'] ?>">
      <td style="padding: 15px 0px;">
        <table style="width: 100%; border-spacing: 0px;">
          <tbody>
            <tr>
              <td style="width: 34%; padding: 0px 15px;  vertical-align:top; border-right: 1px solid <?php print $colores['borde_zona'] ?>">
                <?php print _theme_destacado($destacados, 3, 1, $colores);  ?>             
              </td>
              <td style="width: 33%; padding: 0px 15px;  vertical-align:top; border-right: 1px solid <?php print $colores['borde_zona'] ?>">
                <?php
                  $colores['title_size'] = '18px';
                  print _theme_destacado($destacados, 4, 1, $colores); 
                ?>              
              </td>
              <td style="width: 33%; padding: 0px 15px;  vertical-align:top;">
                <?php print _theme_destacado($destacados, 5, 1, $colores); ?>
                <p style="text-align: right;"><?php print l(t('[+noticias]'), 'clip/' . $url_prefix . '/' . $node->nid, array('absolute' => TRUE, 'attributes' => array('style' => 'color:' . $colores['link_color'] . '; text-decoration:' . $colores['title_decoration'] . '; font-family
  :' . $colores['title_font']))) ?></p>
              </td>               
            </tr>
          </tbody>
        </table>        
      </td>
    </tr>
    <tr>
      <td>
        <?php print $footer; ?>
      </td>
    </tr>    
  </tbody>
</table>