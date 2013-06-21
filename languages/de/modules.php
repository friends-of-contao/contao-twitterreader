<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Twitter Reader for Contao Open Source CMS
 *
 * Copyright (C) 2013 Stefan Lindecke <lindesbs@googlemail.com>
 *
 * @package     twitterreader
 * @license     http://gplv3.fsf.org/ GPL
 * @filesource  https://github.com/lindesbs/TwitterReader
 */


/**
 * Back end modules
 */
$GLOBALS['TL_LANG']['FMD']['twitterreader'] = array
(
  'Twittermeldungen anzeigen', 
  ''
);
$GLOBALS['TL_LANG']['tl_module']['twitterusers'] = array
(
	'Name des Twitter Benutzers',
	'Geben Sie hier den Benutzernamen ihres Twitter Kontos an'
);
$GLOBALS['TL_LANG']['tl_module']['twittercount'] = array
(
	'Anzahl der Nachrichten',
	'Wieviele Nachrichten moechten Sie anzeigen ?'
);
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHTTPLinks'] = array
(
	'Wandel HTTP Links um',
	'Sollen URL automatisch als Link umgeschrieben werden ?'
);
$GLOBALS['TL_LANG']['tl_module']['twitterShowReplies'] = array
(
	'Anzeige aller Antwort-Tweets',
	'Sollen Nachrichten angezeigt werden, die eine Antwort beinhalten?'
);
$GLOBALS['TL_LANG']['tl_module']['twitterEnableUserProfileLink'] = array
(
	'Verlinkung des Benutzerprofils',
	'Sollen automatisch vorhandene Benutzernamen zu den Twitterprofilen verlinkt werden?'
);
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHashtagLink'] = array
(
	'Verlinkung der Hashtags',
	'Sollen automatisch vorhandene Hashtags verlinkt werden?'
);
$GLOBALS['TL_LANG']['tl_module']['twittertemplate'] = array
(
	'Template',
	'Frontendtemplate. Beginnt mit twitterreader_'
);
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype'] = array
(
	'Anfragetype',
	''
);
