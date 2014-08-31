<?php
/*
Template Name: Порівняння
*/

if ( !has_action( 'shoestrap_page_header_override' ) )
  get_template_part('templates/page', 'header');
else
  do_action( 'shoestrap_page_header_override' );

if ( isset($_REQUEST['candidates']) ) {
	//$candidates = explode(",",$_REQUEST['candidates']);
	$candidates = $_REQUEST['candidates'];
	if (is_array($candidates)) {$candidates = array_filter($candidates, 'is_numeric');
	}
	else {
		$candidates=array();
	}	
	if ( count($candidates)>1 ){
		// args
		$args = array(
			'numberposts' => -1,
			'post_type' => array('kandidat', 'party'),
			'post__in' => $candidates,
			'orderby'          => 'title',
			'order'            => 'ASC'
		);
		//var_dump($candidates); 
		// get results
		$the_query = new WP_Query( $args );
		 
		// The Loop
		if( $the_query->have_posts() ){
			$cols[0]=array ("", // Фото
							"Ім'я",
							"Партія",
							"Боротьба з корупцією",
							'Транспорт та інфраструктура',
							"Екологія",
							"Забудова/планування",
							"Історична спадщина та туризм",
							"ЖКГ",
							"Освіта",
							"Здоров'я/медицина",
							"Інше"
							);
							
					while ( $the_query->have_posts() ) {
							$the_query->the_post(); 
							$program_field_name=($post->post_type=='kandidat')?'programm':'программа';
							if (get_field($program_field_name)){
								$program_fields=get_fields(url_to_postid(get_field($program_field_name)));
							}
							else {
								$program_fields['боротьба_з_корупцією']="";
								$program_fields['транспорт_та_інфраструктура']="";
								$program_fields['екологія']="";
								$program_fields['забудова_/_планування']="";
								$program_fields['історична_спадщина_та_туризм']="";
								$program_fields['жкг']="";
								$program_fields['освіта']="";
								$program_fields['здоров_"я_/_медицина']="";
								$program_fields['інше']="";
							}
							
							
							switch ($post->post_type){
							
								case "kandidat":
									$party=url_to_postid(get_field('партія'));
									
									$cols[]=array("<img src=\"".get_field('photo')."\" alt=\"\" width=\"200\"  />",
												  "<a href=\"".get_permalink()."\">".get_field('pib')."</a>",
												  get_field('назва',$party)=="Самовисування"?get_field('назва',$party):"<a href=\"".get_field('партія')."\">".get_field('назва',$party)."</a>",
													$program_fields['боротьба_з_корупцією'],
													$program_fields['транспорт_та_інфраструктура'],
													$program_fields['екологія'],
													$program_fields['забудова_/_планування'],
													$program_fields['історична_спадщина_та_туризм'],
													$program_fields['жкг'],
													$program_fields['освіта'],
													$program_fields['здоров_"я_/_медицина'],
													$program_fields['інше']
												  );
									break;
								
								case "party":
									$cols[]=array("<img src=\"".get_field('лого')."\" alt=\"\" width=\"200\"  />",
												  "", //no PIB for parties
												  "<a href=\"".get_permalink()."\">".get_field('назва')."</a>",
													$program_fields['боротьба_з_корупцією'],
													$program_fields['транспорт_та_інфраструктура'],
													$program_fields['екологія'],
													$program_fields['забудова_/_планування'],
													$program_fields['історична_спадщина_та_туризм'],
													$program_fields['жкг'],
													$program_fields['освіта'],
													$program_fields['здоров_"я_/_медицина'],
													$program_fields['інше']
												  );
									break;
							}

					} 
			wp_reset_query();  // Restore global post data stomped by the_post(). 
			?>
	<!-- COMPARISON START -->
			<table>
			<?php
			
			
			for($i=0;$i<count($cols[0]);$i++){
				$str_has_data=false;
				$outstr="";
				$outstr.="<tr>";
				for($j=0;$j<count($cols);$j++){
					if (($j > 0) && (strlen($cols[$j][$i])>0)) $str_has_data=true;
					$outstr.="<td>".(($i>1 && $cols[$j][$i]=="")?"немає даних":$cols[$j][$i])."</td>\n";
				}
				$outstr.="</tr>\n";
				
				//if ($str_has_data) echo $outstr; // выводить только если в строке есть данные
				echo $outstr;
			
			}

			?>
			</table>
	<!-- COMPARISON END -->
			<?php
		}
		else {
			echo "Query error: no candidates found";		
		} 
	}
	else {
		echo "Query error";
	}
}
else {
	echo "Query error - candidates not specified";
}
?>