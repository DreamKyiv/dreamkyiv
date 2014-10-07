<?php
global $ss_framework;
	echo '<div class="col-sm-3 news-item entry-summary">';
	echo '<article '; post_class(); echo '>';

	do_action( 'shoestrap_in_article_top' );
	shoestrap_title_section( true, 'h3', true );

		    echo '<img src="'; 
		    echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'thumbnail') ); 
		    echo '" class="mainpage" />';

	if ( has_action( 'shoestrap_entry_meta_override' ) ) {
		do_action( 'shoestrap_entry_meta_override' );
	} else {
		do_action( 'shoestrap_entry_meta' );	
	}

        if ( get_query_var('post_type') == 'social' ) {
            echo '<div class="entry-summary">';
		    echo '<img src="'; 
		    echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'thumbnail') ); 
		    echo '" class="mainpage" />';
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
        echo '</div>';

?>
