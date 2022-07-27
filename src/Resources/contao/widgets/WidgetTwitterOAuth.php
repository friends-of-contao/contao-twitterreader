<?php

/*
 * @copyright  2013 Stefan Lindecke <lindesbs@googlemail.com>, Helmut Schottmüller 2018 <http://github.com/hschottm>
 * @author     Stefan Lindecke, Helmut Schottmüller (hschottm)
 * @package    contao-twitterreader
 * @license    http://gplv3.fsf.org/ GPLv3
 * @see	      https://github.com/friends-of-contao/contao-twitterreader
 */

namespace FOC\TwitterReaderBundle;

use Abraham\TwitterOAuth\TwitterOAuth;

 /**
  * Class WidgetTwitterOAuth.
  *
  * @copyright   GPL
  * @author      Stefan Lindecke
  */
class WidgetTwitterOAuth extends \Widget
{
    /**
     * Submit user input.
     *
     * @var bool
     */
    protected $blnSubmitInput = true;

    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate = 'be_widget';

    /**
     * Contents.
     *
     * @var array
     */
    protected $arrContents = [];

    /**
     * Ajax id.
     *
     * @var string
     */
    protected $strAjaxId;

    /**
     * Ajax key.
     *
     * @var string
     */
    protected $strAjaxKey;

    /**
     * Ajax name.
     *
     * @var string
     */
    protected $strAjaxName;

    /**
     * Add specific attributes.
     *
     * @param string
     * @param mixed
     * @param mixed $strKey
     * @param mixed $varValue
     */
    public function __set($strKey, $varValue)
    {
        switch ($strKey) {
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
     * Generate the widget and return it as string.
     *
     * @return string
     */
    public function generate()
    {
        if (!\function_exists('curl_init')) {
            return $GLOBALS['TL_LANG']['tl_settings']['twitterreader_curl_missing'];
        }

        if ('TwitterReaderOAuthCheck' === \Input::get('action')) {
            $this->requestTwitterOAuth();
        } elseif ('TwitterReaderOAuthRevoke' === \Input::get('action')) {
            $this->revokeTwitterOAuth();
        }
        if (strlen(\Input::get('oauth_verifier'))) {
            $this->verifyTwitterOAuth();
        }

        $oauth_token = "";
        $oauth_secret = "";

        if (array_key_exists('twitterreader_credentials_oauth_token', $GLOBALS['TL_CONFIG'])) {
            $oauth_token = $GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token'];
        }
        if (array_key_exists('twitterreader_credentials_oauth_token_secret', $GLOBALS['TL_CONFIG'])) {
            $oauth_secret = $GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token_secret'];
        }

        $sWizard = '';
        if (strlen($oauth_token)) {
            $connection = new TwitterOAuth(TwitterUtil::TwitterReaderConsumerKey(), TwitterUtil::TwitterReaderConsumerSecret(),
        $oauth_token,
        $oauth_secret);
            $objAuth = $connection->get('account/verify_credentials');
            if ($objAuth == null) {
                $sWizard .= $objAuth->error.'<br>';
            } else {
                $sWizard .= '<p>'.$GLOBALS['TL_LANG']['tl_settings']['twitterreader_authenticated_as'].':</p>';
                $sWizard .= '<div><img src="'.$objAuth->profile_image_url.'"><div>';
                $sWizard .= '<div>'.$objAuth->screen_name.'</div>';
                $sWizard .= '<div style="margin-top: 1rem;"><a class="tl_submit" href="'.\Environment::get('request').'&action=TwitterReaderOAuthRevoke">'.$GLOBALS['TL_LANG']['tl_settings']['twitterreader_auth_revoke_auth'].'</a></div>';
            }
        } else {
            $sWizard = '<div style="margin-top: 1rem;"><a class="tl_submit" href="'.\Environment::get('request').'&action=TwitterReaderOAuthCheck">'.$GLOBALS['TL_LANG']['tl_settings']['twitterreader_auth_renew_auth'].'</a></div>';
        }

        return $sWizard;
    }

    /**
     * Trim values.
     *
     * @param mixed
     * @param mixed $varInput
     *
     * @return mixed
     */
    protected function validator($varInput)
    {
        if (\is_array($varInput)) {
            return parent::validator($varInput);
        }

        return parent::validator(trim($varInput));
    }

    protected function revokeTwitterOAuth()
    {
        $this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token']", '');
        $this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token_secret']", '');
        $this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_credentials_user_id']", '');
        $this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_credentials_screen_name']", '');

        $connection = new TwitterOAuth(TwitterUtil::TwitterReaderConsumerKey(), TwitterUtil::TwitterReaderConsumerSecret());
        $result = $connection->oauth2('oauth/invalidate_token', ['access_token' => $GLOBALS['TL_CONFIG']['twitterreader_oauth_token'], 'access_token_secret' => $GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token_secret']]);

        $urlRequest = preg_replace('/&action=TwitterReaderOAuthRevoke/i', '', \Environment::get('request'));
        $this->redirect($urlRequest);
    }

    protected function requestTwitterOAuth()
    {
        $connection = new TwitterOAuth(TwitterUtil::TwitterReaderConsumerKey(), TwitterUtil::TwitterReaderConsumerSecret());
        $urlRequest = preg_replace('/&action=TwitterReaderOAuthCheck/i', '', \Environment::get('request'));

        $request_token = $connection->oauth('oauth/request_token', ['oauth_callback' => 'https://opensource.nasbrill-soft.de/contao-twitterreader-redirect.php?redirectUrl='.TwitterUtil::base64url_encode(\Environment::get('base').$urlRequest)]);

        $this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_oauth_token']", $request_token['oauth_token']);
        $this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_oauth_token_secret']", $request_token['oauth_token_secret']);

        if (200 === $connection->getLastHttpCode()) {
            $url = $connection->url('oauth/authorize', ['oauth_token' => $request_token['oauth_token']]);
            $this->redirect($url);
        } else {
            die('Something wrong happened.');
        }
    }

    protected function verifyTwitterOAuth()
    {
        $connection = new TwitterOAuth(TwitterUtil::TwitterReaderConsumerKey(), TwitterUtil::TwitterReaderConsumerSecret(),
        $GLOBALS['TL_CONFIG']['twitterreader_oauth_token'],
        $GLOBALS['TL_CONFIG']['twitterreader_oauth_token_secret']);

        $arrAccessToken = $connection->oauth("oauth/access_token", ["oauth_verifier" => \Input::get('oauth_verifier')]);

        $this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token']", $arrAccessToken['oauth_token']);
        $this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token_secret']", $arrAccessToken['oauth_token_secret']);
        $this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_credentials_user_id']", $arrAccessToken['user_id']);
        $this->Config->update("\$GLOBALS['TL_CONFIG']['twitterreader_credentials_screen_name']", $arrAccessToken['screen_name']);

        $urlRequest = preg_replace('/(&(amp;)?|\?)oauth_verifier=[^& ]*/i', '', \Environment::get('request'));
        $urlRequest = preg_replace('/(&(amp;)?|\?)oauth_token=[^& ]*/i', '', $urlRequest);

        $this->redirect($urlRequest);
    }
}
