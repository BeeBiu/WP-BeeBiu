// 							静态分页
var obj,j=0
var page=0 
var nowPage=0	//当前页 
var listNum=2	//每页显示数 
var PagesLen=0		//总页数 
var PageNum=15	//分页页码显示数量 
var Pagemao='javascript:void(0)' //锚点名称

var beebiu_imgchangesize_value //图片显示大小 px

var beebiu_select_page=0 //下拉页码值
var beebiu_fopen_page=false		//第一次加载页面时不滚动
window.onload=function(){ 
	obj=document.getElementById("show_image_area").getElementsByTagName("div")
	j=obj.length 
	PagesLen=Math.ceil(j/listNum)
	upPage(0) 
	//cookie
	beebiu_imgchangesize_checkCookie() 
	beebiu_img_nextbt()	 //每页图片末张设置点击下一页
} 
function upPage(p){ 
	nowPage=p
	PageNum=Math.floor(document.getElementById('changepage-home').clientWidth/54)			//根据宽度动态调节分页数量
	//内容变换 
	for (var i=0;i<j;i++){ 
		obj[i].style.display="none" 
	} 
	for (var i=p*listNum;i<(p+1)*listNum;i++){ 
		if(obj[i]){
			obj[i].style.display="block" 
		}
	} 
	//分页链接变换 
	var PageNum_2=PageNum%2==0?Math.ceil(PageNum/2)+1:Math.ceil(PageNum/2) 
	var PageNum_3=PageNum%2==0?Math.ceil(PageNum/2):Math.ceil(PageNum/2)+1 
	var strC='',strS='',strE='',strE2='',strE3='',strE3o='',strE4='',strF1='',strF2='',startPage,endPage
	if (PageNum>=PagesLen) { //分页显示数量大于总页数则直接输出全部页数
		startPage=0
		endPage=PagesLen-1
	} 
	else if (nowPage<PageNum_2){
		startPage=0
		endPage=PagesLen-1>PageNum?PageNum:PagesLen-1
	}//首页 
	else {
		startPage=nowPage+PageNum_3>=PagesLen?PagesLen-PageNum-1: nowPage-PageNum_2+1
		var t=startPage+PageNum
		endPage=t>PagesLen?PagesLen-1:t
	} 
		
	for (var i=startPage;i<=endPage;i++){
		strC+='<li><a href="'+Pagemao+'" '
		if (i==nowPage){
			strC+='class="active" onclick="upPage('+i+')">'+(i+1)+'</a></li>'  //设置选中样式
		}
		else {
			strC+='onclick="upPage('+i+')">'+(i+1)+'</a></li>' 
		}
	}
	if(startPage==0){ //刚开始
		//strF1='<li><a href="###" onclick="">...</a></li>'
		//strF2=''
	}
	else if(PagesLen-1==endPage){ //最后了
		//strF1=''
		//strF2='<li><a href="###" onclick="">...</a></li>'
	}
	else{
		//strF1='<li><a href="###" onclick="">...</a></li>'
		//strF2='<li><a href="###" onclick="">...</a></li>'
	}
	//console.log(PagesLen,PageNum ,startPage , endPage,p)
	//strS='<li><a href="'+Pagemao+'" onclick="upPrePage()">❮</a></li>'
	//strE='<li><a href="'+Pagemao+'" onclick="upNextPage()">❯</a></li>' 
	//strE2=nowPage+1+"/"+PagesLen+"页"+"  共"+j+"条" 
	strE2=''
	//document.getElementById("changpage").innerHTML='<ul class="pagination">'+strS+strC+strE+strE2+'</ul>' 
	strE3= '<br><ul class="pagination">' 
	strE3+= '<li><a href="' + Pagemao + '" onclick="upPage(0)">首页</a></li><li>' 
	beebiu_select_page=nowPage			//改变下拉页码默认值 这里下拉页码要一样
	for(var i=0;i<PagesLen;i++){
		strE3o+='<option value="'+i+'"'
		if(beebiu_select_page==i){
			strE3o+=' selected="selected"'	//判断页码是否选中
		}
		strE3o+=' >'+(i+1)+'/'+PagesLen+'</option>'
	}
	strE3+= '<select class="beebiu_imglist_select">'+strE3o+'</select>'
	strE3+= '</li><li><a href="' + Pagemao + '" onclick="upPage(' + (PagesLen-1) + ')">尾页</a></li>'
	strE3+= '</ul>'

	strE4='<div class="pagination_div">'
	//strE4+= '<a class="pagination_div_bt2" href="' + Pagemao + '" onclick="upPage(0)">首</a>'
	strE4+= '<a class="pagination_div_bt" style="transform:rotate(180deg);" href="'+Pagemao+'" onclick="upPrePage()">➤</a>'		//上一页
	strE4+= '<a class="pagination_div_bt" href="'+Pagemao+'" onclick="upNextPage()">➤</a>' 		//下一页
	//strE4+= '<a class="pagination_div_bt2" href="' + Pagemao + '" onclick="upPage(' + (PagesLen-1) + ')">尾</a>'
	strE4+= '</div>'

	var list1=document.getElementsByClassName('changepage')
	for(var i=0;i<list1.length;i++){
		list1[i].innerHTML='<ul class="pagination">'+strS+strF2+strC+strF1+strE+strE2+'</ul>'+strE3+strE4
	}
	
	beebiu_fopen_page?scrollpagetop():beebiu_fopen_page=true //第一次加载页面时不滚动

	cg_select_bind() 	//下拉栏在chrome不支持onchange，只能动态绑定事件
} 
function upPrePage(){
	if(nowPage>0){
		beebiu_select_page=nowPage-1		//改变下拉页码默认值
		upPage(nowPage-1)
		scrollpagetop()
	}
}
function upNextPage(){
	if(nowPage<PagesLen-1){
		beebiu_select_page=nowPage+1		//改变下拉页码默认值
		upPage(nowPage+1)
		scrollpagetop()
	}
}
function ck_keycode(){ //键盘按下方向键上一页下一页
    key = event.keyCode;
    if (key == 37) {
		upPrePage()
	}
    if (key == 39) {
		upNextPage()
	}
 }
document.onkeydown=ck_keycode; //绑定键盘事件

function cg_select_bind(){
	//document.getElementById('beebiu_imglist_select').addEventListener('change',cg_select,false)
	var select1=document.getElementsByClassName('beebiu_imglist_select')
	for(var i=0;i<select1.length;i++){
		select1[i].onchange=function(){ cg_select(this.value) } //绑定下拉页码事件
	}
}
function cg_select(value){
	upPage(Number(value))		//下拉页码响应函数
}

function scrollpagetop(){
	//滚动到锚点
	const currentY = document.documentElement.scrollTop || document.body.scrollTop
	//const scrollHeight = document.getElementsByClassName('changepage')[0].offsetTop
	const scrollHeight = document.getElementById('changepage-home').offsetTop
	beebiu_scroll(currentY, scrollHeight)
}
// 							静态分页 EDN

/**
 * 						每页图片末张设置点击下一页
 */
function beebiu_img_nextbt(){
	var x=document.getElementsByClassName('img-item')
	var i,n;
	for(i=0,n=0;i<x.length;i++){
		//listNum 每页显示的图片数量
		if(n==listNum-1){
			n=0
			if (x[i].addEventListener){
				x[i].addEventListener('click',upNextPage)
			}
			else{
				x[i].onclick=function(){ upNextPage() }
			}
		}
		else{
			n++
		}
	}
}


/**
 * 						图片大小滑块条 有cookie
 */
//var beebiu_imgchangesize_value; //图片显示大小 px
function beebiu_imgchangesize(value1){
	var range = document.getElementById("changgepage_range")
	var x = document.getElementsByClassName("img-item")
	var i;
	var max=range.max==range.value?true:false
	beebiu_imgchangesize_value = value1
	for (i = 0; i < x.length; i++) {
		if (max){
			x[i].style.width = '100%'
		}
		else{
			x[i].style.width = beebiu_imgchangesize_value+'px'
		}
	}
	beebiu_setCookie('beebiu_imgchangesize',beebiu_imgchangesize_value,7) // 滑动后改变cookie
	range.blur() //主动失去焦点
	//console.log('xiecookie',value1,i,range.max,range.value,beebiu_imgchangesize_value);
}
function beebiu_setCookie(cname,cvalue,exdays){ //cookie (名称，值，时效)
	var d = new Date();
	d.setTime(d.getTime()+(exdays*24*60*60*1000));
	var expires = 'expires='+d.toGMTString();
	document.cookie = cname + '=' + cvalue + '; ' + expires;
}
function beebiu_getCookie(cname){
	var name = cname + '=';
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) {
		var c = ca[i].trim();
		if (c.indexOf(name)==0) { return c.substring(name.length,c.length); }
	}
	return '';
}
function beebiu_imgchangesize_checkCookie(){
	var value1=beebiu_getCookie('beebiu_imgchangesize') 
	if (value1 != ''){
		beebiu_imgchangesize_value = value1
	}
	else {
		beebiu_imgchangesize_value = 1000 //默认1000px
		beebiu_setCookie('beebiu_imgchangesize',beebiu_imgchangesize_value,7) // 设置cookie
	}
	document.getElementById("changgepage_range").value = beebiu_imgchangesize_value //range值初始化
	beebiu_imgchangesize(beebiu_imgchangesize_value)
}


/**
 *	延时滚动动画  window.scrollTo
 * currentY = document.documentElement.scrollTop || document.body.scrollTop  //当前页面滚动距离
 * targetY 需要移动的dom当前位置离要移到的位置的距离
 */
function beebiu_scroll (currentY, targetY) {
	// 计算需要移动的距离
	let needScrollTop = targetY - currentY
	let _currentY = currentY
	setTimeout(function(){
	  // 一次调用滑动帧数，每次调用会不一样 递归最好别用箭头函数
	  const dist = Math.ceil(needScrollTop / 10)
	  _currentY += dist
	  window.scrollTo(_currentY, currentY)
	  // 如果移动幅度小于十个像素，直接移动，否则递归调用，实现动画效果
	  if (needScrollTop > 10 || needScrollTop < -10) {
		beebiu_scroll(_currentY, targetY)
	  } else {
		window.scrollTo(_currentY, targetY)
	  }
	}, 1)
}
  

/** 			全屏按钮 
 * */ 
var Fullscreenbt=false;
document.addEventListener("fullscreenchange", function( event ) { //响应改变全屏状态
	if (document.fullscreenElement) {
	  //console.log('进入全屏')
	  Fullscreenbt=true
	} else {
	  //console.log('退出全屏')
	  Fullscreenbt=false
	}
  });
function changgeFullscreen(){
	if(Fullscreenbt){
		exitFullscreen()
	}
	else{
		launchFullscreen(document.documentElement)
	}
}
function launchFullscreen(element) {
	if(element.requestFullscreen) {
	element.requestFullscreen();
	} else if(element.mozRequestFullScreen) {
	element.mozRequestFullScreen();
	} else if(element.webkitRequestFullscreen) {
	element.webkitRequestFullscreen();
	} else if(element.msRequestFullscreen) {
	element.msRequestFullscreen();
	}
}
function exitFullscreen() {
	if (document.exitFullscreen) {
	  document.exitFullscreen();
	} else if (document.msExitFullscreen) {
	  document.msExitFullscreen();
	} else if (document.mozCancelFullScreen) {
	  document.mozCancelFullScreen();
	} else if (document.webkitExitFullscreen) {
	  document.webkitExitFullscreen();
	}
}



//原生AJAX，支持post，get
var beebiu_ajax = function(obj) {
	// setting extend
	var url = obj.url || '';
	var method = obj.method || 'GET';
	var data = obj.data || null;
	var callback = obj.callback || undefined;
	var json = obj.json || false;
	var contentType = obj.contentType || 'application/x-www-form-urlencoded';
	var xhr = new XMLHttpRequest();
	xhr.open(method, url, true);
	// 设置请求数据的类型
	xhr.setRequestHeader('Content-Type', contentType);
	// 设置返回执行的函数
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4) {
			if (xhr.status == 200) {
			callback ? callback(xhr.responseText) : '';
			}
			else{
				console.log('ajax error');
			}
		}
	}
	json ? xhr.send(JSON.stringify(data)) : xhr.send(obj2query(data));
}
var obj2query = function(obj) {
	var query = '';
	for ( var item in obj) {
		if (obj.hasOwnProperty(item)) {
			// console.log("item is " + item + " and obj.item is " + obj[item]);
			query += item + '=' + obj[item] + '&';
		}
	}
	return query.substring(0, query.length - 1);
}

//数据修改等操作应传入 wp_create_nonce() 以便认证
// 控件ID,函数名，wp认证key
function loadXMLDoc(button, action_, nonce, docid){
	button.disabled=true //防止重复提交
	beebiu_ajax({
		url: '/wordpress/wp-admin/admin-ajax.php',
		method : 'post',
		 data : {
			action : action_,
			postCommentNonce : nonce,
			ajax_postid : post_id_
		 },
		callback : function(response){
			button.disabled=false
			if(docid!=''){
				document.getElementById(docid).innerHTML=response
			}
			console.log('服务器返回 ok', response);
		}
	});
	//alert('发送了')
}
