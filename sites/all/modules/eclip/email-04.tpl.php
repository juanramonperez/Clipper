<p style="text-align: center; font-size: 12px; font-family: \'Trebuchet MS\', Helvetica, Arial;"><?php print t('Si Ud. no ve este correo correctamente presione <a href="!link">aquí<a>', array('!link' => url('clip/' . $url_prefix . '/' . $node->nid, array('absolute' => TRUE)))); ?></p>
<table style="width: 913px">
  <thead>
    <tr><th><?php print $header; ?></th></tr>    
  </thead>
  <tbody>
    <tr>
      <td style="border-bottom: 2px solid <?php $borde_inferior_destacado ? print $borde_inferior_destacado : print 'transparent' ?>;">
        <table style="width: 100%">
          <tbody>
            <tr>
              <td style="width: 60%; vertical-align: middle; ">
                <?php print _eclip_build_news_email_destacados_1($node->nid, $url_prefix, array('category_background' => $category_background, 'category_color' => $category_color, 'link_color' => $link_color)); ?>
              </td>
              <td style="width: 40%; vertical-align: middle; text-align: center;">
                <div class="img-destacado"><?php print $imagen_destacado; ?></div>
              </td>              
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table style="width: 100%">
          <tbody>
            <tr>
              <td style="width: 40%; vertical-align:top; border-right: 2px solid <?php print $borde_zona ?>">
                <?php print _eclip_build_news_email_by_zone($news, 1, $url_prefix, array('category_background' => $category_background, 'category_color' => $category_color, 'link_color' => $link_color, 'category_border' => $category_border, 'limite' => $limite)); ?>
              </td>
              <td style="width: 40%; vertical-align:top; border-right: 2px solid <?php print $borde_zona ?>">
                <?php print _eclip_build_news_email_by_zone($news, 2, $url_prefix, array('category_background' => $category_background, 'category_color' => $category_color, 'link_color' => $link_color, 'category_border' => $category_border, 'limite' => $limite)); ?>
              </td>
              <td style="width: 20%; vertical-align:top; ">
                Banners
              </td>               
            </tr>
          </tbody>
        </table>        
      </td>
    </tr>
    <tr>
      <td style="text-align: center; border-top: 2px solid <?php print $borde_zona ?>;">
        <?php print $footer; ?>
      </td>
    </tr>    
  </tbody>
</table>