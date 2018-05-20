<?php
/**
 * Request collection
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Model\ResourceModel\Request;


use Magento\Cms\Model\ResourceModel\AbstractCollection;
use Magento\Store\Model\Store;
use Smile\ContactUs\Api\Data\RequestInterface;

class RequestCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = RequestInterface::ID;

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = RequestInterface::TABLE_NAME . '_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = RequestInterface::TABLE_NAME . '_collection';

    /**
     * Add filter by store
     *
     * @param int|array|Store $store
     * @param bool $withAdmin
     *
     * @return $this
     */
    public function addStoreFilter($store, $withAdmin = true)
    {
        return $this;
    }

}