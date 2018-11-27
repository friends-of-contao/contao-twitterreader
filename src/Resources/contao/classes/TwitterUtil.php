<?php

/*
 * @copyright  2013 Stefan Lindecke <lindesbs@googlemail.com>, Helmut Schottmüller 2018 <http://github.com/hschottm>
 * @author     Stefan Lindecke, Helmut Schottmüller (hschottm)
 * @package    contao-twitterreader
 * @license    http://gplv3.fsf.org/ GPLv3
 * @see	      https://github.com/friends-of-contao/contao-twitterreader
 */

namespace FOC\TwitterReaderBundle;

class TwitterUtil
{
    public static function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public static function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), \strlen($data) % 4, '=', STR_PAD_RIGHT), true);
    }

    public static function TwitterReaderConsumerKey()
    {
        return self::base64url_decode('Q1cyTlVSWGJoaWhvd3JDQUhTVUJVSlk3RA');
    }

    public static function TwitterReaderConsumerSecret()
    {
        return self::base64url_decode('N0xZaURnWTVzcFhsclZLVlJmMFZNdFhBOTFNMVU0WFN3YUxrS3hCOTk1eVRqNmxlODA');
    }
}
