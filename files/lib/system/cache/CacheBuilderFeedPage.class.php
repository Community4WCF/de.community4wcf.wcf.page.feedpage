<?php
// wcf imports
require_once(WCF_DIR.'lib/system/cache/CacheBuilder.class.php');

/**
 * Caches the FeedPage.
 * 
 * @svn			$Id: CacheBuilderFeedPage.class.php 1706 2011-02-02 13:15:51Z TobiasH87 $
 * @copyright	2010 Community4WCF <http://www.community4wcf.de>
 * @package		de.community4wcf.wcf.page.feedpage
 */
 
class CacheBuilderFeedPage implements CacheBuilder {
	/**
	 * @see CacheBuilder::getData()
	 */
	public function getData($cacheResource) {
		$data = array();
		
		// get FeedPage
		$sql = "SELECT		*
				FROM		wcf".WCF_N."_feedpage
				WHERE		disabled = '0'
				ORDER 		BY feedID DESC
				LIMIT 0,".FEEDPAGE_ITEMS."";
			$result = WCF::getDB()->sendQuery($sql);
			while ($row = WCF::getDB()->fetchArray($result)) {
				$data[] = $row;
			}
		
		return $data;
	}
}
?>