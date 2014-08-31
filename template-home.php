<?php
/*
Template Name: Головна
*/

if ( !has_action( 'shoestrap_page_header_override' ) )
  get_template_part('templates/page', 'header');
else
  do_action( 'shoestrap_page_header_override' );
?>

 <div class="row bigrow">
  <div class="col-sm-12">
<?php echo do_shortcode( "[SlideDeck2 id=19542]" ); ?>  </div>
 </div> 

<div class="row bigrow">
  <div class="col-sm-12 news-preview">
    <h1 class="mainpage text-center">Новини</h1>
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
   <div class="col-sm-12 text-center all-news">
    <a href="<?php echo home_url('/category/novini/') ?>" class="main">ВСІ НОВИНИ</a>
   </div>
  </div>

</div> 


<div class="row bigrow">
    <div class="col-sm-8 face-preview">
        <h2 class="text-center">Київ мрії</h2>
<?php 
        $args = array(
          'posts_per_page' =>2, 
          'cat' => 1,
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
                    <a href="<?php the_permalink(); ?>" class="topnews"><div class="topnews-info"><span><?php echo $category->cat_name ?></span><p><?php the_title(); ?> </p></div></a>
               
            </div>
        </div>
        <?php endwhile;
          wp_reset_query();
      ?> 

 <h2 class="text-center">Життя</h2>
<?php 
        $args = array(
          'posts_per_page' =>2, 
          'cat' => 639,
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
                    <a href="<?php the_permalink(); ?>" class="topnews"><div class="topnews-info"><span><?php echo $category->cat_name ?></span><p><?php the_title(); ?> </p></div></a>
              
            </div>
        </div>
        <?php endwhile;
          wp_reset_query();
      ?> 
</div>

  <div class="col-sm-4" >
    <h2 class="mainpage text-center">Думки</h2>   
    <?php
        $args = array (
            'post_type' => 'social',
            'posts_per_page' => 2
        );
        
        query_posts ($args);
        while ( have_posts() ) : the_post();
    ?>

           <div class="quote">
                <p class="bubble speech">        
		<?php echo get_avatar (get_the_author_meta('ID'), $size = '65' )?>
               <span class="name"><?php the_author() ?></span> 
<a href="<?php the_permalink() ?>"><?php echo get_post_meta($post->ID,'zmist_korotko',true) ?></a><br /><span class="el-icon-calendar icon date"><?php the_time('d.m.Y'); ?></span></p>
 	</div>
      <?php endwhile;

        wp_reset_query();
      ?>
        <div class="text-center"><a href="<?php echo home_url('social')?>" class="main"> ВСІ ДУМКИ</a>
    </div>        
        
    </div>

</div>

 <div class="row bigrow description">
	<div class="col-sm-10">
                <p>

              <strong>DreamKyiv</strong> — інтернет-видання для небайдужих киян, які хочуть бачити наше місто кращим. Пишемо про цікаві ініціативи та активних городян, слідкуємо за життям міста та діями чиновників. Просто хочемо зробити якісне міське медіа для мешканців Києва.
Створили та фінансують проект кілька ентузіастів. Тож якщо ви хочете більше цікавої інформації про Київ, можете долучитися до фінансової підтримки проекту.
</p>
	</div>
	<div class="col-sm-2">
		<a href="https://dreamkyiv.payplug.in/" target="_blank" class="text-center">Допомогти проекту!</a>
	</div>

      </div>
      
      	<h2 class="text-center">Партнери</h2>
      	
<div class="row bigrow">
	<div class="col-sm-3"><a href="http://chasopys.ua" class="bordered"> <img src="/img/chasopys_logo.png"></a></div>
	<div class="col-sm-3"> </div>
	<div class="col-sm-3"> </div>
	<div class="col-sm-3"> </div>
</div>