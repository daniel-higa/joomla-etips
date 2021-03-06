<?php
/**
 * @version		$Id: config.mtree.class.php 950 2010-11-16 09:07:27Z cy $
 * @package		Mosets Tree
 * @copyright	(C) 2005-2009 Mosets Consulting. All rights reserved.
 * @license		GNU General Public License
 * @author		Lee Cher Yeong <mtree@mosets.com>
 * @url			http://www.mosets.com/tree/
 */


defined('_JEXEC') or die('Restricted access');

if ( !class_exists('mtConfig') ) {
	class mtConfig {
		var $_db=null;
		var $mtconfig=null;
		var $jconfig=null;
		var $params=null;

		function mtConfig() {
			$this->_db = JFactory::getDBO();
			$this->_db->setQuery( 'SELECT `varname`, `value`, `default` FROM #__mt_config' );
			$this->mtconfig = $this->_db->loadObjectList('varname');

			$app = JFactory::getApplication();
			
			$this->jconfig['absolute_path'] = JPATH_SITE;
			if(substr(JURI::root(),-1) == '/') {
				$this->jconfig['live_site'] = substr(JURI::root(),0,-1);
			} else {
				$this->jconfig['live_site'] = JURI::root();
			}
			$this->jconfig['sitename'] = $app->getCfg('sitename');
			$this->jconfig['offset'] = $app->getCfg('offset');
			$this->jconfig['MetaTitle'] = $app->getCfg('MetaTitle');
			$this->jconfig['MetaAuthor'] = $app->getCfg('MetaAuthor');
			$this->jconfig['list_limit'] = $app->getCfg('list_limit');
			$this->jconfig['sef'] = $app->getCfg('sef');
			$this->jconfig['cachepath'] = JPATH_BASE.DS.'cache';
			$this->jconfig['mailfrom'] = $app->getCfg('mailfrom');
			$this->jconfig['fromname'] = $app->getCfg('fromname');
		}

		function get($varname){
			if(array_key_exists($varname,$this->mtconfig)) {
				$value = $this->mtconfig[$varname]->value;
			} else {
				$value = '';
			}
		  	if (((is_null($value) || trim($value) == "") && $value !== false) || (is_array($value) && empty($value))) {
				return $this->getDefault($varname);
			} else {
				return $this->mtconfig[$varname]->value;
			}
		}
		
		function set($varname,$value) {
			$this->mtconfig[$varname]->value = $value;
		}
		
		function setTemplate($template){
			$this->mtconfig['template']->value = $template;
		
			$this->_db->setQuery('SELECT params FROM #__mt_templates WHERE tem_name = ' . $this->_db->quote($template) . ' LIMIT 1');
			$params = $this->_db->loadResult();
			$this->params = new JRegistry( $params );
		}
		
		function getjconf($varname){
			return $this->jconfig[$varname];
		}
	
		function getTemParam($key,$default='') {
			if(is_null($this->params)) {
				$this->_db->setQuery('SELECT params FROM #__mt_templates WHERE tem_name = ' . $this->_db->quote($this->get('template')) . ' LIMIT 1');
				$params = $this->_db->loadResult();
				$this->params = new JRegistry( $params );
			}
			return $this->params->get( $key, $default );
		}
	
		function getDefault($varname){
			if( isset($this->mtconfig[$varname]->default) ) {
				return $this->mtconfig[$varname]->default;
			} else {
				return null;
			}
		}

		function getVarArray() {
			foreach( $this->mtconfig AS $key=>$value) {
				if (((is_null($value->value) || trim($value->value) == "") && $value->value !== false) || (is_array($value->value) && empty($value->value))) {
					$vars[$key] = $this->getDefault($key);
				} else {
					$vars[$key] = $value->value;
				}
			}
			return $vars;
		}
	
		function getJVarArray() {
			foreach( $this->jconfig AS $key=>$value) {
				$vars[$key] = $value;
			}
			return $vars;
		}
	}
}
?>