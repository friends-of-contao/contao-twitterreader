<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'FrontendTwitterReader' => 'system/modules/twitterreader/classes/FrontendTwitterReader.php',
	'OAuth'                 => 'system/modules/twitterreader/classes/OAuth.php',
	'TwitterOAuth'          => 'system/modules/twitterreader/classes/TwitterOAuth.php',
	'WidgetTwitterOAuth'    => 'system/modules/twitterreader/classes/WidgetTwitterOAuth.php',
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
