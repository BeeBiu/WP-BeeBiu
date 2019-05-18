<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!-- android 头部 状态栏 主题颜色 -->
	<meta name="theme-color" content="#000" />

	<!-- <link rel="profile" href="http://gmpg.org/xfn/11" /> -->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>	
<body <?php body_class(); ?> >
<!-- BEGIN NAV MENU -->
<div class="flowid nav-outer">
	<div class="mg-auto wid-90 mobwid-90">
		<div class="nav">
			<input type="checkbox" class="navcheck" id="navcheck" />
			<label class="navlabel" for="navcheck" ></label>
			<button class="panbtn" for="navcheck">
				<div></div>
				<div></div>
				<div></div>
			</button>
		    <div class="site-mob-title">
		        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-nav-title"><?php echo bloginfo('name'); ?></a>
		    </div>
			<div class="theme-nav">
				<ul class="logo">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-nav-title"><?php echo bloginfo('name'); ?></a></li>
				</ul>
		        <ul class="nav-wrap">
							<li>
								<button class="button fullscreen" onclick="changgeFullscreen();">全屏</button>  
							</li>
						</ul>
		        <ul class="nav-wrap">
					<?php 
						if (has_nav_menu('primary')) {
							wp_nav_menu(array(
								'theme_location' => 'primary',
								'menu_class'  => '',
							));
							}else {
							 //echo '<ul class="">';
							 wp_list_pages( array('depth' => 1, 
								 'title_li' => '')); 
							 //echo '</ul>';     
						 } 

					?>
				</ul>
			</div>
		</div>
	</div>	
</div>
<!-- END NAV MENU -->