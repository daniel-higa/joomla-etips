<?php 
JHTML::_('stylesheet','components/com_mtree/js/jquery.fancybox-1.3.4.css');
if ( 
	is_array($this->images) 
	&& 
	!empty($this->images)
	): ?>
<div class="images"><?php 
	if(isset($showImageSectionTitle) && $showImageSectionTitle) { ?>
	<div class="title"><?php echo JText::_( 'Images' ); ?> (<?php 
		if ($this->config->getTemParam('skipFirstImage','0') == 1) {
			echo ($this->total_images-1);
		} else {
			echo $this->total_images;
		}
	 ?>)</div><?php } ?>
	<div class="content"><?php
		$i = 0;
		$totalImages = count($this->images);
		foreach ($this->images AS $image): 
			if( $i == 0 && $this->config->getTemParam('showBigImage','1') == 1 ) 
			{
				?>
				<div class="thumbnail first"><!-- <a id="mainimagelink" href="<?php echo JRoute::_('index.php?option=com_mtree&task=viewimage&img_id=' . $image->id . '&Itemid=' . $this->Itemid); ?>"> --><img id="mainimage" src="<?php 
				echo $this->jconf['live_site'] . $this->mtconf['relative_path_to_listing_medium_image'] . $image->filename;
			 	?>" alt="<?php 
					//echo $image->filename;
					if ($image->alt) echo $image->alt;
					else echo $image->filename;
				?>" /><!-- </a> --></div><?php 
				$i++;
				if( $totalImages == 1 )	continue;
			}
		echo '<span>alt: '.$image->alt.'</span>';
		?>
		
		<div class="thumbnail-left"><a class="listingimage" rel="group1" href="<?php echo $this->jconf['live_site'] . $this->mtconf['relative_path_to_listing_medium_image'] . $image->filename; ?>"><img src="<?php 
		echo $this->jconf['live_site'] . $this->mtconf['relative_path_to_listing_small_image'] . $image->filename;
	 	?>" alt="<?php echo $image->filename; ?>" /></a></div><?php 
			$i++;
		endforeach; 
		?>
	</div>
</div>
<script type="text/javascript">
jQuery("a.listingimage").fancybox({
				'opacity'	: true,
				'overlayShow'	: true,
				'overlayOpacity': 0.7,
				'overlayColor'	: '#fff',
				'transitionIn'	: 'none',
				'transitionOut'	: 'none',
				'changeSpeed'	: '0',
				'padding'	: '0',
				'type'		: 'image',
				'changeFade'	: 0,
				'cyclic'	: true
			});
</script>
<?php endif; ?>