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
 * Basis Helper
 * 
 * @category   Ahe
 * @package    Ahe_Redirect404
 * @author     André Herrn <info@andre-herrn.de>
 */
class Ahe_Redirect404_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Sort keyword target by priority
     * 
     * @param array $configData
     * @return array
     */
    public function sortKeywordTarget($configData)
    {
        $keywordTargets = $configData['groups']['redirects']['fields']['keyword_target']['value'];

        //Loop though every rule and replace the key with the priority to allow ksort
        $sortedRules = array();
        $i = 0;
        foreach ($keywordTargets as $key => $rule) {
            if ('__empty' == $key) {
                continue;
            }

            //Add leading zeros to allow correct sort
            $priorityWithLeadingZeros = str_pad($rule['priority'], 10 ,'0', STR_PAD_LEFT);
            $priority = $priorityWithLeadingZeros.'_'.$i;

            $sortedRules[$priority] = $rule;
            $i++;
        }

        //Sort array by key (priority)
        ksort($sortedRules);

        //print_r($sortedRules);
        //exit("d");
        
        //Reset the original values and return the result
        $configData['groups']['redirects']['fields']['keyword_target']['value'] = $sortedRules;
        return $configData;
    }
}