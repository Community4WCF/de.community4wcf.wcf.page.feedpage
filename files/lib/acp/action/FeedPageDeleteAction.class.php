<?php
// wcf imports
require_once(WCF_DIR.'lib/acp/action/AbstractFeedPageAction.class.php');

/**
 * Delete FeedPage Item.
 * 
 * @svn			$Id: FeedPageDeleteAction.class.php 1130 2010-04-04 20:48:45Z TobiasH87 $
 * @copyright	2010 Community4WCF <http://www.community4wcf.de>
 * @package		de.community4wcf.wcf.page.feedpage
 */
 
class FeedPageDeleteAction extends AbstractFeedPageAction {
	/**
	 * @see Action::execute()
	 */
	public function execute() {
		parent::execute();
				
		// check permission
		WCF::getUser()->checkPermission('admin.content.feedpage.feedpagedelete');
		
		// enable feed
		$this->feed->delete();
		$this->executed();
	}
	
	/**
	 * @see AbstractAction::executed()
	 */
	protected function executed() {
		AbstractAction::executed();
		
		// forward to list page
		HeaderUtil::redirect('index.php?page=FeedPageList&deletedfeedID='.$this->feedID.'&packageID='.PACKAGE_ID.SID_ARG_2ND_NOT_ENCODED);
		exit;
	}
}
?>