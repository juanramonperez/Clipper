<html>
<head>
  <title>Test email</title>
<style type="text/css">
  @font-face {
      font-family: Gotham;
      src: url(<?php print url(drupal_get_path('theme', 'eclip_theme') . '/fonts/gotham/Gotham-Book.woff', array('absolute' => TRUE)) ?>);
      font-weight:normal;
  }

  @font-face {
      font-family: Gotham;
      src: url(<?php print url(drupal_get_path('theme', 'eclip_theme') . '/fonts/gotham/Gotham-Medium.woff', array('absolute' => TRUE)) ?>);
      font-weight:bold;
  }
  div.title {
    font-family: Gotham;
    font-size: 20px;
    color: red;
  }
</style>    
</head>
<body>

<div class="title" style="font-family: Gotham;"><p>Lorem ipsum sit amet</p></div>
<div class="title"><p style="font-family: Gotham;">Lorem ipsum sit amet</p></div>
</body>
</html>