<?php
/**
 *  Frontend form
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Block\Form;


use Magento\Framework\View\Element\Template;

class RequestFormBlock extends Template
{
    /**
     * @return string
     */
    public function getAction()
    {
        return '/contact_us/request/save';
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'POST';
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'Leave your question';
    }
}