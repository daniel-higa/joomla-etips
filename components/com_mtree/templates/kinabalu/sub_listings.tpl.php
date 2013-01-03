<div id="listings"><?php

if( $this->task == "search" && empty($this->links) ) {

	if( empty($this->categories) ) {
	?>
	  <!--<p /><center><?php echo JText::_( 'Your search does not return any result' ) ?></center><p />-->
	<?php
	}
	
} else {
	if($this->pageNav->total > 0) {
		?>
		<!--<div class="pages-links">
			<span class="xlistings"><?php echo $this->pageNav->getResultsCounter(); ?></span>
			<?php echo $this->pageNav->getPagesLinks(); ?>
		</div>-->

		<?php
		$i = 0;
		foreach ($this->links AS $link) {
			$i++;
            $sub_class = ($i % 2)?'even':'odd';
			$fields = $this->fields[$link->link_id];
            $aux_link = loadLink($link->link_id, $savantConf, $temp_fields, $aux_params);
            $link_desc_field = $temp_fields->getFieldById(2);
            $link_desc = $link_desc_field->getValue();
            echo "<div class='$sub_class'>";
			include $this->loadTemplate('sub_listingSummary.tpl.php');
            echo '</div>';
		}

		if( $this->pageNav->total > $this->pageNav->limit ) { ?>
		<div class="pages-links">
			<span class="xlistings"><?php echo $this->pageNav->getResultsCounter(); ?></span>
			<?php echo $this->pageNav->getPagesLinks(); ?>
		</div>
		<?php
		}
	}
}
?></div>
<div style="float:left; margin-left:300px;">
<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
<div style="float:left;">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
</div>
<div style="float:left; margin-left:20px;">
<script>
document.write('<a href="http://www.facebook.com/sharer.php?u=' + document.location + '" target="_blank"><img src="images/facebook_counter.png"/></a>');
</script>
</div>
