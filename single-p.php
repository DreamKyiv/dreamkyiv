<?php
/*
Template Name: патрии листинг
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
.row-meta {display: none}
.panel-body {background-color: #ddd; padding: 20px!important;}
.panel-body p {background-color: #656565;}
.panel-body a {color: #fff;}
.row.ballot-item p {font-size: 12px; line-height: 1.2;}
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
							<h1 class="candidate-heading">Попередні результати виборів до Київради за партійними списками за данними екзит-полів</h1>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<p class="bg-success"><span class="caret"></span>&nbsp;<small>Увага! Ви можете вибрати до п'яти партій та порівняти їхні програми</small></p>
						</div>
						</div>
					</div>
					<form action="/vibori/porivnyannya/" method="get">
						
						
						<?php 
 $qwe = get_the_ID(); 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'party'
//	'meta_key' => 'procent',
//	'orderby' => 'meta_value_num',
//	'order'   => 'DESC',
//	'meta_value' => $qwe
));
 
usort($posts, 'parties_by_percents');

foreach($posts as $post)
	{
	
	$permalink = get_permalink( $post->id );
	$pht=get_field('лого', $post->id);
	$order_num=(get_field('nomer', $post->id)=="")?"?":get_field('nomer', $post->id);
	
		$nmr1=get_field('nomer', $post->id);
		
		if($nmr1) {
		$percent=($post->procent)?$post->procent."&nbsp;%":"";
	
	?>
						
						
					<div class="row party-line">
						<div class="col-xs-1">
							<div class="checkbox" >
								<input type="checkbox" name="candidates[]" value="<? echo $post->ID; ?>">
							</div>
						</div>
						
						
						<div class="col-xs-2">
							<p>№<?=$order_num;?> у бюлетені</p>
						</div>
						<div class="col-xs-2">
							<img src="<?echo $pht;?>" class="img-responsive"  width=50>							
						</div>
						<div class="col-xs-4">
							<a href="<? echo $permalink ;?>"><? echo $post->назва; ?></a><br/>
							<? if ($show_fb_like) {?>
							<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35&amp;appId=459995190753545" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe>
							<? } ?>
						</div>
						<div class="col-xs-3">
							<p style="padding:10px 15px; margin: 5px 0; background-color:#fff; display:inline-block;"><strong><?=$percent?></strong></p>
						</div>
					</div>
					
					
					
							<?
 
 

 }} 

 
   ?>
					
				
					
					
				
					<div class="row">
						<div class="col-md-1">
							
						</div>
						<div class="col-md-11">
							<h1 class="candidate-heading">Список партій від яких балотуються мажоритарні кандидати</h1>
						</div>
					</div>
					
					</div>
						
						
						<?php 
 $qwe = get_the_ID(); 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'party',
	'meta_key' => 'nomer',
	'orderby' => 'title',
	'order'   => 'ASC',
//	'meta_value' => $qwe
));
 


foreach($posts as $post)
	{
	
	$permalink = get_permalink( $post->id );
	$pht=get_field('лого', $post->id);
	$order_num=(get_field('nomer', $post->id)=="")?"?":get_field('nomer', $post->id);
	
		$nmr1=get_field('nomer', $post->id);
		
		if($nmr1=='') {

	
	?>
						
						
					<div class="row party-line">
						<div class="col-xs-1">
							<div class="checkbox" >
								<input type="checkbox" name="candidates[]" value="<? echo $post->ID; ?>">
							</div>
						</div>
						<div class="col-xs-2">
							<img src="<?echo $pht;?>" class="img-responsive"   >
							<!--<?  var_dump($pht); ?> -->
						</div>
						<div class="col-xs-9">
							<a href="<? echo $permalink ;?>"><? echo $post->назва; ?></a><br/>
							<? if ($show_fb_like) {?>
							<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35&amp;appId=459995190753545" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe>
							<? } ?>
						</div>
					</div>
					
					
							<?
 
 

 }} 

 
   ?>
					

					<input type="hidden" name="district" value="{okrug_post_id}">
					<input type="hidden" name="ballot" value="party">
					<button type="submit" style="position:fixed; bottom:0px; left:50%; margin-left:-89px; z-index:10; background-color:#617c1c" class="btn btn-success">Порівняти обрані партії</button>
					</form>

<?php

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