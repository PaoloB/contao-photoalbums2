<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2014 Leo Feyer
 *
 * @package    photoalbums2
 * @author     Daniel Kiesel <https://github.com/icodr8>
 * @license    LGPL
 * @copyright  Daniel Kiesel 2012-2014
 */


/**
 * Namespace
 */
namespace Photoalbums2;


/**
 * Class ModulePhotoalbums2List
 *
 * @copyright  Daniel Kiesel 2012-2014
 * @author     Daniel Kiesel <https://github.com/icodr8>
 * @package    photoalbums2
 */
class ModulePhotoalbums2List extends \ModulePhotoalbums2
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'pa2_wrap';


	/**
	 * Subtemplate
	 * @var string
	 */
	protected $strSubtemplate = 'pa2_album';


	/**
	 * generate function.
	 *
	 * @access public
	 * @return void
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### PHOTOALBUMS 2 LIST MODULE ###';

			return $objTemplate->parse();
		}

		// Set Pa2 Type
		$this->pa2type = 'MOD_LIST';

		// Set defaults
		$this->pa2OverviewPage = '';

		return parent::generate();
	}


	/**
	 * compile function.
	 *
	 * @access protected
	 * @return void
	 */
	protected function compile()
	{
		global $objPage;

		// Import CSS files
		$objPa2 = new \Pa2();
		$objPa2->addCssFile();

		// Show albums
		if (!$this->Input->get('album') && ($this->pa2DetailPage == '' || ($this->pa2DetailPage != '' && $this->pa2DetailPage != $objPage->id)))
		{
			$this->prepareAlbums();
		}
		// Go to detail page (images)
		else if ($this->Input->get('album'))
		{
			$this->goToDetailPage();
		}
		// Go to root page
		else
		{
			$this->goToRootPage();
		}
	}
}