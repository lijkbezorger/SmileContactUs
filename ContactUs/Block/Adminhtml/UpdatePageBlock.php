<?php
/**
 *  Block for admin view page
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Block\Adminhtml;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Smile\ContactUs\Api\Data\RequestInterface;
use Smile\ContactUs\Api\RequestRepositoryInterface;
use Smile\ContactUs\Controller\RegistryRequest;
use Smile\ContactUs\Model;
use Smile\ContactUs\Model\Config\Source\DefaultRequestStatus;
use Smile\ContactUs\Model\Request;

class UpdatePageBlock extends Template
{
    /**
     * @var Model\Request
     */
    protected $request = null;

    /**
     * @var Model\RequestRepositoryFactory
     */
    protected $requestRepositoryFactory;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @var DefaultRequestStatus
     */
    protected $defaultRequestStatus;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * ViewPageBlock constructor.
     * @param Model\RequestRepositoryFactory $requestRepositoryFactory
     * @param Registry $coreRegistry
     * @param DefaultRequestStatus $defaultRequestStatus
     * @param UrlInterface $urlBuilder
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        Model\RequestRepositoryFactory $requestRepositoryFactory,
        Registry $coreRegistry,
        DefaultRequestStatus $defaultRequestStatus,
        UrlInterface $urlBuilder,
        Template\Context $context,
        array $data = []
    )
    {
        $this->requestRepositoryFactory = $requestRepositoryFactory;
        $this->coreRegistry = $coreRegistry;
        $this->defaultRequestStatus = $defaultRequestStatus;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->urlBuilder->getUrl(
            '/request/save/', [
                'id' => $this->getModel()->getId()
            ]
        );
    }

    /**
     * @return string
     */
    public function getIndexAction()
    {
        return $this->urlBuilder->getUrl('/request/index');
    }

    /**
     * @return string
     */
    public function getUpdateAction()
    {
        return $this->urlBuilder->getUrl(
            '/request/update/',
            [
                'id' => $this->getModel()->getId()
            ]
        );
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'View request';
    }

    /**
     * @return RequestInterface|Model\Request
     */
    public function getModel()
    {
        if ($this->request === null) {
            $requestId = $this->coreRegistry->registry(RegistryRequest::CURRENT_REQUEST_ID);
            /** @var RequestRepositoryInterface $requestRepository */
            $requestRepository = $this->requestRepositoryFactory->create();
            $requestModel = $requestRepository->getById($requestId);
            $this->request = $requestModel;
        }

        return $this->request;
    }

    public function getStatusesArray()
    {
        /** @var DefaultRequestStatus $defaultRequestStatus */
        $defaultRequestStatus = $this->defaultRequestStatus;
        $statusesArray = $defaultRequestStatus->toArray();

        return $statusesArray;
    }

    public function getStatus()
    {
        /** @var Request $request */
        $request = $this->getModel();

        /** @var int $status */
        $status = $request->getStatus();
        if ($status !== false) {
            $statusesArray = $this->getStatusesArray();
            return $statusesArray[$status];
        }

        return 'No set';
    }

}