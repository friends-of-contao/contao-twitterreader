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
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype'] = ['Requesttype', 'Different request types for tweets'];
$GLOBALS['TL_LANG']['tl_module']['twitterusers'] = ['Name of twitter user', 'The name of the twitter user.'];
$GLOBALS['TL_LANG']['tl_module']['twittercount'] = ['Amount of postings', 'How many postings would you like to display?'];
$GLOBALS['TL_LANG']['tl_module']['twittertemplate'] = ['Template', 'The used template for frontend rendering (starts with <i>twitterreader_</i>).'];
$GLOBALS['TL_LANG']['tl_module']['twitterEnableUserProfileLink'] = ['Enable linking of users', 'Automatic linking of available users?'];
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHashtagLink'] = ['Enable linking of hashtags', 'Automatic linking of available hashtags?'];
$GLOBALS['TL_LANG']['tl_module']['twitterEnableHTTPLinks'] = ['Enable linking of HTTP', 'Automatic linking of URLs?'];
$GLOBALS['TL_LANG']['tl_module']['twitterEnableMediaLinks'] = ['Enable linking of media', 'Automatic linking of media URLs?'];
$GLOBALS['TL_LANG']['tl_module']['twitterEmbedFirstMedia'] = ['Embed first media', 'Automatic embedding of the first media?'];
$GLOBALS['TL_LANG']['tl_module']['twitterEmbedFirstMediaSize'] = ['Width and height of the embedded media', 'Here you can set the media dimensions.'];

/*
 * References
 */
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['mentions_timeline'] = 'Mentions timeline';
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['home_timeline'] = 'Home timeline';
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['retweets_of_me'] = 'Retweets of me';
$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype']['user_timeline'] = 'User timeline';

/*
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['tl_module']['twitterreader_auth_missing'] = 'Twitter authentification not completed. Please reauthenticate.';
