<?php

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
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']          = array('Requesttype', 'Different request types for tweets');
$GLOBALS['TL_LANG']['tl_module']['twitterusers']                 = array('Name of twitter user', 'The name of the twitter user.');
$GLOBALS['TL_LANG']['tl_module']['twittercount']                 = array('Amount of postings', 'How many postings would you like to display?');
$GLOBALS['TL_LANG']['tl_module']['twittertemplate']              = array('Template', 'The used template for frontend rendering (starts with <i>twitterreader_</i>).');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableUserProfileLink'] = array('Enable linking of users', 'Automatic linking of available users?');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHashtagLink']     = array('Enable linking of hashtags', 'Automatic linking of available hashtags?');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHTTPLinks']       = array('Enable linking of HTTP', 'Automatic linking of URLs?');
$GLOBALS['TL_LANG']['tl_module']['twitterEnableMediaLinks']      = array('Enable linking of media', 'Automatic linking of media URLs?');
$GLOBALS['TL_LANG']['tl_module']['twitterEmbedFirstMedia']       = array('Embed first media', 'Automatic embedding of the first media?');
$GLOBALS['TL_LANG']['tl_module']['twitterEmbedFirstMediaSize']   = array('Width and height of the embedded media', 'Here you can set the media dimensions.');

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['mentions_timeline'] = 'Mentions timeline';
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['home_timeline']     = 'Home timeline';
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['retweets_of_me']    = 'Retweets of me';
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['user_timeline']     = 'User timeline';

/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['tl_module']['twitterreader_auth_missing'] = 'Twitter authentification not completed. Please reauthenticate.';
