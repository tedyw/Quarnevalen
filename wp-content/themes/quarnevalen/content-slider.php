<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.1.0
 */
?>
    <!-- START: content-page.php -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	    <?php if($post->post_name == "kontakt"):  ?>
        <div class="row">
            <div class="contact-form six columns hide-for-small">
                <h2 class="entry-title"><?php _e("Contact Us", "quarnevalen"); ?></h2>
                <?php echo do_shortcode("[si-contact-form form='1']"); ?>
            </div>
            <div class="contact entry-content six columns">
                <h1 class="entry-title show-for-small"><?php _e("Contact Us", "quarnevalen"); ?></h1>
                <?php the_content(); ?>
            </div>
        </div>    
        <?php else: ?>
        <header class="entry-header">
            <?php if(!is_child()): ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php endif; ?>
            <?php if(is_front_page()): ?>
            <img src="<?php echo bloginfo("stylesheet_directory") ?>/images/mascot.svg" height="auto" width="25%" class="start-mascot"/>
            <?php endif; ?>
        </header><!-- .entry-header -->
        <div class="entry-content">
            <?php the_content(); ?>

            <?php if($post->post_name == "samarbetspartners" || $post->post_name == "huvudsamarbetspartners" || $post->post_name == "sponsorer"): ?>
                <?php $key = $post->post_name;
                      $args = array(
                            'post_type' => 'company',
                            'posts_per_page' => -1,
                            'order' => 'ASC',
                            'orderby' => 'menu_order'
                            );     
                ?>
            <?php $companies = new WP_Query($args);
                if($companies->have_posts()):?>

                    <ul class="company-container">
                    <?php while ($companies->have_posts()) : $companies->the_post(); ?>
                        <?php if (has_post_thumbnail( $post->ID )) : ?>
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?> 
                            <?php $keys = get_post_meta( get_the_ID(), "company-type" ); ?>
                            <?php if (in_array($key, $keys[0])) : ?>
                                <li class="company-logo">
                                    <div class="inner <?php echo $key ?>">
                                    <img src="<?php echo $image[0]; ?>" />                
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endwhile; wp_reset_postdata(); // end of the loop. ?> 
                    </ul>
                <?php endif; ?> 
            <?php endif; ?>

            <?php if($post->post_name == "bruxstyret" || $post->post_name == "generaler" || $post->post_name == "nojestyret" || $post->post_name == "tagstyret"): ?>
                <?php
                $args = array(
                        'post_type' => 'superior',
                        'posts_per_page' => -1,
                        'order' => 'ASC',
                        'orderby' => 'menu_order'
                        );
                $pagename = $post->post_name;          
                $superiors = new WP_Query($args);
                if($superiors->have_posts()): ?>
                    <ul class="superior-container">
                    <?php while ($superiors->have_posts()) : $superiors->the_post(); ?>
                        <?php if (has_post_thumbnail( $post->ID )) : ?>
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?> 
                        <?php $keys = get_post_meta( get_the_ID(), "superior-type" ); ?>
                            <?php if ($keys[0] == $pagename) : ?>
                                <li class="superior-photo">
                                    <div class="inner <?php echo $key ?>" style="background-image:url(<?php echo $image[0]; ?>)">       
                                        <div class="overlay">
                                            <div class="overlay-inner">
                                                <ul>
                                                    <li><?php the_title(); ?></li>
                                                    <li><?php echo get_field("superior-name")?></li>
                                                    <li><?php echo get_field("superior-phone")?></li>
                                                    <li><?php echo str_replace("@","(at)",get_field("superior-mail"))?></li>
                                                </ul>    
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endwhile; wp_reset_postdata(); // end of the loop. ?> 
                    </ul>
                <?php endif; ?> 
            <?php endif; ?>

            <?php if($post->post_name == "om-quarnevalen" || 
                     $post->post_name == "sok" 
                    ): 
            ?>  

                <ul class="circle-grid">
                <?php $parent = $post->ID; ?>
                    <?php
                    $grandchild = new WP_Query('post_type=page&posts_per_page=-1&order=ASC&orderby=menu_order&post_parent='.$parent);
                    while ($grandchild->have_posts()) : $grandchild->the_post();
                    ?>
                        <li class="circle-container">
                        <?php if (has_post_thumbnail( $post->ID )) : ?>
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
                        <?php endif; ?>
                        <a href="#" class="circle small" data-reveal-id="modal-<?php the_ID(); ?>">
                            <div class="background" <?php if (has_post_thumbnail( $post->ID )) : ?> style="background-image:url(<?php echo $image[0]; ?>)" <?php endif; ?>>           
                            </div>
                            <div class="inner">
                            <?php the_title(); ?>
                            </div>
                        </a>

                        
                        </li>
                        <div id="modal-<?php the_ID(); ?>" class="reveal-modal xlarge">
                            <div class="inner">
                                <h2><?php the_title(); ?></h2>
                                <a class="close-reveal-modal">&#215;</a>
                                <?php the_content(); ?>
                            </div>
                        </div>

                    <?php endwhile; wp_reset_postdata(); // end of the loop. ?> 
                    </ul>  
            <?php endif; ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'requiredfoundation' ) . '</span>', 'after' => '</div>' ) ); ?>
        </div><!-- .entry-content -->
        <?php endif; ?>
    </article><!-- #post-<?php the_ID(); ?> -->
    <!-- END: content-page.php -->