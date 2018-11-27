<?php

/*
 * @copyright  2013 Stefan Lindecke <lindesbs@googlemail.com>, Helmut Schottmüller 2018 <http://github.com/hschottm>
 * @author     Stefan Lindecke, Helmut Schottmüller (hschottm)
 * @package    contao-twitterreader
 * @license    http://gplv3.fsf.org/ GPLv3
 * @see	      https://github.com/friends-of-contao/contao-twitterreader
 */

namespace FOC\TwitterReaderBundle;

class RunonceJob extends \Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->import('Database');
    }

    public function run()
    {
        \System::log('Purging twitterFeedBackup from tl_module table', __METHOD__, TL_GENERAL);
        \Database::getInstance()->query("UPDATE tl_module SET twitterFeedBackup=''");
    }
}

$objRunonceJob = new RunonceJob();
$objRunonceJob->run();
