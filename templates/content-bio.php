<?php

while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <?php do_action( 'shoestrap_in_article_top' ); ?>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php do_action( 'shoestrap_entry_meta_override' ); ?>
    </header>
    <div class="entry-content">
      <?php do_action( 'shoestrap_single_pre_content' ); ?>
      <?php 
        $author_id = get_the_author_meta( 'ID' );
        echo get_avatar( $author_id, 128 ); 
        if (get_user_meta($author_id, 'facebook', true) != ''){echo '<a href="'.get_user_meta($author_id, 'facebook', true).'" class="facebook">facebook</a> ';}
        if (get_user_meta($author_id, 'twitter', true) != ''){echo '<a href="'.get_user_meta($author_id, 'twitter', true).'" class="twitter">twitter</a> ';}
        if (get_the_author_meta('user_url') != ''){echo '<a href="'.get_the_author_meta('user_url').'" class="site">website</a>';}
      ?>
      
      <?php the_content(); ?>
<?php 
      $fields = get_fields();
      if( $fields )
{
  ?>
  <dl>
  <?php
	foreach( $fields as $field_name => $value )
	{
		$field = get_field_object($field_name, false, array('load_value' => false));
    if($value != ''){
        echo '<dt>' . $field['label']  . '</dt>';
        if(is_array($value)){
          echo '<dd><ul>';

          foreach($value as $one){
            if($field['name']=='places_in_kyiv'){
              echo '<li>' . $one['place'] . '</li>';  
            } else {
              echo '<li>' . $one . '</li>';  
            }
            
          } 
          echo '</ul></dd>';
        } else {
          echo '<dd>' . $value . '</dd>';  
        }
        
    }
		
	}?>
  </dl>
  <?php
}

 ?>
      <div class="clearfix"></div>
      <?php do_action( 'shoestrap_single_after_content' ); ?>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php
    // The comments section loaded when appropriate
    // if ( post_type_supports( 'post', 'comments' ) ):
    //   do_action( 'shoestrap_pre_comments' );
    //   if ( !has_action( 'shoestrap_comments_override' ) )
    //     comments_template('/templates/comments.php');
    //   else
    //     do_action( 'shoestrap_comments_override' );
    //   do_action( 'shoestrap_after_comments' );
    // endif;
    ?>
    <?php do_action( 'shoestrap_in_article_bottom' ); ?>
  </article>
<?php endwhile;
