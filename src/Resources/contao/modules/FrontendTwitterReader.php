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
  * Class FrontendTwitterReader.
  *
  * @copyright   GPL
  * @author      Stefan Lindecke
  */
class FrontendTwitterReader extends \Module
{
    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate = 'twitterreader_standard';

    public function generate()
    {
        if (TL_MODE === 'BE') {
            $objTemplate = new BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### TWITTER READER ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = $this->Environment->script.'?do=themes&amp;table=tl_module&amp;act=edit&amp;id='.$this->id;

            return $objTemplate->parse();
        }

        if ($this->twittertemplate) {
            $this->strTemplate = $this->twittertemplate;
        }

        return parent::generate();
    }

    /**
     * Generate module.
     */
    protected function compile()
    {
        $moduleModel = \Contao\ModuleModel::findById($this->id);
        if (null !== $moduleModel) {
            $objFeedBackup = $moduleModel->twitterFeedBackup;
            $objFeed = json_decode($objFeedBackup);
        }
        $UpdateRange = 10;
        // check only, if last check is longer than 1 minute old.
        $actualTime = time();

        if ((($actualTime - $moduleModel->twitterLastUpdate) > $UpdateRange) || (!\is_array($objFeed))) {
            $oauth = new TwitterOAuth(TwitterUtil::TwitterReaderConsumerKey(), TwitterUtil::TwitterReaderConsumerSecret(), $GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token'], $GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token_secret']);
            $arrFeed = [
        'include_entities' => true,
        'count' => $this->twittercount,
        'include_rts' => true,
      ];

            if ('user_timeline' === $this->twitter_requesttype) {
                $arrFeed['screen_name'] = $this->twitterusers;
            }
            $objFeed = $oauth->get('statuses/'.$this->twitter_requesttype, $arrFeed);

            if (\count($objFeed->errors) > 0) {
                \System::log($objFeed->errors[0]->message, __METHOD__, TL_ERROR);
            } else {
                if (\is_array($objFeed)) {
                    $arrSet = [
            'twitterLastUpdate' => time(),
            'twitterFeedBackup' => json_encode($objFeed),
          ];
                    $moduleModel->twitterLastUpdate = time();
                    $moduleModel->twitterFeedBackup = json_encode($objFeed);
                    $moduleModel->save();
                } else {
                    $moduleModel->twitterFeedBackup = null;
                    $moduleModel->save();
                }
            }
        }

        if (!\is_array($objFeed)) {
            \System::log('JSON dump for Twitter module not correct. Module ID "'.$this->id.'"', __METHOD__, TL_ERROR);

            return;
        }

        foreach ($objFeed as $item) {
            $textOutput = $item->text;
            $showItem = true;

            if ($this->twitterEnableHTTPLinks && $item->entities->urls) {
                foreach ($item->entities->urls as $url) {
                    $textOutput = str_replace($url->url, sprintf('<a title="%s" href="%s" %s>%s</a>', $url->expanded_url, $url->expanded_url, LINK_NEW_WINDOW_BLUR, $url->url), $textOutput);
                }
            }

            if ($this->twitterEnableMediaLinks && $item->extended_entities->media) {
                foreach ($item->extended_entities->media as $media) {
                    $textOutput = str_replace($media->url, sprintf('<a title="%s" href="%s" %s>%s</a>', $media->expanded_url, $media->expanded_url, LINK_NEW_WINDOW_BLUR, $media->display_url), $textOutput);
                }
            }

            if ($this->twitterEnableUserProfileLink && $item->entities->user_mentions) {
                foreach ($item->entities->user_mentions as $mention) {
                    $textOutput = str_replace('@'.$mention->screen_name, sprintf('<a title="%s" href="https://www.twitter.com/%s" %s>@%s</a>', $mention->name, $mention->screen_name, LINK_NEW_WINDOW_BLUR, $mention->screen_name), $textOutput);
                }
            }

            if ($this->twitterEnableHashtagLink && $item->entities->hashtags) {
                foreach ($item->entities->hashtags as $hashtag) {
                    $textOutput = str_replace('#'.$hashtag->text, sprintf('<a title="%s" href="https://www.twitter.com/search?q=%s" %s>#%s</a>', $hashtag->text, $hashtag->text, LINK_NEW_WINDOW_BLUR, $hashtag->text), $textOutput);
                }
            }

            if ($this->twitterEnableMediaLinks && $this->twitterEmbedFirstMedia && $item->extended_entities->media) {
                // only embed the first media
                $media = $item->extended_entities->media[0];
                $size = deserialize($this->twitterEmbedFirstMediaSize, true);

                if ('photo' === $media->type) {
                    $textOutput .= '<img style="width: '.$size[0].$size[2].';height: '.$size[1].$size[2].';" src="'.$media->media_url_https.'" />';
                } elseif ('video' === $media->type) {
                    $video = $media->video_info->variants[5];
                    $textOutput .= '<iframe class="autosized-media" frameborder="0" allowfullscreen="" style="width: '.$size[0].$size[2].';height: '.$size[1].$size[2].';" src="https://amp.twimg.com/amplify-web-player/prod/source.html?video_url='.urlencode($video->url).'&amp;content_type='.urlencode($video->content_type).'&amp;image_src='.urlencode($media->media_url_https).'"></iframe>';
                }
            }

            $item->text = $textOutput;

            $item->First = '';
            $item->Last = '';
            $item->EvenOdd = ($counter % 2) ? 'odd' : 'even';

            ++$counter;

            if ($showItem) {
                $arrItems[] = $item;
            }

            if (\count($arrItems) > $this->twittercount) {
                break;
            }
        }

        if (\count($arrItems) > 2) {
            $arrItems[0]->First = 'first';
            $arrItems[\count($arrItems) - 1]->Last = 'last';
        }

        $this->Template->TwitterData = $arrItems;
        $this->Template->TwitterCount = $this->twittercount;
    }
}
