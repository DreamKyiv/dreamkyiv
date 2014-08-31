<?php
/*
Template Name: Округииииии
*/

if ( !has_action( 'shoestrap_page_header_override' ) )
  get_template_part('templates/page', 'header');
else
  do_action( 'shoestrap_page_header_override' );

if ( !has_action( 'shoestrap_content_page_override' ) )
  get_template_part('templates/faces');
else
  do_action( 'shoestrap_content_page_override' );
  
  
  
$show_fb_like=false; 


?>
 
 <style>

h1 {font-weight:500;}
h3.ballot {padding-bottom: 15px; border-bottom: 1px solid #5b5b5b;}
span.date {display: none;}
.panel-body {background-color: #ddd; padding: 20px!important;}
.panel-body p {background-color: #656565;}
.panel-body a {color: #fff;}
.row.ballot-item {padding: 10px 5px; border-bottom: 1px solid #FFFFFF;}
.row.ballot-item p {font-size: 14px; line-height: 1.2; margin-bottom: 0;}
.row.ballot-item.winner {background-color: #cadaac;}


 </style>


<div class="row">
						<div class="col-md-1">
							<img class="form-logo" src="/img/zakogo_logo_small.png" />
						</div>
						<div class="col-md-11">
							<h1 class="candidate-heading"><?php the_title(); ?></h1>
						</div>
</div>
<? /* <div class="row">
	<div class="col-md-12">
		<p style="margin-bottom:10px;">Ваша дільниця № {номер} знаходится за адресою {адрес}<br />
		телефон: {номер телефона, если поле заполнено}<br />
		час роботи: {время работы, если поле заполнено}</p>
	</div>
</div>
*/ ?>
<?
// вывод инфо по участку, если мы пришли с поиска - HTML для этого блока выше

if (isset($pollstation) && is_numeric($pollstation) && get_post($pollstation)){

?>
<div class="row">
<div class="col-md-12">Ваша дільниця №<a href="<?=get_permalink($pollstation)?>"><?=get_field('номер',$pollstation)?></a> розташована за адресою: <a href="<? $w11=get_permalink( $pollstation ); echo $w11;?>"> <?=get_field('адреса_дільниці',$pollstation)?><br /> </a>
<? if(get_field('контактний_телефон',$pollstation)){ ?>телефон: <?=get_field('контактний_телефон',$pollstation)?> <br /> <?}?>
<? if(get_field('час_роботи',$pollstation)){ ?>час роботи:  <?=get_field('час_роботи',$pollstation)?> <br /><?}?>

</div>
</div><br>
<? }  ;?>



<div class="row">
						<div class="col-md-12">
							<div class="panel-group" id="districts">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h2 class="panel-title"><a data-toggle="collapse" data-parent="#districts" href="#collapseOne">Дільниці вашого округу</a></h2>
									</div>
									<div id="collapseOne" class="panel-collapse collapse">
										<div class="panel-body">
						



<?  while( have_rows('дільниці') ): the_row();  
    $qwe=get_sub_field('додай_дільнийю'); 
     $nn=url_to_postid($qwe);  
    
    $nmr=get_field('номер', $nn); 
     $qwe = get_the_ID(); 
    
    echo '<div class="col-sm-2"> <p class="text-center"><a href="'.$qwe.'">'.$nmr.'</a></p>  </div>';
   
    
    
    
  endwhile;
 
 ?>
</div>



</div>

								</div>
								</div></div></div>
								
								
								
	
	<?
						 
	 $url21=get_the_ID(); $qpart2= url_to_postid($url21);  $rr=get_field('номер', $qpart2);  

						
						
	$posts25 = get_posts(array(
	'numberposts' => 1,
	'post_type' => 'kandidat',
    'meta_key' => 'procent',
    'orderby' => 'meta_value',
    'order'   => 'DESC',
//	'meta_key' => 'okrugg',	
//	'meta_value' => $qwe
	
	'meta_query' => array(
		array(
			'key' => 'okrugg',
			'value' => $url21,
			'compare' => '='
		),
		array(
			'key' => 'balatuetsya',
			'value' => 'Мажоритарка',
			'compare' => '='
		)
	)

	
));

foreach($posts25 as $post25)
	{

	
	$pb=get_field('pib', $post25->ID);  
$pht=get_field('photo', $post25->ID); 
	$permalink = get_permalink( $post25->ID ); 

	
	}
	
 //echo  '<h1 align=center><a href='.$permalink.' > Переможець у окрузі - '.$pb.'</a></h1>'; ?>
	
								
<div class="row districts">


<form action="/vibori/porivnyannya/" method="get">


<div class="row">

						<div class="col-md-12">
							<h2 class="text-center">Попередні результати за даними екзит-полів</h2>
							<p class="text-center"><small>Увага! Ви можете відмітити декілька кандидатів та партій, щоб порівняти їхні програми</small></p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							
								<h3 class="text-center ballot"><small>Кандидати в депутати<br />по мажоритарному округу</small></h3>
								
								
								
								<?php 

$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'kandidat',
//    'meta_key' => 'procent',
//    'orderby' => 'meta_value_num',
//   'order'   => 'DESC',
//	'meta_key' => 'okrugg',	
//	'meta_value' => $qwe
	'meta_query' => array(
		array(
			'key' => 'okrugg',
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

usort($posts, 'candidates_by_percents');

foreach($posts as $post)
	{
	
	$qaz=get_field('balatuetsya', $post->id);
	if($qaz=='Мажоритарка') {
	
	$permalink = get_permalink( $post->id ); 
	$nmr=get_field('nomer_v', $post->id); 
	$pht=get_field('photo', $post->id); 
	$prt=get_field('назва', $post->партія);  
	$prt_l=get_permalink( $post->партія); 
	if($pht){ } else {$pht='/img/no_pic.jpg';}


	$percent=($post->procent)?$post->procent."&nbsp;%":"";
	?>

								<div class="row ballot-item<?=(($post->победитель=="1")?" winner":"")?>">
									<div class="col-xs-1">
										<div class="checkbox" >
											<input type="checkbox" name="candidates[]" value="<?echo $post->ID;?>">
										</div>
									</div>
									<div class="col-xs-3">
										<img src="<? echo  $pht ;	 ?>" class="img-responsive" style="margin-right:15px;"  width=50 height=50/>
									</div>
									<div class="col-xs-5">
										<p><a href="<? echo $permalink ;?>"><? echo  $post->pib ;	 ?></a><br />
										<span class="zakogo-candidate-party">
										<? if ($prt!==false && $prt!="Самовисування"){ ?>
											<a href="<? echo $prt_l; ?>"><? echo $prt; ?></a>
										<? 
											} else { ?>
												Самовисування 
										<?		
										   }		
										?>
										</span>
										</p>
									</div>
									
									<div class="col-xs-3">
										<p style="padding:10px 15px; background-color:#fff; display:inline-block;"><strong><?=$percent?></strong></p>
									</div>
									
								</div>
								
							<?	}}  ?>
								
								
							<input type="hidden" name="district" value="<? echo $qwe; ?>">
							<input type="hidden" name="ballot" value="majority">
							<div class="zakogo-ballot-compare"><input type="submit" name="submit" value="Порівняти"></div>
						
						</div>
						<div class="col-sm-4">
							
								<h3 class="text-center ballot"><small>Партії,<br />які балотуються до Київради</small></h3>
								
								
								
 <?php 
 
 $query="select sum(acf.meta_value) as aaa from $wpdb->posts posts
left join $wpdb->postmeta acf on posts.ID= acf.post_id
where posts.post_status='publish' and posts.post_type='party' and acf.meta_key='procent' and acf.meta_value>3";

$total_passed_percent=$wpdb->get_var( $query	); // !!!! заменить на константу (пример: $passed_percent=85.5;) когда будут финальные результаты
 

$qwe = get_the_ID(); 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'party'
//	'orderby'          => 'meta_value_num',
//	'order'            => 'DESC',
//	'meta_key' => 'procent',
	//'meta_value' => '1'
));
 

usort($posts, 'parties_by_percents');

foreach($posts as $post)
	{
	$permalink = get_permalink( $post->id );
		$nmr1=get_field('nomer', $post->id);
		
		if($nmr1) {

	$pht=get_field('лого', $post->id);
	
	$mandates=get_field('мест',$post->id);
	
	?>
	<div class="row ballot-item">
									<div class="col-xs-1">
										<div class="checkbox" >
											<input type="checkbox" name="candidates[]" value="<?echo $post->ID;?>">
										</div>
									</div>
									<div class="col-xs-3">
										<img src="<?echo $pht;?>" class="img-responsive" style="margin-right:15px;" width=50 />
									</div>
									<div class="col-xs-5">
										<p><a href="<? echo $permalink ;?>"><? echo $post->назва; ?></a></p>
									</div>
									<div class="col-xs-3">
										<p style="padding:10px 15px; background-color:#fff; display:inline-block;"><strong><?=$mandates?"Місць:&nbsp;".$mandates:"&nbsp;"?></strong></p>
									</div>
								</div>
	
	
	
 	
 
 <?
 
 
}
 }

 
   ?>
								
							
								
								
								
								
								
								
							<input type="hidden" name="district" value="<? echo $qwe; ?>">
							<input type="hidden" name="ballot" value="party">
							<div class="zakogo-ballot-compare"><input type="submit" name="submit" value="Порівняти"></div>
							
						</div>
						<div class="col-sm-4">
							
								<h3 class="text-center ballot"><small>Кандидати<br />в мери Києва</small></h3>
								
								
								 <?php 
 $qwe = get_the_ID(); 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'kandidat',
//	'meta_key' => 'procent',
//	'orderby' => 'meta_value_num',
//	'order'            => 'DESC',    
	'meta_query' => array(
		array(
			'key' => 'balatuetsya',
			'value' => 'Мер',
			'compare' => '='
		)
	)

	
));
 
usort($posts, 'candidates_by_percents');

foreach($posts as $post)
	{
	
	$qaz=get_field('balatuetsya', $post->id);
	if($qaz=='Мер') {
	
	$permalink = get_permalink( $post->id ); $nmr=get_field('nomer_v', $post->id); $pht=get_field('photo', $post->id);$prt=get_field('назва', $post->партія);  $prt_l=get_permalink( $post->партія);
	
?>	
	
	


<div class="row ballot-item<?=(($post->победитель=="1")?" winner":"")?>">
									<div class="col-xs-1">
										<div class="checkbox" >
											<input type="checkbox" name="candidates[]" value="<?echo $post->ID;?>">
										</div>
									</div>
									<div class="col-xs-3">
										<img src="<?echo $pht;?>" class="img-responsive" style="margin-right:15px;"  width=50/>
									</div>
									<div class="col-xs-5">
										<p><a href="<? echo $permalink ;?>"><? echo $post->pib; ?></a><br /> 
										<span class="zakogo-candidate-party">
										<? if ($prt!="Самовисування"){ ?>
											<a href="<? echo $prt_l; ?>"><? echo $prt; ?></a>
										<? } else {
												echo $prt; 
										   }		
										?>
										</span>
										</p>
									</div>
									<div class="col-xs-3">
										<p style="padding:10px 15px; background-color:#fff; display:inline-block;"><strong><? echo $post->procent; ?>&nbsp%</strong></p>
									</div>
								</div>


 	
 
 <?
 
 
}
 }

 
   ?>
								
								
								
								
								
								
								
								
							<input type="hidden" name="district" value="<? echo $qwe; ?>">
							<input type="hidden" name="ballot" value="mayor">
							<div class="zakogo-ballot-compare"><input type="submit" name="submit" value="Порівняти"></div>
						</div>
					</div>



</form>

<br>

	<? $qqq=get_the_author(); if( $qqq=='Финберг Арсений')  { echo '<div align="center"><a href="mailto:myshyak@gmail.com" ><img src="/img/unnamed.jpg" class="img-responsive" ></a></div>'; }  ?>


						 <?php /*
 $qwe = get_the_ID(); 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'polling_station',
	'meta_key' => 'округ',
	'meta_value' => $qwe
));
 
if($posts)
{
 
	foreach($posts as $post)
	{
echo  the_field('номер', $post->id);	}
 

}
 
  */ ?>		
		
		
				

								<?php disqus_embed('dreamkyiv'); ?>

<?php

function candidates_by_percents( $a, $b ) {
    $ret = 0;

    if( intval($a->победитель) > intval($b->победитель) ) {
        $ret = -1;
    } elseif( intval($a->победитель) < intval($b->победитель) ) {
        $ret = 1;
    } elseif ( intval($a->procent) > intval($b->procent) ) {
        $ret = -1;
    } elseif ( intval($a->procent) < intval($b->procent) ) {
        $ret = 1;
    }
    
    return $ret;
}

function parties_by_percents( $a, $b ) {
    $ret = 0;

    if ( intval($a->procent) > intval($b->procent) ) {
        $ret = -1;
    } elseif ( intval($a->procent) < intval($b->procent) ) {
        $ret = 1;
    }
    
    return $ret;
}


?>