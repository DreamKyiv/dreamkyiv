<?php while ( have_posts() ) : the_post(); ?>
    <div class="face-news preview front-sidebar col-sm-4">
        <?php
            $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
            $post_thumbnail = wp_get_attachment_image_src($post_thumbnail_id,'thumb');
        ?>
            <div class="topnews-wrapper" style="background-image:url(<?php echo $post_thumbnail[0] ?>)">
                <!--div class="topnews-category"><?php the_category(); ?></div-->
                    <a href="<?php the_permalink(); ?>" class="topnews"><div class="topnews-info"><p><?php the_title(); ?></p></div></a>
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