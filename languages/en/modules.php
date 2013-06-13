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


/**
 * Back end modules
 */
$GLOBALS['TL_LANG']['FMD']['twitterreader'] = array('Show twitter postings', '');
$GLOBALS['TL_LANG']['tl_module']['twitterusers'] = array('Name of twitter user','The name of the twitter user');
$GLOBALS['TL_LANG']['tl_module']['twittercount'] = array('Amount of postings','How many postings would you like to display ?');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHTTPLinks'] = array('Enable linking of HTTP','Linking of URL');

$GLOBALS['TL_LANG']['tl_module']['twitterEnableUserProfileLink'] = array('Enable linking of user','Linking of user tag');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHashtagLink'] = array('Enable linking of hashtags','Linking of hashtag');

$GLOBALS['TL_LANG']['tl_module']['twittertemplate'] = array('Template','Used Template for frontend rendering. Starts with twitterreader_');
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype'] = array('Requesttype','Different request types for tweets');
?>
