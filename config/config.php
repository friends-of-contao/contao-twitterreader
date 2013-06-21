<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  GPL 
 * @author     Stefan Lindecke 
 * @package    twitterreader 
 * @license    GPL 
 * @filesource
 */

// CONTENT ELEMENTS
$GLOBALS['FE_MOD']['twitterreader'] = array(
		'twitterreader'     => 'FrontendTwitterReader'
	);


$GLOBALS['BE_FFL']['WidgetTwitterOAuth']  = 'WidgetTwitterOAuth';


define('TWITTERREADER_CONSUMER_KEY', 'FiC4gKrsbRpXQ4GatTbLhw');
define('TWITTERREADER_CONSUMER_SECRET', 'noMHHjUPEYiBwH7LHg19x6mvkxG60AmEHfMzIGXCo');


/**
 * Settings Icon
 */
$GLOBALS['SETTINGS4WARD']['icon']['area_twitterreader'] = 'system/modules/twitterreader/assets/twitter_legend.png';
