<?php if( $this->config->getTemParam('displayAlphaIndex','1') ) { $this->display( 'sub_alphaIndex.tpl.php' ); } 

if ( count($this->categories) > 0 || count($this->links) > 0) {

	if ( count($this->categories) > 0 ) { include $this->loadTemplate( 'sub_subCats.tpl.php' ); } 
	
	if (is_array($this->links) && !empty($this->links)) {
		include $this->loadTemplate( 'sub_listings.tpl.php' );

	} 
} else {
	?><center><?php echo sprintf(JText::_( 'There are no cat or listings' ), ( (is_numeric($this->alpha)) ? JText::_( 'Number' ) : strtoupper($this->alpha)) )?></center><?php 
}
?>