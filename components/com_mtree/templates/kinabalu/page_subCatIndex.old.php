<?php





	//echo "<div id='".$items['cat_id']."__' class='titulo_region' style='width:100%; float:left; margin-bottom: 20px;'>".$items['cat_name']."</div><br><br>";
	
	
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
	










 //if( $this->cat_show_listings ) include $this->loadTemplate( 'sub_listings.tpl.php' ) ?>
