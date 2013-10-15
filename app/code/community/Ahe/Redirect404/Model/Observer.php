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
        Mage::getModel('aheredirect404/redirect')->checkForRedirect(
            $observer->getEvent()->getControllerAction()->getRequest()->getRequestUri()
        );
    }
}