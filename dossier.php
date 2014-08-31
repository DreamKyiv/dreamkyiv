<?php
/*
Template Name: Прошедшие - досье	
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
.row.ballot-item {padding: 10px 5px; border-bottom: 1px solid #FFFFFF;}
.row.ballot-item p {font-size: 14px; line-height: 1.2; margin-bottom: 0;}
.mayor {margin-bottom: 20px;}
ul.places {list-style-type:none; padding: 0;}
ul.places li {display: inline-block; margin-bottom: 2px; height:50px; width:50px; vertical-align:top;}
ul.places li a img {vertical-align: middle; vertical-align: -webkit-baseline-middle;
.final-candidates {margin-top: 10px;}
.final-candidates h3 {margin-top: 10px;} 
.party-heading {margin-bottom: 10px;}

</style>



<div class="row">
	<div class="col-md-12 text-center">
		<h2>Місця в Київраді</h2>
	</div>
	
<table>
<tr><th>Ім'я</th><th>Вік</th><th>Поточна партія</th><th>Місце роботи</th><th>Освіта</th></tr>
	<?	
/*
Имя
Возраст
Текущая партия
Предыдущая партия
Сфера деятельности
Место работы, должность
Место рождения (киевлянин или нет) 
Образование

*/
	
	
    

	$i=0;$j=0;

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

		foreach($posts2 as $post2)
	{
	
	$name=get_field('pib',$post2->ID);
	$age=(get_field('рік_народження',$post2->ID))?2014-get_field('рік_народження',$post2->ID):"";
	$party_name=get_field('назва', $post2->партія);
	$work=get_field('місце_роботи',$post2->ID);
	$educ=get_field('освіта',$post2->ID);
	
	echo "<tr><td>$name</td><td>$age</td><td>$party_name</td><td>$work</td><td>$educ</td></tr>\n";
	
	}

	?>
			
		
		 <?php 

	
		
	
$query="select sum(acf.meta_value) as aaa from $wpdb->posts posts
left join $wpdb->postmeta acf on posts.ID= acf.post_id
where posts.post_status='publish' and posts.post_type='party' and acf.meta_key='procent' and acf.meta_value>3";

$total_passed_percent=$wpdb->get_var( $query	); // !!!! заменить на константу (пример: $passed_percent=85.5;) когда будут финальные результаты	

		
// нахождение ID партии, у которой максимальная дробная часть от 60*(party->percent/total_passed_percent)
$query="select mod(60*(acf.meta_value / ((select sum(acf.meta_value) as total_percent from wp_posts posts
left join wp_postmeta acf on posts.ID= acf.post_id
where posts.post_status='publish' and posts.post_type='party' and acf.meta_key='procent' and acf.meta_value>3))),1) 

as max_remainder, posts.id as party_id from wp_posts posts
left join wp_postmeta acf on posts.ID= acf.post_id
where posts.post_status='publish' and posts.post_type='party' and acf.meta_key='procent' and acf.meta_value>3
order by max_remainder desc limit 1";
$party_to_inc_id=$wpdb->get_var( $query,1);			
	
	
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
	
		$prc=$post31->procent;  	$qwe12=$post31->ID; 
		$mst=round(60*$prc/$total_passed_percent);	 
		if($party_to_inc_id==$post31->ID) $mst++;	// добавляем 1 партии, у которой максимальная дробная часть

		
// выбор кандидатов по партиям
	$posts4 = get_posts(array(
	'numberposts' => $mst,
	'post_type' => 'kandidat',
	'orderby'          => 'meta_value_num',
	'order'            => 'ASC',
	'meta_key' => 'nomer_v',
//	'meta_value' => $qwe
	'meta_query' => array(
		array(
			'key' => 'партія',
			'value' => $qwe12,
			'compare' => '='
		),
		array(
			'key' => 'balatuetsya',
			'value' => 'Партійні списки',
			'compare' => '='
		)
	)

));
 

foreach($posts4 as $post4)
	{

	$name=get_field('pib',$post4->ID);
	$age=(get_field('рік_народження',$post4->ID))?2014-get_field('рік_народження',$post4->ID):"";
	$party_name=get_field('назва', $post4->партія);
	$work=get_field('місце_роботи',$post4->ID);
	$educ=get_field('освіта',$post4->ID);
	
	echo "<tr><td>$name</td><td>$age</td><td>$party_name</td><td>$work</td><td>$educ</td></tr>\n";
	

}

}

?>
	
</table>

</div>


</main>



