<?php
#
# Load category#-header-id# modules
#
global $mtconf;
$document	= &JFactory::getDocument();
$renderer	= $document->loadRenderer('module');

$contents	= '';


echo "<pre>";

//echo $this->cat_id;
//$this->cat_id = '85';
//var_dump($this->categories);

$zone = "tree";
$modules =& JModuleHelper::getModules($zone);
foreach ($modules as $module){
   echo JModuleHelper::renderModule($module);
}


echo "</pre>";

$modules = JModuleHelper::getModules('category-header-id'.$this->cat_id);
if( !empty($modules) )
{
	$contents	.= '<div class="category-header-inner">';
	foreach ($modules as $mod)  {
		$params = new JRegistry( $mod->params );
		$contents .= '<div class="module'.$params->get('moduleclass_sfx').'">';
		if ($mod->showtitle) 
		{
			$contents .= '<h3>' . $mod->title . '</h3>';
			$contents .= '<div class="triangle"></div>';
		}
		$contents .= $renderer->render($mod);
		$contents .= '</div>';
	}
	$contents	.= '</div>';
}

$modules = JModuleHelper::getModules('category2-header-id'.$this->cat_id);
if( !empty($modules) )
{
	$contents	.= '<div class="category2-header-inner">';
	foreach ($modules as $mod)  {
		$params = new JRegistry( $mod->params );
		$contents .= '<div class="module'.$params->get('moduleclass_sfx').'">';
		if ($mod->showtitle) 
		{
			$contents .= '<h3>' . $mod->title . '</h3>';
			$contents .= '<div class="triangle"></div>';
		}
		$contents .= $renderer->render($mod);
		$contents .= '</div>';
	}
	$contents	.= '</div>';
}

$modules = JModuleHelper::getModules('category3-header-id'.$this->cat_id);
if( !empty($modules) )
{
	$contents	.= '<div class="category3-header-inner">';
	foreach ($modules as $mod)  {
		$params = new JRegistry( $mod->params );
		$contents .= '<div class="module'.$params->get('moduleclass_sfx').'">';
		if ($mod->showtitle) 
		{
			$contents .= '<h3>' . $mod->title . '</h3>';
			$contents .= '<div class="triangle"></div>';
		}
		$contents .= $renderer->render($mod);
		$contents .= '</div>';
	}
	$contents	.= '</div>';
}

if( !empty($contents) )
{
	echo '<div class="category-header-modules">' . $contents . '</div>';
}
?> 
<div id="cat-header">
<h2 class="contentheading"><?php echo htmlspecialchars($this->cat_name) ?><?php echo ($this->mtconf['show_category_rss']) ? $this->plugin('showrssfeed','new') : ''; ?></h2>
<p class="mbutton">
<?php
if (isset($this->cat_allow_submission) && $this->cat_allow_submission && $this->user_addlisting >= 0) {
	//echo $this->plugin("ahref","index.php?option=com_mtree&task=addlisting&cat_id=$this->cat_id&Itemid=$this->Itemid",JText::_( 'Add your listing here' ),'class="add-listing"');
}
?></p>
</div>
<?php
if ( (isset($this->cat_image) && $this->cat_image <> '') || (isset($this->cat_desc) && $this->cat_desc <> '') ) {
	echo '<div id="cat-desc">';
	if (isset($this->cat_image) && $this->cat_image <> '') {
		echo '<div id="cat-image">';
		$this->plugin( 'image', $this->config->getjconf('live_site').$this->config->get('relative_path_to_cat_small_image') . $this->cat_image , $this->cat_name, '', '', '' );
		echo '</div>';
	}
	if ( isset($this->cat_desc) && $this->cat_desc <> '') {	echo $this->cat_desc; }
	echo '</div>';
}
?>

<?php //include $this->loadTemplate( 'sub_subCats.tpl.php' ) ?>


<script type="text/javascript"> 
function ir_a(id){
	jQuery('html,body').animate({ scrollTop: jQuery('#' + id + '__').offset().top }, { duration: 'slow', easing: 'swing'});
	}
</script>

<?php
$lang =& JFactory::getLanguage();
echo $lang->getName();
//Categorías según el idioma. Para agregar una, agregar una línea 'idioma' => 'numId',
$categorias = array(
	'English (United Kingdom)' => '85',
	'Español (España)' => '86',
	'French (FR)' => '192',
	'中文（简体）' => '194',
	'Russian' => '299',
	'German (DE-CH-AT)' => '355',
	'Italian (IT)' => '408',
	'Português (pt-PT)' => '461',
	'Korean(Republic of Korea)' => '568',
	'日本語 (Japan)' => '621'
);

/* OLD
if($lang->getName() == 'English (United Kingdom)')
{
   $categoria = '85';
}
elseif ($lang->getName() == 'Español (España)')
{
   $categoria = '86';
}
elseif ($lang->getName() == 'French (FR)')
{
   $categoria = '192';
}
elseif ($lang->getName() == '中文（简体）')
{
   $categoria = '194';
}
elseif ($lang->getName() == 'Russian')
{
   $categoria = '299';
}
elseif ($lang->getName() == 'German (DE-CH-AT)')
{
   $categoria = '355';
}
elseif ($lang->getName() == 'Italian (IT)')
{
   $categoria = '408';
}
elseif ($lang->getName() == 'Português (pt-PT)'){
	$categoria = '461';
}
*/
$categoria = $categorias[$lang->getName()];

$query = 'SELECT * FROM btda0_mt_cats WHERE cat_parent = "'.$categoria.'" ORDER BY cat_name';
$db1 =& JFactory::getDBO();
$db1->setQuery($query);
echo "<pre>";
//print_r($db1->loadAssocList());
echo "</pre>";

$lista = $db1->loadAssocList();

foreach ($lista as $items)
{
	echo "<div onclick='ir_a(\"".$items['cat_id']."\")' id='".$items['cat_id']."_' class='titulo_region' style='width:33%; float:left; margin-bottom:10px; '>".$items['cat_name']."</div>";

}
echo "<br><br>";



foreach ($lista as $items)
{
	echo "<div id='".$items['cat_id']."__' class='titulo_region' style='width:100%; float:left; margin-bottom: 20px;'>".$items['cat_name']."</div><br><br>";
	
	
	//$query2 = 'SELECT * FROM btda0_mt_cl WHERE cat_id = "'.$items['cat_id'].'"';/*btda0_mt_links*/
	$query2 = 'SELECT * FROM btda0_mt_cl cl '.
		'JOIN btda0_mt_links link ON cl.cl_id = link.link_id WHERE cl.cat_id = "'.$items['cat_id'].'" ORDER BY '.$mtconf->get('first_listing_order1');
	$db2 =& JFactory::getDBO();
	$db2->setQuery($query2);
	$lista2 = $db2->loadAssocList();
	
	
	
	foreach ($lista2 as $items2)
				{
					$query3 = 'SELECT * FROM btda0_mt_links WHERE link_id = "'.$items2['cl_id'].'" AND link_published = "1" ';
						$db3 =& JFactory::getDBO();
						$db3->setQuery($query3);
						
						$lista3  = $db3->loadAssocList();
						
						foreach ($lista3 as $items3)
								{
									//echo $items3['link_name']."*".$items3['link_published']."<br>";
									
									
									
									
									
																	$menu = &JSite::getMenu();
																	$items	= $menu->getItems('link', 'index.php?option=com_mtree');
																	$Itemid = 0;
																	$Itemid = $items3['link_id'];
																	
																	
																	$uri =& JURI::getInstance();
																	$linkid = $items3['link_id'];
																	
																	?>
                                                                    
                                                                    
                                                                    
                                                                     <?php
																						echo "<pre>";
																						//var_dump($items3);
																						echo "</pre>";
																						?>
                                                                    
                                                                    
                                                                    			<div class="listing-summary">
                                                                                	<div class="header">
                                                                                		<h3>
                                                                                        
                                                                                       
                                                                                        	 <a style="color:#000; font-size:14px;" id="" href="<?php echo $uri->toString(array( 'scheme', 'host', 'port' )) . JRoute::_("index.php?option=com_mtree&task=viewlink&link_id=$linkid&Itemid=$Itemid");?>"><?php echo $items3['link_name']?></a>	
                                                                                             
                                                                                        </h3>
                                                                                    </div>
                                                                               
                                                                               
                                                                               
                                                                               
                                                                              
                                                                               
                                                                               
                                                                               <div class="fields">
                                                                                <div class="row0">
                                                                                
                                                                                
                                                                                 <!-- Custom field BEGINING -->
                                                                                
                                                                                    <div class="fieldRow" style="width:32%">
                                                                                    <span class="caption">
                                                                                         <?php 
																			   $query_iphone = 'SELECT * FROM btda0_mt_cfvalues WHERE cf_id = "32" AND link_id = "'.$items2['link_id'].'"';
																				$db_iphone =& JFactory::getDBO();
																				$db_iphone->setQuery($query_iphone);
																				
																				$lista_iphone  = $db_iphone->loadAssocList();
																				//var_dump($lista_iphone);
																				if($lista_iphone['0']['value'] != '')
																				{
																				?>
                                                                                        
                                                                                        <a target="_blank" 
																							onclick="_gaq.push(['_trackEvent', 'Destinos', '<?php echo $items3['link_name']."/IPhone"?>'])"
                                                                                        	href="<?php echo $lista_iphone['0']['value']?>">
                                                                                            	<img src="/images/apple-logo.png" style="vertical-align: middle"> iPhone</a>                                                                                           
                                                                                 <?php }?>
                                                                                 </span>
                                                                                    </div>
                                                                                    <div class="fieldRow" style="width:32%">
                                                                                        <span class="caption">
                                                                                        
                                                                                        <?php 
																			   $query_ipad = 'SELECT * FROM btda0_mt_cfvalues WHERE cf_id = "33" AND link_id = "'.$items2['link_id'].'"';
																				$db_ipad =& JFactory::getDBO();
																				$db_ipad->setQuery($query_ipad);
																				
																				$lista_ipad  = $db_ipad->loadAssocList();
																				//var_dump($lista_iphone);
																				if($lista_ipad['0']['value'] != '')
																				{
																				?>
                                                                                        <a target="_blank"
																							onclick="_gaq.push(['_trackEvent', 'Destinos', '<?php echo $items3['link_name']."/IPad"?>'])"
																							href="<?php echo $lista_ipad['0']['value']?>"><img src="/images/apple-logo.png" style="vertical-align: middle"> iPad </a>
                                                                                                     
                                                                                 <?php }?>
                                                                                        
                                                                                        
                                                                                        
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="fieldRow lastFieldRow" style="width:32%">
                                                                                        <span class="caption">
                                                                                        
                                                                                        
                                                                                        
                                                                                        
                                                                                        <?php 
																			   $query_blackberry = 'SELECT * FROM btda0_mt_cfvalues WHERE cf_id = "34" AND link_id = "'.$items2['link_id'].'"';
																				$db_blackberry =& JFactory::getDBO();
																				$db_blackberry->setQuery($query_blackberry);
																				
																				$lista_blackberry  = $db_blackberry->loadAssocList();
																				//var_dump($lista_iphone);
																				if($lista_blackberry['0']['value'] != '')
																				{
																				?>
                                                                                	<a target="_blank" href="<?php echo $lista_blackberry['0']['value']?>"><img src="/images/Blackberry_logo.png" style="vertical-align: middle"> BlackBerry</a>
                                                                                        
                                                                                                     
                                                                                 <?php }?>
                                                                                        
                                                                                        
                                                                                        
                                                                                        
                                                                                        
                                                                                        </span>
                                                                                    </div>
                                                                                    
                                                                                    
                                                                                    <!-- Custom field END -->
                                                                                    
                                                                                    
                                                                                    
                                                                                </div></div></div>
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                   																
                                                                    <?php
																	/*
																	$document->addHeadLink( 
																	$uri->toString(array( 'scheme', 'host', 'port' )) . JRoute::_('index.php?option=com_mtree&task=listcats&cat_id='.$cat_id.'&Itemid='.$Itemid)
																		,'canonical'
																		,'rel'
																	);
																   echo "<pre>";
																   var_dump($uri);
																   echo "</pre>";
																	*/
									
									
									}
						
					
					
					
				}
	
	}









 //if( $this->cat_show_listings ) include $this->loadTemplate( 'sub_listings.tpl.php' ) ?>

<?php
if( empty($this->categories) && $this->pageNav->total == 0 ) {
?>
<div class="pages-links">
	<span class="xlistings"><?php echo $this->pageNav->getResultsCounter(); ?></span>
	<?php echo $this->pageNav->getPagesLinks(); ?>
</div>
<?php	
}

#
# Load category#-footer-id# modules
#

$document	= &JFactory::getDocument();
$renderer	= $document->loadRenderer('module');

$contents	= '';

$modules = JModuleHelper::getModules('category-footer-id'.$this->cat_id);
if( !empty($modules) )
{
	$contents	.= '<div class="category-footer-inner">';
	foreach ($modules as $mod)  {
		$params = new JRegistry( $mod->params );
		$contents .= '<div class="module'.$params->get('moduleclass_sfx').'">';
		if ($mod->showtitle) 
		{
			$contents .= '<h3>' . $mod->title . '</h3>';
			$contents .= '<div class="triangle"></div>';
		}
		$contents .= $renderer->render($mod);
		$contents .= '</div>';
	}
	$contents	.= '</div>';
}

$modules = JModuleHelper::getModules('category2-footer-id'.$this->cat_id);
if( !empty($modules) )
{
	$contents	.= '<div class="category2-footer-inner">';
	foreach ($modules as $mod)  {
		$params = new JRegistry( $mod->params );
		$contents .= '<div class="module'.$params->get('moduleclass_sfx').'">';
		if ($mod->showtitle) 
		{
			$contents .= '<h3>' . $mod->title . '</h3>';
			$contents .= '<div class="triangle"></div>';
		}
		$contents .= $renderer->render($mod);
		$contents .= '</div>';
	}
	$contents	.= '</div>';
}

$modules = JModuleHelper::getModules('category3-footer-id'.$this->cat_id);
if( !empty($modules) )
{
	$contents	.= '<div class="category3-footer-inner">';
	foreach ($modules as $mod)  {
		$params = new JRegistry( $mod->params );
		$contents .= '<div class="module'.$params->get('moduleclass_sfx').'">';
		if ($mod->showtitle) 
		{
			$contents .= '<h3>' . $mod->title . '</h3>';
			$contents .= '<div class="triangle"></div>';
		}
		$contents .= $renderer->render($mod);
		$contents .= '</div>';
	}
	$contents	.= '</div>';
}

if( !empty($contents) )
{
	echo '<div class="category-header-modules">' . $contents . '</div>';
}

?>
