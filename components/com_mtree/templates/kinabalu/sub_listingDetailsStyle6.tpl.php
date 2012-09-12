<div id="listing">
<h2><?php 
$link_name = $this->fields->getFieldById(1);
$this->plugin( 'ahreflisting', $this->link, $link_name->getOutput(1), '', array("delete"=>true, "link"=>false) ) 
?></h2>

<?php
if ( !empty($this->mambotAfterDisplayTitle) ) { 
	echo trim( implode( "\n", $this->mambotAfterDisplayTitle ) );
}

if ( !empty($this->mambotBeforeDisplayContent) && $this->mambotBeforeDisplayContent[0] <> '' ) { 
	echo trim( implode( "\n", $this->mambotBeforeDisplayContent ) ); 
}
echo '<div class="column first">';

if ($this->config->getTemParam('skipFirstImage','0') == 1) {
	array_shift($this->images);
}
if (!empty($this->images)) include $this->loadTemplate( 'sub_images.tpl.php' );

echo '</div>';

echo '<div class="column second">';
echo '<h3>';
echo JText::_('Listing details');
echo '</h3>';
// Address
$address = '';
if( $this->config->getTemParam('displayAddressInOneRow','1') ) {
	$this->fields->resetPointer();
	$address_parts = array();
	$address_displayed = false;
	while( $this->fields->hasNext() ) {
		$field = $this->fields->getField();
		$output = $field->getOutput(1);
		if(in_array($field->getId(),array(4,5,6,7,8)) && !empty($output)) {
			$address_parts[] = $output;
		}
		$this->fields->next();
	}
	if( count($address_parts) > 0 ) { $address = implode(', ',$address_parts); }
}

// Other custom fields
echo '<div class="fields">';
$number_of_columns = $this->config->getTemParam('numOfColumnsInDetailsView','1');
$field_count = 0;
$need_div_closure = false;
$this->fields->resetPointer();
while( $this->fields->hasNext() ) {
	$field = $this->fields->getField();
	$value = $field->getValue();
	if( 
		( 
			(!$field->hasInputField() && !$field->isCore() && empty($value)) || (!empty($value) || $value == '0')
			&& 
			// This condition ensure that fields listed in array() are skipped
			!in_array($field->getName(),array('link_name','link_desc'))
			&&
			(
				(
					$this->config->getTemParam('displayAddressInOneRow','1') == 1
					&& 
					!in_array($field->getId(),array(5,6,7,8)) 
				)
				||
				$this->config->getTemParam('displayAddressInOneRow','1') == 0
			)
		) 
		||
		// Fields in array() are always displayed regardless of its value.
		in_array($field->getName(),array('link_featured'))
	) {
		if( $field_count % $number_of_columns == 0 ) {
			echo '<div class="row0">';
			$need_div_closure = true;
		}
		
		echo '<div class="fieldRow'.(($field_count % $number_of_columns == ($number_of_columns -1))?' lastFieldRow':'').'" style="width:'.floor(98/intval($number_of_columns)).'%">';
		
		if($this->config->getTemParam('displayAddressInOneRow','1') && in_array($field->getId(),array(4,5,6,7,8)) && $address_field = $this->fields->getFieldById(4)) {
			if( $address_displayed == false ) {
				echo '<div class="caption">';
				if($address_field->hasCaption()) {
					echo $address_field->getCaption();
				}
				echo '</div>';
				echo '<div class="output">';
				echo $address_field->getDisplayPrefixText(); 
				echo $address;
				echo $address_field->getDisplaySuffixText(); 
				echo '</div>';
				$address_displayed = true;
			}
		} else {
			echo '<div class="caption">';
			// echo $field->getId();
			if($field->hasCaption()) {
				echo $field->getCaption();
			}
			echo '</div>';
			echo '<div class="output">';
			switch($field->getFieldType()) {
				case 'mfile':
					echo $field->getDisplayPrefixText(); 
					echo '<p class="mbutton">';
					echo $field->getOutput(1);
					echo '<p>';
					echo $field->getDisplaySuffixText(); 
					break;

				default:
					echo $field->getDisplayPrefixText(); 
					echo $field->getOutput(1);
					echo $field->getDisplaySuffixText(); 
			}
			echo '</div>';
		}
		echo '</div>';
			
		if( ($field_count % $number_of_columns) == ($number_of_columns-1) ) {
			echo '</div>';
			$need_div_closure = false;					
		}
		$field_count++;
	}
	$this->fields->next();
}
if( $need_div_closure ) {
	echo '</div>';
	$need_div_closure = false;
}

echo '</div>';

echo '<div class="listing-desc">';
if(!is_null($this->fields->getFieldById(2))) { 
	$link_desc = $this->fields->getFieldById(2);
	echo $link_desc->getOutput(1);
}
echo '</div>';
if ( !empty($this->mambotAfterDisplayContent) ) { echo trim( implode( "\n", $this->mambotAfterDisplayContent ) ); }

if( $this->config->get('show_favourite') == 1 || $this->config->get('show_rating') == 1 )
{
	echo '<div class="rating-fav">';
	if($this->config->get('show_rating')) {
		echo '<div class="rating">';
		$this->plugin( 'ratableRating', $this->link, $this->link->link_rating, $this->link->link_votes); 
		echo '<div id="total-votes">';
		if( $this->link->link_votes <= 1 ) {
			echo $this->link->link_votes . " " . strtolower(JText::_( 'Vote' ));
		} elseif ($this->link->link_votes > 1 ) {
			echo $this->link->link_votes . " " . strtolower(JText::_( 'Votes' ));
		}
		echo '</div>';
		echo '</div>';
	}

	if($this->config->get('show_favourite')) {
	?>
	<div class="favourite">
	<span class="fav-caption"><?php echo JText::_( 'Favoured' ) ?>:</span>
	<div id="fav-count"><?php echo number_format($this->total_favourites,0,'.',',') ?></div><?php 
		if($this->my->id > 0){ 
			if($this->is_user_favourite) {
				?><div id="fav-msg"><a href="javascript:fav(<?php echo $this->link->link_id ?>,-1);"><?php echo JText::_( 'Remove favourite' ) ?></a></div><?php 
			} else {
				?><div id="fav-msg"><a href="javascript:fav(<?php echo $this->link->link_id ?>,1);"><?php echo JText::_( 'Add as favourite' ) ?></a></div><?php 
				}
		} ?>
	</div><?php
	}
	echo '</div>';
}

echo '</div>';

if( $this->show_actions_rating_fav ) {
	?>
	<div class="actions-rating-fav">
	<?php if( $this->show_actions ) { ?>
	<div class="actions">
	<?php 
		$this->plugin( 'ahrefreview', $this->link, array("rel"=>"nofollow") ); 
		$this->plugin( 'ahrefrecommend', $this->link, array("rel"=>"nofollow") );	
		$this->plugin( 'ahrefprint', $this->link );
		$this->plugin( 'ahrefcontact', $this->link, array("rel"=>"nofollow") );
		$this->plugin( 'ahrefvisit', $this->link );
		$this->plugin( 'ahrefreport', $this->link, array("rel"=>"nofollow") );
		$this->plugin( 'ahrefclaim', $this->link, array("rel"=>"nofollow") );
		$this->plugin( 'ahrefownerlisting', $this->link );
		$this->plugin( 'ahrefmap', $this->link );
	?></div><?php
	}
	?></div><?php 
}
?>
</div>