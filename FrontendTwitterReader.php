<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  GPL 
 * @author     Stefan Lindecke 
 * @package    twitterreader 
 * @license    GPL 
 * @filesource
 */


/**
 * Class FrontendTwitterReader 
 *
 * @copyright  GPL 
 * @author     Stefan Lindecke 
 * @package    Controller
 */
class FrontendTwitterReader extends Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'twitterreader_standard';


	/**
	 * Generate module
	 */
	protected function compile()
	{
				
		if ($this->twittertemplate)
		{
			$this->Template = new FrontendTemplate($this->twittertemplate);
		}
				
		


		$sqlTwitter = $this->Database->prepare("SELECT * FROM tl_module WHERE id=?")
						->limit(1)
						->execute($this->id);
	
		$xmlFeed = $sqlTwitter->twitterFeedBackup;
							
		$UpdateRange = 61; // check only, if last check is longer than 1 minute old.
		$actualTime=time();
		
		if ((($actualTime-$sqlTwitter->twitterLastUpdate)>$UpdateRange) ||
			(!is_array($sqlTwitter->twitterFeedBackup)))
		{	
		
			$oauth = new TwitterOAuth(TWITTERREADER_CONSUMER_KEY, TWITTERREADER_CONSUMER_SECRET,
						$GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token'],
						$GLOBALS['TL_CONFIG']['twitterreader_credentials_oauth_token_secret']);

		
			$oauth->format = 'json';
			
			$arrFeed = array('include_entities'=>true,'count'=>$this->twittercount,'include_rts'=>true);
			
			if ($this->twitter_requesttype=='user_timeline')
			{
				$arrFeed['screen_name']=$this->twitterusers;
			}

			$objFeed  = $oauth->get('statuses/'.$this->twitter_requesttype,$arrFeed);
			
            
			if (is_array($objFeed))
			{
				$arrSet = array(
							'twitterLastUpdate'	=> time(),
							'twitterFeedBackup' => $objFeed
							);
								
								
				$objDBFeed = $this->Database->prepare("UPDATE tl_module %s WHERE id=?")
							->set($arrSet)
							->execute($this->id);
			}		
			else
			{
				$sqlTwitter = $this->Database->prepare("UPDATE tl_module SET twitterFeedBackup=NULL WHERE id=?")
						->executeUncached($this->id);
	
			}
		}
		
		if (!is_array($objFeed))
		{
			$this->log('JSON  dump for Twitter module not correct. Module ID "' . $this->id.'"', 'TwitterReader', TL_ERROR);
			
			return;
		}
		
		
		foreach ($objFeed as $item)
		{
			$textOutput = $item->text;
			$showItem = true;

			
			if (($this->twitterEnableHTTPLinks) && ($item->entities->urls))
			{
				
				//print_a($item);	
				foreach ($item->entities->urls as $url)
				{
					$textOutput = str_replace($url->url,
										sprintf('<a title="%s" href="%s" %s>%s</a>',
												$url->url,
												$url->url,
												LINK_NEW_WINDOW_BLUR,
												$url->url),
									$textOutput);            
				}
			}

			 
			if (($this->twitterEnableUserProfileLink) && ($item->entities->user_mentions))
			{
				//	print_a($item);
				
				foreach ($item->entities->user_mentions as $mention)
				{
					$textOutput = str_replace('@'.$mention->screen_name,
										sprintf('<a title="%s" href="http://www.twitter.com/%s" %s>@%s</a>',
												$mention->name,
												$mention->screen_name,
												LINK_NEW_WINDOW_BLUR,
												$mention->screen_name),
									$textOutput);            
				}
			}  
			
			if (($this->twitterEnableHashtagLink) && ($item->entities->hashtags))
			{
				foreach ($item->entities->hashtags as $hashtag)
				{
					$textOutput = str_replace('#'.$hashtag->text,
										sprintf('<a title="%s" href="http://www.twitter.com/#!/search?q=%s" %s>#%s</a>',
												$hashtag->text,
												$hashtag->text,
												LINK_NEW_WINDOW_BLUR,
												$hashtag->text),
									$textOutput);            
				}
			}  
			
			$item->text = $textOutput;
				
			$item->First = '';
			$item->Last = '';
			$item->EvenOdd = ($counter % 2) ? 'odd' : 'even';
			
			
				
			$counter++;
			
			
			if ($showItem)
			{
				$arrItems[] = $item;
			}
			
			if (count($arrItems)>$this->twittercount)
			{
				break;
			}
		
		
		}
		
		if (count($arrItems)>2)
		{
			$arrItems[0]->First = 'first';
			$arrItems[count($arrItems)-1]->Last = 'last';
		}
	
			
		$this->Template->TwitterData=$arrItems;
		$this->Template->TwitterCount=$this->twittercount;
			
	
		
	}
	
}

?>
