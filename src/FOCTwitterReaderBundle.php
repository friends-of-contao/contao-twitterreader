<?php

declare(strict_types=1);

/*
 * @copyright  2013 Stefan Lindecke <lindesbs@googlemail.com>, Helmut Schottmüller 2018 <http://github.com/hschottm>
 * @author     Stefan Lindecke, Helmut Schottmüller (hschottm)
 * @package    contao-twitterreader
 * @license    http://gplv3.fsf.org/ GPLv3
 * @see	      https://github.com/friends-of-contao/contao-twitterreader
 */

namespace FOC\TwitterReaderBundle;

use FOC\TwitterReaderBundle\DependencyInjection\TwitterReaderExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FOCTwitterReaderBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new TwitterReaderExtension();
    }
}
