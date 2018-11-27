<?php

/*
 * @copyright  2013 Stefan Lindecke <lindesbs@googlemail.com>, Helmut Schottmüller 2018 <http://github.com/hschottm>
 * @author     Stefan Lindecke, Helmut Schottmüller (hschottm)
 * @package    contao-twitterreader
 * @license    http://gplv3.fsf.org/ GPLv3
 * @see	      https://github.com/friends-of-contao/contao-twitterreader
 */

/**
 * Fields.
 */
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype'] = ['Anfragetyp', 'Wählen Sie, welche Twitter-Meldungen ausgegeben werden sollen.'];
$GLOBALS['TL_LANG']['tl_module']['twitterusers'] = ['Name des Twitter Benutzers', 'Geben Sie hier den Benutzernamen ihres Twitter Kontos an.'];
$GLOBALS['TL_LANG']['tl_module']['twittercount'] = ['Anzahl der Nachrichten', 'Wieviele Nachrichten möchten Sie anzeigen?'];
$GLOBALS['TL_LANG']['tl_module']['twittertemplate'] = ['Template', 'Das verwendete Frontend-Template (beginnt mit <i>twitterreader_</i>).'];
$GLOBALS['TL_LANG']['tl_module']['twitterEnableUserProfileLink'] = ['Verlinkung des Benutzerprofils', 'Sollen vorhandene Benutzernamen automatisch zu den Twitterprofilen verlinkt werden?'];
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHashtagLink'] = ['Verlinkung der Hashtags', 'Sollen vorhandene Hashtags automatisch verlinkt werden?'];
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHTTPLinks'] = ['Wandel HTTP Links um', 'Sollen URLs automatisch als Link umgeschrieben werden?'];
$GLOBALS['TL_LANG']['tl_module']['twitterEnableMediaLinks'] = ['Wandel Media Links um', 'Sollen URLs zu Medien automatisch als Link umgeschrieben werden?'];
$GLOBALS['TL_LANG']['tl_module']['twitterEmbedFirstMedia'] = ['Erstes Medium einbetten', 'Soll das erste Medium automatisch eingebettet werden?'];
$GLOBALS['TL_LANG']['tl_module']['twitterEmbedFirstMediaSize'] = ['Breite und Höhe des eingebetteten Mediums', 'Hier können Sie die Abmessungen des Mediums festlegen.'];

/*
 * References
 */
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['mentions_timeline'] = 'Mentions-Timeline';
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['home_timeline'] = 'Home-Timeline';
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['retweets_of_me'] = 'Meine Retweets';
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['user_timeline'] = 'Benutzer-Timeline';

/*
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['tl_module']['twitterreader_auth_missing'] = 'Twitter Authentifizierung nicht vollständig. Bitte neu durchführen.';
