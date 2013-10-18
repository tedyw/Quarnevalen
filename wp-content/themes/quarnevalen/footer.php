<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the class=container div and all content after
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.1.0
 */
?>
		<?php
			/*
				A sidebar in the footer? Yep. You can can customize
				your footer with three columns of widgets.
			*/
			if ( ! is_404() )
				get_sidebar( 'footer' );
			?>

            <?php $key = "huvudsamarbetspartners";
                  $args = array(
                        'post_type' => 'company',
                        'posts_per_page' => -1,
                        'order' => 'ASC',
                        'orderby' => 'menu_order'
                        );     
            ?>
            <div class="hsp active">
            	<div class="hint">
            		<div class="knob">
            			<div class="container">
            				<span>Huvud-samarbets-partners</span>
            			</div>
            		</div>
            	</div>
				<?php $companies = new WP_Query($args);
	            if($companies->have_posts()):?>
			        <div class="company-footer">
			            <ul class="company-container">
			            <?php while ($companies->have_posts()) : $companies->the_post(); ?>
			                <?php if (has_post_thumbnail( $post->ID )) : ?>
			                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); ?> 
			                    <?php $keys = get_post_meta( get_the_ID(), "company-type" ); ?>
			                    <?php if (in_array($key, $keys[0])) : ?>
			                        <li class="company-logo">
	                                    <div class="inner <?php echo $key ?>" style="background-image:url()">
	                                    	<img src="<?php echo $image[0]; ?>" />                
	                                    </div>
                                	</li>
			                    <?php endif; ?>
			                <?php endif; ?>
			            <?php endwhile; wp_reset_postdata(); // end of the loop. ?> 
			            </ul>
			        </div>    
	            <?php endif; ?> 
            </div>
			<div id="footer" role="contentinfo">
				<div class="row">
					<div class="six mobile-two columns">
						<span class="artist">
							<a href="http://codeorig.in/" title="Designed by Tedy Warsitha"><div class="artist-logo"></div></a>
						</span>
						<span class="copy">2013 &copy Quarnevalen.</span>
						<span>Mail: info(at)quarnevalen.se</span>
						<span>Tel: 08-10 20 18</span>
					</div>
					<div class="six mobile-two columns">
						<a href="https://www.facebook.com/quarnevalen?fref=ts" target="_blank"><span class="icon icon-facebook" aria-hidden="true"></span></a>
						<a href="https://twitter.com/Quarnevalen" target="_blank"><span class="icon icon-twitter" aria-hidden="true"></span></a>
					</div>	
				</div>
			</div>
	</div><!-- Container End -->

	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
	     chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 7]>
		<script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		<script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->

	<?php wp_footer(); ?>
</body>
</html>