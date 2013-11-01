/**
* Provide the HTML to create the modal dialog.
*/

Drupal.theme.prototype.EclipDefaultModal = function () {
  var html = ''
  html += '<div id="ctools-modal" class="popups-box">';  
  html += '  <div class="ctools-modal-content eclip-modal-content">';
  html += '    <span class="popups-close"><a class="close" href="#">X</a></span>';  
  html += '    <div class="modal-container">';
  html += '      <div class="modal-header">';
  html += '        <span id="modal-title" class="modal-title"></span>';
  html += '        <div class="clear-block"></div>';
  html += '      </div>';
  html += '    <div class="modal-scroll"><div id="modal-content" class="modal-content"></div></div>';
  html += '  </div>';
  html += '</div>';
  return html;
}