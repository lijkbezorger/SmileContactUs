<?php
/**
 *  Request repository
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Smile\ContactUs\Api\Data;
use Smile\ContactUs\Api\RequestRepositoryInterface;
use Smile\ContactUs\Model;
use Smile\ContactUs\Model\ResourceModel;

class RequestRepository implements RequestRepositoryInterface
{
    /**
     * @var ResourceModel\Request
     */
    protected $requestResource;

    /**
     * @var Model\RequestFactory
     */
    protected $requestFactory;

    /**
     * @var RequestCollectionFactory
     */
    protected $requestCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var SearchResultsInterface
     */
    protected $searchResultsFactory;

    /**
     * RequestRepository constructor.
     *
     * @param ResourceModel\Request $requestResource
     * @param Model\RequestFactory $requestFactory
     * @param RequestCollectionFactory $requestCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsInterface $searchResults
     */
    public function __construct(
        ResourceModel\Request $requestResource,
        Model\RequestFactory $requestFactory,
        RequestCollectionFactory $requestCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterface $searchResults
    )
    {
        $this->requestResource = $requestResource;
        $this->requestFactory = $requestFactory;
        $this->requestCollectionFactory = $requestCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResults;
    }

    /**
     * @param Data\RequestInterface $requestItem
     *
     * @return Data\RequestInterface
     * @throws CouldNotSaveException
     */
    public function save(Data\RequestInterface $requestItem)
    {
        try {
            $requestResource = $this->requestResource;
            $requestResource->save($requestItem);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $requestItem;
    }

    /**
     * @param int $requestItemId
     *
     * @return Data\RequestInterface
     */
    public function getById($requestItemId)
    {
        $entity = $this->requestFactory->create();
        try {
            $this->requestResource->load($entity, $requestItemId);
        } catch (NoSuchEntityException $e) {
            $entity = $this->requestFactory->create();
        }

        return $entity;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return mixed
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Request $collection */
        $collection = $this->requestCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @param Data\RequestInterface $requestItem
     *
     * @return bool
     *
     * @throws CouldNotSaveException
     */
    public function delete(Data\RequestInterface $requestItem)
    {
        try {
            $this->requestResource->delete($requestItem);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * @param int $requestItemId
     *
     * @return bool
     * @throws CouldNotSaveException
     */
    public function deleteById($requestItemId)
    {
        return $this->delete($this->getById($requestItemId));
    }
}