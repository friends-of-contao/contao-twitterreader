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
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']                         = array('Anfragetyp', 'Wählen Sie, welche Twitter-Meldungen ausgegeben werden sollen.');
$GLOBALS['TL_LANG']['tl_module']['twitterusers']                                = array('Name des Twitter Benutzers', 'Geben Sie hier den Benutzernamen ihres Twitter Kontos an.');
$GLOBALS['TL_LANG']['tl_module']['twittercount']                                = array('Anzahl der Nachrichten', 'Wieviele Nachrichten möchten Sie anzeigen?');
$GLOBALS['TL_LANG']['tl_module']['twittertemplate']                             = array('Template', 'Das verwendete Frontend-Template (beginnt mit <i>twitterreader_</i>).');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableUserProfileLink']                = array('Verlinkung des Benutzerprofils', 'Sollen vorhandene Benutzernamen automatisch zu den Twitterprofilen verlinkt werden?');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHashtagLink']                    = array('Verlinkung der Hashtags', 'Sollen vorhandene Hashtags automatisch verlinkt werden?');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHTTPLinks']                      = array('Wandel HTTP Links um', 'Sollen URLs automatisch als Link umgeschrieben werden?');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableMediaLinks']                     = array('Wandel Media Links um', 'Sollen URLs zu Medien automatisch als Link umgeschrieben werden?');

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
$GLOBALS['TL_LANG']['tl_module']['twitterreader_auth_missing']                  = 'Twitter Authentifizierung nicht vollständig. Bitte neu durchführen.';
