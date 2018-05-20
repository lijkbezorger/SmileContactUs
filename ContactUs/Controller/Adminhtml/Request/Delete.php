<?php
/**
 * Delete admin action
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Controller\Adminhtml\Request;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Smile\ContactUs\Controller\Adminhtml\BaseAction;

class Delete extends BaseAction
{
    /**
     * @var array
     */
    protected $_publicActions = ['index'];

    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * @var Registry
     */
    protected $coreRegistry = null;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Registry $coreRegistry
    ) {
        $this->pageFactory = $pageFactory;
        parent::__construct($context, $pageFactory, $coreRegistry);
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        if ($this->_isAllowed()) {
            return $this->pageFactory->create();
        }

        return $this->_redirect('/');
    }
}