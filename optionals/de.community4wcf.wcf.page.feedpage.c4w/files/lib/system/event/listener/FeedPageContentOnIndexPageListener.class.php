<?php
//wcf imports
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

/**
 * Add FeedPage Content on Index
 * 
 * @svn			$Id: FeedPageContentOnIndexPageListener.class.php 1708 2011-02-02 15:09:57Z TobiasH87 $
 * @package		de.community4wcf.wcf.page.feedpage.c4w
 */
class FeedPageContentOnIndexPageListener implements EventListener {
	/**
	 * @see EventListener::execute
	 */
	public function execute($eventObj, $className, $eventName){
		//check permissions and if not can see or module deactivated
		if (!WCF::getUser()->getPermission('user.managepages.canViewFeedPage') || !FEEDPAGE_C4W_ENABLE_INDEX || !MODULE_FEEDPAGE) return;
		
		// Loads cache resources
		WCF::getCache()->addResource('feedpageFeeds', WCF_DIR.'cache/cache.feedpageFeeds.php', WCF_DIR.'lib/system/cache/CacheBuilderFeedPage.class.php');
		// get feedpageFeeds from cache
		$this->feedpageFeeds = WCF::getCache()->get('feedpageFeeds');
		
		if(count($this->feedpageFeeds)) {
			foreach ($this->feedpageFeeds as &$feeds) {
				$feeds['description']  = self::getFormattedMessage($feeds['description']);
			}
		}
		
		WCF::getTPL()->assign(array('feedpageFeeds' => $this->feedpageFeeds));
		
		//requirements for FeedPage Content
		WCF::getTPL()->append(array('additionalContents' => WCF::getTPL()->fetch('feedpageContent')));
		
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
}
?>