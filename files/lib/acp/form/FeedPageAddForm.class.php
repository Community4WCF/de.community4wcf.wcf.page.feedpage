<?php
// wcf imports
require_once(WCF_DIR.'lib/acp/form/ACPForm.class.php');
require_once(WCF_DIR.'lib/data/feedpage/FeedPageEditor.class.php');

/**
 * Add a feed to FeedPage.
 * 
 * @svn			$Id: FeedPageAddForm.class.php 1714 2011-02-02 18:52:02Z TobiasH87 $
 * @copyright	2010 Community4WCF <http://www.community4wcf.de>
 * @package		de.community4wcf.wcf.page.feedpage
 */
 
class FeedPageAddForm extends ACPForm {
	// system
	public $templateName = 'feedpageAdd';
	public $activeMenuItem = 'wcf.acp.menu.link.content.feedpage.add';
	public $neededPermissions = 'admin.content.feedpage.feedpageadd';

	/**
	 * feed editor object
	 * 
	 * @var	FeedPageEditor
	 */
	public $feed;
	
	// parameters
	public $feedID = 0;
	public $title = '';
	public $author = '';
	public $link = 'http://';
	public $pubDate = '';
	public $description = '';
	
	/**
	 * @see Form::readFormParameters()
	 */
	public function readFormParameters() {
		parent::readFormParameters();
		
		if (isset($_REQUEST['title'])) $this->title = StringUtil::trim($_REQUEST['title']);
		if (isset($_REQUEST['author'])) $this->author = StringUtil::trim($_REQUEST['author']);
		if (isset($_REQUEST['link'])) $this->link = StringUtil::trim($_REQUEST['link']);
		# use guid as link
		if (isset($_REQUEST['pubDate'])) $this->pubDate = intval($_REQUEST['pubDate']);
		if (isset($_REQUEST['description'])) $this->description = StringUtil::trim($_REQUEST['description']);
	}
	
	/**
	 * @see Form::validate()
	 */
	public function validate() {
		parent::validate();
		
		// title
		if (empty($this->title)) {
			throw new UserInputException('title');
		}
		
		// author
		if (empty($this->author)) {
			throw new UserInputException('author');
		}
		
		// link
		if (empty($this->link) && !FEEDPAGE_STANDARDLINK_ENABLE) {
			throw new UserInputException('link');
		}

		# use guid as link
		
		// description
		if (!$this->description) {
			throw new UserInputException('description');
		}
	}
	
	/**
	 * @see Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'action' => 'add',
			'title' => $this->title,
			'author' => $this->author,
			'link' => $this->link,
			'description' => $this->description,
		));
	}
	
	/**
	 * @see Form::save()
	 */
	public function save() {
		parent::save();
		
		// save
		if (WCF::getUser()->getPermission('admin.content.feedpage.feedpageadd')) {
			$this->feed = FeedPageEditor::create($this->title, $this->author, $this->link, TIME_NOW, $this->description);	
		}
		
		// reset values
		$this->title = $this->author = $this->link = $this->description = '';
		
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