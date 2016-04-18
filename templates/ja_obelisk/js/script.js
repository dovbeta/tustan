/** 
 *------------------------------------------------------------------------------
 * @package       T3 Framework for Joomla!
 *------------------------------------------------------------------------------
 * @copyright     Copyright (C) 2004-2013 JoomlArt.com. All Rights Reserved.
 * @license       GNU General Public License version 2 or later; see LICENSE.txt
 * @authors       JoomlArt, JoomlaBamboo, (contribute to this project at github 
 *                & Google group to become co-author)
 * @Google group: https://groups.google.com/forum/#!forum/t3fw
 * @Link:         http://t3-framework.org 
 *------------------------------------------------------------------------------
 */
 
var JASliderSupport = {
	inited: false,
	sid: null,
	refresh: false,
	
	initialize: function(){
		if(window.jasliderInst && window.jasliderInst.length && !JASliderSupport.inited){

			window.jasliderInst.each(function(inst){
				inst.lastRZWidth = false;
				inst._ooptions = Object.clone(inst.options);
			});
			
			
			window.addEvent('resize', function(){
				clearTimeout(JASliderSupport.sid);
				JASliderSupport.sid = setTimeout(JASliderSupport.resize, 100);
			}).addEvent('orientationchange', function(){
				widnow.fireEvent('resize');
			});
			
			JASliderSupport.resize();
			
			JASliderSupport.inited = true;
		}
	},
	resize: function(){
	
		window.jasliderInst.each(function(instance){

			var ooptions = instance._ooptions,
				options = instance.options,
				vars = instance.vars,
				ratio = vars.slider.setStyle('width', '').getWidth() / (ooptions.mainWidth+ooptions.thumbWidth),
				nwidth = ooptions.mainWidth * ratio
				nheight = ooptions.mainHeight * ratio,
				ntwidth = ooptions.thumbWidth * ratio,
				ntheight = ooptions.thumbHeight * ratio;
				
			
			if(instance.lastRZWidth != nwidth){
				JASliderSupport.rzTimeout = (/iphone|ipod|ipad|android|ie|blackberry|fennec/).test(navigator.userAgent.toLowerCase()) ? 300 : 100;
				instance.lastRZWidth = nwidth;

				options.mainWidth = nwidth;
				options.mainHeight = nheight;
				
				options.thumbWidth = ntwidth;
				options.thumbHeight = ntheight;
				
				vars.size = Math.floor(nwidth);
				if(options.animation == 'move'){
					vars.mainFrame.setStyle(vars.modes[1], vars.size * (vars.total + 2));
					
					vars.fx = new Fx.Tween(vars.mainFrame, Object.append(Object.clone(vars.fxop), {
						onComplete: instance.animFinished.bind(instance)
					})).set(vars.modes[0], -vars.curIdx * vars.size + vars.offset);
				}
				vars.mainWrap.setStyles({
					'width': nwidth,
					'height': nheight
				});

				vars.mainFrame.setStyles({
					'height': nheight
				});
				
				vars.mainItems.setStyles({
					'width': nwidth,
					'height': nheight
				});
				instance.initMasker();
				instance.initThumbAction();
				instance.initMainCtrlButton();
				instance.initProgressBar();
			} else {
				JASliderSupport.rzTimeout *= 2;
			}
		});

		clearTimeout(JASliderSupport.sid);
		JASliderSupport.sid = setTimeout(JASliderSupport.resize, JASliderSupport.rzTimeout);
	}
};

(function($){

    $(window).load(function(){
        JASliderSupport.initialize();
  			$('html').addClass('loaded');
    });

})(jQuery);
 
(function($){
    $(document).ready(function(){
		$('.modal-header .close').click(function(){
			$('.modal-body').find('iframe').each(function(){
				resrc = $(this).attr('src');
				$(this).attr('src',resrc);
			})
		})
        //Check div message show
        if(($("#system-message-container").html() || '').length > 1){
            if(($("#system-message").html() || '').length > 1){
                $("#system-message-container").show();
                $("#system-message a.close").click(function(){
                    $("#system-message-container").hide();
                });
            }else{
                $("#system-message-container").hide();
            }
        }else{
            $("#system-message-container").hide();
        }

        
        
        // back to top
		(function(){
			$('#back-to-top').on('click', function(){
				$('html, body').stop(true).animate({
					scrollTop: 0
				}, {
					duration: 800, 
					easing: 'easeInOutCubic',
					complete: window.reflow
				});

				return false;
			});
		})();
		//using carousel for popup video
        if($('#videocarousel').length >0){
            $('#videocarousel').jcarousel({
                offset: 1,
                scroll:1
            });
            //Slideshow video
            $('#videocarousel').find('li').each(function(){
                $(this).find('a').click(function(){
                    $('.itemVideoEmbedded #video-container').find('iframe').attr('src',$(this).attr('href'));
                    return false;
                });
            });
        }
        //Override rating joomla plugin
        if($('article .content_rating').length >0 ){
            var imgratings = $('.com_content.view-article .content_rating').find('img'),
                fimgsrc = imgratings.eq(0).attr('src'),
                imghoverin = fimgsrc.indexOf('rating_star_blank.png')>0?fimgsrc.replace('rating_star_blank.png','rating_star.png'):fimgsrc,
                imghoverout = fimgsrc.indexOf('rating_star_blank.png')>0?fimgsrc:fimgsrc.replace('rating_star.png','rating_star_blank.png'),
                defindex = $('.com_content.view-article .content_rating').find('img[src="'+imghoverin+'"]').length,
                formvoter = $('.com_content.view-article .content_vote').parent();
                formvoter.hide();
            //Index images
            imgratings.each(function(index){
                $(this).hover(function(){
                    for(i=0;i<=index;i++){
                        imgratings.eq(i).attr('src',imghoverin);
                    }
                    for(i=index+1;i<5;i++){
                        imgratings.eq(i).attr('src',imghoverout);
                    }
                },function(){
                    for(i=0;i<defindex;i++){
                        imgratings.eq(i).attr('src',imghoverin);
                    }
                    for(i=defindex;i<5;i++){
                        imgratings.eq(i).attr('src',imghoverout);
                    }
                }).click(function(){
                        uratingval = index + 1;

                        formvoter.find('input[name="user_rating"]').filter('[value="'+uratingval+'"]').attr('checked', true);
                        formvoter.submit();
                });
            });
        }
        //Slideshow images in k2 items
        $('#ja-k2-gallery.thumbnails').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0,1]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    return item.el.attr('title');
                }
            }
        });
    });
})(jQuery);