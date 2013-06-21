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
 
define('TWITTERREADER_CONSUMER_KEY', 'FiC4gKrsbRpXQ4GatTbLhw');
define('TWITTERREADER_CONSUMER_SECRET', 'noMHHjUPEYiBwH7LHg19x6mvkxG60AmEHfMzIGXCo'); 


/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['twitterreader']['twitterreader'] = 'FrontendTwitterReader';


/**
 * Back end form fields
 */
$GLOBALS['BE_FFL']['WidgetTwitterOAuth']  = 'WidgetTwitterOAuth';


/**
 * Settings Icon
 */
$GLOBALS['SETTINGS4WARD']['icon']['area_twitterreader'] = 'system/modules/twitterreader/assets/twitter_legend.png';
