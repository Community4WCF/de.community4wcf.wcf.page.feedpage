<?php
// wcf imports
require_once(WCF_DIR.'lib/action/AbstractAction.class.php');
require_once(WCF_DIR.'lib/data/feedpage/FeedPageEditor.class.php');

/**
 * FeedPage Action.
 * 
 * @svn			$Id: AbstractFeedPageAction.class.php 1016 2010-03-06 14:12:31Z TobiasH87 $
 * @copyright	2010 Community4WCF <http://www.community4wcf.de>
 * @package		de.community4wcf.wcf.page.feedpage
 */

class AbstractFeedPageAction extends AbstractAction {
	/**
	 * feed id
	 * 
	 * @var	integer
	 */
	public $feedID = 0;
	
	/**
	 * feed editor object
	 * 
	 * @var	FeedPageEditor
	 */
	public $feed = null;
	
	/**
	 * @see Action::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();
		
		if (isset($_REQUEST['feedID'])) $this->feedID = intval($_REQUEST['feedID']);
		$this->feed = new FeedPageEditor($this->feedID);	
		if (!$this->feed->feedID) {
			throw new IllegalLinkException();
		}
	}
	
	/**
	 * @see AbstractAction::executed()
	 */
	protected function executed() {
		parent::executed();
		
		// forward to list page
		HeaderUtil::redirect('index.php?page=FeedPageList&packageID='.PACKAGE_ID.SID_ARG_2ND_NOT_ENCODED);
		exit;
	}
}
?>