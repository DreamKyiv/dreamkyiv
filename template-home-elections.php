<?php
/*
Template Name: Головна - ВИБОРИ
*/

if ( !has_action( 'shoestrap_page_header_override' ) )
  get_template_part('templates/page', 'header');
else
  do_action( 'shoestrap_page_header_override' );
?>

<div class="row bigrow">   
      <div class="col-sm-8 preview front-main">
			<div class="row">
				<div class="col-sm-2">
					<img class=" form-logo" src="/img/zakogo_logo.png" />
				</div>
				<div class="col-sm-10">
					<h2 class="form-heading">За кого я можу голосувати?</h2>
					<form role="form" class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-10">
								<input type="text" class="form-control" id="street_address" placeholder="введіть вашу адресу...">
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-11" style="padding-top:20px;">
					<p style="margin-bottom:34px;">За допомогою цієї сторінки ви зможете дізнатись, хто з кандидатів балотується по вашому окрузі і хоче представляти ваші інтереси в Київраді, а також адресу вашої виборчої дільниці.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<img class="img-responsive" src="/img/panorama.jpg" width="100%" />
				</div>
			</div>
		</div>
	  <div class="col-sm-4 front-side">
<?php  $posts = get_field('news'); $do_not_duplicate = array();
    $posts = array_slice($posts, 0, 2); 
    if( $posts ): 
      foreach( $posts as $post): // variable must be called $post (IMPORTANT) 
      setup_postdata($post); $do_not_duplicate[] = $post->ID;
 ?>
      
       <div class="row">
        <?php
            $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
            $post_thumbnail = wp_get_attachment_image_src($post_thumbnail_id,'thumb');
            
            $categories = get_the_category();
            if($categories) {
                foreach($categories as $cat) {
                    if ($cat->parent == 0)
                        $category = $cat;
                }
            }            
        ?>
           
           
        <div class="col-md-12 preview front-sidebar">
            <div class="topnews-wrapper" style="background-image:url(<?php echo $post_thumbnail[0] ?>)">
                <div class="topnews-category"><ul class="post-categories"><li><a href="<?php echo get_category_link( $category->term_id ) ?>" title="<?php esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) ?>"><?php echo $category->cat_name ?></a></li></ul></div>
                <div class="topnews-info">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>
            </div>
        </div>           
       </div>
      
  <?php 
      endforeach; 
      wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
   endif; ?></div>  </div>
 
<div class="row bigrow">
  <div class="col-sm-12 news-preview">
    <h2>Новини</h2>
    <?php 
      $args = array(
        'post__not_in' => $do_not_duplicate,
        'posts_per_page' =>4, 
        'category_name' => 'novini',
      );
      query_posts( $args );
      while ( have_posts() ) : the_post();?>
      
        <div class="col-sm-3 news-item"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br><span class="el-icon-calendar icon date"><?php the_time('d.m.Y'); ?></span></div>
      
        
      <?php endwhile;

        wp_reset_query();
    ?>
    <a href="<?php echo home_url('/news/') ?>" class="all-news">Всі матеріали</a>
    
  </div>

</div> 

<div class="row bigrow">
    <div class="col-sm-8 face-preview">
        <h2>Обличчя</h2>
    <div class="row"><?php 
        $args = array(
          'posts_per_page' =>2, 
          'cat' => 5,
        );
        query_posts( $args );
        while ( have_posts() ) : the_post();?>
        <div class="col-sm-6 face-news preview front-sidebar">      
        <?php
            $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
            $post_thumbnail = wp_get_attachment_image_src($post_thumbnail_id,'thumb');

            $categories = get_the_category();
            if($categories) {
                foreach($categories as $cat) {
                    if ($cat->parent == 0)
                        $category = $cat;
                }
            }            
            
        ?>
            <div class="topnews-wrapper" style="background-image:url(<?php echo $post_thumbnail[0] ?>)">
                <div class="topnews-category"><ul class="post-categories"><li><a href="<?php echo get_category_link( $category->term_id ) ?>" title="<?php esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) ?>"><?php echo $category->cat_name ?></a></li></ul></div>
                <div class="topnews-info">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>
            </div>
        </div>
        <?php endwhile;
          wp_reset_query();
      ?> 
      <div class="col-sm-12">

    
        <h2>Допомогти проекту</h2>
            <p>
              DreamKyiv — інтернет-видання для небайдужих киян, які хочуть бачити наше місто кращим. Пишемо про цікаві ініціативи та активних городян, слідкуємо за життям міста та діями чиновників. Просто хочемо зробити якісне міське медіа для мешканців Києва.
Створили та фінансують проект кілька ентузіастів. Тож якщо ви хочете більше цікавої інформації про Київ, можете долучитися до фінансової підтримки проекту.<!-- Зробити це можна так:
            </p>
            <p><a href="#" class="liqpay donate">Liqpay</a>
 <a href="#" class="paypal donate">Paypal</a> <a href="#" class="visams donate">Visa/Mastercard</a>--></p>
      </div>
    
    </div>   
    </div>
    <div class="col-sm-4">
    <h2>Вибори</h2>
    <a href="<?php echo home_url('/vibori/') ?>"><img src="http://dreamkyiv.com/wp-content/uploads/2014/05/DK_Candidates_300x140_4.png" alt="" /></a>
    
    <div class="row">
    <?php
        $args = array (
            'post_type' => 'social',
            'posts_per_page' => 2
        );
        
        query_posts ($args);
        while ( have_posts() ) : the_post();
    ?>
        <div class="social-item">
            <div class="item-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?></div>
            <div class="item-content">
                <div class="item-author"><?php the_author() ?>, <?php echo get_the_date('j F') ?></div>
                <div class="item-preview"><a href="<?php the_permalink() ?>"><?php echo get_post_meta($post->ID,'zmist_korotko',true) ?></a></div>
            </div>
        </div>
      <?php endwhile;

        wp_reset_query();
      ?>
        <div class="archive-link"><a href="<?php echo home_url('social')?>">&raquo; Всі матеріали</a>
    </div>        
        
    </div>
</div>


<div class="row bigrow">
  <div class="col-sm-12">
    <a href="http://chasopys.ua/" class='wide-banner'><img src="http://dreamkyiv.com/wp-content/uploads/2014/05/Cha_forDremKyiv_940x105_7-05.png" alt="" /></a>
  </div>
</div>
