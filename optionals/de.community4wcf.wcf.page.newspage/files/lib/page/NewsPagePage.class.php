<?php
// wcf imports
require_once(WCF_DIR.'lib/page/AbstractPage.class.php');
require_once(WCF_DIR.'lib/data/message/bbcode/MessageParser.class.php');

/**
 * Show the NewsPage.
 * 
 * @svn			$Id: NewsPagePage.class.php 1084 2010-03-17 13:33:03Z TobiasH87 $
 * @copyright	2010 Community4WCF <http://www.community4wcf.de>
 * @package		de.community4wcf.wcf.page.newspage
 */

class NewsPagePage extends AbstractPage {
	/**
	 * list of feedpageFeeds
	 * 
	 * @var	array<integer>
	 */
	public $feedpageFeeds = array();
		
	/**
	 * Read FeedPage cache.
	 * 
	 * @param 	array		$feedpageFeeds
	 */
	public function readParameters() {
		parent::readParameters();
		// Loads cache resources
		WCF::getCache()->addResource('feedpageFeeds', WCF_DIR.'cache/cache.feedpageFeeds.php', WCF_DIR.'lib/system/cache/CacheBuilderFeedPage.class.php');
		// get feedpageFeeds from cache
		$this->feedpageFeeds = WCF::getCache()->get('feedpageFeeds');
		
		if(count($this->feedpageFeeds)) {
		foreach ($this->feedpageFeeds as &$feeds) {
			$feeds['description']  = self::getFormattedMessage($feeds['description']);
			}
		}
	}

	/**
	 * @see Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'feedpageFeeds' => $this->feedpageFeeds
		));
	}
	
	/**
	 * @see Page::getFormattedMessage($message)
	 */
	public function getFormattedMessage($message) {
		// parse message
		$enableSmilies = 1;
		$enableHtml = 0;
		$enableBBCodes = 1;
		
		$parser = MessageParser::getInstance();
		$parser->setOutputType('text/html');
		return $parser->parse($message, $enableSmilies, $enableHtml, $enableBBCodes);
	}
	
	/**
	 * @see Page::show()
	 */
	public function show() {
		// set active menu item
		require_once(WCF_DIR.'lib/page/util/menu/PageMenu.class.php');
		PageMenu::setActiveMenuItem('wcf.header.menu.newspage');
		
		// check permission
		WCF::getUser()->checkPermission('user.managepages.canViewNewsPage');
		
		// check module options
		if (MODULE_FEEDPAGE != 1) {
			throw new IllegalLinkException();
		}
		
		// show page
		parent::show();
		
		// send content
		WCF::getTPL()->display('newspageFeed');

	}
}
?>