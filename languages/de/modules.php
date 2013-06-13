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
$GLOBALS['TL_LANG']['FMD']['twitterreader'] = array('Twittermeldungen anzeigen', '');
$GLOBALS['TL_LANG']['tl_module']['twitterusers'] = array('Name des Twitter Benutzers','Geben Sie hier den Benutzernamen ihres Twitter Kontos an');
$GLOBALS['TL_LANG']['tl_module']['twittercount'] = array('Anzahl der Nachrichten','Wieviele Nachrichten moechten Sie anzeigen ?');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHTTPLinks'] = array('Wandel HTTP Links um','Sollen URL automatisch als Link umgeschrieben werden ?');
$GLOBALS['TL_LANG']['tl_module']['twitterShowReplies'] = array('Anzeige aller Antwort-Tweets','Sollen Nachrichten angezeigt werden, die eine Antwort beinhalten?');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableUserProfileLink'] = array('Link auf Benutzerprofil des Antwortenden','Bei Antworten auf das Profil des Schreibenden verlinken');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHashtagLink'] = array('Verlinkung der Hashtags','Sollen automatisch vorhandene Hashtags verlinkt werden.');


$GLOBALS['TL_LANG']['tl_module']['twittertemplate'] = array('Template','Frontendtemplate. Beginnt mit twitterreader_');
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype'] = array('Anfragetype','');
?>
