<?php
#
# Load category#-header-id# modules
#
global $mtconf;
$document	= &JFactory::getDocument();
$renderer	= $document->loadRenderer('module');

$contents	= '';

/* custom for etips only */
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
/* end custom */


$zone = "tree";
$modules =& JModuleHelper::getModules($zone);
foreach ($modules as $module){
   echo JModuleHelper::renderModule($module);
}


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

$sub_class = '';
if (!is_array($categorias) or !in_array($this->cat_id, array_values($categorias))) {
   $sub_class = 'head_sub_cat';
}

?>

<?php
$document->addCustomTag('<meta property="og:image" content="'. JURI::base() . 'images/etips_200.jpg"/>');
//$document->addCustomTag('<meta property="og:type" content="article"/>');
//$document->addCustomTag('<meta property="og:title" content="' . $document->getTitle() . '" />');
//$document->addCustomTag('<meta property="og:url" content="'. JURI::current() .'" />');
//$document->addCustomTag('<meta property="og:site_name" content="http://etips.danielhiga.org.ar" />');
//$document->addCustomTag('<meta property="og:description" content="' . 'test 123 test 123' . '" />');
//$document->addCustomTag('<meta property="fb:admins" content="" />');
?>

<div id="cat-header">
<h1 class="contentheading <?php echo $sub_class;?>"><?php echo htmlspecialchars($this->cat_name) ?><?php echo ($this->mtconf['show_category_rss']) ? $this->plugin('showrssfeed','new') : ''; ?></h1>
<p class="mbutton">
<?php
if (isset($this->cat_allow_submission) && $this->cat_allow_submission && $this->user_addlisting >= 0) {
	//echo $this->plugin("ahref","index.php?option=com_mtree&task=addlisting&cat_id=$this->cat_id&Itemid=$this->Itemid",JText::_( 'Add your listing here' ),'class="add-listing"');
}
?></p>
</div>
<?php
$lang =& JFactory::getLanguage();
$categoria = $categorias[$lang->getName()];
if ( (isset($this->cat_image) && $this->cat_image <> '') || (isset($this->cat_desc) && $this->cat_desc <> '') ) {
	echo '<div id="cat-desc">';
	if (isset($this->cat_image) && $this->cat_image <> '') {
		echo '<div id="cat-image">';
		//$this->plugin( 'image', $this->config->getjconf('live_site').$this->config->get('relative_path_to_cat_small_image') . $this->cat_image , $this->cat_name, '', '', '' );
		echo '</div>';
	}
	$alt_cat = cat_alt(htmlspecialchars($this->cat_name), $categoria);
	if ( isset($this->cat_desc) && $this->cat_desc <> '') {	echo set_alt($this->cat_desc, $alt_cat); }
	echo '</div>';
}
?>


<script type="text/javascript"> 
function ir_a(id){
	jQuery('html,body').animate({ scrollTop: jQuery('#' + id + '__').offset().top }, { duration: 'slow', easing: 'swing'});
	}
</script>

<?php

$lang =& JFactory::getLanguage();

echo '<div style="clear:both;"></div>';
//Categorías según el idioma. Para agregar una, agregar una línea 'idioma' => 'numId',

$categoria = $categorias[$lang->getName()];

if (in_array($this->cat_id, array_values($categorias))) {
    $query = 'SELECT * FROM btda0_mt_cats WHERE cat_parent = "'.$categoria.'" ORDER BY cat_name';
    $db1 =& JFactory::getDBO();
    $db1->setQuery($query);


    $lista = $db1->loadAssocList();

    foreach ($lista as $items)
    {
        echo "<div onclick='ir_a(\"".$items['cat_id']."\")' id='".$items['cat_id']."_' class='titulo_region' style='width:33%; float:left; margin-bottom:10px; '>".$items['cat_name']."</div>";
    }
    echo "<br><br>";
    
    foreach ($lista as $items)
    {
        echo "<div id='".$items['cat_id']."__' class='titulo_region' style='width:100%; float:left; margin-bottom: 20px;'>".$items['cat_name']."</div><br><br>";
            
        $db2 =& JFactory::getDBO();
        $query2 = 'SELECT cat.* FROM #__mt_cats AS cat ';
        $query2 .= 'WHERE cat_published=1 && cat_approved=1 && cat_parent= ' . $db2->quote($items['cat_id']) . ' ORDER BY cat_name';
        $db2->setQuery($query2);
        $lista2 = $db2->loadAssocList();
        
        
        
        //var_dump($lista2);
        foreach ($lista2 as $items2) {
            echo '<div class="listing-summary fieldRow"><div class="header-mtree"><h3>';
            //echo $items2['cat_name'];
            $cat_id = $items2['cat_id'];
            $short_description = isset($items2['cat_short_description'])?$items2['cat_short_description']:'';
            $app_link = (isset($items2['cat_link']) and !empty($items2['cat_link']))?$items2['cat_link']:'';
            $app_ico = (isset($items2['cat_link']) and !empty($items2['cat_link']))?'<img class="applogo" src="images/apple-logo.png" alt="shop"/>':'';
            $this->plugin('ahref', "index.php?option=$this->option&task=listcats&cat_id=$cat_id&Itemid=$this->Itemid", htmlspecialchars($items2['cat_name']), '');
            echo '</h3></div><div class="fields">';
            $this->plugin('ahref', "index.php?option=$this->option&task=listcats&cat_id=$cat_id&Itemid=$this->Itemid", htmlspecialchars($short_description), '');
            echo '<a href="'. $app_link .' " target="_blank" onclick="_gaq.push([\'_trackEvent\', \'Destinos-'. $lang->getTag() .'\',\''. $items2['cat_name'] .'\'])">'. $app_ico  .'</a></div></div>';
        }
        
        include('page_subCatIndex.old.php');
    }
} else {
    if( $this->cat_show_listings ) {
        include $this->loadTemplate( 'sub_listings.tpl.php');
    }
}

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
