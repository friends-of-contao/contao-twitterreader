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

/**
 * Class WidgetTwitterOAuth
 *
 * @copyright   GPL
 * @author      Stefan Lindecke
 * @package     Widget
 */
class WidgetTwitterOAuth extends Widget
{

	/**
	 * Submit user input
	 * @var boolean
	 */
	protected $blnSubmitInput = true;

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'be_widget';

	/**
	 * Contents
	 * @var array
	 */
	protected $arrContents = array();
	
	/**
	 * Ajax id
	 * @var string
	 */
	protected $strAjaxId;

	/**
	 * Ajax key
	 * @var string
	 */
	protected $strAjaxKey;

	/**
	 * Ajax name
	 * @var string
	 */
	protected $strAjaxName;

	
	/**
	 * Add specific attributes
	 * @param string
	 * @param mixed
	 */
	public function __set($strKey, $varValue)
	{
		switch ($strKey)
		{
			case 'value':
				$this->varValue = deserialize($varValue);
				break;

			case 'maxlength':
				$this->arrAttributes[$strKey] = ($varValue > 0) ? $varValue : '';
				break;

			case 'mandatory':
				$this->arrConfiguration['mandatory'] = $varValue ? true : false;
				break;

			case 'readonly':
				$this->arrAttributes['readonly'] = 'readonly';
				$this->blnSubmitInput = false;
				break;

			default:
				parent::__set($strKey, $varValue);
				break;
		}
	}


	/**
	 * Trim values
	 * @param mixed
	 * @return mixed
	 */
	protected function validator($varInput)
	{
		if (is_array($varInput))
		{
			return parent::validator($varInput);
		}

		return parent::validator(trim($varInput));
	}


	/**
	 * Generate the widget and return it as string
	 * @return string
	 */
	public function generate()
	{
		if (!function_exists('curl_init'))
		{
			return $GLOBALS['TL_LANG']['tl_settings']['twitterreader_curl_missing'];
		}
	
		if ($this->Input->get('action') == 'TwitterReaderOAuthCheck')
		{
			$this->requestTwitterOAuth();
			
		}

		if ($this->Input->get('oauth_verifier'))
		{
			$this->verifyTwitterOAuth();
			
		}

		
		$sWizard = '
				<a href="'.$this->Environment->request.'&action=TwitterReaderOAuthCheck" class="tl_link_button" onclick="Backend.getScrollOffset(); %s">'.$GLOBALS['TL_LANG']['tl_settings']['twitterreader_auth_renew_auth'].'</a>
				<br>';
		
		$sWizard .= $this->displayTwitterOAuth();
							
		return $sWizard;
	
	
		
	}
	
	protected function displayTwitterOAuth()
	{
		require_once('TwitterOAuth.php');

			$oauthRequest = new TwitterOAuth(TWITTERREADER_CONSUMER_KEY, TWITTERREADER_CONSUMER_SECRET,
						$GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token'],
						$GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token_secret']);
		
			$oauthRequest->format = 'json';
			$objAuth  = $oauthRequest->get('account/verify_credentials');
		
			if ($objAuth->error)
			{
				$strReturn =	$objAuth->error.'<br>';
			}
			else
			{
				$strReturn =	'<img src="'.$objAuth->profile_image_url.'"><br>';
				$strReturn .=	$objAuth->screen_name.'<br>';
			}
			
		return $strReturn;
	}
	
	
	protected function requestTwitterOAuth()
	{
		require_once('TwitterOAuth.php');

		$oauth = new TwitterOAuth(TWITTERREADER_CONSUMER_KEY, TWITTERREADER_CONSUMER_SECRET);
		
		$urlRequest = preg_replace('/&action=TwitterReaderOAuthCheck/i', '', $this->Environment->request);
        
        
        
        
		$objRequest = $oauth->getRequestToken($this->Environment->base.$urlRequest);
        
		
		$this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_oauth_token']", $objRequest['oauth_token']);
		$this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_oauth_token_secret']", $objRequest['oauth_token_secret']);
		
		if($oauth->http_code==200)
		{
			$url = $oauth->getAuthorizeURL($objRequest['oauth_token']);
			$this->redirect($url);
		} 
		else 
		{		
			die('Something wrong happened.');
		}
	}
	
	protected function verifyTwitterOAuth()
	{
		require_once('TwitterOAuth.php');
		$oauth = new TwitterOAuth(TWITTERREADER_CONSUMER_KEY, TWITTERREADER_CONSUMER_SECRET,
						$GLOBALS['TL_CONFIG']['twitterreader_oauth_token'],
						$GLOBALS['TL_CONFIG']['twitterreader_oauth_token_secret']);
						
						
		$arrAccessToken = $oauth->getAccessToken($this->Input->get('oauth_verifier'));
		
		
		$this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token']",$arrAccessToken['oauth_token']);
		$this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token_secret']",$arrAccessToken['oauth_token_secret']);
		$this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_credentials_user_id']",$arrAccessToken['user_id']);
		$this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_credentials_screen_name']",$arrAccessToken['screen_name']);
		
		$urlRequest= preg_replace('/(&(amp;)?|\?)oauth_verifier=[^& ]*/i', '', $this->Environment->request);	
		$urlRequest= preg_replace('/(&(amp;)?|\?)oauth_token=[^& ]*/i', '', $urlRequest);
	
		$this->redirect($urlRequest);
	}
}
