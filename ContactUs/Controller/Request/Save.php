<?php
/**
 * Save frontend action
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Controller\Request;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Smile\ContactUs\Helper\ConfigDataHelper;
use Smile\ContactUs\Model;

class Save extends Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var ConfigDataHelper
     */
    protected $configDataHelper;

    /**
     * @var Model\RequestFactory
     */
    protected $requestFactory;

    /**
     * @var Model\RequestRepositoryFactory
     */
    private $requestRepositoryFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param ConfigDataHelper $configDataHelper
     * @param Model\RequestFactory $requestFactory
     * @param Model\RequestRepositoryFactory $requestRepositoryFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ConfigDataHelper $configDataHelper,
        Model\RequestFactory $requestFactory,
        Model\RequestRepositoryFactory $requestRepositoryFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->configDataHelper = $configDataHelper;
        $this->requestFactory = $requestFactory;
        $this->requestRepositoryFactory = $requestRepositoryFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        try {
            /** @var Http $request */
            $request = $this->getRequest();
            //Get post data
            $post = (array)$request->getPost();
            if (empty($post)) {
                $resultRedirect->setUrl('/contact_us/request/create');

                return $resultRedirect;
            }
            //Set data to model
            $requestModel = $this->requestFactory->create();
            $requestModel->setData($post);
            //Get default status
            $requestModel->setStatus($this->configDataHelper->getGeneralConfig('default_request_status'));

            $requestRepository = $this->requestRepositoryFactory->create();

            $requestRepository->save($requestModel);

            $this->messageManager->addSuccessMessage('Thanks for your request.');
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl('/contact_us/request/result');

            return $resultRedirect;

        } catch (\Exception $e) {
            $resultRedirect->setUrl('/contact_us/request/create');
            $this->messageManager->addExceptionMessage($e, 'We can\'t do it.');

            return $resultRedirect;
        }
    }
}
