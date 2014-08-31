<?php
/**
 * Template Name: Пошук дільниці
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
				<div class="row">
						<div class="col-sm-2">
							<img class="img-responsive form-logo" src="img/zakogo_logo.png" />
						</div>
						<div class="col-sm-10">
							<h2 class="form-heading">За кого голосувати?</h2>
							<form role="form" class="form-horizontal">
								<div class="form-group">
									<div class="col-sm-7">
										<input type="text" class="form-control" id="street_address" placeholder="введи свой адрес..." style="width: 95%; margin: 5px;">
									</div>
								</div>
							</form>
						</div>
				</div>
				<div class="row">
					<div class="col-sm-11">
						<p>С помощью этой формы вы легко определите, в каком избирательном участке вы живете, кто из кандидатов претендует представлять ваши интересы в Киевраде по мажоритарным спискам, а также программы и партийные списки кандидатов.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<img class="img-responsive" src="img/panorama.jpg" />
					</div>
				</div>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_footer();
