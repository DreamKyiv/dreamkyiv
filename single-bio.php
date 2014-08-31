<?php

if ( !has_action( 'shoestrap_content_single_override' ) )
  get_template_part('templates/content', 'bio');
else
  do_action( 'shoestrap_content_single_override' );
