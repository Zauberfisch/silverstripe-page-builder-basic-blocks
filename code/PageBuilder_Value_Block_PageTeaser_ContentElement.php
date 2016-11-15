<?php


/**
 * Class PageBuilder_Value_Block_PageTeaser_ContentElement
 *
 * @property int $PageID
 * @method Page Page()
 */
class PageBuilder_Value_Block_PageTeaser_ContentElement extends PageBuilder_ContentElement {
	private static $has_one = [
		'Page' => 'Page',
	];

	public function getPageBuilderPopupFields() {
		$return = parent::getPageBuilderPopupFields();
		$return->push(new TreeDropdownField('PageID', '', 'Page'));
		return $return;
	}

	public function getTitle() {
		$p = $this->Page();
		return $p && $p->exists() ? $p->getTitle() : parent::getTitle();
	}
	
	public function PageBuilderPreview() {
		$p = $this->Page();
		return $p && $p->exists() ? $p->getBreadcrumbs() : $this->getTitle();
	}
	
	
}
