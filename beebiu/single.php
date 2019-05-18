<?php get_header(); ?>

<div class="single-box">
	<div class="mg-auto wid-90 mobwid-90">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
			<!-- <h2> the_title(); </h2> -->
			<!--自定义内容-->
			<div class="beebiu_imginfo_box">
				<div class="beebiu_imginfo_box_img">
					<?php the_post_thumbnail(); ?>
				</div>
				<div class="beebiu_imginfo_detail">
					<h3><?php the_title(); ?></h3>
					<ul>
						<li>
							<span>
								<strong>作者：</strong>
								<?php 
									//echo get_the_category_list( esc_html__( ' '));
									//the_category(' ');
									$categories = get_the_category();
									$separator = '';
									$output = '';
									if ( ! empty( $categories ) ) {
										foreach( $categories as $category ) {
											$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" rel="category">' . $category->name  . '</a>' . $separator;
										}
										echo $output;
									}
								?>
								<?php
									//可自定义样式，如果不需要就上面
								//	$categories=get_the_category();
								//	foreach($categories as $category) { 
								//		echo '<a href="' . get_category_link( $category->term_id ) . '" rel="category" >' . $category->name. '</a>';
								//	}
								?>
							</span>
						</li>
						<li>
							<span>
								<strong>ID：</strong>
								<?php the_id(); ?>
							</span>
						</li>
						<li>
							<span>
								<strong>发布时间：</strong>
								<?php the_time('Y-m-d H:i:s'); ?>
							</span>
						</li>
						<li>
							<span>
								<strong>最近修改：</strong>
								<?php the_modified_time('Y-m-d H:i:s');?>
							</span>
						</li>
						<li>
							<span>
								<strong>TAG</strong>
								<?php the_tags('','',''); ?>
								<?php //the_tags('<ul><li>','</li><li>','</li></ul>'); ?>
							</span>
						</li>
						<li>
							<span>
								<strong>访问次数：</strong>
								<?php post_views(); ?>
							</span>
						</li>
						<li>
							<span>
								<?php 
								$list=get_the_term_list( $post->ID, 'artist' );
								if( $list!=null){
									echo '<strong>作者 </strong>' . $list;
								} ?>
							</span>
						</li>
						<li>
							<span>
								<?php 
								$list=get_the_term_list( $post->ID, 'original' );
								if( $list!=null){
									echo '<strong>原作 </strong>' . $list;
								} ?>
							</span>
						</li>
						<li>
							<span>
								<?php 
								$list=get_the_term_list( $post->ID, 'translated' );
								if( $list!=null){
									echo '<strong>翻译组 </strong>' . $list;
								} ?>
							</span>
						</li>
						<li>
							<button class="button favorite" id="fa_bt" onclick="loadXMLDoc(this, 'shoucang_xingxing', '<?php echo wp_create_nonce('Favorite'); ?>', 'fa_div')">
							<span id="fa_div" class="fa_"><?php beebiu_mark_show($post->ID); ?></span>
							</button>
						</li>
						<li>
							<span>
								<strong>备注：</strong>
								<?php 
									global $current_user;
									$id = $current_user -> ID;
									//var_dump(the_author_meta('user_login',$id)); 
									the_author_meta('user_login',$id);
									
								?>
								<?php echo admin_url('admin-ajax.php')?>
								<div id="myDiv"><h2>使用 AJAX 修改该文本内容</h2></div>
								<button type="button" onclick="loadXMLDoc(this, 'handler', '<?php echo wp_create_nonce('操作认证1'); ?>', 'myDiv')">修改内容</button>
							</span>
						</li>
					</ul>
				</div>
			</div>
																					<div class="widget widget-tab"> <!-- 选项卡 -->
																						<input type="radio" name="widget-tab" id="wb-h1" checked="checked"/>
																						<input type="radio" name="widget-tab" id="wb-h2"/>
																						<input type="radio" name="widget-tab" id="wb-h3"/>
																						<div class="widget-title inline-ul">
																							<ul>
																								<li class="wb-h1">
																									<label for="wb-h1">快速预览</label>
																								</li>
																								<li class="wb-h2">
																									<label for="wb-h2">其他作品</label>
																								</li>
																								<li class="wb-h3">
																									<label for="wb-h3">后台信息</label>
																								</li>
																							</ul>
																						</div>
																						<div class="widget-content">
																							<div class="wb-list1 active">
																								<?php include( get_stylesheet_directory() . '/s/thumbnail.php');//缩略图预览 ?>
																							</div>
																							<div class="wb-list2 active">
																								<?php include( get_stylesheet_directory() . '/s/artist.php'); ?>
																							</div>
																							<div class="wb-list3 active" style="color:#ff0;">
																								<?php the_content(); ?>
																							</div>
																						</div>
																					</div>
			<div> <!-- 留言框 -->
				<?php comments_template(); ?>
			</div>
		<?php endwhile; else : ?>
		<h2><?php esc_html__('No posts Found!', 'beebiu'); ?></h2>
		<?php endif; ?>
		<!--								自定义内容										-->									
		<div class="zanding">
			<?php 
			wp_enqueue_script( 'beebiu_zidingyi_js', get_template_directory_uri() . '/js.js', array(), '1.0.1', false); //静态分页JS
			?>
		</div>
			
		<div class="beebiu-imglist">
		<div class="changgeimgsize">
			<input id="changgepage_range" type="range" min="100" max="1900" step="100" oninput="beebiu_imgchangesize(this.value)">
		</div>
		<div class="changepage" id="changepage-home"></div>
		
			<div id="show_image_area">
			<?php
			$file_arry = array();
			$cont_json = beebiu_json(get_the_content());
			//传入文章正文返回信息数组 0.server_folder物理文件夹名称 1.server_path物理文件路径 2.web_spath虚拟目录子路径 3.web_rpath虚拟目录根目录 4.web_img首页图片名称 5.web_list静态数据
			
			$file_dir = str_replace('\\','/', $cont_json->server_path, $file_i);	//替换windows目录斜杠
			if( ! $cont_json ){
				echo '文件目录不正常';
			}
			else{
				if (substr($file_dir,-1) != '/'){
					$cont_json->server_path .= '/';			//补上物理路径末尾斜杠/
					$file_dir = $file_dir . '/' . $cont_json->server_folder;
				}
				else{
					$file_dir .= $cont_json->server_folder;
				}
				echo '<br>file_dir=' . $file_dir . '<br>'; 
			}

			if( !isset($cont_json->web_list) ){ //不存在静态数据时，动态生成
				$file_arry=beebiu_scan_dir($file_dir); //枚举目录 返回文件名数组
				foreach($file_arry as $file_value){
					echo '<div class="imgdivs"><img class="img-item" data-src="' 
					, $cont_json->web_rpath
					, $cont_json->web_spath
					, '/'
					, $cont_json->server_folder
					, '/' 
					, $file_value 
					, '" alt="" style="border:1px solid #c8f0f0;padding:1px;"></div>';
				}

			} else { 	//静态数据直接输出
				$file_arry = $cont_json->web_list;
				foreach($file_arry as $file_value){
					echo '<div class="imgdivs"><img class="img-item" data-src="' 
					, $cont_json->web_rpath
					, $cont_json->web_spath
					, '/'
					, $cont_json->server_folder
					, '/' 
					, $file_value 
					, '" alt="" style="border:1px solid #c8f0f0;padding:1px;"></div>';
				}
			}



			////////////////////////////////////////////////////////////////////////////////////////额外处理
			if ( has_post_thumbnail() ) { //判断当前文章是否有缩略图
				//the_post_thumbnail();
			}
			else {//如果不存在则自动上传并生成缩略图
				$post_id = get_the_ID();  
				$file = $file_dir . '/' . $cont_json->web_img; //上传的文件完整路径
				$filename = $cont_json->server_folder . '-' . $cont_json->web_img;//服务器文件名称，要有后缀

				$upload_file = wp_upload_bits( $filename, null, @file_get_contents( $file ) );
				if ( ! $upload_file['error'] ) {
				// if succesfull insert the new file into the media library (create a new attachment post type).
				$wp_filetype = wp_check_filetype($filename, null );
				
				$attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_parent'    => $post_id,
					'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
					'post_content'   => '',
					'post_status'    => 'inherit'
				);
				
				$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $post_id );
				if ( ! is_wp_error( $attachment_id ) ) {
					// if attachment post was successfully created, insert it as a thumbnail to the post $post_id.
					require_once(ABSPATH . "wp-admin" . '/includes/image.php');
				
					$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
				
					wp_update_attachment_metadata( $attachment_id,  $attachment_data );
					set_post_thumbnail( $post_id, $attachment_id );
				}
				}
			}
			///////////缩略图自动生成结束
			
			?>
			
			</div>
			<div class="changepage"></div>
		</div>
		<!--								自定义内容										-->
	</div>
</div>
<?php
global $post; //ajax传递post，ID
echo <<<eot
<script type="text/javascript">
var post_id_=$post->ID
</script>
eot
?>
<script type="text/javascript">
//图片懒加载
	let ele = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (entry.intersectionRatio > 0) {
					entry.target.src = entry.target.dataset.src;
				}
			})
	  }, {
		rootMargin: '100px',
		threshold: [0.000001]
	  }
	);
	let eleArray = Array.from(document.getElementsByClassName('img-item'));
	eleArray.forEach((item) => {
		ele.observe(item);
	})
</script>
<?php get_footer(); ?>