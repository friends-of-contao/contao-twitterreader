<?php

/*
 * @copyright  2013 Stefan Lindecke <lindesbs@googlemail.com>, Helmut Schottmüller 2018 <http://github.com/hschottm>
 * @author     Stefan Lindecke, Helmut Schottmüller (hschottm)
 * @package    contao-twitterreader
 * @license    http://gplv3.fsf.org/ GPLv3
 * @see	      https://github.com/friends-of-contao/contao-twitterreader
 */

/**
 * Add config callback.
 */
$GLOBALS['TL_DCA']['tl_module']['config']['onload_callback'][] = ['tl_twitter_module', 'checkConfig'];

/*
 * Add palette to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'twitterEnableMediaLinks';
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'twitterEmbedFirstMedia';
$GLOBALS['TL_DCA']['tl_module']['palettes']['twitterreader'] = '{title_legend},name,headline,type;{config_legend},twitter_requesttype,twitterusers,twittercount;{template_legend},twittertemplate,twitterEnableUserProfileLink,twitterEnableHashtagLink,twitterEnableHTTPLinks,twitterEnableMediaLinks;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/*
 * Add to subpalettes
 */
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['twitterEnableMediaLinks'] = 'twitterEmbedFirstMedia';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['twitterEmbedFirstMedia'] = 'twitterEmbedFirstMediaSize';

/*
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['twitter_requesttype'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype'],
    'default' => 'user_timeline',
    'exclude' => true,
    'inputType' => 'select',
    'options' => ['mentions_timeline', 'home_timeline', 'retweets_of_me', 'user_timeline'],
    'reference' => &$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype'],
    'eval' => ['mandatory' => true, 'submitOnChange' => true, 'tl_class' => 'w50'],
    'save_callback' => [
        ['tl_twitter_module', 'purgeCacheData'],
    ],
    'sql' => "varchar(255) NOT NULL default 'user_timeline'",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['twitterusers'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['twitterusers'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['twittercount'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['twittercount'],
    'default' => '3',
    'exclude' => true,
    'inputType' => 'select',
    'options' => range(1, 20),
    'eval' => ['mandatory' => true, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['twittertemplate'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['twittertemplate'],
    'default' => 'twitterreader_standard',
    'exclude' => true,
    'inputType' => 'select',
    'options_callback' => ['tl_twitter_module', 'getTwitterTemplates'],
    'eval' => ['mandatory' => true, 'tl_class' => 'clr'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['twitterEnableUserProfileLink'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['twitterEnableUserProfileLink'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50'],
    'sql' => "varchar(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['twitterEnableHashtagLink'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['twitterEnableHashtagLink'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50'],
    'sql' => "varchar(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['twitterEnableHTTPLinks'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['twitterEnableHTTPLinks'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50'],
    'sql' => "varchar(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['twitterEnableMediaLinks'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['twitterEnableMediaLinks'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50', 'submitOnChange' => true],
    'sql' => "varchar(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['twitterEmbedFirstMedia'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['twitterEmbedFirstMedia'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50', 'submitOnChange' => true],
    'sql' => "varchar(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['twitterEmbedFirstMediaSize'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['twitterEmbedFirstMediaSize'],
    'exclude' => true,
    'inputType' => 'imageSize',
    'options' => ['px', '%', 'em', 'rem', 'ex', 'pt', 'pc', 'in', 'cm', 'mm'],
    'eval' => ['includeBlankOption' => true, 'rgxp' => 'digit', 'nospace' => true, 'tl_class' => 'w50'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['twitterLastUpdate'] = [
    'sql' => "int(10) unsigned NOT NULL default '0'",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['twitterFeedBackup'] = [
   'sql' => 'text NULL',
];

/**
 * Class tl_twitter_module.
 *
 * Extends Backendclass for TwitterReader
 *
 * @copyright  Stefan Lindecke (C) 2013
 * @author     Stefan Lindecke <lindesbs@googlemail.com>
 */
class tl_twitter_module extends Backend
{
    /**
     * Import the back end user object.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function checkConfig()
    {
        $oauth_token = "";
        $oauth_secret = "";
        $twitter_user_id = "";
        $twitter_screen_name = "";

        if (array_key_exists('twitterreader_credentials_oauth_token', $GLOBALS['TL_CONFIG'])) {
            $oauth_token = $GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token'];
        }
        if (array_key_exists('twitterreader_credentials_oauth_token_secret', $GLOBALS['TL_CONFIG'])) {
            $oauth_secret = $GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token_secret'];
        }
        if (array_key_exists('twitterreader_credentials_user_id', $GLOBALS['TL_CONFIG'])) {
            $twitter_user_id = $GLOBALS['TL_CONFIG']['twitterreader_credentials_user_id'];
        }
        if (array_key_exists('twitterreader_credentials_screen_name', $GLOBALS['TL_CONFIG'])) {
            $twitter_screen_name = $GLOBALS['TL_CONFIG']['twitterreader_credentials_screen_name'];
        }

        if (strlen($oauth_token) == 0 || strlen($oauth_secret) == 0 || strlen($twitter_user_id) == 0 || strlen($twitter_screen_name) == 0) {
            $_SESSION['TL_ERROR'][] = $GLOBALS['TL_LANG']['tl_module']['twitterreader_auth_missing'];
        }
    }

    public function getTwitterTemplates(DataContainer $dc)
    {
        return \Controller::getTemplateGroup('twitterreader_');
    }

    public function purgeCacheData($field, DataContainer $dc)
    {
        $sqlTwitter = $this->Database->prepare("UPDATE tl_module SET twitterFeedBackup='' WHERE id=?")->executeUncached($dc->activeRecord->id);

        return $field;
    }
}
