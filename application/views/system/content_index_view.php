<script type="text/javascript">	
var n = 1;	
var slide_list = [
<?include("./application/views/system/slide.php");?>
];	
var slide_width = '80%';
</script>
<script type="text/javascript" src="/js/slideshow.js"></script>

<div id="slideshow_buffer" style="display: none;"></div>
<div id="slideshow"></div>

<?if($type=='admin'){?>
	<?$d['elm']='Index';?>
	<?$this->load->view("/system/admin_edit",$d);?>
<?}?>
<div id="block_Index">
	<?$this->load->view("/Index/content_Index_".$lang."_view")?></div>