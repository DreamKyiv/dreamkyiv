<?php
/*
Template Name: Головна - Результати2
*/

if ( !has_action( 'shoestrap_page_header_override' ) )
  get_template_part('templates/page', 'header');
else
  do_action( 'shoestrap_page_header_override' );
?>
<style>
ul.places {list-style-type:none; padding: 0;}
ul.places li {display: inline-block; margin-bottom: 2px; height:50px; width:50px; vertical-align:top;}
ul.places li a img {vertical-align: middle; vertical-align: -webkit-baseline-middle;}
.final-candidates {margin-top: 10px;}
.final-candidates h3 {margin-top: 10px;} 
.party-heading {margin-bottom: 10px;}


</style>



<div class="row bigrow">   
      <div class="col-sm-8 preview front-main">
			<div class="row">
				<div class="col-md-12 text-center">
					<h2>Попередні результати виборів (за даними екзит-полів)</h2>
				</div>
				<p align="center"><a href="/rezultaty-vyboriv/">Детальніше</a></p>	
				<div class="col-md-12">
					<h3 class="text-center">По мажоритарному округу</h3>
						<ul class="places">
<?				

$parties=array();
		
    $common_classes = "class='ui-corner-all ui-state-default'";

	$posts2 = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'kandidat',
    'meta_key' => 'okrugg',
	'orderby' => 'meta_value_num',  
	'order'            => 'ASC',

	
	'meta_query' => array(
		array(
			'key' => 'balatuetsya',
			'value' => 'Мажоритарка',
			'compare' => '='
		),
		array(
			'key' => 'победитель',
			'value' => '1',
			'compare' => '='
		),
	)

	
));


$cnt=0;
		foreach($posts2 as $post2) {
			var_dump(in_array($post2->ID,array_keys($parties)));
			if (in_array($post2->ID,array_keys($parties))){
				$party_url=$parties[$post2->ID]['url'];
				$party_logo=$parties[$post2->ID]['logo'];			
				echo "in array";
			}
			else {
				$party_url=get_field('партія',$post2->ID);  
				$party_id= url_to_postid($party_url); 
				$party_logo=get_field('лого', $party_id,false); if($party_logo){ $party_logo=wp_get_attachment_image_src($party_logo,'small50')[0]; } else {$party_logo='/wp-content/uploads/parties_small/brick_samovisuvanets.png';} 			
				$parties[$post2->ID]['url']=$party_url;
				$parties[$post2->ID]['logo']=$party_logo;
			}
			
			
			
			
			echo "<li $common_classes><a href=\"$party_url\"><img src=\"$party_logo\" width=\"50\" height=\"50\" /></a></li>\n";
			$cnt++;
		}
		while ($cnt++<60){
				echo "<li $common_classes></li>\n";
			}
			
?>					
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-center">За партійними списками</h3>
					<ul class="places">
<?
$query="select sum(acf.meta_value) as aaa from $wpdb->posts posts
left join $wpdb->postmeta acf on posts.ID= acf.post_id
where posts.post_status='publish' and posts.post_type='party' and acf.meta_key='procent' and acf.meta_value>3";

$total_passed_percent=$wpdb->get_var( $query	); // !!!! заменить на константу (пример: $passed_percent=85.5;) когда будут финальные результаты	
	
	
	
		$er=3;
$cnt=0;
// выбор всех партий, где % >3		
$posts31 = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'party',
	'orderby'          => 'meta_value_num',
	'order'            => 'DESC',
	'meta_key' => 'procent',
	//'meta_value' => '3',
	//'compare' => '>='
	
	'meta_query' => array(
		array(
			'key' => 'procent',
			'value' => $er,
			'compare' => '>'
		))
	
));
 



foreach($posts31 as $post31)
	{
		$mandates=round(60*$post31->procent/$total_passed_percent);
		
		$party_url=get_permalink( $post31->ID); 
		$party_logo=get_field('лого',$post31->ID); if($party_logo){ $party_logo=str_replace("2014/05","parties_small",$party_logo); } else {$party_logo='/img/no_pic.jpg';}
		
		for($i=0;$i<$mandates;$i++){
			echo "<li $common_classes><a href=\"$party_url\"><img src=\"$party_logo\" width=\"50\" height=\"50\" /></a></li>\n";
			$cnt++;
		}
	}
while ($cnt++<60){
				echo "<li $common_classes>&nbsp;</li>\n";
			}
	
?>					
					</ul>
				<p align="center"><a href="/rezultaty-vyboriv/">Детальніше</a></p>	
				</div>
			</div>
		</div>
	  <div class="col-sm-4 front-side">
<?php  $posts = get_field('news'); $do_not_duplicate = array();
    $posts = array_slice($posts, 0, 3); 
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
    <h2>Думки</h2>
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


<script>
    jQuery(document).ready(function(){
        jQuery('ul.places li').hover(function () {
            jQuery(this).addClass('ui-state-focus').removeClass('ui-state-default');
        }, function () {
            jQuery(this).removeClass('ui-state-focus').addClass('ui-state-default');
        });
    });
</script>