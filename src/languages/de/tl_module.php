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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_module']['twitterusers']                                = array('Name des Twitter Benutzers', 'Geben Sie hier den Benutzernamen ihres Twitter Kontos an');
$GLOBALS['TL_LANG']['tl_module']['twittercount']                                = array('Anzahl der Nachrichten', 'Wieviele Nachrichten moechten Sie anzeigen ?');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHTTPLinks']                      = array('Wandel HTTP Links um', 'Sollen URL automatisch als Link umgeschrieben werden ?');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableUserProfileLink']                = array('Verlinkung des Benutzerprofils', 'Sollen automatisch vorhandene Benutzernamen zu den Twitterprofilen verlinkt werden?');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHashtagLink']                    = array('Verlinkung der Hashtags', 'Sollen automatisch vorhandene Hashtags verlinkt werden?');
$GLOBALS['TL_LANG']['tl_module']['twittertemplate']                             = array('Template', 'Frontendtemplate. Beginnt mit twitterreader_');
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']                         = array('Anfragetype', 'Wählen Sie welche Twitter-Meldungen ausgegeben werden sollen.');

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['mentions_timeline']    = 'Mentions-Timeline';
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['home_timeline']        = 'Home-Timeline';
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['retweets_of_me']       = 'Meine Retweets';
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['user_timeline']        = 'Benutzer-Timeline';


/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['tl_module']['twitterreader_auth_missing']                  = 'Twitter Authentifizierung nicht vollstaendig. Bitte neu durchfuehren.';
