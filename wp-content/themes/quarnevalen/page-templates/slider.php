<?php
/**
 * Template Name: Slider Page Template
 * Description: Vertical slide page
 * 
 * If there aren't any other templates present to
 * display content, it falls back to index.php
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.1.0
 */

get_header(); ?>

	<!-- Row for main content area -->
	<div id="content">

		<div id="main" role="main">
			
		<div class="pt-trigger top">
			<div id="trigger-top" class="button ribbon" onclick="loadPreviousPage()">
				<div class="knob">
					<div class="inner"><?php _e("Up", "quarnevalen") ?></div>
				</div>	
			</div>
		</div>
		<div class="pt-trigger bottom">
			<div id="trigger-bottom" class="button ribbon" onclick="loadNextPage()">
				<div class="knob">
					<div class="inner"><?php _e("Down", "quarnevalen") ?></div>
				</div>
			</div>
		</div>	

		<div id="pt-main" class="pt-perspective">
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="pt-page <?php echo get_field("background-color"); ?>"
				style="
					<?php if(get_field("custom-background-color")): ?> 
						background-color:<?php echo get_field("custom-background-color");?>;
					<?php endif; ?>
					<?php if(get_field("background-image")): ?> 
						background-image:url('<?php echo get_field("background-image");?>');
					<?php endif; ?>
				">
				<div class="pt-page-container">
					<div class="pt-page-inner">
						<div class="post-box">
							<?php get_template_part( 'content', 'slider' ); ?>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; // end of the loop. ?>
			
			<?php the_ID(); ?>
			<?php $parent = $post->ID; ?>
			<?php $parent_name = $post->post_name; ?>

			<?php
			query_posts('post_type=page&order=ASC&orderby=menu_order&post_parent='.$parent);
			 while (have_posts()) : the_post();
			?>
			<div class="pt-page <?php echo get_field("background-color"); ?>"
				style="
					<?php if(get_field("custom-background-color")): ?> 
						background-color:<?php echo get_field("custom-background-color");?>;
					<?php endif; ?>
					<?php if(get_field("background-image")): ?> 
						background-image:url('<?php echo get_field("background-image");?>');
					<?php endif; ?>
				">
				<div class="pt-page-container">
					<div class="pt-page-inner">
						<div class="post-box">
							<?php get_template_part( 'content', 'slider' ); ?>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; // end of the loop. ?>


		</div>

		<div class="pt-message">
			<p>Your browser does not support CSS animations.</p>
		</div>

		</div><!-- /#main -->

	</div><!-- End Content row -->

<?php get_footer(); ?>