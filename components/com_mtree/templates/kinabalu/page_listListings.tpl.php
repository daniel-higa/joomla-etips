<h2 class="contentheading"><?php echo $this->title ?>&nbsp;<?php echo $this->plugin('showrssfeed',$this->task); ?></h2>

<div id="listings">

<div class="pages-links">
	<span class="xlistings"><?php echo $this->pageNav->getResultsCounter(); ?></span>
	<?php echo $this->pageNav->getPagesLinks(); ?>
</div>
<?php
	$i = 0;
	foreach ($this->links AS $link) {
		$i++;
		$fields = $this->fields[$link->link_id];
		include $this->loadTemplate('sub_listingSummary.tpl.php');
	}
	
	if( $this->pageNav->total > 0 ) { ?>
	<div class="pages-links">
		<span class="xlistings"><?php echo $this->pageNav->getResultsCounter(); ?></span>
		<?php echo $this->pageNav->getPagesLinks(); ?>
	</div>
	<?php }
	
?></div>