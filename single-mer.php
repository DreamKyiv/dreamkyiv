<?php
/*
Template Name: меры листинг
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
#accordion {margin-top: 20px;}
div.row-meta {display: none;}
.panel-body {background-color: #ddd; padding: 20px!important;}
.panel-body p {background-color: #656565;}
.panel-body a {color: #fff;}
.row.ballot-item p {font-size: 12px; line-height: 1.2;}
.row.party-line.winner {background-color: #cadaac;}
.col-sm-1 {
    clear: both;
}
 </style>



<script type="text/javascript">
jQuery(function(){
    var max = 5;
    var checkboxes = $('input[type="checkbox"]');

    checkboxes.change(function(){
        var current = checkboxes.filter(':checked').length;
        checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
    });
});
</script>

			
								
 


					<div class="row">
						<div class="col-md-1">
							<img class="form-logo" src="/img/zakogo_logo_small.png" />
						</div>
						<div class="col-md-11">
							<h1 class="candidate-heading">Попередні результати виборів мера Києва за данними екзит-полів</h1>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<p class="bg-success"><span class="caret"></span>&nbsp;<small>Увага! Ви можете вибрати до п'яти кандидатів та порівняти їхні програми</small></p>
						</div>
						</div>
					</div>
					<form action="/vibori/porivnyannya/" method="get">
						
						
						<?php 
 $qwe = get_the_ID(); 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'kandidat',
	'meta_key' => 'procent',
	'orderby'          => 'meta_value_num',
	'order'            => 'DESC',
	'meta_query' => array(
		array(
			'key' => 'balatuetsya',
			'value' => 'Мер',
			'compare' => '='
		)
	)
));
 


foreach($posts as $post)
	{
	
	$permalink = get_permalink( $post->id );
	$pht=get_field('photo', $post->id);
	$nmr=get_field('nomer_v', $post->id);
	
	?>
						
						
					<div class="row party-line<?=(($post->победитель=="1")?" winner":"")?>">
						<div class="col-xs-1">
							<div class="checkbox" >
								<input type="checkbox" name="candidates[]" value="<? echo $post->ID; ?>">
							</div>
						</div>
						
						<div class="col-xs-3">
							<p style="padding:10px 15px; margin: 5px 0; background-color:#fff; display:inline-block;"><strong><? echo $post->procent; ?>&nbsp%</strong></p>
						</div>
					
						<div class="col-xs-2">
							<img src="<?echo $pht;?>" class="img-responsive" />
						</div>
						<div class="col-xs-6">
							<a href="<? echo $permalink ;?>"><? echo $post->pib; ?></a>
						</div>
					</div>
					
					
					
							<?
 
 

 }

 
   ?>
					

					<input type="hidden" name="district" value="{okrug_post_id}">
					<input type="hidden" name="ballot" value="party">
					<button type="submit" style="position:fixed; bottom:0px; left:50%; margin-left:-89px; z-index:10; background-color:#617c1c" class="btn btn-success">Порівняти кандидатів</button>
					</form>
					
					
					
					
				
								
								
								
								
								
					
		
				

			
			 

 		
					
						
	