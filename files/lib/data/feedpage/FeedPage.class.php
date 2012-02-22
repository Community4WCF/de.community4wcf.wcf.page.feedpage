<?php
// wcf imports
require_once(WCF_DIR.'lib/data/DatabaseObject.class.php');

/**
 * Represents the FeedPage.
 * 
 * @svn			$Id: FeedPage.class.php 1046 2010-03-07 13:58:37Z TobiasH87 $
 * @copyright	2010 Community4WCF <http://www.community4wcf.de>
 * @package		de.community4wcf.wcf.page.feedpage
 */
 
class FeedPage extends DatabaseObject {

	/**
	 * Creates a new FeedPage item.
	 *
	 * If id is set, the function reads the FeedPage data from database.
	 * Otherwise it uses the given resultset.
	 * 
	 * @param 	integer		$feedID		id of a FeedPage
	 * @param 	array		$row		resultset with FeedPage data form database
	 */
	public function __construct($feedID, $row = null) {
		if ($feedID !== null) {
			$sql = "SELECT		*
					FROM		wcf".WCF_N."_feedpage
					WHERE		feedID = ".$feedID;
			$row = WCF::getDB()->getFirstRow($sql);
		}
		
		parent::__construct($row);
	}
	
	/**
	 * Read FeedPage cache.
	 * 
	 * @param 	array		$feedpageFeeds
	 */
	 public function readCache() {
		// Loads cache resources
		WCF::getCache()->addResource('feedpageFeeds', WCF_DIR.'cache/cache.feedpageFeeds.php', WCF_DIR.'lib/system/cache/CacheBuilderFeedPage.class.php');
		// get feedpageFeeds from cache
		$feedpageFeeds = WCF::getCache()->get('feedpageFeeds'); 
		
		return $feedpageFeeds;
	 }
}
?>