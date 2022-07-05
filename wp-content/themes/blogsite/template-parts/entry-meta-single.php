<div class="entry-meta">

	<span class="entry-category"><?php blogsite_first_category(); ?></span>		

	<span class="entry-author"><?php the_author_posts_link(); ?></span> 

	<span class="entry-date"><?php echo get_the_date(); ?></span>

	<span class="entry-comment"><?php comments_popup_link( __('0 Comment','blogsite'), __('1 Comment', 'blogsite'), '% Comments', 'comments-link', __('comments off', 'blogsite'));?></span>

</div>