<?php 
/**
 * @version		0.1
 * @package 
 * @author 
 * @copyright 
 * @license 
 */


ini_set('display_errors', true);
error_reporting(E_ALL); //php 错误显示

function beebiu_setup(){
	
	// ADD THEME SUPPORT
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "custom-header" );
	add_theme_support( "custom-background" );
	add_theme_support( 'post-thumbnails' );
	// add_theme_support('woocommerce');


	// ADD EDITOR STYLE
	add_editor_style();

	//REGISTER NAV MENUS
	register_nav_menus(
	    array(
	      'primary-menu' => __( 'Primary Menu', 'beebiu' ),
	    )
	  );


	 


	load_theme_textdomain( 'beebiu' );


}

add_action('after_setup_theme', 'beebiu_setup');

// Load styles
function beebiu_load_styles_scripts(){
	
		wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css');

		//wp_enqueue_style( 'noto-google-fonts-style', 'https://fonts.googleapis.com/css?family=Noto+Sans');

		if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
	
}

add_action('wp_enqueue_scripts', 'beebiu_load_styles_scripts');


// Creating the sidebar
function beebiu_menu_init() {


register_sidebar(
		array(
                'name' 			=> __('Sidebar Widgets', 'beebiu'),
                'id'    		=> 'sidebar_id',
                'class'       	=> '',
				'description' 	=> __('Add sidebar widgets here', 'beebiu'),
				'before_widget' => '<div class="sidebar-items">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h2>',
				'after_title' 	=> '</h2>',
	));


	register_sidebar(array(
                'name' 			=> __('Left Footer', 'beebiu'),
                'id'    		=> 'left_footer',
                'class' 		=> '',
				'description' 	=> __('Add widgets here', 'beebiu'),
				'before_widget' => '<li>',
				'after_widget' 	=> '</li>',
				'before_title' 	=> '<h2>',
				'after_title' 	=> '</h2>',
	));
	
	register_sidebar(array(
                'name' 			=> __('Middle Footer', 'beebiu'),
                'id'    		=> 'middle_footer',
                'class' 		=> '',
				'description' 	=> __('Add widgets here', 'beebiu'),
				'before_widget' => '<li>',
				'after_widget' 	=> '</li>',
				'before_title'	=> '<h2>',
				'after_title' 	=> '</h2>',
	));
	
	register_sidebar(array(
                'name' 			=> __('Right Footer', 'beebiu'),
                'id'    		=> 'right_footer',
                'class' 		=> '',
				'description' 	=> __('Add widgets here', 'beebiu'),
				'before_widget' => '<li>',
				'after_widget' 	=> '</li>',
				'before_title' 	=> '<h2>',
				'after_title' 	=> '</h2>',
	));
	
	register_sidebar(array(
                'name' 			=> __('Fourth Footer', 'beebiu'),
                'id'    		=> 'fourth_footer',
                'class' 		=> '',
				'description' 	=> __('Add widgets here', 'beebiu'),
				'before_widget' => '<li>',
				'after_widget' 	=> '</li>',
				'before_title' 	=> '<h2>',
				'after_title' 	=> '</h2>',
	));

	register_sidebar(array(
                'name' 			=> __('Full Width Footer', 'beebiu'),
                'id'    		=> 'full_width_footer',
                'class' 		=> '',
				'description' 	=> __('Add widgets here', 'beebiu'),
				'before_widget' => '<li>',
				'after_widget' 	=> '</li>',
				'before_title' 	=> '<h2>',
				'after_title' 	=> '</h2>',
	));

}
add_action('widgets_init', 'beebiu_menu_init');

// 修改摘要信息的长度 默认情况下，摘要(excerpt)信息的长度设置为55个字
function beebiu_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'beebiu_excerpt_length', 999 );
// 修改摘要信息末尾附加的字符串 摘要(excerpt)信息末尾附加的字符串默认设置为“[…]”
function beebiu_excerpt_more( $more ) {
    return '';
}
add_filter( 'excerpt_more', 'beebiu_excerpt_more' );

//																					-----------------------	|| 注册
function beebiu_reg_post_type() {
	$labels = array(
		//'name'					=> _x( 'products', 'Post type general name' ),		//post type 名称
		//'singular_name'			=> _x( 'product', 'Post type singular name' ),		//post type 单个 item 时的名称，因为英文有复数
		//'add_new'				=> _x( '增加产品', '添加新内容的链接名称' ),
		//'add_new_item'			=> __( '增加一个产品' ),
		//'edit_item'				=> __( '编辑产品' ),
		//'new_item'				=> __( '新产品' ),
		//'all_items'				=> __( '所有产品' ),
		//'view_item'				=> __( '查看产品' ),
		//'search_items'			=> __( '搜索产品' ),
		//'not_found'				=> __( '没有找到有关产品' ),
		//'not_found_in_trash'	=> __( '回收站里面没有相关产品' ),
		'parent_item_colon'		=> '',
		'menu_name'				=> '漫画合集'
	);
	$args = array(
		'labels'				=> $labels,
		'description'			=> '貌似完全没用',		//类型的简短描述性摘要
		'public'				=> true,
		'menu_position'			=> 5,		//菜单顺序中应显示帖子类型的位置
		'supports'				=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' , 'revisions' , 'custom-fields' ),
		'taxonomies'			=> array('category', 'post_tag'),	//支持的分类法
		'has_archive'			=> true
	);
	register_post_type( 'book1', $args );
	/* unset( $args );
    unset( $labels ); */
}
add_action( 'init', 'beebiu_reg_post_type' );
//------------------------------------------------------------------------上面是文章类型，下面是分类
function beebiu_reg_tags() {
	$beebiu_post_type =  array( 'post' ,'book1' ); 	//要绑定的文章类型 post为默认文章类型
	$labels = array(
		'name'				=> _x( '作者', 'taxonomy general name' ),		//taxonomy 名称
		'singular_name'		=> _x( '作者', 'taxonomy singular name' ),	//taxonomy 单数名称
		//'search_items'		=> __( '搜索产品分类' ),
		//'all_items'			=> __( '所有产品分类' ),	//tags无效，分类用
		//'parent_item'		=> null,	//__( '该分类的上级分类' ),  如果是tags设为空
		//'parent_item_colon'	=> null,	//__( '该分类的上级分类：' ),
		//'edit_item'			=> __( '编辑产品分类' ),
		//'update_item'		=> __( '更新产品分类' ),
		//'add_new_item'		=> __( '添加新的产品分类' ),
		//'new_item_name'		=> __( '新产品分类' ),
		'menu_name'			=> __( '_作者 artist' ),
	);
	$args = array(
		'labels'			=> $labels,
		'public'			=> true,
		'show_in_nav_menus'	=> true,
		'hierarchical'		=> false, //控制自定义分类法的格式，如果值是false，则将分类（category）转化成标签（tags）
		'show_ui'			=> true,
		'query_var'			=> true,
        'rewrite'			=> true,
        'show_admin_column'	=> true
	);
	register_taxonomy( 'artist', $beebiu_post_type , $args );//$1 是该自定义分类法的名称；$2是对应的自定义文章类型名称

	unset( $args );
	unset( $labels );
	$labels = array(
		'name'				=> _x( '原作', 'taxonomy general name' ),		//taxonomy 名称
		'singular_name'		=> _x( '原作', 'taxonomy singular name' ),	//taxonomy 单数名称
		'menu_name'			=> __( '_原作 original' ),
	);
	$args = array(
		'labels'			=> $labels,
		'public'			=> true,
		'show_in_nav_menus'	=> true,
		'hierarchical'		=> false, //控制自定义分类法的格式，如果值是false，则将分类（category）转化成标签（tags）
		'show_ui'			=> true,
		'query_var'			=> true,
        'rewrite'			=> true,
        'show_admin_column'	=> true
	);
	register_taxonomy( 'original', $beebiu_post_type , $args );//$1 是该自定义分类法的名称；$2是对应的自定义文章类型名称

	unset( $args );
	unset( $labels );
	$labels = array(
		'name'				=> _x( 'language', 'taxonomy general name' ),		//taxonomy 名称
		'singular_name'		=> _x( 'language', 'taxonomy singular name' ),	//taxonomy 单数名称
		'menu_name'			=> __( '_语言 language' ),
	);
	$args = array(
		'labels'			=> $labels,
		'public'			=> true,
		'show_in_nav_menus'	=> true,
		'hierarchical'		=> false, //控制自定义分类法的格式，如果值是false，则将分类（category）转化成标签（tags）
		'show_ui'			=> true,
		'query_var'			=> true,
        'rewrite'			=> true,
        'show_admin_column'	=> true
	);
	register_taxonomy( 'language', $beebiu_post_type , $args );//$1 是该自定义分类法的名称；$2是对应的自定义文章类型名称

	unset( $args );
	unset( $labels );
	$labels = array(
		'name'				=> _x( 'translated', 'taxonomy general name' ),		//taxonomy 名称
		'singular_name'		=> _x( 'translated', 'taxonomy singular name' ),	//taxonomy 单数名称
		'menu_name'			=> __( '_翻译组 translated' ),
	);
	$args = array(
		'labels'			=> $labels,
		'public'			=> true,
		'show_in_nav_menus'	=> true,
		'hierarchical'		=> false, //控制自定义分类法的格式，如果值是false，则将分类（category）转化成标签（tags）
		'show_ui'			=> true,
		'query_var'			=> true,
        'rewrite'			=> true,
		'show_admin_column'	=> true,
	);
	register_taxonomy( 'translated', $beebiu_post_type , $args );//$1 是该自定义分类法的名称；$2是对应的自定义文章类型名称
/* 	unset( $args );
	unset( $labels ); */
}
add_action( 'init', 'beebiu_reg_tags', 0 );
//																					-----------------------	|| 注册 end
//列出目录下所有文件名
function beebiu_scan_dir($dir){
    $files = array();
    if (is_dir($dir) && $dir != '/') {
        if ($handle = opendir($dir)) {
            while (($file = readdir($handle)) !== false) {
                if ($file != "." && $file != "..") {
					if(is_dir($dir . "/" . $file) == false){
						//$files[] = $dir . "/" . $file;
						$files[] = $file;
					}
				}
			}
			closedir($handle);
			return $files;
		}
	}
	else{
		echo '不是目录';
	}
}

function beebiu_geshihua_trim_value(&$value) //回调函数
{ 
    $value = trim($value); 	//去除数组前后空白字符
}

function beebiu_geshihua($file_list){
	$new_flist = array();	//tags函数居然不过滤nbsp空格
	$new_flist = strip_tags( str_replace('&nbsp;','',$file_list) );	//去除html，php等标签 wp有自带函数wp_filter_nohtml_kses，但会去除win目录\
	$new_flist = explode("\n",$new_flist);							//按行分割文本 最好填上第三个参数，避免文章不正常导致过度分割
	//var_dump($new_flist);
	array_walk($new_flist, 'beebiu_geshihua_trim_value'); 			//删除数组中全部成员的空白字符
	//echo '<br>';
	//var_dump($new_flist);
	//echo '<br>shanchu<br>';
	$new_flist = array_filter($new_flist);
	//var_dump($new_flist);
	return array_values($new_flist);		//重建数组索引
}
function beebiu_json($str){
	//将get_the_content() 转为json格式
	//json对部分字符无法解析，仅对win环境路径名 \ 替换处理，如果失败很可能是解析问题
	return json_decode(  str_replace('\\', '/', implode(beebiu_geshihua($str)) ) );
}


function beebiu_js_add() { //添加静态分页JS
   //wp_enqueue_script( 'beebiu_zidingyi_js', get_template_directory_uri() . '/js.js', array(), '1.0.1', false);
}
//add_action( 'wp_enqueue_scripts', 'beebiu_js_add' );



function record_visitors()
{
	if (is_singular()){
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID){
		  $post_views = (int)get_post_meta($post_ID, 'beebiu_views', true);
		  if(!update_post_meta($post_ID, 'beebiu_views', ($post_views+1))){
			add_post_meta($post_ID, 'beebiu_views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'record_visitors');  
 
/// 函数名称：post_views 
/// 函数作用：取得文章的阅读次数
function post_views($before = '', $after = '', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'beebiu_views', true);
  if ($echo){
	  echo $before, number_format($views), $after;
  }
  else{
	  return $views;
  }
}

//add_user_meta 用户额外信息  add_post_meta  文章额外信息  
//add_comment_meta 给一个评论添加meta自定义附加信息

//用户文章收藏功能
function die__beebiu_mark_add(){ //数组结构减少数据库行数，将一个用户所有文章都存入数组，考虑php和流量压力暂时放弃
	//if(is_user_logged_in())
	$user = wp_get_current_user();
	if( 0 != $user->id ){	//判断用户登录
		$beebiu_mark = get_user_meta($user->id, 'beebiu_marks', true);
		global $post;
		$post_ID = $post->ID;

		if( !empty($beebiu_mark) ){
			echo '该用户已存在该记录，直接更新';
			if(isset($beebiu_mark[$post_ID])){ //判断key是否已存在
				echo $post_ID,"已收藏，则不更新";
			} else{
				//不存在则加入成员
				$beebiu_mark[]=array( 
					$post_ID=>array(
						true,
						-1
					)
				);
				echo update_user_meta($user->id, 'beebiu_marks', $beebiu_mark) ,'----';
			}
			echo $post_ID , Print_r(Array_values($beebiu_mark)) , $beebiu_mark['188']  ;
		} else {
			echo '不存在记录，首次建立';
			$beebiu_mark = array( 
				$post_ID=>array(
					true,
					-1
				)
			); //结构 文章ID为key，嵌套数组 [0] 判断是否收藏文章，[1]则是星星评分-1表示没评
			echo $post_ID;
			add_user_meta($user->id, 'beebiu_marks', $beebiu_mark); //如果是空的，初始化建立
		}
	} else {
		echo '该功能必须登陆';
	}
}
//用户文章收藏功能2
function beebiu_mark_add(){ //每个用户对每篇文章的操作均生成一行数据，如果用户基数太大mysql查询压力比较大，由于wp本身架构问题暂无法解决，方案3，自定义数据表看情况，折中来看这个最好
	$user = wp_get_current_user();
	if( !empty($user->id) ){	//判断用户登录
		$post_ID = $_POST['ajax_postid'];
		if($post_ID){
			$beebiu_mark = get_user_meta($user->id, 'beebiu_mk_'. $post_ID, true); //获得该用户对应文章的字段信息

			if( !empty($beebiu_mark) ){
				echo '该用户已存在该记录';
				$beebiu_mark[0] = !$beebiu_mark[0]; //取反 改变收藏

				// if(isset($beebiu_mark[0])){ //判断key是否已存在
				// 	echo '<br>',$post_ID,"已收藏，则不更新";
				// } else{
				// 	//不存在则加入成员
				// 	$beebiu_mark=array(
				// 		true,
				// 		-1
				// 	);
				// 	echo update_user_meta($user->id, 'beebiu_mk_'. $post_ID, $beebiu_mark) ,'<br>--不存在则加入成员--';
				// }
				echo update_user_meta($user->id, 'beebiu_mk_'. $post_ID, $beebiu_mark) ,'<br>--更新数据--';
				echo '<br>',$post_ID , Print_r(Array_values($beebiu_mark)) , $beebiu_mark  ;
			} else {
				//echo '不存在记录，首次建立',$post_ID;
				$beebiu_mark = array(
					true,
					-1
				); //结构 嵌套数组 [0] 判断是否收藏文章，[1]则是星星评分-1表示没评
				add_user_meta($user->id, 'beebiu_mk_'. $post_ID, $beebiu_mark); //如果是空的，初始化建立
			}
		}
	} else {
		echo '必须登陆';
	}
	beebiu_mark_show($_POST['ajax_postid']);
}
//统计行数
function beebiu_mark_show($id){
	if($id){
		$post_ID = $id;
	} else {
		global $post;
		$post_ID = $post->ID;
	}
	if($post_ID){
		global $wpdb;
		$arr = $wpdb->get_results(
			"SELECT COUNT(meta_key) as metas FROM $wpdb->usermeta WHERE meta_key='beebiu_mk_". $post_ID . "'"
		);
		echo $arr[0]->metas;
		//var_dump($arr);
	} else {
		echo 'error';	
	}
}

//get_the_author_meta('mark_post',$id); //获取用户收藏字段
//update_user_meta( $id, 'mark_post', $posts ); //更新字段

//给用户添加自定义字段 数据库 wp_usermeta表  , $contactmethods['数据表 meta_key'] = '列表左侧名称'; 无法自定义值 ，unst 可以删除
add_filter( 'user_contactmethods', 'beebiu_add_contact_fields' );
function beebiu_add_contact_fields( $contactmethods ) {
	$contactmethods['qq'] = 'QQ';
	$contactmethods['qq_weibo'] = '腾讯微博';
	//unset( $contactmethods['yim'] );
	//unset( $contactmethods['aim'] );
	//unset( $contactmethods['jabber'] );
	return $contactmethods;
}



//																												WP AJAX BE
function handler(){
	$nonce = $_POST['postCommentNonce'];
	//echo 'sssssssssssssssssssssssss';

	echo $nonce;
	echo 'ajax_postid=',$_POST['ajax_postid'];


	if(!wp_verify_nonce($nonce, '操作认证1')){
		echo '认证失败了';
	}
	else{
		echo '认证成功！';
	}
    wp_die(); //必须结束
}
add_action( 'wp_ajax_handler', 'handler' );
add_action( 'wp_ajax_nopriv_handler', 'handler' ); 

//收藏文章，星星评分 AJAX
function shoucang_xingxing(){
	$nonce = $_POST['postCommentNonce'];
	//echo $nonce;
	//echo 'num=',$_POST['num'];

	if(!wp_verify_nonce($nonce, 'Favorite')){
		//echo '认证失败了';
	}
	else{
		//echo '认证成功！';
		beebiu_mark_add($_POST['ajax_postid']);
	}
    wp_die(); //必须结束
}
add_action( 'wp_ajax_shoucang_xingxing', 'shoucang_xingxing' );
add_action( 'wp_ajax_nopriv_shoucang_xingxing', 'shoucang_xingxing' ); 
//																												WP AJAX END

//自定义的评论列表样式 codex.wordpress.org/Function_Reference/wp_list_comments
function beebiu_list_comments_callback($comment, $args, $depth) {
	//var_dump($comment);
	//var_dump($args);
	//var_dump($depth);
	if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
	} ?>
		<?php 
            if ( $args['avatar_size'] != 0 ) {
				echo get_avatar( $comment, $args['avatar_size'] ); //touxiang
			}
		if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
		} ?>
		<div class='comment-right'>
        <div class="comment-meta commentmetadata"><?php 
				printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ); ?>
			<time><?php
                /* translators: 1: date, 2: time */
                printf( 
                    __('%1$s at %2$s'), 
                    get_comment_date(),  
                    get_comment_time() 
				); 
			?></time><?php
				edit_comment_link( __( '(Edit)' ), '  ', '' ); 
                comment_reply_link( 
                    array_merge( 
                        $args, 
                        array( 
                            'add_below' => $add_below, 
                            'depth'     => $depth, 
                            'max_depth' => $args['max_depth'] 
                        ) 
                    ) 
                ); ?>

		</div>
			<div class='comment-meta-body'>
			<?php comment_text(); ?>
			</div>
		</div><?php
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}


?>