<?php
/*
Template Name: Результати виборів
*/

if ( !has_action( 'shoestrap_page_header_override' ) )
  get_template_part('templates/page', 'header');
else
  do_action( 'shoestrap_page_header_override' );
?>


<style>
span.distr {
color: #000;
background: #FFF;
position: absolute;
display: block;
font-size: 10px;
z-index: 5;
padding: 5px;
line-height: 0px;
}

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
	<div class="col-md-1">
		<img class="form-logo" src="/img/zakogo_logo_small.png" />
	</div>
	<div class="col-md-11">
		<h1 class="candidate-heading">Результати виборів</h1>
		
</h3>
	</div>
</div>

<div class="row">
	<div class="col-md-12 text-center">
		<h2>Мер Києва</h2>
	</div>
</div>

<div class="row mayor">
	<div class="col-xs-2 col-xs-offset-3">
		<img src="http://dreamkyiv.com/wp-content/uploads/2014/05/Vitali_Klitschko_2014-02-01.jpg" class="img-responsive" />
	</div>
	<div class="col-xs-7">
		<h3><a href="http://dreamkyiv.com/kandidat/mer-klychko-vitalij-volodymyrovych-2/">Кличко Віталій Володимирович (<?=get_field('procent',1052)?>%)</a></h3>
		<p><a href="http://dreamkyiv.com/party/udar/">УДАР</a></p>
	</div>
</div>

<script>
jQuery(document).ready(function(){
    jQuery("ul.places img").tooltip({html : true});
});
</script>

<div class="row">
	<div class="col-md-12 text-center">
		<h2>Місця в Київраді</h2>
	</div>
	<div class="col-md-6">
		<h3 class="text-center">По мажоритарному округу</h3>
		<ul class="places">
			
			
			
	
	<?	

    $common_classes = "class='ui-corner-all ui-state-default'";	
    $parties_total_results = array();

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


$cnt=0;
		foreach($posts2 as $post2)
	{
	
	$qaz=get_field('balatuetsya', $post2->ID);
	
	$permalink = get_permalink( $post2->ID ); 
	
	$url11=get_field('партія',$post2->ID);  
	$qpart44= url_to_postid($url11);
	
	$party_logo=get_field('лого', $qpart44,false); 
	if($party_logo!=10666){ $party_logo=wp_get_attachment_image_src($party_logo,'small50')[0]; } else {$party_logo='/wp-content/uploads/parties_small/brick_samovisuvanets.png';} 
	
	
	$ws=get_field('okrugg',$post2->ID);
	$ws2=url_to_postid($ws);
	$ws3=get_field('номер',$ws2);
	
	$parties_total_results = add_party_total( $parties_total_results, $qpart44, 'maj', 1 );
	
	$pb=get_field('pib', $post2->ID);    
	$nmr=get_field('nomer_v', $post2->ID); 
	$pht=get_field('photo', $post2->ID); 
	$prt=get_field('назва', $post2->партія);  
	$prt_l=get_permalink( $post2->партія); 
	if($pht){  } else {$pht='/img/no_pic.jpg';}
	
   $mz[$i]='<div class="row"><div class="col-xs-3"><img src="'.$pht.'" class="img-responsive" style="margin-right:15px;"  width=50 height=50/></div><div class="col-xs-6"><p><a href="'.$permalink.'">'.$pb.'</a><br>
<span class="zakogo-candidate-party">'.$prt.'</span></p></div>
			<div class="col-xs-3"><p>'.$ws3.' округ</p>
			</div>
		</div>'; $i++;

//	if ($prt=="Самовисування") { 
//		echo "<li $common_classes party='$qpart44'><span class=\"distr\">".$ws3."</span><img src=\"$party_logo\" height=50 width=50></li>\n"; 
//	}
//	else { 
		echo "<li $common_classes party='$qpart44'><span class=\"distr\">".$ws3."</span><a href=\"$ws\"><img src=\"$party_logo\" height=50 width=50></a></li>\n";
//	}
	$cnt++;
	
	}
	while ($cnt++<60){
		echo "<li $common_classes></li>\n";
	}
	?>
			
			
			
			
		</ul>
	</div>
	<div class="col-md-6">
		<h3 class="text-center">За партійними списками</h3>
		<ul class="places">
			
		 <?php 

	
		
// сумма процентов прошедших	
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

$winner_party_ids=array();

$cnt=0;
// выбор всех партий, где % >3		
$posts31 = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'party',
	'orderby'          => 'meta_value_num',
	'order'            => 'DESC',
	'meta_key' => 'мест',
	'meta_query' => array(
		array(
			'key' => 'мест',
			'value' => 0,
			'compare' => '>'
		)
		)
	//'meta_value' => '3',
	//'compare' => '>='		
	
));
 



foreach($posts31 as $post31)
	{
	
		$prc=$post31->procent;  	$qwe12=$post31->ID; 
		$mst=get_field('мест',$post31->ID);
		
	
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

	$pht4=get_field('photo', $post4->ID); if($pht4){ } else {$pht4='/img/no_pic.jpg';}
		$permalink2 = get_permalink( $post4->ID ); 
			$pb=get_field('pib', $post4->ID); 
    $prt=get_field('назва', $post4->партія);  
	$prt_l=get_permalink( $post4->партія); 
	
	$parties_total_results = add_party_total( $parties_total_results, $post4->партія, 'party', 1 );
	 
	$party_logo=get_field('лого', $post4->партія,false); 
	if($party_logo!=10666){ $party_logo=wp_get_attachment_image_src($party_logo,'small50')[0]; } else {$party_logo='/wp-content/uploads/parties_small/brick_samovisuvanets.png';} 	

	
	$prtpb[$j]='
	<div class="row">
			<div class="col-xs-3">
				<img src="'.$pht4.'" class="img-responsive" style="margin-right:15px;"  width=50 height=50/>
			</div>
			<div class="col-xs-9">
				<p><a href="'.$permalink2.'">'.$pb.'</a><br />
					<span class="zakogo-candidate-party">'.$prt.'</span>
				</p>
			</div>
		</div>'; $j++;
		
		

	
?>	<li <?= $common_classes ?> party="<?= $post4->партія ?>">  <a href="<? echo $prt_l; ?>">	<img src="<? echo  $party_logo ;	 ?>" width=50></a>    </li>  <?
	
$cnt++;
}

}
while ($cnt++<60){
		echo "<li $common_classes></li>\n";
}	

echo "<!--";
//var_dump($winner_party_ids);
echo "-->";


?>
	

	
					</ul>
	</div>
</div>

<div class="row text-center">
	<div class="col-md-12">
		<h2>Поіменно:</h2>
	</div>
</div>

<div class="row final-candidates">
	<div class="col-md-6">
		
		
		<? 
		for($i=0; $i<=60; $i++){
		echo $mz[$i];}?>
		
		
		
	</div>
	
	<div class="col-xs-6 party-lists">
		
		
		
			<? 
		for($j=0; $j<=60; $j++){
		echo $prtpb[$j];}?>
		
		
		</div>
			</div>
</div>


</main>


<script>
    jQuery(document).ready(function(){
        jQuery('ul.places li').hover(function () {
            jQuery(this).addClass('ui-state-focus').removeClass('ui-state-default');
        }, function () {
            jQuery(this).removeClass('ui-state-focus').addClass('ui-state-default');
        });
    });
</script>

<?php

function add_party_total( $in_current_res, $in_party_id, $in_vote_type, $in_votes=1 ) {
    if( !array_key_exists($in_party_id, $in_current_res) ) {
        $in_current_res[$in_party_id] = array( 'maj' => 0, 'party' => 0 );
    }
    
    $in_current_res[$in_party_id][$in_vote_type] += $in_votes ;
    
    return $in_current_res;
}
?>

<script>
jQuery(document).ready(function(){
<?php
    foreach( $parties_total_results as $party_id => $party_data ) {
        ?>
        jQuery("ul.places li[party=<?=$party_id?>], ul.places li[party=<?=$party_id?>] a img").attr("title", "За мажоритарними списками - <?= $party_data['maj'] ?>,<br />за партійними списками - <?= $party_data['party'] ?>.<br />Загалом - <?= $party_data['maj'] + $party_data['party'] ?>");
        <?php
    }
?>
    jQuery("ul.places li").tooltip({html : true});
});
</script>

?>
