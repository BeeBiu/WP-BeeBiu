
<!-- BEGIN POST CLASS -->
    
    <?php if(  is_archive() || is_category() || is_tag() || is_home() || is_posts_page()  ) { ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('beebiu-responsive'); ?> >
		<?php if ( has_post_thumbnail()) : ?> 
		<a href="<?php the_permalink(); ?>">
			<div class="beebiu-responsive-box-img">
				<img alt="" src="<?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium'); echo $full_image_url[0]; ?>">
			</div>
		</a>
		<?php else: ?>
		<a href="<?php the_permalink(); ?>">
			<div class="beebiu-responsive-box-img">
				<?php 
					/* $file_list = array();
					$file_list = beebiu_geshihua(get_the_content());	//传入文章正文返回信息数组 0.物理文件夹名称 1.物理文件路径 2.虚拟目录子路径 3.虚拟目录根目录 4.首页图片名称
					echo '<img src="' , $file_list[3] , $file_list[2], '/', $file_list[0], '/' , $file_list[4] , '">'; */
					$cont_json = beebiu_json(get_the_content());
					//传入文章正文返回信息数组 0.server_folder物理文件夹名称 1.server_path物理文件路径 2.web_spath虚拟目录子路径 3.web_rpath虚拟目录根目录 4.web_img首页图片名称 5.web_list静态数据
					if( !empty($cont_json) ){
						echo '<img src="' , $cont_json->web_rpath , $cont_json->web_spath, '/', $cont_json->server_folder, '/' , $cont_json->web_img , '">';
					} else{
						echo '<img src="error_none">';
					}

				?>
			</div>
		</a>
		<?php endif; ?>	
		
			<div class="beebiu-responsive-info">
				<div class="title">
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>

			</div>
			<!-- 
			has_post_thumbnail()								//缩略图检查  
			the_permalink()										//帖子链接
			the_title();	the_title_attribute() 转义较为安全	//帖子标题
			the_excerpt(__('Read more &raquo;', 'gripvine')	 	//帖子摘要 
			the_time(get_option('date_format')); 				//帖子时间 2018-09-09
			the_author_posts_link();							//帖子作者
			comments_link();									//显示当前帖子评论的链接。
			comments_number();									//显示当前帖子具有的评论数量的语言字符串
			the_category(' &bull; ');							//帖子分类
			the_tags( '标签:', ' • ', '<br />' );				//帖子标签
			-->
			
			
			
			

                            <!-- <span class="comments"><a href="<?php /* comments_link(); */ ?>"> <?php /* comments_number(); */ ?> </a></span> -->
                   

					<div class="category" data-flags="<?php 
						$terms_language = get_the_terms( $post->ID, 'language' );		//获取tags 显示旗帜 name=名称 slug=别名 description=图像描述
						if( $terms_language ){ 
							echo $terms_language[0]->slug;
						} ?>">

                    	<?php 
                            $gripvine_category = get_the_category_list( esc_html__( ', ', 'gripvine' ) );
    						if ( $gripvine_category ) {
                                printf( '<span class="">' . esc_html__( '%1$s', 'gripvine' ) . '</span>', $gripvine_category );
							}

                        ?>
    							
    				</div>

    </div>
    <?php  }  ?>
    

<!-- END POST CLASS -->