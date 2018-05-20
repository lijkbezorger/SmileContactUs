<?php
/**
 * Update admin action
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Controller\Adminhtml\Request;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Smile\ContactUs\Controller\Adminhtml\BaseAction;

class Update extends BaseAction
{
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
            $this->initCurrentRequest();

            return $this->pageFactory->create();
        }

        return $this->_redirect('/');
    }
}