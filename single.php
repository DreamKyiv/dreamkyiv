<?php
$post = $wp_query->post;

if (in_category('95')) {
include('single-95.php');
}

elseif(in_category('97'))
{
include('single-97.php');
}
elseif(in_category('96'))
{
include('single-96.php');
}
elseif(in_category('98'))
{
include('single-98.php');
}
elseif(in_category('106'))
{
include('single-mer.php');
}

else {
include('templates/content-single.php');
}


?>