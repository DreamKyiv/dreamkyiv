<?php
/*
Template Name: Округ
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

h1 {font-weight:500;}
#accordion {margin-top: 20px;}
.panel-body {background-color: #ddd;}
.panel-body p {background-color: #656565;}
.panel-body a {color: #fff;}
div.row.row-meta {display: none;}
 </style>

 
 
					<div class="row">
						<div class="col-md-1">
							<img src="<?php echo get_stylesheet_directory_uri() ?>/zakogo_logo_small.jpg" />
						</div>
						<div class="col-md-4">
							<h1>Округи</h1>
						</div>
					</div>
					
			
		<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Голосіївський район</a></h2>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse">
								<div class="panel-body">
 
 		
							 <?php
 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'area',
	'meta_key' => 'район',
	'meta_value' => 'Голосіївський район'
));
 
if($posts)
{
 
	foreach($posts as $post)
	{
echo '<div class="col-md-2"><p class="text-center"><a href="http://dreamkyiv.com/area/electoral-district-'. $post->номер .'/"> '. $post->номер . '</a></p> </div>	';	}
 

}
 
?>					</div>
							</div>
						</div>

		
			<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTen"> Дарницький район</a></h2>
							</div>
							<div id="collapseTen" class="panel-collapse collapse">
								<div class="panel-body">
 
 		
							 <?php
 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'area',
	'meta_key' => 'район',
	'meta_value' => 'Дарницький район'
));
 
if($posts)
{
 
	foreach($posts as $post)
	{
		echo '<div class="col-md-2"><p class="text-center"><a href="http://dreamkyiv.com/area/electoral-district-'. $post->номер .'/"> '. $post->номер . '</a></p> </div>	';
	}
 

}
 
?>					</div>
							</div>
						</div>
			
						<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseNine"> Деснянський район</a></h2>
							</div>
							<div id="collapseNine" class="panel-collapse collapse">
								<div class="panel-body">
 
 		
							 <?php
 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'area',
	'meta_key' => 'район',
	'meta_value' => 'Деснянський район'
));
 
if($posts)
{
 
	foreach($posts as $post)
	{
echo '<div class="col-md-2"><p class="text-center"><a href="http://dreamkyiv.com/area/electoral-district-'. $post->номер .'/"> '. $post->номер . '</a></p> </div>	';	}
 

}
 
?>					</div>
							</div>
						</div>
			
			
							<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseEight"> Дніпровський район</a></h2>
							</div>
							<div id="collapseEight" class="panel-collapse collapse">
								<div class="panel-body">
 
 		
							 <?php
 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'area',
	'meta_key' => 'район',
	'meta_value' => 'Дніпровський район'
));
 
if($posts)
{
 
	foreach($posts as $post)
	{
echo '<div class="col-md-2"><p class="text-center"><a href="http://dreamkyiv.com/area/electoral-district-'. $post->номер .'/"> '. $post->номер . '</a></p> </div>	';	}
 

}
 
?>					</div>
							</div>
						</div>
		
							<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseSix"> Оболонський район</a></h2>
							</div>
							<div id="collapseSix" class="panel-collapse collapse">
								<div class="panel-body">
 
 		
							 <?php
 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'area',
	'meta_key' => 'район',
	'meta_value' => 'Оболонський  район'
));
 
if($posts)
{
 
	foreach($posts as $post)
	{
echo '<div class="col-md-2"><p class="text-center"><a href="http://dreamkyiv.com/area/electoral-district-'. $post->номер .'/"> '. $post->номер . '</a></p> </div>	';	}
 

}
 
?>					</div>
							</div>
						</div>
			
			
								<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven"> Печерський район</a></h2>
							</div>
							<div id="collapseSeven" class="panel-collapse collapse">
								<div class="panel-body">
 
 		
							 <?php
 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'area',
	'meta_key' => 'район',
	'meta_value' => 'Печерський  район'
));
 
if($posts)
{
 
	foreach($posts as $post)
	{
echo '<div class="col-md-2"><p class="text-center"><a href="http://dreamkyiv.com/area/electoral-district-'. $post->номер .'/"> '. $post->номер . '</a></p> </div>	';	}
 

}
 
?>					</div>
							</div>
						</div>
						
							<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">Подільський район</a></h2>
							</div>
							<div id="collapseFive" class="panel-collapse collapse">
								<div class="panel-body">
 
 		
							 <?php
 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'area',
	'meta_key' => 'район',
	'meta_value' => 'Подільський  район'
));
 
if($posts)
{
 
	foreach($posts as $post)
	{
echo '<div class="col-md-2"><p class="text-center"><a href="http://dreamkyiv.com/area/electoral-district-'. $post->номер .'/"> '. $post->номер . '</a></p> </div>	';	}
 

}
 
?>					</div>
							</div>
						</div>
						

			
				<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Святошинський  район</a></h2>
							</div>
							<div id="collapseOne" class="panel-collapse collapse">
								<div class="panel-body">
 
 		
							 <?php
 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'area',
	'meta_key' => 'район',
	'meta_value' => 'Святошинський  район'
));
 
if($posts)
{
 
	foreach($posts as $post)
	{
echo '<div class="col-md-2"><p class="text-center"><a href="http://dreamkyiv.com/area/electoral-district-'. $post->номер .'/"> '. $post->номер . '</a></p> </div>	';	}
 

}
 
?>				</div>
							</div>
						</div>
						
								
					
					
										
						
						
				<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Солом’янський район</a></h2>
							</div>
							<div id="collapseThree" class="panel-collapse collapse">
								<div class="panel-body">
 
 		
							 <?php
 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'area',
	'meta_key' => 'район',
	'meta_value' => 'Солом\'янський район'
));
 
if($posts)
{
 
	foreach($posts as $post)
	{
echo '<div class="col-md-2"><p class="text-center"><a href="http://dreamkyiv.com/area/electoral-district-'. $post->номер .'/"> '. $post->номер . '</a></p> </div>	';	}
 

}
 
?>					</div>
							</div>
						</div>
								
						
								<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Шевченківський район</a></h2>
							</div>
							<div id="collapseFour" class="panel-collapse collapse">
								<div class="panel-body">
 
 		
							 <?php
 
$posts = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'area',
	'meta_key' => 'район',
	'meta_value' => 'Шевченківський район'
));
 
if($posts)
{
 
	foreach($posts as $post)
	{
echo '<div class="col-md-2"><p class="text-center"><a href="http://dreamkyiv.com/area/electoral-district-'. $post->номер .'/"> '. $post->номер . '</a></p> </div>	';	}
 

}
 
?>					</div>
							</div>
						</div>
						
						
						
													
					
						
						
				
						
						
						
			
	
		
		
		
			
		