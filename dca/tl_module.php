<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

if (function_exists('curl_init'))
{
	
	$GLOBALS['TL_DCA']['tl_module']['palettes']['twitterreader'] = 'name,type,headline;{area_twitter},twitter_requesttype,twitterusers,twittercount,twittertemplate;{area_twittersettings},twitterEnableHTTPLinks,twitterEnableUserProfileLink,twitterEnableHashtagLink;align,space,cssID';
}

$GLOBALS['TL_DCA']['tl_module']['fields']['twitterusers'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['twitterusers'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true,'tl_class'=>'w50')
);


$GLOBALS['TL_DCA']['tl_module']['fields']['twitter_requesttype'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_module']['twitter_requesttype'],
	'default'		=> 'user_timeline',
	'exclude'       => true,
	'inputType'     => 'select',
	'save_callback'	=>	array(
							array('tl_twitter_module', 'purgeCacheData'),
							),
	'options'		=> array('public_timeline','home_timeline','friends_timeline','user_timeline'),
	'eval'          => array('mandatory'=>true,'submitOnChange'=>true)
);

$GLOBALS['TL_DCA']['tl_module']['fields']['twittertemplate'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['twittertemplate'],
	'default'			=> 'twitterreader_standard',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'			=> array('tl_twitter_module', 'getTwitterTemplates'),
	'eval'                    => array('mandatory'=>true,'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['twittercount'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['twittercount'],
	'default'			=> '3',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'			=> array(1,2,3,4,5,6,7,8,9,10),
	'eval'                    => array('mandatory'=>true,'tl_class'=>'w50')
);



$GLOBALS['TL_DCA']['tl_module']['fields']['twitterEnableHTTPLinks'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['twitterEnableHTTPLinks'],
	'exclude'                 => true,
	'inputType'               => 'checkbox'
);



$GLOBALS['TL_DCA']['tl_module']['fields']['twitterShowReplies'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['twitterShowReplies'],
	'exclude'                 => true,
	'inputType'               => 'checkbox'
);


$GLOBALS['TL_DCA']['tl_module']['fields']['twitterEnableUserProfileLink'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['twitterEnableUserProfileLink'],
	'exclude'                 => true,
	'inputType'               => 'checkbox'
);


$GLOBALS['TL_DCA']['tl_module']['fields']['twitterEnableHashtagLink'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['twitterEnableHashtagLink'],
	'exclude'                 => true,
	'inputType'               => 'checkbox'
);




class tl_twitter_module extends Backend
{
public function getTwitterTemplates(DataContainer $dc)
	{
		return $this->getTemplateGroup('twitterreader_', $dc->activeRecord->pid);
	}

	
	public function purgeCacheData($field,DataContainer $dc)
	{
		$sqlTwitter = $this->Database->prepare("UPDATE tl_module SET twitterFeedBackup='' WHERE id=?")
						->executeUncached($dc->activeRecord->id);
						
		return $field;
	}
	

}

?>
