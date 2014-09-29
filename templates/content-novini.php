<?php while ( have_posts() ) : the_post(); ?>
        <div class="social-item col-sm-4">
            <div class="item-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?></div>
            <div class="item-content">
                <div class="item-author"><?php the_author() ?>, <?php echo get_the_date('j F') ?></div>
                <div class="item-preview"><a href="<?php the_permalink() ?>"><?php echo get_post_meta($post->ID,'zmist_korotko',true) ?></a></div>
            </div>
        </div>
<?php
    if ( ($wp_query->current_post+1) % 3 == 0):
        ?>
        </div><div class="row">
    <?php
    endif;
 endwhile; 

?>    
