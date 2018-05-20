<?php
/**
 * Save admin action
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Controller\Adminhtml\Request;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Smile\ContactUs\Controller\Adminhtml\BaseAction;
use Smile\ContactUs\Helper\ConfigDataHelper;
use Smile\ContactUs\Model;

class Save extends BaseAction
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
     * @var Registry
     */
    protected $coreRegistry = null;

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
     * @param Registry $coreRegistry
     * @param Model\RequestFactory $requestFactory
     * @param Model\RequestRepositoryFactory $requestRepositoryFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $coreRegistry,
        ConfigDataHelper $configDataHelper,
        Model\RequestFactory $requestFactory,
        Model\RequestRepositoryFactory $requestRepositoryFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->configDataHelper = $configDataHelper;
        $this->requestFactory = $requestFactory;
        $this->requestRepositoryFactory = $requestRepositoryFactory;
        parent::__construct($context, $resultPageFactory, $coreRegistry);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if ($this->_isAllowed()) {
            try {
                /** @var Http $request */
                $request = $this->getRequest();
                //Get post data
                $post = (array)$request->getPost();
                if (empty($post)) {
                    $resultRedirect->setUrl('/admin_contact_us/request/update');

                    return $resultRedirect;
                }
                //Set data to model
                $requestModel = $this->requestFactory->create();
                $requestModel->setData($post);
                $requestRepository = $this->requestRepositoryFactory->create();

                $requestRepository->save($requestModel);

                $this->messageManager->addSuccessMessage('Request was successfully updated');
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $resultRedirect->setUrl('/admin_contact_us/request/view');

                return $resultRedirect;

            } catch (\Exception $e) {
                $resultRedirect->setUrl('/admin_contact_us/request/update');
                $this->messageManager->addExceptionMessage($e, 'We can\'t do it.');

                return $resultRedirect;
            }
        }

        return $resultRedirect;
    }
}
