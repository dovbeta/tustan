<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ТуCтань</title>
	
	<meta name='yandex-verification' content='7b6fd096c129c123' />
  	<meta name="google-site-verification" content="-wT4bVSVkc6suF-2arBk2etDyhpiE-AKwLVFYClfRlI" />
      
	<jdoc:include type="head" />

    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/assets/css/bootstrap-theme.css" rel="stylesheet">
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/assets/css/main.css" rel="stylesheet">
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/assets/flexslider/flexslider.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">

    <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/assets/js/bootstrap.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/assets/js/html5shiv.min.js"></script>
    <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/assets/js/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/assets/flexslider/jquery.flexslider.js"></script>
    <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/assets/js/main.js"></script>
	
  <script type="text/javascript">
	window.addEvent('domready', function(){
		if (typeof jQuery != 'undefined' && typeof MooTools != 'undefined' ) {
			Element.implement({	
				slide: function(how, mode){
					return this;
				}
			}); 
		}
	 });
  </script>

</head>
<body>
    <div class="container document">

        <div class="header row">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-3 col-md-3 col-sm-6 " id="logo-block">
					<a href="<?php echo $this->baseurl ?>">
                        <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/img/logo.png" class="logo">
					</a>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-6" id="desc-menu-position">
                        <!--<div class="col-lg-12">-->
                            <div class="col-lg-8 top-contacts">
                                <div class="col-lg-3">
                                    +38(067)752-56-78<br>
                                    +38(03248)48-370
                                </div>
                                <div class="col-lg-4">
                                    +38(095)586-51-78<br/>
                                    Skype: tustanua
                                </div>
                                <div class="col-lg-5">
                                    email: hoteltustan@gmail.com<br />
                                    тел: +38(03248)48-377
                                </div>
                            </div>
                            <div class="col-lg-4 top-buttons">
                                <div class="col-lg-6 col-md-3 col-sm-6">
                                </div>
                                <div class="col-lg-6 col-md-3 col-sm-6">
									<jdoc:include type="modules" name="header" />
                                    <!--<span class="button-top">
                                    <a href="#">Увійти</a>
                                    <a href="#">Зареєструватись</a>
                                    </span>-->
                                </div>
                            </div>
                        <!--</div>-->
                        <div id="menu-top" class="col-lg-12">
                            <nav class="navbar" role="navigation">
                                <div class="container-fluid">
                                    <!-- Brand and toggle get grouped for better mobile display -->
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </div>
                                    <!-- Collect the nav links, forms, and other content for toggling -->
                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
										<jdoc:include type="modules" name="mainnav" />
										<jdoc:include type="modules" name="languageswicherload" />
                                    </div><!-- /.navbar-collapse -->
                                </div><!-- /.container-fluid -->
                            </nav>

                        </div>
                    </div>

                </div>
            </div>

            <div id="mobile-menu-position"></div>

            <div class="row">
                <div class="col-lg-12 carousel-block">
                    <div class="col-lg-3">
						<jdoc:include type="modules" name="left" />
                    </div>

                    <div class="col-lg-9">
						<jdoc:include type="modules" name="slider" />
                    </div>

                </div>
            </div>

        </div>
        <div class="content row">
			<jdoc:include type="message" />
			<jdoc:include type="component" />
					<!-- div class="col-lg-11 middle">
						<a href="#" class="social g-plus"></a>
						<a href="#" class="social tweeter"></a>
						<a href="#" class="social vk"></a>
						<a href="#" class="social rss"></a>
						<a href="#" class="social facebook"></a>
						<a href="#" class="social odnoklasniki"></a>
					</div -->
                </div>
            </div>

    <div class="footer">
        <div class="container document">
            <div class="row">
                <div class="col-lg-5">
                    <div class="col-lg-6">
                        <span>+38(067)752-56-78</span>
                        <span>+38(095)586-51-78</span>
                        <span>+38(03248)48-370</span>

                    </div>
                    <div class="col-lg-6">
                        <span>e-mail:   hoteltustan@gmail.com</span>
                        <span>+38(03248)48-377</span><br />
                        <span>Skype:   tustanua</span>
                    </div>
                </div>
                <div class="col-lg-7">
					<jdoc:include type="modules" name="user4" />
                </div>
            </div>
            <div class="row">
				<!-- Топ Traveller -->
				<a href="http://traveller.com.ua" target="_blank" title="on-line бронювання, широкий спектр послуг, лікування і СПА, бювет, ресторани та бари, зручне розташування біля джерел лікувальної води Нафтуся, Східниця, Трускавець, Карпати, відпочинок в Східниці, отдих в Сходнице, відпочинок в Східниці, отдих в Трускавце, відпочтнок в Трускавці, відпочинок в Карпатах."><img src="http://traveller.com.ua/top/img.php?id=4169" border=0 alt="on-line бронювання, широкий спектр послуг, лікування і СПА, бювет, ресторани та бари, зручне розташування біля джерел лікувальної води Нафтуся, Східниця, Трускавець, Карпати, відпочинок в Східниці, отдих в Сходнице, відпочинок в Східниці, отдих в Трускавце, відпочтнок в Трускавці, відпочинок в Карпатах." width="88" height="31"></a>
				<!-- /Топ Traveller -->
				<!-- hit.ua -->
				<a href='http://hit.ua/?x=124233' target='_blank'>
				<script language="javascript" type="text/javascript"><!--
				Cd=document;Cr="&"+Math.random();Cp="&s=1";
				Cd.cookie="b=b";if(Cd.cookie)Cp+="&c=1";
				Cp+="&t="+(new Date()).getTimezoneOffset();
				if(self!=top)Cp+="&f=1";
				//--></script>
				<script language="javascript1.1" type="text/javascript"><!--
				if(navigator.javaEnabled())Cp+="&j=1";
				//--></script>
				<script language="javascript1.2" type="text/javascript"><!--
				if(typeof(screen)!='undefined')Cp+="&w="+screen.width+"&h="+
				screen.height+"&d="+(screen.colorDepth?screen.colorDepth:screen.pixelDepth);
				//--></script>
				<script language="javascript" type="text/javascript"><!--
				Cd.write("<img src='http://c.hit.ua/hit?i=124233&g=0&x=1"+Cp+Cr+
				"&r="+escape(Cd.referrer)+"&u="+escape(window.location.href)+
				"' border='0' width='88' height='31' "+
				"alt='hit.ua: сейчас на сайте, посетителей и просмотров за сегодня' title='hit.ua: сейчас на сайте, посетителей и просмотров за сегодня'/>");
				//--></script>
				<noscript>
				<img src='http://c.hit.ua/hit?i=124233&g=0&x=1' border='0' width='88' height='31' alt='hit.ua: сейчас на сайте, посетителей и просмотров за сегодня' title='hit.ua: сейчас на сайте, посетителей и просмотров за сегодня'/>
				</noscript></a>
				<!-- / hit.ua -->
			</div>
        </div>
    </div>
  <!-- Код тега ремаркетинга Google -->
<!--------------------------------------------------
С помощью тега ремаркетинга запрещается собирать информацию, по которой можно идентифицировать личность пользователя. Также запрещается размещать тег на страницах с контентом деликатного характера. Подробнее об этих требованиях и о настройке тега читайте на странице http://google.com/ads/remarketingsetup.
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 954698280;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/954698280/?value=0&guid=ON&script=0"/>
</div>
</noscript>
</body>
</html>