jQuery(function () {
  jQuery(".dropdown-main li").hover(function () {
    //$('ul.sub', this).slideDown(500);
    //$('>ul.sub', this).slideDown(500);
    jQuery('>ul.dropdown-container:not(:animated)', this).slideDown(500);
  }, function () {
    //$('ul.sub',this).slideUp(300);
    jQuery('>ul.dropdown-container', this).slideUp(300);
  });
});
