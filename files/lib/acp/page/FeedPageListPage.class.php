<?php
// wcf imports
require_once(WCF_DIR.'lib/page/SortablePage.class.php');
require_once(WCF_DIR.'lib/data/feedpage/FeedPage.class.php');

/**
 * Shows a list of feeds from FeedPage.
 * 
 * @svn			$Id: FeedPageListPage.class.php 1085 2010-03-17 13:39:20Z TobiasH87 $
 * @copyright	2010 Community4WCF <http://www.community4wcf.de>
 * @package		de.community4wcf.wcf.page.feedpage
 */

class FeedPageListPage extends SortablePage {
	// system
	public $templateName = 'feedpageList';
	public $neededPermissions = 'admin.content.feedpage.feedpageshow';
	public $defaultSortField = 'feedID';
	public $defaultSortOrder = 'DESC';
	public $itemsPerPage = 30;
	public $deletedfeedID = 0;
	
	/**
	 * list of feedpageFeeds
	 * 
	 * @var	array
	 */
	public $feedpageFeeds = array();
	
	/**
	 * @see Page::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();
		
		if (isset($_REQUEST['deletedfeedID'])) $this->deletedfeedID = intval($_REQUEST['deletedfeedID']);
	}
	
	/**
	 * @see Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'feedpageFeeds' => $this->feedpageFeeds,
			'deletedfeedID' => $this->deletedfeedID
		));
	}
	
	/**
	 * @see SortablePage::validateSortField()
	 */
	public function validateSortField() {
		parent::validateSortField();
		
		switch ($this->sortField) {
			case 'feedID':
			case 'title':
			case 'author':
			case 'pubDate': break;
			default: $this->sortField = $this->defaultSortField;
		}
	}
	
	/**
	 * @see Page::show()
	 */
	public function show() {
		// set active acpmenu item
		WCFACP::getMenu()->setActiveMenuItem('wcf.acp.menu.link.content.feedpage.show');
		
		// check module options
		if (!MODULE_FEEDPAGE) {
			throw new IllegalLinkException();
		}
		
		parent::show();
	}
	
	/**
	 * @see Page::readData()
	 */
	public function readData() {
		parent::readData();
		
		$this->readFeedPage();
	}
	
	/**
	 * @see MultipleLinkPage::countItems()
	 */
	public function countItems() {
		parent::countItems();
		
		$sql = "SELECT	COUNT(*) AS count
			FROM	wcf".WCF_N."_feedpage";
		$row = WCF::getDB()->getFirstRow($sql);
		return $row['count'];
	}
	
	/**
	 * Gets a list of feeds.
	 */
	protected function readFeedPage() {
		if ($this->items) {
			$sql = "SELECT		*
					FROM		wcf".WCF_N."_feedpage
					ORDER BY	".$this->sortField." ".$this->sortOrder;
			$result = WCF::getDB()->sendQuery($sql, $this->itemsPerPage, ($this->pageNo - 1) * $this->itemsPerPage);
			while ($row = WCF::getDB()->fetchArray($result)) {
				$this->feedpageFeeds[] = $row;
			}
		}
	}
}
?>