<?php
// wcf imports
require_once(WCF_DIR.'lib/data/feedpage/FeedPage.class.php');

/**
 * Provides functions to edit FeedPage.
 * 
 * @svn			$Id: FeedPageEditor.class.php 1017 2010-03-06 15:19:04Z TobiasH87 $
 * @copyright	2010 Community4WCF <http://www.community4wcf.de>
 * @package		de.community4wcf.wcf.page.feedpage
 */

class FeedPageEditor extends FeedPage {
	
	/**
	 * Resets the feedpage cache after changes.
	 */
	public static function resetCache() {
		// reset feedpage cache		
		WCF::getCache()->clear(WCF_DIR . 'cache', 'cache.feedpageFeeds.php', true);
	}
	
	/**
	 * Creates a new FeedPage item.
	 * 
	 * @return	FeedPageEditor
	 */
	 public static function create($title, $author, $link, $pubDate, $description) {
		 // save data
		 $feedID = self::insert($title, $author, $link, $pubDate, $description);
		 
		 // get feed
		$feed = new FeedPageEditor($feedID);
		
		// return new feed
		return $feed;
	 }
	 
	 /**
	 * Creates the FeedPage item row in database table.
	 *
	 * @param 	string		$title
	 * @param 	string		$author
	 * @param 	string		$link
	 * @param 	intval		$pubDate
	 * @param 	string		$description
	 * @param	integer		$feedID
	 *
	 * @return	FeedPageEditor
	 */
	public static function insert($title, $author, $link, $pubDate, $description) { 
		$sql = "INSERT INTO	wcf".WCF_N."_feedpage
					(title, author, link, pubDate, description)
			VALUES	(	
				'".escapeString($title)."',
				'".escapeString($author)."',
				'".escapeString($link)."',
				'".$pubDate."',
				'".escapeString($description)."'
				)";
		WCF::getDB()->sendQuery($sql);
		return WCF::getDB()->getInsertID();
	}
	
	/**
	 * Updates the data of a FeedPage item.
	 */
	public function update($title = null, $author = null, $link = null, $description = null) {
		$fields = array();
		if ($title !== null) $fields['title'] = $title;
		if ($author !== null) $fields['author'] = $author;
		if ($link !== null) $fields['link'] = $link;
		if ($description !== null) $fields['description'] = $description;
		
		$this->updateData($fields);
	}
	
	/**
	 * Updates the data of a FeedPage item.
	 *
	 * @param 	array		$fields
	 */
	public function updateData($fields = array()) { 
		$updates = '';
		foreach ($fields as $key => $value) {
			if (!empty($updates)) $updates .= ',';
			$updates .= $key.'=';
			if (is_int($value)) $updates .= $value;
			else $updates .= "'".escapeString($value)."'";
		}
		
		if (!empty($updates)) {
			$sql = "UPDATE	wcf".WCF_N."_feedpage
				SET	".$updates."
				WHERE	feedID = ".$this->feedID;
			WCF::getDB()->sendQuery($sql);
		}
	}
	
	/**
	 * Enables this FeedPage item.
	 */
	public function enable() {
		$sql = "UPDATE	wcf".WCF_N."_feedpage
			SET	disabled = 0			
			WHERE	feedID = ".$this->feedID;
		WCF::getDB()->sendQuery($sql);
		
		// reset cache
		self::resetCache();
	}
	
	/**
	 * Disables this FeedPage item.
	 */
	public function disable() {
		$sql = "UPDATE	wcf".WCF_N."_feedpage
			SET	disabled = 1			
			WHERE	feedID = ".$this->feedID;
		WCF::getDB()->sendQuery($sql);
		
		// reset cache
		self::resetCache();
	}
	
	/**
	 * Deletes this FeedPage item.
	 */
	public function delete() {
		// delete FeedPage item
		$sql = "DELETE FROM wcf".WCF_N."_feedpage
			WHERE		feedID = ".$this->feedID;
		WCF::getDB()->sendQuery($sql);
		
		// reset cache
		self::resetCache();
	}
}
?>