<?php
/**
 * Column actions
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Ui\Component\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class BlockActions
 */
class ColumnActions extends Column
{
    /**#@+
     * Url path
     */
    const URL_PATH_VIEW = 'admin_contact_us/request/view';
    const URL_PATH_UPDATE = 'admin_contact_us/request/update';
    const URL_PATH_DELETE = 'admin_contact_us/request/delete';
    /**@#-*/

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    )
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['id'])) {
                    $urlEntityParamName = 'id';
                    $item[$this->getData('name')] = [
                        'view' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_VIEW,
                                [
                                    $urlEntityParamName => $item['id']
                                ]
                            ),
                            'label' => 'View'
                        ],
                        'update' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_UPDATE,
                                [
                                    $urlEntityParamName => $item['id']
                                ]
                            ),
                            'label' => 'Update'
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    $urlEntityParamName => $item['id']
                                ]
                            ),
                            'label' => 'Delete'
                        ],
                    ];
                }
            }
        }

        return $dataSource;
    }
}
