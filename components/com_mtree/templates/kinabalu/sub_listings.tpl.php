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
