/**
 * Created by user1 on 18.08.14.
 */
jQuery(document).ready(function(){
//    $('.bxslider').bxSlider({
//        pagerCustom: '#bx-pager',
//        controls: false
//    });

    // The slider being synced must be initialized first
    jQuery('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 210,
        itemMargin: 5,
        asNavFor: '#slider'
    });

    jQuery('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel"
    });


    function MenuPosCh() {
        if (jQuery(document).width() < 1199 ) {
            jQuery('#menu-top').appendTo(jQuery('#mobile-menu-position'));
        } else {
            jQuery('#menu-top').appendTo(jQuery('#desc-menu-position'));
        };
    };

    MenuPosCh();

    jQuery(window).resize(function(){
        MenuPosCh();
    });
    //if (!localStorage.getItem('hide_modal')) {
      jQuery(".modal_link").trigger("click" );
      localStorage.setItem('hide_modal', true);
    //}

});