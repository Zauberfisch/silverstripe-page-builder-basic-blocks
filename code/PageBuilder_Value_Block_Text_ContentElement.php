<?php


/**
 * Class PageBuilder_Value_Block_Text_ContentElement
 *
 * @property string $Content
 */
class PageBuilder_Value_Block_Text_ContentElement extends PageBuilder_ContentElement {
	private static $db = [
		'Content' => 'HTMLText',
	];

	public function getPageBuilderPopupFields() {
		$return = parent::getPageBuilderPopupFields();
		$return->push(new HtmlEditorField('Content', $this->fieldLabel('Content')));
		return $return;
	}

	public function getTitle() {
		return $this->Content ? $this->obj('Content')->Summary() : parent::getTitle();
	}
}
