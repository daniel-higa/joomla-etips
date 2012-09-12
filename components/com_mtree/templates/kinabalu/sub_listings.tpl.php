<div id="listings"><?php

if( $this->task == "search" && empty($this->links) ) {

	if( empty($this->categories) ) {
	?>
	<p /><center><?php echo JText::_( 'Your search does not return any result' ) ?></center><p />
	<?php
	}
	
} else {
	if($this->pageNav->total > 0) {
		?>
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