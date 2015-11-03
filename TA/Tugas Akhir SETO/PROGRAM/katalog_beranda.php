<?php 
	session_start();	
	include "config/koneksi.php";
	include "config/fungsi_indotgl.php";
	include "config/class_paging.php";
	include "config/fungsi_combobox.php";
	include "config/library.php";
	include "config/fungsi_autolink.php";
	include "config/fungsi_rupiah.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
	<title>NANO/Computer/Corner ::: Belanja segala jenis komputer dan perlengkapannya secara online.</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="css/orbit-1.3.0.css" />    
    <link rel="stylesheet" type="text/css" href="js/css/smoothnsss/jquery-ui-1.8.17.custom.css" />
	<link rel="stylesheet" href="js/nikki-liteAccordion/css/liteaccordion.css" />
    <script type="text/javascript" src="js/jquery-ui-1.8.17.customm.min.js"></script>
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" src="js/jquery.orbit-1.3.0.min.js"></script>
	<script src="js/nikki-liteAccordion/js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="js/nikki-liteAccordion/js/liteaccordion.jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="css/js/nicEdit2.js"></script>
	<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	</script>
	<!--[if IE 6]>
	<link rel="stylesheet" type="text/css" href="css/iecss.css" />
	<![endif]-->
	<!-- JavaScript Popup Image -->
	<script>
	PositionX = 100;
	PositionY = 100;

	defaultWidth  = 500;
	defaultHeight = 500;
	var AutoClose = true;

	if (parseInt(navigator.appVersion.charAt(0))>=4){
		var isNN=(navigator.appName=="Netscape")?1:0;
		var isIE=(navigator.appName.indexOf("Microsoft")!=-1)?1:0;
	}
	var optNN='scrollbars=no,width='+defaultWidth+',height='+defaultHeight+',left='+PositionX+',top='+PositionY;
	var optIE='scrollbars=no,width=150,height=100,left='+PositionX+',top='+PositionY;
	function popImage(imageURL,imageTitle){
		if (isNN){imgWin=window.open('about:blank','',optNN);}
		if (isIE){imgWin=window.open('about:blank','',optIE);}
		with (imgWin.document){
			writeln('<html><head><title>Loading...</title><style>body{margin:0px;}</style>');writeln('<sc'+'ript>');
			writeln('var isNN,isIE;');writeln('if (parseInt(navigator.appVersion.charAt(0))>=4){');
			writeln('isNN=(navigator.appName=="Netscape")?1:0;');writeln('isIE=(navigator.appName.indexOf("Microsoft")!=-1)?1:0;}');
			writeln('function reSizeToImage(){');writeln('if (isIE){');writeln('window.resizeTo(300,300);');
			writeln('width=300-(document.body.clientWidth-document.images[0].width);');
			writeln('height=300-(document.body.clientHeight-document.images[0].height);');
			writeln('window.resizeTo(width,height);}');writeln('if (isNN){');       
			writeln('window.innerWidth=document.images["George"].width;');writeln('window.innerHeight=document.images["George"].height;}}');
			writeln('function doTitle(){document.title="'+imageTitle+'";}');writeln('</sc'+'ript>');
			if (!AutoClose) writeln('</head><body bgcolor=ffffff scroll="no" onload="reSizeToImage();doTitle();self.focus()">')
			else writeln('</head><body bgcolor=ffffff scroll="no" onload="reSizeToImage();doTitle();self.focus()" onblur="self.close()">');
			writeln('<img name="George" src='+imageURL+' style="display:block"></body></html>');
			close();		
		}
	}
	
	</script><!-- End PopUp -->
	 <script>
	$(function() {
		$( "#tabs" ).tabs({
			collapsible: true,
		});
		/*var cookie = $("#tabs").tabs("option","cookie");
		$("#tabs").tabs("option","cookie",{ expires:1 } );*/
	});
	$(function() {
		$( "#tabsBottom" ).tabs({
			collapsible: true,
		});
		/*var cookie = $("#tabs").tabs("option","cookie");
		$("#tabs").tabs("option","cookie",{ expires:1 } );*/
	});
	$(function() {
		$( "#tabsSocial" ).tabs();
	});
	$(function() {
		$( "#accordion" ).accordion({
		 autoHeight: false,
		 collapsible: true
		});
	});
	$(function() {
		$( "#accordionMenu" ).accordion({
		 autoHeight: false,
		  event: 'mouseover'
		});
	});
	</script>
	<script type="text/javascript" src="css/js/boxOver.js"></script>
    <style type="text/css">

#topbar{
position:absolute;
padding: 0px;
width: 275px;
height:40;
visibility: hidden;
z-index: 300;
}

</style>

<script type="text/javascript">

/***********************************************
* Floating Top Bar script- © Dynamic Drive (www.dynamicdrive.com)
* Sliding routine by Roy Whittle (http://www.javascript-fx.com/)
* This notice must stay intact for legal use.
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

var persistclose=0 //set to 0 or 1. 1 means once the bar is manually closed, it will remain closed for browser session
var startX = 180 //set x offset of bar in pixels
var startY = 2 //set y offset of bar in pixels
var verticalpos="fromtop" //enter "fromtop" or "frombottom"

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function get_cookie(Name) {
var search = Name + "="
var returnvalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search)
if (offset != -1) {
offset += search.length
end = document.cookie.indexOf(";", offset);
if (end == -1) end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end))
}
}
return returnvalue;
}

function closebar(){
if (persistclose)
document.cookie="remainclosed=1"
document.getElementById("topbar").style.visibility="hidden"
}

function staticbar(){
	barheight=document.getElementById("topbar").offsetHeight
	var ns = (navigator.appName.indexOf("Netscape") != -1) || window.opera;
	var d = document;
	function ml(id){
		var el=d.getElementById(id);
		if (!persistclose || persistclose && get_cookie("remainclosed")=="")
		el.style.visibility="visible"
		if(d.layers)el.style=el;
		el.sP=function(x,y){this.style.left=x+"px";this.style.top=y+"px";};
		el.x = startX;
		if (verticalpos=="fromtop")
		el.y = startY;
		else{
		el.y = ns ? pageYOffset + innerHeight : iecompattest().scrollTop + iecompattest().clientHeight;
		el.y -= startY;
		}
		return el;
	}
	window.stayTopLeft=function(){
		if (verticalpos=="fromtop"){
		var pY = ns ? pageYOffset : iecompattest().scrollTop;
		ftlObj.y += (pY + startY - ftlObj.y)/8;
		}
		else{
		var pY = ns ? pageYOffset + innerHeight - barheight: iecompattest().scrollTop + iecompattest().clientHeight - barheight;
		ftlObj.y += (pY - startY - ftlObj.y)/8;
		}
		ftlObj.sP(ftlObj.x, ftlObj.y);
		setTimeout("stayTopLeft()", 10);
	}
	ftlObj = ml("topbar");
	stayTopLeft();
}

if (window.addEventListener)
window.addEventListener("load", staticbar, false)
else if (window.attachEvent)
window.attachEvent("onload", staticbar)
else if (document.getElementById)
window.onload=staticbar
</script>
</head>
<body>
<!--<div id="topbar"><a href="" onClick="closebar(); return false"><img src="css/images/close.gif" border="0" /></a>
<div class="top_search"><form action="search?" method="post">
            <input type="text" class="search_input" name="search" value="Pencarian Cepat" />
            <input type="image" src="css/images/keyword-icon.png" width="25" height="25" class="search_bt"/></form>
</div>
</div>
	<script type="text/javascript">
		//global vars
		var inputWdith = '250px';
		var inputWdithReturn = '140px';		
		$(document).ready(function() {
			$('input').focus(function(){
				//clear the text in the box.
				$(this).val(function() {
		            $(this).val(''); 
				});
				//animate the box
				$(this).animate({
					width: inputWdith
				}, 500 )
			});	
			
			$('input').blur(function(){
				$(this).val('Enter Search Value');
				$(this).animate({
					width: inputWdithReturn
				}, 800 )
			});
		});
		
		</script>-->
<div id="main_container">
	<div id="header">
		<?php
			include "include/header.php";
		?>
	</div>
	<div id="main_content"> 
		<div id="menu_tab">
			<?php
				include "include/menu.php";
			?>
   		</div><!-- end of menu tab -->
   		<div class="left_content">
			<?php
				include "include/left_content.php";
			?>
		</div><!-- end of left content -->
		<div class="center_content">
			<?php
				include "katalog_konten.php";
				if ($_GET['module']!="detailproduk") {
			?>
			<div id="bottom_section">
				<div id="tabsBottom">
					<ul>
						<li><a href="#promo"><img src="css/images/icq.png" /></a></li>
						<li><a href="#barubeli"><img src="css/images/itunes.png" /></a></li>
						<li><a href="#lastreview"><img src="css/images/hype_machine.png" /></a></li>
					</ul>
					<div id="promo">           
						<div class='desc_prod_box_big'>
						
						</div><!--desc_prod_box_big-->
						<br>
					</div><!--end promo-->
					<div id="barubeli">
						<div class='desc_prod_box_big'>

						</div><!--desc_prod_box_big-->
						<br>					
					</div><!-- end barubeli -->
					<div id="lastreview">
						<div class='desc_prod_box_big'>

						</div><!--desc_prod_box_big-->
						<br>					
					</div><!-- end lastreview -->
				</div><!-- end tabsBottom -->		
			</div><!-- end bottom_section -->
			<?php
				}
			?>
        </div><!-- end of center content -->
		<div class="right_content">
			<?php
				include "include/right_content.php";
			?>
		</div><!-- end of right content -->   
   	</div><!-- end of main content -->
    <div class="footer">
		<div class="left_footer">
        <img src="css/images/payment.gif" alt="" title="header=[Pembayaran yang kami terima] body=[&nbsp;] fade=[on]" width="150" height="30"/>
        </div><!-- end of left_footer -->
        <div class="center_footer">
        NANO/Computer/Corner &copy;2011.<br />
        Developed by:<a href="http://setoelkahfi.web.id/" target="_blank" title="header=[http://setoelkahfi.web.id/] body=[&nbsp;] fade=[on]">Seto El Kahfi</a><br />
        </div><!-- end of center_footer -->
        <div class="right_footer">
        <a href="beranda.seto">Beranda</a>
        <a href="profil-kami">Profil Kami</a>
        <a href="peta-situs">Peta Situs</a>
        <a href="kontak-kami">Kontak Kami</a>
        </div><!-- end of RIGHT_footer --> 
   </div><!-- end of footer -->               
</div><!-- end of main_container -->
</body>
</html>