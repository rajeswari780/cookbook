jQuery(document).ready(function($){
    // this will get the full URL at the address bar
    var url = window.location.href;

    // passes on every "a" tag
    $("#block-leftnavigation li a").each(function() {
        console.log('inside');
        // checks if its the same on the address bar
        if (url == (this.href)) {
            $(this).closest("li").addClass("active");
            //for making parent of submenu active
           $(this).closest("li").parent().addClass("active");
        }
    });

    $("#navbarSupportedContent li a").each(function() {
        // checks if its the same on the address bar
        if (url == (this.href)) {
            $(this).closest("li").addClass("active");
            //for making parent of submenu active
           $(this).closest("li").parent().addClass("active");
        }
    });
});   