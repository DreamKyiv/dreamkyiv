<?php
/*
Template Name: распечатка
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

.row.printing {margin-top: 10px;}
.row.printing .col-xs-6 {background-color: #EEEEEE; padding: 0 10px; border-right: 10px solid #FFFFFF}
.row.printing .col-xs-9 p {font-size: 10px;}
/*.row.printing .col-xs-1 {width: 100px;}*/

 </style>



<div class="row">
	<div class="col-xs-1">
		<img class="form-logo" src="/img/zakogo_logo_small.png" />
	</div>
	<div class="col-xs-11">
		<h2 style="font-size:16px;">А чи знаєте ви, що за право представляти ваші інтереси у Київській раді борються ці люди?<br /><small>Кандидати у депутати за вашим мажоритарним округом</small></h2>
		<a class="btn btn-success hidden-print" href="javascript:if(window.print)window.print()" role="button">Роздрукувати, щоб сусіди теж знали</a>
	</div>
</div>
	<div class="row printing">
		
			
				<?php 

 $qwe = $_GET["okrugid"];  $plngs = $_GET["polst"]; $e44=get_permalink($qwe);
 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'kandidat',
	'orderby'          => 'title',
	'order'            => 'ASC',
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
 


foreach($posts as $post)
	{
	
	$qaz=get_field('balatuetsya', $post->id);
	if($qaz=='Мажоритарка') {
	
	$permalink = get_permalink( $post->id ); $nmr=get_field('nomer_v', $post->id); $pht=get_field('photo', $post->id); $prt=get_field('назва', $post->партія);  $prt_l=get_permalink( $post->партія); if($pht){ } else {$pht='/img/no_pic.jpg';}


	
	?>

		
		<div class="col-xs-6">
			<div class="row ballot-item">
				<div class="col-xs-1">
					<img src="<? echo  $pht ;	 ?>" class="img-responsive" style="margin-right:15px;" width="50" height="50">
				</div>
				<div class="col-xs-9">
					<p><? echo  $post->pib ;	 ?><br>
					<span class="zakogo-candidate-party">
					<?=($prt===false)?"Самовисування":$prt?>
					</span>
					</p>
				</div>
			</div>
		</div>	
			<?	}}  ?>
			
			
			
			
		
		
	</div>
</div>
<div class="row">
	<? if($plngs){ ?>
	<div class="col-xs-8">
		<p><strong>Ваша дільниця <? echo $plngs;?></strong><br />
		<strong>Адреса дільниці:</strong> <?=get_field('адреса_дільниці',$plngs)?><br />
		Не знаєш, хто всі ці люди?<br />Заходь на Dreamkyiv.com</p>
	</div> <?}?>
	<div class="col-xs-4">
		<p><img src="http://api.qrserver.com/v1/create-qr-code/?color=000000&amp;bgcolor=FFFFFF&amp;data=<?php echo  $e44 ;?>
" alt="qr code" /></p>
	</div>
</div>
</main><!-- /.main -->
 		
					
						
	