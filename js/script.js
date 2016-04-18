function showEditor(id){
		$.post("/adminka/get_view",{view:id,lg:document.getElementById('langues').value},function complite(html){
            
            $('#block_' + id).html(html);
		    document.getElementById('block_' + id + '_buttons').innerHTML = '<div id="' + id + '" onclick="saveContent(this.id)" style="cursor:pointer">Save</div>';
        });
		//var text = document.getElementById('block_'+id).innerHTML;
		//document.getElementById('block_' + id).innerHTML = '<textarea id="block_' + id + '_editor" rows="13" cols="75">' + text + '</textarea>';
		//document.getElementById('block_' + id + '_buttons').innerHTML = '<div id="' + id + '" onclick="saveContent(this.id)" style="cursor:pointer">Save</div>';
	}

function saveContent(id){
		var text = $('iframe#textarea_name').contents().find('body').html();
		$.post("/file_work/save",{ids:id,data:text,lg:document.getElementById('langues').value},function complite(html){

            document.getElementById('block_' + id).innerHTML = text;
		    document.getElementById('block_' + id + '_buttons').innerHTML = '<div id="' + id + '" onclick="showEditor(this.id)" style="cursor:pointer">Edit</div>';
        });

	}
function showslide(){

	$.post("/adminka/get_slide",{},function complite(html){
            document.getElementById('slide_edit').innerHTML = html;
		});
}
	
function select(elm){	
    if(elm.lang=='hide'){
		elm.lang='show';
		document.getElementById(elm.id+"_edit").style.display = "block";
	}else{
		elm.lang='hide';
		document.getElementById(elm.id+"_edit").style.display = "none";
	}
}
function mouseOver(element_id){
	document.getElementById("menu_separator_" + (element_id - 1)).src = "/images/button_separator_over.png";
	document.getElementById("menu_separator_" + (element_id + 1)).src = "/images/button_separator_over.png";
}

function mouseLeave(element_id){
	document.getElementById("menu_separator_" + (element_id - 1)).src = "/images/button_separator_norm.png";
	document.getElementById("menu_separator_" + (element_id + 1)).src = "/images/button_separator_norm.png";
}

function get_menu(){
	$.post("/adminka/get_menu",{},function complite(html){
		document.getElementById("menus_edit").innerHTML = html;
	});
}

function get_news(){
	$.post("/adminka/get_news",{},function complite(html){
		document.getElementById("newss_edit").innerHTML = html;
	});
}

function get_bron(){
	$.post("/adminka/get_bron",{},function complite(html){
		document.getElementById("bron_edit").innerHTML = html;
	});
}
function get_user(){
	$.post("/adminka/get_user",{},function complite(html){
		document.getElementById("user_edit").innerHTML = html;
	});
}

function chek_bot(one,two){
	if((parseInt(one)+parseInt(two))==document.getElementById("result").value){
		document.getElementById("sbm_buttom").style.display = "inline-block";
	}
}

function dell_elm_menu(id){
	if(confirm('Видалити?')){
    $.post("/adminka/dell_menu/",{mid:id},function complite(html){
        document.getElementById("menus_edit").innerHTML = html;
    });
	}
}
function dell_elm_news(id){
	if(confirm('Видалити?')){
		$.post("/news/dell_news/",{nid:id},function complite(html){
			window.location.href = "/";
		});
	}
}

function dell_elm_lang(id){
	if(confirm('Видалити?')){
		$.post("/adminka/dell_lang/",{lid:id},function complite(html){
			window.location.href = "/";
		});
	}
}
function dell_user(id){
	if(confirm('Видалити?')){
		$.post("/adminka/dell_user/",{uid:id},function complite(html){
			get_user();
		});
	}
}
function dell_bron(id){
	if(confirm('Видалити?')){
		$.post("/adminka/dell_bron/",{bid:id},function complite(html){
			get_bron();
		});
	}
}

function edit_langue(lang){
	$.post("/adminka/edit_langue/",{lg:lang},function complite(html){
        document.getElementById("lang_"+lang).style.display = "block";
        document.getElementById("lang_"+lang).innerHTML = "<form action='/adminka/save_langue' method='post'><input type='hidden' name='lg' value='"+lang+"'><textarea cols='75' rows='13' name='langue"+lang+"'>"+html+"</textarea><input type='submit' class='button' value='save'></form>";
    });
}

function conf(){
	//document.getElementById("bg_top").style.width = "600px";//(document.body.scrollWidth)+"px";
	//document.getElementById("bg_top").style.right = "0px";
}


function old_news(lang){
	var start = parseInt(document.getElementById("start").value);
	var count = parseInt(document.getElementById("count").value)-4;
	start+=3;
	if(count<start){
		start = count;
		document.getElementById("start").value = start;
	}else{
		document.getElementById("start").value = start;
	}
	if(start>0){
		document.getElementById("nw").style.display = "block";
	}else{
		document.getElementById("nw").style.display = "none";
	}
	if(start==count){
		document.getElementById("ld").style.display = "none";
	}else{
		document.getElementById("ld").style.display = "block";
	}
	$.post("/news/get_news/"+lang+"/"+start,{},function complite(html){
		document.getElementById("news").innerHTML = html;
	});
}

function new_news(lang){
	var start = parseInt(document.getElementById("start").value);
	var count = parseInt(document.getElementById("count").value)-4;
	start-=3;
	if(0>start){
		start = 0;
		document.getElementById("start").value = start;
	}else{
		document.getElementById("start").value = start;
	}
	if(start>0){
		document.getElementById("nw").style.display = "block";
	}else{
		document.getElementById("nw").style.display = "none";
	}
	if(start==count){
		document.getElementById("ld").style.display = "none";
	}else{
		document.getElementById("ld").style.display = "block";
	}
	$.post("/news/get_news/"+lang+"/"+start,{},function complite(html){
		document.getElementById("news").innerHTML = html;
	});
}


function get_lang(){
	$.post("/adminka/get_lang",{},function complite(html){
		document.getElementById("langs_edit").innerHTML = html;
	});
}







function getObj(objID)
{
    if (document.getElementById) {return document.getElementById(objID);}
    else if (document.all) {return document.all[objID];}
    else if (document.layers) {return document.layers[objID];}
}

function checkClick(e) {
	e?evt=e:evt=event;
	CSE=evt.target?evt.target:evt.srcElement;
	if (getObj('fc'))
		if (!isChild(CSE,getObj('fc')))
			getObj('fc').style.display='none';
}

function isChild(s,d) {
	while(s) {
		if (s==d)
			return true;
		s=s.parentNode;
	}
	return false;
}

function Left(obj)
{
	var curleft = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curleft += obj.offsetLeft
			obj = obj.offsetParent;
		}
	}
	else if (obj.x)
		curleft += obj.x;
	return curleft;
}

function Top(obj)
{
	var curtop = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curtop += obj.offsetTop
			obj = obj.offsetParent;
		}
	}
	else if (obj.y)
		curtop += obj.y;
	return curtop;
}

// Calendar script
var now = new Date;
var sccd=now.getDate();
var sccm=now.getMonth();
var sccy=now.getFullYear();
var ccm=now.getMonth();
var ccy=now.getFullYear();

document.write('<table id="fc" style="position:absolute;top: 315px;left: 570px;border-collapse:collapse;background:#FFFFFF;border:1px solid #303030;display:none;-moz-user-select:none;-khtml-user-select:none;user-select:none; z-index:1000" cellpadding=2>');
document.write('<tr style="font:bold 13px Arial; color:black;"><td style="cursor:pointer;font-size:15px" onclick="csubm()">&laquo;</td><td colspan="5" id="mns" align="center"></td><td align="right" style="cursor:pointer;font-size:15px" onclick="caddm()">&raquo;</td></tr>');
document.write('<tr style="background:#980000;font:12px Arial;color:#FFFFFF"><td align=center>П</td><td align=center>В</td><td align=center>С</td><td align=center>Ч</td><td align=center>П</td><td align=center>С</td><td align=center>Н</td></tr>');
for(var kk=1;kk<=6;kk++) {
	document.write('<tr>');
	for(var tt=1;tt<=7;tt++) {
		num=7 * (kk-1) - (-tt);
		document.write('<td id="v' + num + '" style="width:18px;height:18px">&nbsp;</td>');
	}
	document.write('</tr>');
}
document.write('<tr><td colspan="7" align="center" style="cursor:pointer;font:13px Arial;background:#980000;" onclick="today()">Сьогодні: '+addnull(sccd,sccm+1,sccy)+'</td></tr>');
document.write('</table>');

document.all?document.attachEvent('onclick',checkClick):document.addEventListener('click',checkClick,false);




var updobj;
function lcs(ielem) {
	updobj=ielem;
	getObj('fc').style.left=Left(ielem);
	getObj('fc').style.top=Top(ielem)+ielem.offsetHeight;
	getObj('fc').style.display='';

	// First check date is valid
	curdt=ielem.value;
	curdtarr=curdt.split('-');
	isdt=true;
	for(var k=0;k<curdtarr.length;k++) {
		if (isNaN(curdtarr[k]))
			isdt=false;
	}
	if (isdt&(curdtarr.length==3)) {
		ccm=curdtarr[1]-1;
		ccy=curdtarr[2];
		prepcalendar(curdtarr[0],curdtarr[1]-1,curdtarr[2]);
	}

}

function evtTgt(e)
{
	var el;
	if(e.target)el=e.target;
	else if(e.srcElement)el=e.srcElement;
	if(el.nodeType==3)el=el.parentNode; // defeat Safari bug
	return el;
}
function EvtObj(e){if(!e)e=window.event;return e;}
function cs_over(e) {
	evtTgt(EvtObj(e)).style.background='#FFEBCC';
}
function cs_out(e) {
	evtTgt(EvtObj(e)).style.background='#FFFFFF';
}
function cs_click(e) {
	updobj.value=calvalarr[evtTgt(EvtObj(e)).id.substring(1,evtTgt(EvtObj(e)).id.length)];
	getObj('fc').style.display='none';
}

var mn=new Array('Січень','Лютий','Березень','Квітень','Травень','Червень','Липень','Серпень','Вересень','Жовтень','Листопад','Грудень');
var mnn=new Array('31','28','31','30','31','30','31','31','30','31','30','31');
var mnl=new Array('31','29','31','30','31','30','31','31','30','31','30','31');
var calvalarr=new Array(42);

function f_cps(obj) {
	obj.style.background='#FFFFFF';
	obj.style.font='10px Arial';
	obj.style.color='#333333';
	obj.style.textAlign='center';
	obj.style.textDecoration='none';
	obj.style.border='1px solid #606060';
	obj.style.cursor='pointer';
}

function f_cpps(obj) {
	obj.style.background='#C4D3EA';
	obj.style.font='10px Arial';
	obj.style.color='#FF9900';
	obj.style.textAlign='center';
	obj.style.textDecoration='line-through';
	obj.style.border='1px solid #6487AE';
	obj.style.cursor='default';
}

function f_hds(obj) {
	obj.style.background='#FFF799';
	obj.style.font='bold 10px Arial';
	obj.style.color='#333333';
	obj.style.textAlign='center';
	obj.style.border='1px solid #6487AE';
	obj.style.cursor='pointer';
}

// day selected
function prepcalendar ( hd, cm, cy )
{
	now=new Date();
	sd=now.getDate();
	td=new Date();
	td.setDate(1);
	td.setFullYear(cy);
	td.setMonth(cm);
	cd=td.getDay();
	if (cd==0)cd=6; else cd--;

	getObj('mns').innerHTML=mn[cm]+ ' ' + cy;

	marr=((cy%4)==0)?mnl:mnn;

	for(var d=1;d<=42;d++)
	{
		f_cps ( getObj ( 'v' + parseInt ( d ) ) );
		if ( ( d >= (cd -(-1) ) ) && ( d<=cd-(-marr[cm]) ) )
		{
			getObj('v'+parseInt(d)).onmouseover=cs_over;
			getObj('v'+parseInt(d)).onmouseout=cs_out;
			getObj('v'+parseInt(d)).onclick=cs_click;

			// if today
			if (sccm == cm && sccd == (d-cd) && sccy == cy)
				getObj('v'+parseInt(d)).style.color='#FF9900';

			getObj('v'+parseInt(d)).innerHTML=d-cd;

			calvalarr[d]=addnull(d-cd,cm-(-1),cy);
		}
		else
		{
			getObj('v'+d).innerHTML='&nbsp;';
			getObj('v'+parseInt(d)).onmouseover=null;
			getObj('v'+parseInt(d)).onmouseout=null;
			getObj('v'+parseInt(d)).onclick=null;
			getObj('v'+parseInt(d)).style.cursor='default';
		}
	}
}

prepcalendar('',ccm,ccy);

function caddm() {
	marr=((ccy%4)==0)?mnl:mnn;

	ccm+=1;
	if (ccm>=12) {
		ccm=0;
		ccy++;
	}
	prepcalendar('',ccm,ccy);
}

function csubm() {
	marr=((ccy%4)==0)?mnl:mnn;

	ccm-=1;
	if (ccm<0) {
		ccm=11;
		ccy--;
	}
	prepcalendar('',ccm,ccy);
}

function today() {
	updobj.value=addnull(now.getDate(),now.getMonth()+1,now.getFullYear());
	getObj('fc').style.display='none';
	prepcalendar('',sccm,sccy);
}

function addnull(d,m,y)
{
	var d0='',m0='';
	if (d<10)d0='0';
	if (m<10)m0='0';

	return ''+d0+d+'-'+m0+m+'-'+y;
}