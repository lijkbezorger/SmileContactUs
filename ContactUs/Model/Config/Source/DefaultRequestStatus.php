<?php
/**
 * Source model for default request status
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class DefaultRequestStatus implements ArrayInterface
{
    /**#@+
     * Consts for default request statuses
     */
    const STATUS_NEW = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_CLOSED = 2;
    /**@#-*/

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => static::STATUS_NEW,
                'label' => __('New')
            ],
            [
                'value' => static::STATUS_IN_PROGRESS,
                'label' => __('In progress')
            ],
            [
                'value' => static::STATUS_CLOSED,
                'label' => __('Closed')
            ]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [
            static::STATUS_NEW => __('New'),
            static::STATUS_IN_PROGRESS => __('In progress'),
            static::STATUS_CLOSED => __('Closed')
        ];
    }
}
