<?php
/*
Template Name: Партии
*/

if ( !has_action( 'shoestrap_page_header_override' ) )
  get_template_part('templates/page', 'header');
else
  do_action( 'shoestrap_page_header_override' );

if ( !has_action( 'shoestrap_content_page_override' ) )
  get_template_part('templates/faces');
else
  do_action( 'shoestrap_content_page_override' );
  
  
  
  
 ?>
 
<style>
.party-candidate {padding: 10px 0;}
div.row-meta {display: none;}
main.main.col-sm-12 > p {display: none;}
figure.thumbnail {display: none;}
p[style^="color: #000000"] {display: none;}
.panel-body p {background-color: #ffffff; padding: 20px!important; margin-bottom: 0px!important; font-style:}
div.col-md-6 {
    background-color: #EEEEEE;
    border-right: 10px solid #FFFFFF;
    padding: 0 10px;
}

.col-md-6 h3.text-center.ballot small{
    color: #3D3D3D;
    font-size: 22px;
}
h3.ballot {padding-bottom: 15px; border-bottom: 1px solid #5b5b5b;}
.row.party-candidate {padding: 10px 5px; border-bottom: 1px solid #FFFFFF;}
.row.party-candidate p {font-size: 14px; line-height: 1.2; margin-bottom: 0;}
h4.chapter-title {margin-left: 15px; font-size: 16px; font-style: normal;}
.panel-body a {
color: inherit!important;
}
.row.party-candidate.winner {background-color: #cadaac;}
</style>

	<!---VOTE-START--->
					<div class="row">
						<div class="col-md-1">
							<img class="form-logo" src="/img/zakogo_logo_small.png" />
						</div>
						<div class="col-md-11">
							<h1 class="candidate-heading"><?php the_field('назва'); ?></h1>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							
							<img src="<?php echo the_field('лого');  ?>" class="img-responsive" width=300 />
							
							
						</div>
						<div class="col-md-8">
						<? if($qq=get_field('лідер_партії')){ echo "<p>Лідер партії: $qq </p>"; } ?> 	
							<p><small>  </small></p>
							
							<? if(get_field('фб_партії')){  ?>	<a href="<?php the_field('фб_партії'); ?>  "><img src="/img/fb_btn.png"></a>  <? } ?>
						<? if(get_field('вк_партії')){  ?>	<a href="<?php the_field('вк_партії'); ?>"><img src="/img/vk_btn.png"></a></p> <? } ?>
							
							
					 <? if($qq=get_field('сайт_партії')){ echo "<p>Сайт партії: <a href=\"$qq\" target=\"_blank\">$qq</a></p>"; } ?> 
					 
					 <? if($qq=get_field('nomer')){ echo "<p>№ $qq в виборчому бюлетені</p>"; } ?> 

					 </div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h2 class="panel-title text-center"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Історія</a></h2>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
										<div class="panel-body">
											<p> <?php the_field('історія_партії'); ?> </p>
										</div>
									</div>
								</div>
							</div>
							
							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h2 class="panel-title text-center"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Програма</a></h2>
									</div>
									<div id="collapseOne" class="panel-collapse collapse">
										<div class="panel-body">
											<p>
											
										<?php  
							
							$url31=get_field('программа'); $qpart3= url_to_postid($url31);    
							if (url_to_postid($url31)==606) {
?>
<p>
Вибачте, але в нас немає інформації щодо програми цієї партії. Є що додати? Пишіть на <a href="mailto:myshyak@gmail.com">myshyak@gmail.com</a>
</p>
<?							
							
							}
							else {
								$q1=get_field('боротьба_з_корупцією', $qpart3); 
								if($q1){
									echo "<h4 class='chapter-title'>Боротьба з корупцією </H4><p>$q1</p>";
								}
								
								
								$q1=get_field('транспорт_та_інфраструктура', $qpart3); 
								if($q1){
								echo "<h4 class='chapter-title'>Транспорт та інфраструктура </H4><p>$q1</p>";
								}
								
								
									$q1=get_field('екологія', $qpart3); 
								if($q1){
								echo "<h4 class='chapter-title'>Екологія </H4><p>$q1</p>";
								}
								
								
								$q1=get_field('забудова_/_планування', $qpart3); 
								if($q1){
								echo "<h4 class='chapter-title'>Забудова, планування </H4><p>$q1</p>";
								}
								
								
								$q1=get_field('історична_спадщина_та_туризм', $qpart3); 
								if($q1){
								echo "<h4 class='chapter-title'>Iсторична спадщина та туризм </H4><p>$q1</p>";
								}
								 
								 $q1=get_field('жкг', $qpart3); 
								if($q1){
								echo "<h4 class='chapter-title'>ЖКГ </H4><p>$q1</p>";
								}
								
								
								 $q1=get_field('освіта', $qpart3); 
								if($q1){
								echo "<h4 class='chapter-title'>Освіта </H4><p>$q1</p>";
								}
								
								$q1=get_field('здоров_"я_/_медицина', $qpart3); 
								if($q1){
								echo "<h4 class='chapter-title'>Здоров'я / медицина </H4><p>$q1</p>";
								}
								
								$q1=get_field('інше', $qpart3); 
								if($q1){
								echo "<h4 class='chapter-title'>&nbsp;</H4><p>$q1</p>";
								}
								
							}
						?>	
											
											 </p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
							<div class="row">
						<div class="col-md-12">
							
							
						<? if(have_rows('листовки')) { ?>	
						<h3 class="text-center">Агітаційні матеріали</h3>
							<div id="links">
							<?  while( have_rows('листовки') ): the_row();      ?>
							
							<a href='<? the_sub_field('додай_листівку');  ?>'  rel="lightbox">
						        	<img src=  <? the_sub_field('додай_листівку');  ?>  width=50  alt=""  ></a>
  
<?
 
  endwhile;
 
 

 
?>
						</div>
				<? } ?>			
						    
							
						</div>
					</div>
					<br>
		<? /*			<script src="/wp-content/plugins/nextgen-nivoslider/script/jquery.nivo.slider.js" type="text/javascript"></script>
			<link rel="stylesheet" href="/wp-content/plugins/nextgen-nivoslider/stylesheets/nivo-slider.css" type="text/css" media="screen" />		<script type="text/javascript">
	(function($){
		$(window).load(function() {
		    $('#slider').nivoSlider();
		});
	})(jQuery);
	</script>
	
					
					<?php if(get_field('листовки')): ?>
	<div id="slider">
		<?php while(the_repeater_field('листовки')): ?>
			<?php $image = wp_get_attachment_image_src(get_sub_field('додай_листівку'), 'full'); ?>
			<?php $thumb = wp_get_attachment_image_src(get_sub_field('додай_листівку'), 'thumbnail'); ?>
	    	<img src="<?php echo $thumb[0]; ?>" alt="<?php  the_sub_field('title');?>" rel="<?php echo $thumb[0]; ?>" />
	    <?php endwhile; ?>
	</div>
	<?php endif;   */?>
					
					
					
									
									 <?php   
									 
									 $qwe = get_the_ID();
 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'kandidat',
	'orderby'          => 'meta_value_num',
	'order'            => 'ASC',
	'meta_key' => 'nomer_v',
//	'meta_value' => $qwe
	'meta_query' => array(
		array(
			'key' => 'партія',
			'value' => $qwe,
			'compare' => '='
		),
		array(
			'key' => 'balatuetsya',
			'value' => 'Партійні списки',
			'compare' => '='
		)
	)

));
 
 
 
if($posts)
{
 
?>				
					<div class="row">
						<div class="col-md-6">
							<h3 class="text-center ballot"><small>Кандидати за партійним списком</small></h3>
<? 

$mandates=get_field('мест',$qwe);
$passed_cnt=0;
foreach($posts as $post){
	
	$pht=get_field('photo', $post->id); 
	
	?>
	<div class="row party-candidate<?=(($passed_cnt++<$mandates)?" winner":"")?>">
	<div class="col-sm-3">
									<img src="<? if($pht){echo $pht;} else {echo '/img/no_pic.jpg';}?>" class="img-responsive"  height= 86 width=86 />
								</div>
								<div class="col-sm-5">
	
	<?
	
	$permalink = get_permalink( $post->id ); $nmr=get_field('nomer_v', $post->id);
echo ' <p><a href="'. $permalink   . '"> '. $post->pib  . '</a><br />';	 

if ($nmr!="")  { echo  '№ '. $nmr . ' в партійному списку'; }
echo '</p> </div>' ;	 

 ?>
 	<div class="col-sm-4">
									
								</div>
							</div>
 
 <?
 
 

 }

}
 
?>
									
									
											</div>
			
						
						<div class="col-md-6">
							<h3 class="text-center ballot"><small>Кандидати від партії за мажоритарними округами</small></h3>
						
						
						
									 <?php   
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'kandidat',
	'orderby'          => 'meta_value_num',
	'order'            => 'ASC',
	'meta_key' => 'okrugg',
//	'meta_value' => $qwe
	'meta_query' => array(
		array(
			'key' => 'партія',
			'value' => $qwe,
			'compare' => '='
		),
		array(
			'key' => 'balatuetsya',
			'value' => 'Мажоритарка',
			'compare' => '='
		)
	)	
));									 
									 
 
 
 
if($posts)
{
 
	foreach($posts as $post)
	{
	

	$pht=get_field('photo', $post->id); if($pht){ } else {$pht='/img/no_pic.jpg';}
	$permalink = get_permalink( $post->id ); $nmr=get_field('okrugg', $post->id); $nmr66=url_to_postid($nmr); $nmr2=get_field('номер', $nmr66);
	
	?>
	<div class="row party-candidate<?=(($post->победитель=="1")?" winner":"")?>">
	<div class="col-sm-3">
						<?		echo '<a href="'. $permalink  . '"> <img src="'.$pht .'" class="img-responsive"  height= 86 width=86 /> </a> '; ?>
								</div>
								<div class="col-sm-5">
	
	<?
	
	
echo ' <p><a href="'. $permalink   . '"> '. $post->pib  . '</a><br />';	 

echo  'Округ №'. $nmr2 . '</p> </div>' ;	 

 ?>
 	<div class="col-sm-4">
								
								</div>
							</div>
 
 <?
 
 

 }

}
 
?>
						
						</div>
					</div>


					
			

					
			<? $qqq=get_the_author(); if( $qqq=='Финберг Арсений')  { echo '<div align="center"><a href="mailto:myshyak@gmail.com" ><img src="/img/unnamed.jpg" class="img-responsive" ></a></div>'; }  ?>

 		
					<?php disqus_embed('dreamkyiv'); ?>

						
	