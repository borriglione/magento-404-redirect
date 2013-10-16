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
 * Observer
 * 
 * @category   Ahe
 * @package    Ahe_Redirect404
 * @author     André Herrn <info@andre-herrn.de>
 */
class Ahe_Redirect404_Model_Observer
{
    /**
     * Catch CMS 404 No Route action
     *
     * The CMS 404 No Route action is opened if no route for a given url could be found by Magento
     *
     * @param  Varien_Event_Observer $observer
     * @return void
     */
    public function noRoute($observer)
    {
        //Check if extension is enabled
        if (false === Mage::getModel('aheredirect404/config')->getIsActive()) {
            return;
        }

        Mage::getModel('aheredirect404/redirect')->checkForRedirect(
            $observer->getEvent()->getControllerAction()->getRequest()->getRequestUri()
        );
    }

    /**
     * Sort redirect fields by priority before saving them
     *
     * @param  Varien_Event_Observer $observer
     * @return void
     */
    public function prepareRuleSet($observer)
    {
        $configObject = $configData = $observer->getEvent()->getObject();
        $configData = $configObject->getData();

        //Check if we have the correct configuration area
        if ('aheredirect404' != $configData['section']
            && isset($configData['groups']['redirects']['fields']['keyword_target'])) {
            return;
        }

        //Init keyword target sort by priority
        $configData = Mage::helper('aheredirect404/data')->sortKeywordTarget($configData);
        
        //Save sorted config
        $configObject->setData($configData);
    }
}