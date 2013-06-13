<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{area_twitterreader},twitterreader_auth';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['twitterreader_auth'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_settings']['twitterreader_auth'],
	'inputType'			=> 'WidgetTwitterOAuth',
	'explanation'		=> 'twitter_auth'
);
