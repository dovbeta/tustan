<div  style="position: absolute;margin-left: 715px;margin-top: -160px;">
            <?if($type=='admin'){?>
            <?$d['elm']='top_telephone';?>
            <?$this->load->view("/system/admin_edit",$d);?>
            <?}?>
            
            <div id="block_top_telephone">
            <?$this->load->view("/top_telephone/content_top_telephone_".$lang."_view")?></div>
            <div>
                <a target="_blank" href='http://vk.com/hoteltustan'><img src="http://hoteltustan.com.ua/images/upload/2014_06_22/24/vk_icon.png"></a>
                <a target="_blank" href='https://www.facebook.com/groups/hoteltustan/'><img src="http://hoteltustan.com.ua/images/upload/2014_06_22/24/facebook-icon.png"></a>
                <a target="_blank" href='http://www.odnoklassniki.ru/profile/570845261117'><img src="http://hoteltustan.com.ua/images/upload/2014_06_22/24/od-icon.png"></a>
            </div>
</div>