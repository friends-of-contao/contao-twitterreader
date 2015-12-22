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
 * Add to palette
 */
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
