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
 * Class RunonceJob
 *
 * @copyright  Stefan Lindecke <lindesbs@googlemail.com>
 * @author     Stefan Lindecke
 * @package    twitterreader
 * @license    http://gplv3.fsf.org/ GPL
 */
 
class RunonceJob extends Controller
{
	public function __construct()
	{
	    parent::__construct();
	    $this->import('Database');
	}

	public function run()
	{
	  \Database::getInstance()->query("UPDATE tl_module SET twitterFeedBackup=''");
	}
}


 
$objRunonceJob = new RunonceJob();
$objRunonceJob->run(); 
