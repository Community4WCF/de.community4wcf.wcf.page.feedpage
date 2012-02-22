<?php
//wcf imports
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

/**
 * Add FeedPage Link in Header
 * 
 * @svn			$Id: FeedPageLinkOnIndexPageListener.class.php 1708 2011-02-02 15:09:57Z TobiasH87 $
 * @package		de.community4wcf.wcf.page.feedpage.c4w
 */
class FeedPageLinkOnIndexPageListener implements EventListener {
	/**
	 * @see EventListener::execute
	 */
	public function execute($eventObj, $className, $eventName){
		//check permissions and if not can see or module deactivated
		if (!WCF::getUser()->getPermission('user.managepages.canViewFeedPage') || !MODULE_FEEDPAGE) return;
		
		//requirements for Feed
		WCF::getTPL()->append(array('additionalHead' => WCF::getTPL()->fetch('feedpageLink')));
	}
}
?>