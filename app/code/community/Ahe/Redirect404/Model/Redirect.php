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
 * Redirect Model
 * 
 * @category   Ahe
 * @package    Ahe_Redirect404
 * @author     André Herrn <info@andre-herrn.de>
 */
class Ahe_Redirect404_Model_Redirect
{
    /**
     * HTTP Status code for the redirection
     */
    const REDIRECT_HTTP_STATUS_CODE = 301;

    /**
     * Main function to check if a redirect exists and to trigger it in case
     * 
     * @param string $requestUri f.e. /foo/bar.html
     * @return void
     */
    public function checkForRedirect($requestUri)
    {
        //If a redirect is found for the request uri trigger the redirect
        if ($targetUri = $this->getRedirectUri($requestUri)) {
            $this->triggerRedirect($targetUri);
        }
    }

    /**
     * Get earliest redirect
     * 
     * @param string $requestUri
     * @return string|boolean
     */
    public function getRedirectUri($requestUri)
    {
        foreach (Mage::getModel('aheredirect404/config')->getKeywordTargetCombinations() as $ruleSet) {
            if (false !== strpos($requestUri, $ruleSet['keyword'])) {
                return $ruleSet['target_uri'];
            }
        }
        return false;
    }

    /**
     * Trigger a redirect
     * 
     * @param string $targetUri
     * @return void
     */
    public function triggerRedirect($targetUri)
    {
        //Build target Url
        $targetUrl = Mage::getUrl().$targetUri;

        //Trigger redirect
        header ('HTTP/1.1 '.self::REDIRECT_HTTP_STATUS_CODE.' Moved Permanently');
        header ('Location: ' . $targetUrl);

        //Exit to stop further processing
        exit();
    }
}