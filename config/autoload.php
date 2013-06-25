<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Twitterreader
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'FrontendTwitterReader' => 'system/modules/twitterreader/FrontendTwitterReader.php',
	'OAuth'                 => 'system/modules/twitterreader/OAuth.php',
	'TwitterOAuth'          => 'system/modules/twitterreader/TwitterOAuth.php',
	'WidgetTwitterOAuth'    => 'system/modules/twitterreader/WidgetTwitterOAuth.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'FrontendTwitterReader'         => 'system/modules/twitterreader/templates',
	'twitterreader_public_timeline' => 'system/modules/twitterreader/templates',
	'twitterreader_standard'        => 'system/modules/twitterreader/templates',
	'twitterreader_userinfos'       => 'system/modules/twitterreader/templates',
));
