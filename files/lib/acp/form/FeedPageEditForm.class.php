<?php
// wcf imports
require_once(WCF_DIR.'lib/acp/form/FeedPageAddForm.class.php');

/**
 * Edit a feed from FeedPage.
 * 
 * @svn			$Id: FeedPageEditForm.class.php 1085 2010-03-17 13:39:20Z TobiasH87 $
 * @copyright	2010 Community4WCF <http://www.community4wcf.de>
 * @package		de.community4wcf.wcf.page.feedpage
 */

class FeedPageEditForm extends FeedPageAddForm {
	// system
	public $neededPermissions = 'admin.content.feedpage.feedpageedit';
	
	/**
	 * feed id
	 * 
	 * @var	integer
	 */
	public $feedID = 0;
	
	/**
	 * @see Page::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();
		
		// get feed id
		if (isset($_REQUEST['feedID'])) $this->feedID = intval($_REQUEST['feedID']);
		
		// get feed
		$this->feed = new FeedPageEditor($this->feedID);
	}
	
	/**
	 * @see Page::readData()
	 */
	public function readData() {
		parent::readData();
		
		if (!count($_POST)) {
			// get values
			$this->title = $this->feed->title;
			$this->author = $this->feed->author;
			$this->link = $this->feed->link;
			$this->description = $this->feed->description;
		}
	}
	
	/**
	 * @see Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'feedID' => $this->feedID,
			'feed' => $this->feed,
			'action' => 'edit'
		));
	}
	
	/**
	 * @see Form::save()
	 */
	public function save() {
		AbstractForm::save();
		
		// save
		if (WCF::getUser()->getPermission('admin.content.feedpage.feedpageedit')) {
			$this->feed->update($this->title, $this->author, $this->link, $this->description);	
		}
		
		// reset cache
		FeedPageEditor::resetCache();
		$this->saved();
		
		// show success message
		WCF::getTPL()->assign('success', true);
	}
	
	/**
	 * @see Page::show()
	 */			
	public function show() {		
		// check module options
		if (!MODULE_FEEDPAGE) {
			throw new IllegalLinkException();
		}
		
		// show page
		parent::show();
	}
}
?>