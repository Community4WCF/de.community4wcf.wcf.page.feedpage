<?php
// wcf imports
require_once(WCF_DIR.'lib/page/AbstractFeedPage.class.php');
require_once(WCF_DIR.'lib/data/message/bbcode/MessageParser.class.php');

/**
 * Show the FeedPage.
 * 
 * @svn			$Id: FeedPagePage.class.php 1085 2010-03-17 13:39:20Z TobiasH87 $
 * @copyright	2010 Community4WCF <http://www.community4wcf.de>
 * @package		de.community4wcf.wcf.page.feedpage
 */

class FeedPagePage extends AbstractFeedPage {
	/**
	 * list of feedpageFeeds
	 * 
	 * @var	array<integer>
	 */
	public $feedpageFeeds = array();
		
	/**
	 * @see Page::readData()
	 */
	public function readData() {
		parent::readData();
		// get feedpageFeeds
			$sql = "SELECT 	*
					FROM 	wcf".WCF_N."_feedpage
					WHERE 	pubDate > ".($this->hours ? (TIME_NOW - $this->hours * 3600) : (TIME_NOW - 30 * 86400))."
					AND		disabled = 0
					ORDER 	BY feedID DESC";
			$result = WCF::getDB()->sendQuery($sql);
			while ($row = WCF::getDB()->fetchArray($result)) {
			$this->feedpageFeeds[] = $row;
			}
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
		// check permission
		WCF::getUser()->checkPermission('user.managepages.canViewFeedPage');
		
		// check module options
		if (!MODULE_FEEDPAGE) {
			throw new IllegalLinkException();
		}
		
		// show page
		parent::show();
		
		// send content
		WCF::getTPL()->display(($this->format == 'atom' ? 'feedpageAtom' : 'feedpageRSS2'), false);
	}
}
?>