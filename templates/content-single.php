<?php

global $ss_framework;

while ( have_posts() ) : the_post();

	echo '<article class="' . implode( ' ', get_post_class() ) . ' col-sm-8 col-sm-offset-2">';
		do_action( 'shoestrap_single_top' );
		shoestrap_meta( 'cats' );
		shoestrap_title_section();
                
                $author = get_user_by('id',get_the_author_meta('ID'));
                $photographer = get_user_by('id',get_post_meta($post->ID,'photograph',true));
                
                echo '<div class="entry-copyright">';
                if (user_can($author->id, 'author')) {
                    echo '<div class="entry-author">';
                    echo '<div class="author-avatar">'.get_avatar( $author->id, 50 ).'</div>';
                    echo '<div class="author-name">Текст:<br>'.$author->display_name.'</div>';
                    echo '</div>';
                }
                
                if (user_can($photographer->id, 'photographer')) {
                    echo '<div class="entry-author">';
                    echo '<div class="author-avatar">'.get_avatar( $photographer->id, 50 ).'</div>';
                    echo '<div class="author-name">Фото:<br>'.$photographer->display_name.'</div>';
                    echo '</div>';
                }
                echo '</div>';
                
                do_action( 'shoestrap_entry_meta' );
			shoestrap_meta( 'tags' );
			wp_link_pages( array(
				'before' => '<nav class="page-nav"><p>' . __('Pages:', 'shoestrap'),
				'after'  => '</p></nav>'
			) );
			
                $post_subtitle = esc_html(get_post_meta($post->ID,'post_subtitle',true));
                if ( $post_subtitle):
                    echo '<div class="entry-subtitle">';
                    echo $post_subtitle;
                    echo '</div>';
                endif;
                
                if ( get_post_type() == 'social' ):
                    $zmist_korotko = esc_html(get_post_meta($post->ID,'zmist_korotko',true));

                    echo '<p>'.$zmist_korotko.'</p>';
                    $fb_post_link = get_post_meta($post->ID,'fb_post_link',true);
                    echo do_shortcode('[facebook_embedded_post href="'.$fb_post_link.'"]');

                    /* handle the result */
                endif;

		echo '<div class="entry-content">';
			do_action( 'shoestrap_single_pre_content' );
			the_content();
			echo $ss_framework->clearfix();
			do_action( 'shoestrap_single_after_content' );
		echo '</div>';
		
		echo '<footer>';
			
		echo '</footer>';
		
		lm_relative_posts_by_cats();

		// The comments section loaded when appropriate
		if ( post_type_supports( 'post', 'comments' ) ) {
			do_action( 'shoestrap_pre_comments' );

			if ( ! has_action( 'shoestrap_comments_override' ) ) {
				comments_template( '/templates/comments.php' );
			} else {
				do_action( 'shoestrap_comments_override' );
			}

			do_action( 'shoestrap_after_comments' );
		}

		do_action( 'shoestrap_in_article_bottom' );
	echo '</article>';
endwhile;


