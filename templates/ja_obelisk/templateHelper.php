<?php
/**
 * ------------------------------------------------------------------------
 * JA Fixel Template
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - Copyrighted Commercial Software
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites:  http://www.joomlart.com -  http://www.joomlancers.com
 * This file may not be redistributed in whole or significant part.
 * ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.image.image');

class JAObeliskHelper {
    public static function relTime($timespan, $granularity = 2) {
        static $units = array(
            'YEAR' => 31536000,
            'MONTH' => 2592000,
            'WEEK' => 604800,
            'DAY' => 86400,
            'HOUR' => 3600,
            'MIN' => 60,
            'SEC' => 1,
        );

        $output = '';
        if(!ctype_digit($timespan)){
            $timespan = strtotime($timespan);
        }

        $interval = time() - $timespan;

        $future = $interval < 0;
        if($future){
            $interval = abs($interval);
        }

        foreach ($units as $key => $value) {
            if ($interval >= $value) {
                $output .= ($output ? ' ' : '') . JText::sprintf('TPL_RT_' . $key . (floor($interval / $value) != 1 ? 'S' : ''), floor($interval / $value));
                $interval %= $value;
                $granularity--;
            }

            if ($granularity == 0) {
                break;
            }
        }

        return $output ? JText::sprintf($future ? 'TPL_RT_FUTURE' : 'TPL_RT_PAST', $output) : JText::_('TPL_RT_NOW');
    }

    public static function getParam($item){

        if(! $item->params instanceof JRegistry) {
            $params = new JRegistry;
            $params->loadString($item->params);

            $item->params = $params;
        }

        return $item->params;
    }

    public static function getEx($item){

        if(!isset($item->iattribs) && is_string($item->attribs)){
            $attribs = new JRegistry;
            $attribs->loadString($item->attribs);
            $item->iattribs = $attribs;
        }

        if(isset($item->iattribs) && $item->iattribs instanceof JRegistry){
            return array(
                'type' => $item->iattribs->get('content_type', 'text')
            );
        }

        return array(
            'type' => 'text',
        );
    }
    public static function image($item, $type = ''){

        $result = array();

        if($type == 'video'){
            $result = self::video($item);
        }

        if(empty($result)){

            if(preg_match('/<img[^>]+>/i', isset($item->text) ? $item->text : $item->introtext, $imgs)){
                return JUtility::parseAttributes($imgs[0]);
            }
        }

        return $result;
    }
    public static function sanitize($item, $prop = 'introtext'){
        $exinfo = self::getEx($item);
        $result = $item->$prop;

        if($exinfo['type'] == 'video'){
            $result = preg_replace('@<iframe\s[^>]*src=[\"|\']([^\"\'\>]+)[^>].*?</iframe>@ms', '', $item->$prop);
        } else if($exinfo['type'] == 'gallery'){
            $result = preg_replace('@<img[^>]+>@ms', '', $item->$prop);
        }

        return $result;
    }
    public static function getMedia($content,$width=420,$height=315){
        $htmlmedia = '';
        $media = JAObeliskHelper::getMediaData($content);
        //Video content
        $htmlmedia .= '<div id="video-container">';
        //Always show iframe first
        $htmlmedia .= '<iframe width="'.$width.'" height="'.$height.'" src="'.$media[0]['src'].'" frameborder="0" allowfullscreen></iframe>';
        $htmlmedia .= '</div>';

        //Carosel video
        $htmlmedia .= '<ul id="videocarousel" class="jcarousel-skin-tango">';
        $i =0;
        foreach($media as $mda){
            $sactive = '';
            if($i == 0) $sactive =' active';
            $htmlmedia .= '<li><a href="'.$mda['src'].'"><img src="'.$mda['thumb'].'" class="thumb'.$sactive.'" /></a></li>';
            $i ++;
        }
        $htmlmedia .= '</ul>';

        return $htmlmedia;
    }
    protected function getMediaData($videos){

        $data = array();
        if(preg_match_all('@<iframe\s[^>]*src=[\"|\']([^\"\'\>]+)[^>].*?</iframe>@ms', $videos, $iframesrc) > 0){
            if(isset($iframesrc[1])){
                foreach($iframesrc[1] as $ifr){
                    //Check youtube embed
                    $video = array();
                    $vid = str_replace(
                        array(
                            'http:',
                            'https:',
                            '//youtu.be/',
                            '//www.youtube.com/embed/',
                            '//youtube.googleapis.com/v/'), '', $ifr);

                    $vid = preg_replace('@(\/|\?).*@i', '', $vid);

                    if(!(empty($vid))){
                        $video['thumb']   = 'http://img.youtube.com/vi/' . $vid . '/0.jpg';
                        $video['src']   = $ifr;
                        array_push($data,$video);
                    }else{
                        //Check vimeo embed
                        $vid = str_replace(
                            array('//player.vimeo.com/video/'), '', $ifr);

                        $vid = preg_replace('@(\/|\?).*@i', '', $vid);

                        if(!(empty($vid))){
                            $video['thumb']   = JAObeliskHelper::getVimeoThumb('http://vimeo.com/api/v2/video/' . $vid . '.json');
                            $video['src']   = $ifr;
                            array_push($data,$video);
                        }
                    }
                }
            }

        }
        return $data;
    }

    protected function getVimeoThumb($data)
    {
        //Check allow_url_fopen
        if(ini_get('allow_url_fopen') == 1){
            $data = @file_get_contents($data);
            $data = json_decode($data);
            return $data[0]->thumbnail_large;
        }elseif(function_exists('curl_version')){
            //Using by curl
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
            curl_setopt($ch, CURLOPT_URL, $data);
            $data = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($data);
            return $data[0]->thumbnail_large;
        }else{
            //Return null
            return;
        }
    }

    public static function photogallery($items,$class="span4"){
        if(preg_match_all('#<img[^>]+>#iU', $items, $imgs)){
            //remove the text
            $items = preg_replace('#<img[^>]+>#iU', '', $items);
            //collect all images
            $img_data = array();
            // parse image attributes
            foreach( $imgs[0] as $img_tag){
                $img_data[$img_tag] = JUtility::parseAttributes($img_tag);
            }
            $total = count($img_data);
            if($total > 0) :
                $items .=  '<h3 class="gallery-title">'.JText::_('TPL_PHOTO').'</h3><ul class="thumbnails row-fluid" id="ja-k2-gallery">';
                $j = 0;
                foreach ($img_data as $img => $attr) :
                    $items .=  '<li class="'.$class.'">'
                        .'<a title="'.$attr['alt'].'" href="'.(isset($attr['src']) ? $attr['src'] : '').'" class="thumbnail'.($j == 0 ? ' active' : '').'">'
                        .$img.
                        '</a>
                    </li>';
                    $j++;
                endforeach;
                $items .= '</ul>';
            endif;
            return $items;
        }else{
            return $items;
        }
    }
}
