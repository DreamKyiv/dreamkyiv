<?php
/*
Template Name: Поиск 111
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
div.row.row-meta {display:none;}
</style>

		<div class="row">
			<div class="col-sm-2">
				<img class="img-responsive form-logo" src="/img/zakogo_logo.png" />
			</div>
			<div class="col-sm-10">
				<h2 class="form-heading">За кого я можу голосувати?</h2>
				<form role="form" class="form-horizontal">
					<div class="form-group">
						<div class="col-sm-10">
							<input type="text" class="form-control" id="street_address" placeholder="введіть вашу адресу...">
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-11" style="padding-top:20px;">
				<p> За допомогою цієї сторінки ви зможете дізнатись, хто з кандидатів балотується за вашим округом і хоче представляти ваші інтереси в Київраді, а також адресу вашої виборчої дільниці.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<img class="img-responsive" src="/img/panorama.jpg" width="100%" />
			</div>
		</div>
