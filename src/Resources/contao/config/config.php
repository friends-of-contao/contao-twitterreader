<?php

/*
 * @copyright  2013 Stefan Lindecke <lindesbs@googlemail.com>, Helmut Schottmüller 2018 <http://github.com/hschottm>
 * @author     Stefan Lindecke, Helmut Schottmüller (hschottm)
 * @package    contao-twitterreader
 * @license    http://gplv3.fsf.org/ GPLv3
 * @see	      https://github.com/friends-of-contao/contao-twitterreader
 */

use FOC\TwitterReaderBundle\FrontendTwitterReader;
use FOC\TwitterReaderBundle\WidgetTwitterOAuth;

 /*
 * Front end modules
 */
$GLOBALS['FE_MOD']['application']['twitterreader'] = FrontendTwitterReader::class;

/*
 * Back end form fields
 */
$GLOBALS['BE_FFL']['widgetTwitterAuth'] = WidgetTwitterOAuth::class;
