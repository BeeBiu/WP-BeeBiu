<?php 
/**
 * 评论页面
 *
 * @version    0.1
 * @package
 * @author
 * @copyright
 * @license
 *
 * 
 */
?>
<?php 
if ( post_password_required() ) {
	return;
}
?>
<div class="comments-box">
	<?php 
		//貌似只对默认14天后关闭的评论有效，新文章是否允许评论貌似无效
		if ( ! comments_open() ) {
			echo '<p class="no-comments">Comments are closed.</p>';
		}
		comment_form( array(
			'title_reply'		=> ''
			) ); //评论输入框

		if ( have_comments() ) : ?>
	<div class="comment-pagination">
		<?php 
			/* echo get_query_var('paged') ,'当前页=',get_query_var('cpage') ,' ',get_query_var('comments_per_page') , ' 总=',get_comment_pages_count() ,"<br>";
			//echo '<pre>' , var_dump ($wp_query,true) , '</pre>';*/
			echo paginate_comments_links(array(
				'prev_text'		=> '<',
				'next_text'		=> '>'
			));?>
	</div>
	<div class="comment-list">
		<?php
			wp_list_comments( array(
				'style'      	=> 'ul',
				'max_depth'		=> '2',
				'callback'		=> 'beebiu_list_comments_callback',
				'avatar_size'	=> 32,
			) ); 
		?>
	</div>
	<?php endif; // have_comments() ?>
</div>