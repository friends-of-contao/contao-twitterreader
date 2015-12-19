
CREATE TABLE `tl_module` (
  `twitter_requesttype` varchar(255) NOT NULL default 'user_timeline',
  `twitterusers` varchar(255) NOT NULL default '',
  `twittercount` varchar(255) NOT NULL default '',

  `twittertemplate` varchar(255) NOT NULL default '',
  `twitterEnableUserProfileLink` varchar(1) NOT NULL default '',
  `twitterEnableHashtagLink` varchar(1) NOT NULL default '',
  `twitterEnableHTTPLinks` varchar(1) NOT NULL default '',
  `twitterEnableMediaLinks` varchar(1) NOT NULL default '',

  `twitterLastUpdate` int(10) unsigned NOT NULL default '0',
  `twitterFeedBackup` text NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



