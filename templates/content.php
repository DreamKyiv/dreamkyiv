<?php

global $ss_framework; ?>
<div class="row bigrow">
  <div class="col-sm-12 news-preview">
    <?php 
      $args = array(
        'post__not_in' => $do_not_duplicate,
        'posts_per_page' =>4, 
        'category_name' => 'novini',
      );
      query_posts( $args );
      while ( have_posts() ) : the_post();?>
      
        <div class="col-sm-3 news-item"><?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') ); ?>
<img src="<?php echo $url ?>" class="mainpage" /><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br><span class="el-icon-calendar icon date"><?php the_time('d.m.Y'); ?></span></div>
      
        
      <?php endwhile;

        wp_reset_query();
    ?>
  </div>

</div> 
<?php echo '<article '; post_class(); echo '>';

	do_action( 'shoestrap_in_article_top' );
	shoestrap_title_section( true, 'h3', true );

	if ( has_action( 'shoestrap_entry_meta_override' ) ) {
		do_action( 'shoestrap_entry_meta_override' );
	} else {
		do_action( 'shoestrap_entry_meta' );	
	}

        if ( get_query_var('post_type') == 'social' ) {
            echo '<div class="entry-summary">';
                    echo get_post_meta(get_the_ID(), 'zmist_korotko',true);
                    echo $ss_framework->clearfix();
            echo '</div>';
        }

        if ( has_action( 'shoestrap_entry_footer' ) ) {
		echo '<footer class="entry-footer">';
		do_action( 'shoestrap_entry_footer' );
		echo '</footer>';
	}

	do_action( 'shoestrap_in_article_bottom' );

echo '</article>';
