<?php

											
$number_of_ls_columns = $this->config->getTemParam('numOfListingColumnsInSummaryView',1);

if( $number_of_ls_columns >= 2 && ($i % $number_of_ls_columns) == 1 ) {
	echo '<div class="lsrow">';
}

?><div class="listing-summary<?php 
	if( $number_of_ls_columns >= 2 ) {
	echo ' ls'.(floor(100/$number_of_ls_columns));
	if($i % $number_of_ls_columns == 0) {
		echo ' column4';
	} else {
		echo ' column'.($i % $number_of_ls_columns);
	}
}
echo ($link->link_featured && $this->config->getTemParam('useFeaturedHighlight','1')) ? ' featured':'';
?>">
		<div class="header">
		<h3><?php 
			$link_name = $fields->getFieldById(1);
			switch( $this->config->getTemParam('listingNameLink','1') )
			{
				default:
				case 1:
					$this->plugin( 'ahreflisting', $link, $link_name->getOutput(2), '', array('delete'=>false) );
					break;
				case 4:
					if( !empty($link->website) ) {
						$this->plugin( 'ahreflisting', $link, $link_name->getOutput(2), '', array('delete'=>false), 1 );
					} else {
						$this->plugin( 'ahreflisting', $link, $link_name->getOutput(2), '', array('delete'=>false) );
					}
					break;
				case 2:
					$this->plugin( 'ahreflisting', $link, $link_name->getOutput(2), '', array('delete'=>false), 1 );
					break;
				case 3:
					$this->plugin( 'ahreflisting', $link, $link_name->getOutput(2), 'target="_blank"', array('delete'=>false), 1 );
					break;
				case 0:
					$this->plugin( 'ahreflisting', $link, $link_name->getOutput(2), '', array('delete'=>false, 'link'=>false) );
					break;
			}
		?></h3><?php
		
		if( $number_of_ls_columns == 1 )
		{
			// Rating
			$this->plugin( 'rating', $link->link_rating, $link->link_votes, $link->attribs);
			
			if( $this->config->get('show_review') )
			{
				echo '<span class="reviews">';
				echo '<a href="' . JRoute::_( 'index.php?option=com_mtree&task=viewlink&link_id=' . $link->link_id . '&Itemid='  . $this->Itemid ) . '">' . $this->reviews[$link->link_id]->total . ' ' . strtolower(JText::_( 'Reviews' )) . '</a>';
				echo '</span>';
			}
			echo '</div>';
		} else {
			echo '</div>';
			// Rating
			echo '<div class="rating-review">';
			$this->plugin( 'rating', $link->link_rating, $link->link_votes, $link->attribs);

			if( $this->config->get('show_review') )
			{
				echo '<span class="reviews">';
				echo '<a href="' . JRoute::_( 'index.php?option=com_mtree&task=viewlink&link_id=' . $link->link_id . '&Itemid='  . $this->Itemid ) . '">' . $this->reviews[$link->link_id]->total . ' ' . strtolower(JText::_( 'Reviews' )) . '</a>';
				echo '</span>';
			}
			echo '</div>';
		}
		
		if( $this->config->getTemParam('showImageInSummary',1) )
		{
			if ($link->link_image ) {
				$this->plugin( 'ahreflistingimage', $link, 'class="image' . (($this->config->getTemParam('imageDirectionListingSummary','left')=='right') ? '':'-left') . '" alt="'.htmlspecialchars($link->link_name).'"' );
			}
			else if ( $this->config->getTemParam('showFillerImage',1) ) 
			{
				?>
				<a href="<?php echo JRoute::_('index.php?option=com_mtree&task=viewlink&link_id=' . $link->link_id . '&Itemid='  . $this->Itemid); ?>">
				<img src="<?php echo $this->config->getjconf('live_site'); ?>/components/com_mtree/templates/kinabalu/images/noimage_thb.png" width="<?php echo $this->config->get('resize_listing_size'); ?>" height="<?php echo $this->config->get('resize_listing_size'); ?>" class="image<?php echo (($this->config->getTemParam('imageDirectionListingSummary','left')=='right') ? '':'-left'); ?>" alt="" />
				</a>
				<?php
			}
		}
		
		// Address
		if( $this->config->getTemParam('displayAddressInOneRow','1') ) {
			$fields->resetPointer();
			$address_parts = array();
			while( $fields->hasNext() ) {
				$field = $fields->getField();
				$output = $field->getOutput(2);
				if(in_array($field->getId(),array(4,5,6,7,8)) && !empty($output)) {
					$address_parts[] = $output;
				}
				$fields->next();
			}
			if( count($address_parts) > 0 ) { echo '<p class="address">' . implode(', ',$address_parts) . '</p>'; }
		}
		
		// Website
		$website = $fields->getFieldById(12);
		if(!is_null($website) && $website->hasValue()) { echo '<p class="website">' . $website->getOutput(2) . '</p>'; }

		// Listing's first image
		if(!is_null($fields->getFieldById(2)) || $link->link_image) {
			echo '<p>';
			if(!is_null($fields->getFieldById(2))) { 
				$link_desc = $fields->getFieldById(2);
				echo $link_desc->getOutput(2);
			}
			echo '</p>';
		}
		
		// Listing's category
		if($this->task <> 'listcats' && $this->task <> '' ) {
			echo '<div class="category"><span>' . JText::_( 'Category' ) . ':</span>';
			$this->plugin( 'mtpath', $link->cat_id, '' );
			echo '</div>';
		}
		
		// Other custom field		
		$fields->resetPointer();
		echo '<div class="fields">';
		$number_of_columns = $this->config->getTemParam('numOfColumnsInSummaryView','1');
		$field_count = 1;
		$need_div_closure = false;
		while( $fields->hasNext() ) {
			$field = $fields->getField();
			$value = $field->getOutput(2);
			if(
				( 
					(
						!$field->hasInputField() && !$field->isCore() && empty($value)) 
						|| 
						(!empty($value) || $value == '0')
					) 
					&&	
					!in_array($field->getId(),array(1,2,12))
					&&
					(
						($this->config->getTemParam('displayAddressInOneRow','1') && !in_array($field->getId(),array(4,5,6,7,8))
						||
						$this->config->getTemParam('displayAddressInOneRow','1') == 0						
					)
				)
			) {
				// Start of a row
				if( $number_of_columns == 1 || $field_count % $number_of_columns == 1 ) {
					echo "\n\t\t<div class=\"row0\">";
					$need_div_closure = true;
				}
				echo "\n\t\t\t" . '<div style="width:'.floor(98/$number_of_columns).'%" class="fieldRow'.(($number_of_columns == 1 || $field_count % $number_of_columns == 0)?' lastFieldRow':'').'">';

				if($field->hasCaption()) {
					echo "\n\t\t\t\t".'<span class="caption">';				
					
									
					//preg_match('/<a href="([^"]+)">/',$field->getOutput(2),$salida); 
					$link = $field->getOutput(2);
					
					
										 
					if($field_count == '1')
					{
						
					
					echo tuFuncion($link, "<img style=\"vertical-align: middle\" src=\"/images/apple-logo.png\" /> iPhone");
						
						
						?><!--
                       <a href="<?php //echo $salida?>"> <img src="/images/apple-logo.png" /> iPhone </a>
                       -->
                       
                       
                        <?php
						}
					if($field_count == '2')
					{
						
                        echo tuFuncion($link, "<img style=\"vertical-align: middle\" src=\"/images/apple-logo.png\" /> iPad ");
						
						}
					if($field_count == '3')
					{
					    echo tuFuncion($link, "<img style=\"vertical-align: middle\" src=\"/images/Blackberry_logo.png\" /> BlackBerry");

						
						}
					
					
					echo '</span>'; //$field_count."**". $field->getCaption() . 
					//echo '<span class="output">' . $field->getOutput(2) . '</span>';
				} else {
					echo "\n\t\t\t\t".'<span class="output">' . $field->getOutput(2) . '</span>';
				}
				echo "\n\t\t\t".'</div>';

				// End of a row
				if( $number_of_columns == 1 || $field_count % $number_of_columns == 0 ) {
					echo "\n\t\t</div>";
					$need_div_closure = false;
				}
				$field_count++;
			}
			$fields->next();
		}
		if( $need_div_closure ) {
			echo "\n\t\t</div>";
			$need_div_closure = false;
		}
		echo '</div>';
		
		if($this->config->getTemParam('showActionLinksInSummary','0')) {
			echo '<div class="actions">';
			$this->plugin( 'ahrefreview', $link, array("rel"=>"nofollow") ); 
			$this->plugin( 'ahrefrecommend', $link, array("rel"=>"nofollow") );	
			$this->plugin( 'ahrefprint', $link );
			$this->plugin( 'ahrefcontact', $link, array("rel"=>"nofollow") );
			$this->plugin( 'ahrefvisit', $link );
			$this->plugin( 'ahrefreport', $link, array("rel"=>"nofollow") );
			$this->plugin( 'ahrefclaim', $link, array("rel"=>"nofollow") );
			$this->plugin( 'ahrefownerlisting', $link );
			$this->plugin( 'ahrefmap', $link );
			echo '</div>';
		}
?></div><?php

if( $number_of_ls_columns > 1 && ($i % $number_of_ls_columns == 0 || $i == count($this->links)) ) {
	echo '</div>';
}

?>
