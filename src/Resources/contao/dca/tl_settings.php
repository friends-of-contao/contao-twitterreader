<?php

/*
 * @copyright  2013 Stefan Lindecke <lindesbs@googlemail.com>, Helmut Schottmüller 2018 <http://github.com/hschottm>
 * @author     Stefan Lindecke, Helmut Schottmüller (hschottm)
 * @package    contao-twitterreader
 * @license    http://gplv3.fsf.org/ GPLv3
 * @see	      https://github.com/friends-of-contao/contao-twitterreader
 */

/**
 * Add to palette.
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{area_twitterreader},twitterreader_auth';

/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['twitterreader_auth'] = [
  'label' => &$GLOBALS['TL_LANG']['tl_settings']['twitterreader_auth'],
  'inputType' => 'widgetTwitterAuth',
  'eval' => ['tl_class' => 'w50'],
  'explanation' => 'twitter_auth',
];
