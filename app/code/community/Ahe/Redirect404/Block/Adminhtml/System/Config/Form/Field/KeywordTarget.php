<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Ahe
 * @package    Ahe_Redirect404
 * @copyright  Copyright (c) 2013 André Herrn <info@andre-herrn.de>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author     André Herrn <info@andre-herrn.de>
 */

/**
 * Keyword Target Configuration Frontend Model Block
 * 
 * @category   Ahe
 * @package    Ahe_Redirect404
 * @author     André Herrn <info@andre-herrn.de>
 */
class Ahe_Redirect404_Block_Adminhtml_System_Config_Form_Field_KeywordTarget
    extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->addColumn('keyword', array(
            'label' => Mage::helper('adminhtml')->__('Keyword'),
            'style' => 'width:250px',
        ));
        
        $this->addColumn('target_uri', array(
            'label' => Mage::helper('adminhtml')->__('Target uri'),
            'style' => 'width:250px',
        ));

        $this->addColumn('priority', array(
            'label' => Mage::helper('adminhtml')->__('Priority'),
            'style' => 'width:50px',
        ));
        
        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('adminhtml')->__('Add rewrite');
        parent::__construct();
    }
}