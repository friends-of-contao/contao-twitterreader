<?php
if(!defined('TL_ROOT'))
    die('You can not access this file directly!');

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
 * Add palette to tl_module
 */

$GLOBALS['TL_DCA']['tl_module']['config']['onload_callback'][]=array(
    'tl_twitter_module',
    'checkConfig'
);

$GLOBALS['TL_DCA']['tl_module']['palettes']['twitterreader']='name,type,headline;{area_twitter},twitter_requesttype,twitterusers,twittercount,twittertemplate;{area_twittersettings},twitterEnableHTTPLinks,twitterEnableUserProfileLink,twitterEnableHashtagLink;align,space,cssID';

/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['twitterusers']=array(
    'label'=>&$GLOBALS['TL_LANG']['tl_module']['twitterusers'],
    'exclude'=>true,
    'inputType'=>'text',
    'eval'=> array(
        'mandatory'=>true,
        'tl_class'=>'w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['twitter_requesttype']=array(
    'label'=>&$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype'],
    'default'=>'user_timeline',
    'exclude'=>true,
    'inputType'=>'select',
    'save_callback'=> array( array(
            'tl_twitter_module',
            'purgeCacheData'
        ), ),
    'options'=> array(
        'mentions_timeline',
        'home_timeline',
        'retweets_of_me',
        'user_timeline'
    ),
    'eval'=> array(
        'mandatory'=>true,
        'submitOnChange'=>true
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['twittertemplate']=array(
    'label'=>&$GLOBALS['TL_LANG']['tl_module']['twittertemplate'],
    'default'=>'twitterreader_standard',
    'exclude'=>true,
    'inputType'=>'select',
    'options_callback'=> array(
        'tl_twitter_module',
        'getTwitterTemplates'
    ),
    'eval'=> array(
        'mandatory'=>true,
        'tl_class'=>'w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['twittercount']=array(
    'label'=>&$GLOBALS['TL_LANG']['tl_module']['twittercount'],
    'default'=>'3',
    'exclude'=>true,
    'inputType'=>'select',
    'options'=> array(
        1,
        2,
        3,
        4,
        5,
        6,
        7,
        8,
        9,
        10
    ),
    'eval'=> array(
        'mandatory'=>true,
        'tl_class'=>'w50'
    )
);

$GLOBALS['TL_DCA']['tl_module']['fields']['twitterEnableHTTPLinks']=array(
    'label'=>&$GLOBALS['TL_LANG']['tl_module']['twitterEnableHTTPLinks'],
    'exclude'=>true,
    'inputType'=>'checkbox'
);

$GLOBALS['TL_DCA']['tl_module']['fields']['twitterEnableUserProfileLink']=array(
    'label'=>&$GLOBALS['TL_LANG']['tl_module']['twitterEnableUserProfileLink'],
    'exclude'=>true,
    'inputType'=>'checkbox'
);

$GLOBALS['TL_DCA']['tl_module']['fields']['twitterEnableHashtagLink']=array(
    'label'=>&$GLOBALS['TL_LANG']['tl_module']['twitterEnableHashtagLink'],
    'exclude'=>true,
    'inputType'=>'checkbox'
);

/**
 * Class tl_twitter_module
 *
 * Extends Backendclass for TwitterReader
 *
 * @copyright  Stefan Lindecke (C) 2013
 * @author     Stefan Lindecke <lindesbs@googlemail.com>
 */
class tl_twitter_module extends Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');

    }

    public function checkConfig()
    {

        
        
        if ((!$GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token']) || 
        (!$GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token_secret']) || 
        (!$GLOBALS['TL_CONFIG']['twitterreader_credentials_user_id']) || 
        (!$GLOBALS['TL_CONFIG']['twitterreader_credentials_screen_name']))
        {
        $_SESSION["TL_ERROR"][]=$GLOBALS['TL_LANG']['tl_module']['twitterreader_auth_missing'];    
        }

    }

    public function getTwitterTemplates(DataContainer $dc)
    {

        return $this->getTemplateGroup('twitterreader_', $dc->activeRecord->pid);
    }

    public function purgeCacheData($field, DataContainer $dc)
    {
        $sqlTwitter=$this->Database->prepare("UPDATE tl_module SET twitterFeedBackup='' WHERE id=?")->executeUncached($dc->activeRecord->id);

        return $field;
    }

}
