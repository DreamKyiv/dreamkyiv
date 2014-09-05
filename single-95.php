<?php
/*
Template Name: КАНДИДАТ
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


.candidate-all h1 {font: 42px regular 'PT Serif', serif;}
.candidate-all h2 {font: 30px regular 'PT Serif', serif;}
.general-info span, .portrait span {display:block; font-size: 13px; color: #9d9d9d; margin: 10px 0 12px 0;}
.bordered, .candidate-control h2 {padding-bottom: 20px; margin-bottom: 20px; border-bottom: 1px solid #c3c3c3;}
.candidate-web ul {list-style-type: none; padding-left: 0;}
.candidate-web ul li {display: inline-block; margin-right: 3px;}
.candidate-control p {font-size: 12px; color: #004480;}
.candidate-control .col-sm-8 {border-bottom: 1px solid #c3c3c3;}
.row-meta {display: none}
#accordion {margin-top: 20px;}
.panel-body {background-color: #ddd;}
.panel-body p {background-color: #656565;}
.panel-body a {color: #fff;}
body.single p {margin-bottom: 10px;}
#collapseTwo .panel-body p, #collapseOne .panel-body p, #collapseSteps .panel-body p { background-color: #FFF; padding: 20px; margin-bottom: 0;} // bio, program
 </style>

<?php
// frontend uploader status message
if( array_key_exists('response', $_GET) &&  $_GET['response'] == 'fu-sent' ) {
    echo "<br><p class='ugc-notice success'>Дякуємо - Ваш файл успішно завантажено! Він з'виться на сайті найближчим часом після модерації.</p>";
}

$is_vinner=(get_field('победитель')=='1'); 
//if (is_user_logged_in() && get_current_user_id()==71){
if (is_vinner) {
$this_candidate_ID=get_the_ID();
?>
<div class="row candidate-all">
						<div class="col-sm-4 portrait">
							<div class="row">
								<div class="col-sm-12">
									<? $photo=get_field('photo'); if ($photo===false) $photo='/img/no_pic.jpg'; ?>
									<img src="<?=$photo;?>" class="img-responsive" />
								</div>
							</div>
							<div class="row controllers">
								<div class="col-sm-12">
									<span>Волонтери DreamKyiv Контроль</span>
										<?
											$candidate_control = get_posts(array(
												'numberposts' => 1,
												'post_type' => 'deputy_control',
												'meta_key' => 'control_deputy_reference',
												'meta_value' => $this_candidate_ID
												)

											);	
											$candidate_control_postID=$candidate_control[0]->ID;
											coauthors("<br>"); //listing all "authors" - third-party plugin
										?>
								</div>
							</div>
						</div>
						<div class="col-sm-8 general-info">
							<div class="row candidate-general bordered">
								<div class="col-sm-12">
								<h1><?=get_field('pib');?></h1>
								<p>
								<? $ballot_type=get_field('balatuetsya'); 	
										$party_list_num=get_field('nomer_v');
							$okrug_url=get_field('okrugg'); $okrug_post_id= url_to_postid($okrug_url);  $okrug_number=get_field('номер', $okrug_post_id); 
							$okrug_district=get_field('район',$okrug_post_id);

							$party_url=get_field('партія'); $party_post_id= url_to_postid($party_url);  $party_name=get_field('назва',$party_post_id); 

							if($ballot_type=='Мажоритарка' || $ballot_type=='Мер'){
								echo 'Пройшов по округу <a href="'.$okrug_url.'">№'.$okrug_number.'</a> ('.$okrug_district.')<br>';
								
							}	
							elseif($ballot_type=='Партійні списки'){
								echo 'Пройшов по списках партії <a href="'.$party_url.'">'.$party_name.'</a><br>';
							
							}
?>
<p>
<?							
							while( have_rows('deputy_posts') ){
								the_row();
								echo 'Комісія КМДА '.get_sub_field_object('deputy_posts_department')['choices'][ get_sub_field('deputy_posts_department') ].', '.get_sub_field('deputy_posts_role').'<br>';
							}
							?>
								</p>
								</div>
							</div>
							<div class="row candidate-reception bordered">
								<div class="col-sm-6">
									<span>Приймальня</span>
									<p><?=get_field('deputy_office_address');?></p>
								</div>
								<div class="col-sm-6">
									<span>Приймальні години</span>
									<p><?=get_field('deputy_office_schedule');?></p>
								</div>
							</div>
							<div class="row candidate-web bordered">
								<div class="col-sm-6">
									<span>Соцмережі</span>
									<ul>
										<? 
										if($fb_link=get_field('ss_links')) { echo '<li><a href="'.$fb_link.'"><img src="/img/facebook-logo.png" /></a></li>';}
										if($vk_link=get_field('посилання_на_профілі_у_соц._мережах_VK')) { echo '<li><a href="'.$vk_link.'"><img src="/img/vk-logo.png" /></a></li>';}
										if($yt_link=get_field('посилання_на_профілі_у_соц._мережах_YT')) { echo '<li><a href="'.$yt_link.'"><img src="/img/yt-logo.png" /></a></li>';}
										?>
									</ul>
								</div>
								<? if ($site=get_field('Site')){ ?>
								<div class="col-sm-6">
									<span>Веб-сайт</span>
									<a href="<?=$site?>"><?=$site?></a>
								</div>
								<? }?>
							</div>
							<div class="row candidate-bio bordered">
								<div class="col-sm-12">
									<span>Стисла біографія</span>
									<p>
									<?
									$bio="";
									$q_year=get_field('рік_народження');
									$q_place=get_field('місце_роботи');
									$q_edu=get_field('освіта');  	
									if($qq=get_field('біографія')){   //trimming duplicate bio info
										$qq=str_replace("Рік народження: $q_year<br />","",$qq);
										$qq=str_replace("Освіта: $q_edu<br />","",$qq);
										$qq=str_replace("Місце роботи: $q_place<br />","",$qq);
										$qq=preg_replace("/Членство в партії: .*/","",$qq); 
										$bio = trim($qq);
									}	
									if ($q_year) echo "Рік народження: $q_year<br>";
									if ($q_edu) echo "Освіта: $q_edu<br>";
									if ($q_place) echo "Місце роботи: $q_place<br>";
									echo $bio;
									?>
									</p>
								</div>
							</div>
							<div class="row candidate-assistants bordered">
								<div class="col-sm-12">
									<span>Помічники</span>
								</div>
								<?
								while( have_rows('deputy_assistants') ){
									the_row();
									echo '<div class="col-sm-6">';
									echo '<p>'.get_sub_field('deputy_assistant_name').'</p>';
									echo '<span class="phone">'.get_sub_field('deputy_assistant_contacts').'</span>';
									echo '</div>';
								}
								?>
							</div>
							<!--div class="row candidate-declaraion">
								<div class="col-sm-12">
									<img src="sheet-logo.png" />
									<a href="#">Скачать декларацию<br />о доходах</a>
									<span>2,3 Мб</span>
								</div>
							</div-->
							<div class="row candidate-subscribe">
								<!--- Тут будет форма подписки --->
							</div>
						</div>
					</div>
				
					<div class="row candidate-control">
							<?
							$promises=get_field('control_promisses',$candidate_control_postID);
							if ($promises) { ?>
								<div class="col-sm-6">
									<h2>Контроль обіцянок</h2>													
							<?php 
								foreach( $promises as $key => $row ){
									$column_id[ $key ] = $row['control_promise_createdate'];
								}
								array_multisort( $column_id, SORT_DESC, $promises );						
								$prom_status=get_field_object('control_promisses',$candidate_control_postID)['sub_fields'][2]['choices'];
								$i=0;
								while($i<count($promises) && $i<5 ){							
									echo '<div class="row">
											<div class="col-sm-8">
												<p>'.$promises[$i]['control_promise_text'].'</p>
											</div>
											<div class="col-sm-4">';
										/*	echo "<!--";
											var_dump($promises[$i]);
											echo "-->";*/
											$prom_status_index=$promises[$i]['control_promise_status'];
											$prom_status_text=$prom_status[$prom_status_index];
											switch($prom_status_index){
												case "0":
													$style="declared";
													break;
												case "50":
													$style="in-process";
													break;
												case "100":
													$style="done";
													break;
												default:
													$style="";
													
											}	
											echo '<p class="'.$style.'">'.$prom_status_text.'</p>';
									echo '		</div>
										</div>';
									$i++;	
								}	
							?>
							</div>
							<?php 
							}
							?>
							
						
						
							<?
							if (have_rows('control_voting',$candidate_control_postID)){
							?>
								<div class="col-sm-6">
								<h2>Голосування</h2>		
							<? 
							
							$i=0;
							$votes=[];
							$column_id=[];
							while(have_rows('control_voting',$candidate_control_postID)){
								the_row();
								$voting_link=get_sub_field('control_voting_decision');
								$voting_id=url_to_postid($voting_link);
								$votes[$i]=get_fields($voting_id);
								$votes[$i]['title']=get_post_field('post_title',$voting_id);
								$votes[$i]['link']=$voting_link;
								
								$vote_index=get_sub_field('control_voting_vote');
								$vote_text=($vote_index>0)?get_sub_field_object('control_voting_vote')['choices'][$vote_index]:"?";
								switch($vote_index){
									case "1":
										$style="not_voted";
										break;
									case "2":
										$style="none";
										break;
									case "3":
										$style="yes";
										break;
									case "4":
										$style="no";
										break;
									case "5":
										$style="withheld";
										break;
									default:
										$style="";
								
								}
								$votes[$i]['vote_text']=$vote_text;
								$votes[$i]['vote_css_style']=$style;
								$column_id[$i]=$votes[$i]["rada_decision_voting_date"];

								
								$i++;
								
							}
							array_multisort( $column_id, SORT_DESC, $votes);
							for ($i=0;$i<5;$i++){
							?>
										<div class="row">
											<div class="col-sm-10">
												<p><?=$votes[$i]['title']?></p>
											</div>
											<div class="col-sm-2">	
												<p class="<?=$votes[$i]['vote_css_style']?>"><?=$votes[$i]['vote_text']?></p>
											</div>
										</div>
							<?			
							}
							?>							
							</div>
							<? } ?>
					</div>
					
					<div class="row articles">
						<?
						if (have_rows('deputy_news')) {
						?>
						<div class="col-sm-8">
							<h2>Новини депутата</h2>
							<?
								while( have_rows('deputy_news') ){
									the_row();
									echo '<p><a href="'.get_sub_field('deputy_news_link').'" target="_blank">'.get_sub_field('deputy_news_alt_text').'</a></p>';
								}
						}	
						
						if (have_rows('посилання') ){
						?>
						<h2>Кандидат у ЗМІ</h2>
							<?
								while( have_rows('посилання') ){
									the_row();
									echo '<p><a href="'.get_sub_field('link').'" target="_blank">'.get_sub_field('alt_text').'</a></p>';
								}
						}
							?>
						</div>
						<? if ($fb_link) {
                        ?>
                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s); js.id = id;
                                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=716603265055209&version=v2.0";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="col-sm-4">
							<h2>Думки</h2>
							<div class="quote">
                                <div class="fb-like-box" data-href="<?=$fb_link?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="true" data-show-border="true"></div>
							</div>
                        <? } 
                        
                        if (have_rows('листівки')){
                        ?>
							<h2>Передвиборча агітація</h2>
							<div class="row">
							<?  
							while( have_rows('листівки') ){
								the_row();      
								echo '<div class="col-sm-6">
									<a href="'.get_sub_field('листовка').'" rel="lightbox"><img src="'.get_sub_field('листовка').'" width="150"  alt=""  /></a>
								</div>';
							}
							
							
							?>														
							</div>
						<? 
						} 
						?>	
						</div>
					</div>
					
					<!--div class="row bigrow description">
						<div class="col-sm-10">
							<p><strong>DreamKyiv</strong> — інтернет-видання для небайдужих киян, які хочуть бачити наше місто кращим. Пишемо про цікаві ініціативи та активних городян, слідкуємо за життям міста та діями чиновників. Просто хочемо зробити якісне міське медіа для мешканців Києва. Створили та фінансують проект кілька ентузіастів. Тож якщо ви хочете більше цікавої інформації про Київ, можете долучитися до фінансової підтримки проекту.</p>
						</div>
						<div class="col-sm-2">
							<a href="#" class="text-center">Допомогти проекту</a>
						</div>
					</div>
				
					<h2 class="text-center">Партнери</h2>
					
					<div class="row">
						<div class="col-sm-3 text-center">
							<a href="#" class="bordered"><img src="./DreamKyiv_files/chasopys_logo.png" /></a>
						</div>
						<div class="col-sm-3 text-center">
							<a href="#" class="bordered"><img src="./DreamKyiv_files/chasopys_logo.png" /></a>
						</div>
						<div class="col-sm-3 text-center">
							<a href="#" class="bordered"><img src="./DreamKyiv_files/chasopys_logo.png" /></a>
						</div>
						<div class="col-sm-3 text-center">
							<a href="#" class="bordered"><img src="./DreamKyiv_files/chasopys_logo.png" /></a>
						</div>
					</div-->

<?
}
else{
?>


				
<!---VOTE-START--->
					<div class="row">
						<div class="col-md-1">
							<img class="form-logo" src="/img/zakogo_logo_small.png" />
						</div>
						<div class="col-md-11">
							<h1 class="candidate-heading"><?php the_field('pib'); $pib3=get_field('pib');	?></h1>
						</div>
					</div>
					
					
				
					<div class="row">
						<div class="col-md-4" style="min-height: 350px;">
							<? $pht=get_field('photo'); if ($pht===false) $pht='/img/no_pic.jpg'; ?>
							<img src="<?=$pht?>" class="img-responsive"  width=300 />
						</div>
						<div class="col-md-8" style="float: none; width: 100%;">
						
						
						<?	$vibori_proshli=0;
						
										 $url21=get_field('okrugg'); $qpart2= url_to_postid($url21);  $rr=get_field('номер', $qpart2); 

	
	
	
	
			$url11=get_field('партія');  
			$qpart= url_to_postid($url11);   
									
			$asq=get_field('balatuetsya');  $ws=get_field('nomer_v');
			
			
			if($asq=='Мажоритарка' || $asq=='Мер'){
				$vib2=get_field('победитель');   
				
				if($vib2=='1'){
					$imgv='<img src=/img//thumbnail.png width=100>' ;
				} else {
					$imgv='<img src=/img//thumbnail-2.png width=100>';
				}

			}	
			elseif($asq=='Партійні списки'){				
				$passed=false;
				$passed_candidates = get_posts(array(
					'numberposts' => get_field('мест',$qpart),
					'post_type' => 'kandidat',
					'orderby'          => 'meta_value_num',
					'order'            => 'ASC',
					'meta_key' => 'nomer_v',
					'meta_query' => array(
							array(
								'key' => 'партія',
								'value' => $qpart,
								'compare' => '='
							),
							array(
								'key' => 'balatuetsya',
								'value' => 'Партійні списки',
								'compare' => '='
							)
					)
					)
				);
				$this_candidate_ID=get_the_ID();
				$passed_candidates_ids=array();
				foreach ($passed_candidates as $passed_candidate){
					$passed_candidates_ids[]=$passed_candidate->ID;
					if ($passed_candidate->ID==$this_candidate_ID){
						$passed=true;
						break;
					}
				}
				
				if (in_array($this_candidate_ID,$passed_candidates_ids)){
					$imgv='<img src=/img//thumbnail.png width=100>' ;
				}
				else {
					$imgv='<img src=/img//thumbnail-2.png width=100>';
				}
			}
	
				echo $imgv;

				 
				 
				 
				 
				 
				     ?>
							
							<p><small>  <a href=" <?php the_field('okrugg');?> " > <?php   if($asq=='Мажоритарка') { echo 'Балотується в окрузі № '; } elseif($asq=='Партійні списки') { echo'Йде за партійним списком під № '; echo $ws;} elseif($asq=='Мер') { } ?>  <?       the_field('номер', $qpart2);     ?> </a> </small></p>
							
							
							
							<? if (false){ //if($asq=='Мер') { ?> 
							<p> <a href=" <?php the_field('партія'); ?> ">   
							
	<?php   
			if(get_field('лого', $qpart)){ echo '<img src="'.get_field('лого', $qpart).'" width=85>'; echo '  '; }    
			the_field('назва', $qpart);    ?>  
							
							
							        </a></p>
									
							<? }
								else { 
								$url11=get_field('партія'); 
								$qpart= url_to_postid($url11); 
							?>
							<p>Балотувався від партії: <?= get_field('лого', $qpart) ? '<br>' : '' ?>
							
							<? if ($url11!="" && get_field('назва', $qpart)!="Самовисування") {?>
							<a href=" <?php the_field('партія'); ?> ">   
							
	<?php      if(get_field('лого', $qpart)){ echo '<img src="'.get_field('лого', $qpart).'" width=85>'; echo '  '; }    the_field('назва', $qpart);    ?>  
							
							
							        </a>
							<?} else { ?>
								Самовисування
							<? } ?>		
									</p>
							<? $url22=get_field('член_партії'); if ($url22!=$url11) { $qpart= url_to_postid($url22);   ?>	
									<p>Член партії: <?= get_field('лого', $qpart) ? '<br>' : '' ?>
									<? if ($url22!="") {?>
									<a href=" <?php the_field('член_партії'); ?> ">   
							
	<?php     if(get_field('лого', $qpart)){ echo '<img src="'.get_field('лого', $qpart).'" width=85>'; echo '  '; }    the_field('назва', $qpart);    ?>  
							
							
							        </a>
									<?} 
									else { ?>
									Безпартійний
									<? } ?>
									</p>		
							<?  }
							
							} ?>		
				 <? if($qq=get_field('Site')){ echo "<p>Сайт кандидата: <a href=\"$qq\" target=\"_blank\">$qq</a></p>"; } ?> 			
				 <? if($q_year=get_field('рік_народження')){  ?> 	<p><small>Дата народження:  <?=$q_year?></small> </p>  <? } ?>  
				 <? if($q_place=get_field('місце_роботи')){  ?> 	<p><small>Місце роботи:  <?=$q_place?> </small></p>  <? } ?>  
				 <? if($q_edu=get_field('освіта')){  ?> 	<p><small>Освіта:  <?=$q_edu?> </small></p>  <? } ?>  	
		 
							      
							        
							        
							        
							<? 
							$biod = '';
							if($qq=get_field('біографія')){   //trimming duplicate bio info
									$qq=str_replace("Рік народження: $q_year<br />","",$qq);
									$qq=str_replace("Освіта: $q_edu<br />","",$qq);
									$qq=str_replace("Місце роботи: $q_place<br />","",$qq);
									$qq=preg_replace("/Членство в партії: .*/","",$qq); 
									$bio = trim($qq);
							}				 	
							?>   

							
							<p class="social-buttons">
						<? if($qq=get_field('ss_links')){  ?>	<a href="<?=$qq?>  "><img src="/img/fb_btn.png"></a>  <? } ?>
						<? if($qq=get_field('посилання_на_профілі_у_соц._мережах_VK')){  ?>	<a href="<?=$qq?>"><img src="/img/vk_btn.png"></a></p> <? } ?>

						<?	 while( have_rows('посилання') ): the_row(); $u7='Додаткова інформація';  if(get_sub_field('alt_text')){$u7=get_sub_field('alt_text');}  echo '<a href="'; the_sub_field('link');  echo '">'.$u7.'</a><br>';  endwhile;	?>	
							
							
						
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php 
								if ($bio!=""){
							?>
								<div class="panel-group" id="accordion">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h2 class="panel-title text-center"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Біографія</a></h2>
										</div>
										<div id="collapseTwo" class="panel-collapse collapse">
											<div class="panel-body">
												<p> <?=  $bio  ?> </p>
											</div>
										</div>
									</div>
								</div>						
							<?php 
									}
							?>  						
						
					<? if(have_rows('перші_шаги')){  ?>
					  		<div class="panel-group" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h2 class="panel-title text-center"><a data-toggle="collapse" data-parent="#accordion" href="#collapseSteps">Перші кроки</a></h2>
									</div>
									<div id="collapseSteps" class="panel-collapse collapse">
										<div class="panel-body">
											<p>
							<?php
 

  while( have_rows('перші_шаги') ): the_row(); 
  
  ?> <p> <?
  the_sub_field('крок1');   ?> </p> <?
  
  endwhile;						
?>
											</p>
										</div>
									</div>
								</div>
							</div>
<? } ?>


						<div class="panel-group" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h2 class="panel-title text-center"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Програма</a></h2>
									</div>
									<div id="collapseOne" class="panel-collapse collapse">
										<div class="panel-body">
											<p>
						<?php  
							
							$url31=get_field('programm'); $qpart3= url_to_postid($url31);  
//var_dump($url31);							
							if ($url31 && $qpart3!=606){
								$only_other=true;
							
								$q1=get_field('боротьба_з_корупцією', $qpart3); 
								if($q1){
								$only_other=false;
								echo "<h4>Боротьба з корупцією </H4><p>";
								  echo $q1;
								 echo " </p>";}
								
								
								$q1=get_field('транспорт_та_інфраструктура', $qpart3); 
								if($q1){
								$only_other=false;
								echo "<h4>Транспорт та інфраструктура </H4><p>";
								  echo $q1;
								 echo " </p>";}
								
								
									$q1=get_field('екологія', $qpart3); 
								if($q1){
								$only_other=false;
								echo "<h4>Екологія </H4><p>";
								  echo $q1;
								 echo " </p>";}
								
								
								$q1=get_field('забудова_/_планування', $qpart3); 
								if($q1){
								$only_other=false;
								echo "<h4>Забудова, планування </H4><p>";
								  echo $q1;
								 echo " </p>";}
								
								
								$q1=get_field('історична_спадщина_та_туризм', $qpart3); 
								if($q1){
								$only_other=false;
								echo "<h4>Iсторична спадщина та туризм </H4><p>";
								  echo $q1;
								 echo " </p>";}
								 
								 $q1=get_field('жкг', $qpart3); 
								if($q1){
								$only_other=false;
								echo "<h4>ЖКГ </H4><p>";
								  echo $q1;
								 echo " </p>";}
								
								
								 $q1=get_field('освіта', $qpart3); 
								if($q1){
								$only_other=false;
								echo "<h4>Освіта </H4><p>";
								  echo $q1;
								 echo " </p>";}
								
								$q1=get_field('здоров_"я_/_медицина', $qpart3); 
								if($q1){
								$only_other=false;
								echo "<h4>Здоров'я / медицина </H4><p>";
								  echo $q1;
								 echo " </p>";}
								
								$q1=get_field('інше', $qpart3); 
								if($q1){
								if (!$only_other) echo "<h4>Iнше </H4>";
								echo "<p>";
								  echo $q1;
								 echo " </p>";}
								
							}
							else {
							?>
							<p class="text-center">
Вибачте, але в нас немає інформації щодо програми цього кандидата. Є що додати? Пишіть на <a href="mailto:myshyak@gmail.com">myshyak@gmail.com</a>
</p>
							<?
							}
						?>	
											</p>
										</div>
									</div>
								</div>
							</div>
													
					
						</div>
					</div>
					<? if(have_rows('листівки')) { ?>	
					<div class="row">
						<div class="col-md-12">
							<h3 class="text-center">Агітаційні матеріали</h3>
							<div id="links">
							
							
							<?  while( have_rows('листівки') ): the_row();      ?>
							
							<a href='<? the_sub_field('листовка');  ?>'  rel="lightbox">
						        	<img src="<? the_sub_field('листовка');  ?>"  width="150"  alt=""  >
						    </a>
  
<?
 
  endwhile;
 
 

 
?>
							
						    
							</div>
						</div>
					</div>
					<? } ?>	
<?php

echo do_shortcode( 
'[fu-upload-form form_layout="image" suppress_default_fields="true" class="candidat-ads-uploader" title="Запропонувати додаткові агіт-матеріали (будуть опубліковані після модерації)"]
[input type="text" name="post_title" id="title" class="required" description="Заголовок" multiple=""]
[textarea name="post_content" class="textarea" id="ug_caption" description="Ваші контактні данні (e-mail, номер телефону) на випадок, якщо нам знадобляться уточнення"]
[input type="file" name="photo" id="ug_photo" class="required" description="Зображення (у форматах JPEG або PNG)" multiple=""]
[input type="submit" class="btn" value="Завантажити" id="ug_submit_button"]
[/fu-upload-form]' );

}

?>

<!---VOTE-END--->

<?php disqus_embed('dreamkyiv'); ?>


			
			 

 		
					
						
	