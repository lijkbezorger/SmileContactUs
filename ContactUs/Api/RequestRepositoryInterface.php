<?php
/**
 *  Request repository interface
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Api;

use Smile\ContactUs\Api\Data\RequestInterface;


interface RequestRepositoryInterface
{
    /**
     * @param RequestInterface $requestItem
     *
     * @return RequestInterface
     */
    public function save(RequestInterface $requestItem);

    /**
     * @param int $requestItemId
     *
     * @return RequestInterface
     */
    public function getById($requestItemId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return mixed
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param RequestInterface $requestItem
     *
     * @return mixed
     */
    public function delete(RequestInterface $requestItem);

    /**
     * @param int $requestItemId
     *
     * @return RequestInterface
     */
    public function deleteById($requestItemId);
}