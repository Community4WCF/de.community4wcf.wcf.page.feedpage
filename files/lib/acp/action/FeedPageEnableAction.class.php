<?php
// wcf imports
require_once(WCF_DIR.'lib/acp/action/AbstractFeedPageAction.class.php');

/**
 * Enable FeedPage Item.
 * 
 * @svn			$Id: FeedPageEnableAction.class.php 1016 2010-03-06 14:12:31Z TobiasH87 $
 * @copyright	2010 Community4WCF <http://www.community4wcf.de>
 * @package		de.community4wcf.wcf.page.feedpage
 */
 
class FeedPageEnableAction extends AbstractFeedPageAction {
	/**
	 * @see Action::execute()
	 */
	public function execute() {
		parent::execute();
				
		// check permission
		WCF::getUser()->checkPermission('admin.content.feedpage.feedpageedit');
		
		// enable feed
		$this->feed->enable();
		$this->executed();
	}
}
?>