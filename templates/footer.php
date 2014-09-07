<?php global $ss_framework; ?>
<div class="container-fluid footer-top">
<footer id="page-footer" class="hidden-print" role="contentinfo">
	<?php echo $ss_framework->open_container( 'div' ); ?>
		<div class="col-sm-3"><img src="/img/logo_inv.png" class="img-responsive"></div>
		<div class="col-sm-8 col-sm-offset-1"><ul class="bottom-menu"><li><a href="http://dreamkyiv.com/category/novini">Новини</a></li> <li><a href="http://dreamkyiv.com/category/kontrol-statti/">Контроль</a></li> <li><a href="http://dreamkyiv.com/category/dream-kyiv">Київ мрії</a></li> <li><a href="http://dreamkyiv.com/category/zhyttya">Життя</a></li> <li><a href="http://dreamkyiv.com/category/mij-rajon">Мій район</a></li><li><a href="/feed/"><img src="/img/rss.png" alt="RSS" width="30"></a></li></ul></div>
	<?php echo $ss_framework->close_container( 'div' ); ?>
</footer>
</div>
<div class="container-fluid footer-bottom">
<footer id="page-footer-2" class="hidden-print" role="contentinfo">
	<div class="col-sm-3"><span>&copy;&nbsp;2014 DreamKyiv</span></div>
	<div class="col-sm-8 col-sm-offset-1"><ul class="footer-bottom"><li><a href="http://dreamkyiv.com/about/">Про проект</a></li><li><a href="http://dreamkyiv.com/kontakty/">Контакти</a></li><li><?php echo do_shortcode('[wp_colorbox_media url="#inline-content" type="inline" hyperlink="Новини на email"]')?></li></ul></div>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-303271-10', 'dreamkyiv.com');
  ga('send', 'pageview');

</script>
<div style="display:none">
<div id="inline-content">
<!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="//dreamkyiv.us8.list-manage.com/subscribe/post?u=43d8cc67792e8476181a88300&amp;id=f06292319c" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
	<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Отримувати новини DreamKyiv на email" required>
    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;"><input type="text" name="b_43d8cc67792e8476181a88300_f06292319c" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="Отримувати!" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
</form>
</div>
</div>
<!--End mc_embed_signup-->
</div>
</footer>