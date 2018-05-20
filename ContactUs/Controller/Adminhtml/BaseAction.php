<?php
/**
 * Abstract admin Action
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Controller\Adminhtml;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Smile\ContactUs\Controller\RegistryRequest;

abstract class BaseAction extends Action
{
    /**#@+
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Smile_ContactUs::general_config';
    /**@#-*/

    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $coreRegistry = null;

    /**
     * BaseAction constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param Registry $coreRegistry
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Registry $coreRegistry
    ) {
        $this->pageFactory = $pageFactory;
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Request initialization
     *
     * @return string request id
     */
    protected function initCurrentRequest()
    {
        $requestId = (int)$this->getRequest()->getParam('id');

        if ($requestId) {
            $this->coreRegistry->register(RegistryRequest::CURRENT_REQUEST_ID, $requestId);
        }

        return $requestId;
    }
}