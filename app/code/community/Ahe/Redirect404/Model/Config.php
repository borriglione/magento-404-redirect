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
 * Config Model
 * 
 * @category   Ahe
 * @package    Ahe_Redirect404
 * @author     André Herrn <info@andre-herrn.de>
 */
class Ahe_Redirect404_Model_Config
{
    /**
     * Get active status
     * 
     * @return boolean
     */
    public function getIsActive()
    {
        return (1 == Mage::getStoreConfig("aheredirect404/redirects/active"));
    }
    
    /**
     * Get keyword - target uri collection
     * 
     * @return array
     */
    public function getKeywordTargetCombinations()
    {
        return unserialize(Mage::getStoreConfig("aheredirect404/redirects/keyword_target"));
    }
}