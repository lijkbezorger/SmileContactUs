<?php
/**
 *  Config data helper
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Helper;


use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class ConfigDataHelper extends AbstractHelper
{

    /**#@+
     * Const for xml path in config.xml
     */
    const XML_PATH_CONTACT_US = 'contact_us/';
    /**@#-*/

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getGeneralConfig($code, $storeId = null)
    {
        return $this->getConfigValue(
            self::XML_PATH_CONTACT_US .'general/'. $code,
            $storeId
        );
    }
}