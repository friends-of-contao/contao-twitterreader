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
$GLOBALS['TL_LANG']['tl_module']['twitterusers']                    = array('Name of twitter user', 'The name of the twitter user');
$GLOBALS['TL_LANG']['tl_module']['twittercount']                    = array('Amount of postings', 'How many postings would you like to display ?');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHTTPLinks']          = array('Enable linking of HTTP', 'Linking of URL');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableUserProfileLink']    = array('Enable linking of user', 'Linking of user tag');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHashtagLink']        = array('Enable linking of hashtags', 'Linking of hashtag');
$GLOBALS['TL_LANG']['tl_module']['twittertemplate']                 = array('Template', 'Used Template for frontend rendering. Starts with twitterreader_');
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']             = array('Requesttype', 'Different request types for tweets');

/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['tl_module']['twitterreader_auth_missing']      = 'Twitter authentification not completed. Please reauthenticate.';
