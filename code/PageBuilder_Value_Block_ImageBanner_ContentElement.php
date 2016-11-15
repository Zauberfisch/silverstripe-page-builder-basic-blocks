<?php


/**
 * Class PageBuilder_Value_Block_ImageBanner_ContentElement
 *
 * @property string $Title
 * @property string $LinkMode
 * @property string $LinkCustomURL
 * @property boolean $LinkNewTab
 * @property string $Height
 * @property int $ImageID
 * @property int $LinkPageID
 * @method Image Image()
 * @method Page LinkPage()
 */
class PageBuilder_Value_Block_ImageBanner_ContentElement extends PageBuilder_ContentElement {
	private static $db = [
		'Title' => 'Varchar(255)',
		'LinkMode' => 'Varchar',
		'LinkCustomURL' => 'Varchar(1000)',
		'LinkNewTab' => 'Boolean',
		'Height' => 'Varchar',
	];
	private static $has_one = [
		'Image' => 'Image',
		'LinkPage' => 'Page',
	];
	
	public function Link() {
		if ($this->LinkMode == 'custom') {
			return $this->LinkCustomURL;
		} elseif ($this->LinkMode == 'page') {
			$p = $this->LinkPage();
			if ($p && $p->exists()) {
				return $p->Link();
			}
		}
		return null;
	}
	
	public function getPageBuilderPopupFields() {
		$return = parent::getPageBuilderPopupFields();
		$return->push(new TextField('Title', $this->fieldLabel('Title')));
		$return->push(
			(new UploadFIeld('Image', $this->fieldLabel('Image')))
				->setFolderName('banner')
		);
		$return->push(
			(new DropdownField('Height', $this->fieldLabel('Height'), [
				'100px' => '100',
				'150px' => '150',
				'200px' => '200',
				'300px' => '300',
				'400px' => '400',
				'450px' => '450',
				'600px' => '600',
			]))->setEmptyString('auto')
		);
		$return->push(new CompositeField([
			(new DropdownField('LinkMode', $this->fieldLabel('LinkMode'), [
				'' => _t('MysiteLinkField.LinkModeNone', 'none'),
				'page' => _t('MysiteLinkField.LinkModePage', 'Page'),
				'custom' => _t('MysiteLinkField.LinkModeCustom', 'Custom URL'),
			])),
			(new DisplayLogicWrapper([
				new TreeDropdownField('LinkPageID', $this->fieldLabel('LinkPageID'), 'Page'),
			]))->hideUnless('LinkMode')->isEqualTo('page')->end(),
			(new DisplayLogicWrapper([
				new TextField('LinkCustomURL', $this->fieldLabel('LinkCustomURL')),
			]))->hideUnless('LinkMode')->isEqualTo('custom')->end(),
			(new DisplayLogicWrapper([
				new CheckboxField('LinkNewTab', $this->fieldLabel('LinkNewTab')),
			]))->hideUnless('LinkMode')->isNotEqualTo('')->end(),
		]));
		return $return;
	}
	
	public function PageBuilderPreview() {
		$i = $this->Image();
		if ($i && $i->exists()) {
			return sprintf(
				'<img src="%s" alt="%s" style="%s">',
				$i->FitMax(400, 300)->getURL(),
				$this->getTitle(),
				'max-width: 100%;'
			);
		}
		return parent::PageBuilderPreview();
	}
}
