$(function(){
    $(".dropdown-main li").hover(
        function(){
            //$('ul.sub', this).slideDown(500);
            //$('>ul.sub', this).slideDown(500);
            $('>ul.dropdown-container:not(:animated)', this).slideDown(500);
        },
        function(){
            //$('ul.sub',this).slideUp(300);
            $('>ul.dropdown-container',this).slideUp(300);
        }
    );
});