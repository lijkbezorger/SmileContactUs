<?php
/**
 * Upgrade actions with db on upgrade module
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Store\Api\Data\StoreInterfaceFactory;
use Smile\ContactUs\Helper\ConfigDataHelper;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @var ConfigDataHelper
     */
    protected $configDataHelper;

    public function __construct(
        ConfigDataHelper $configDataHelper
    )
    {
        $this->configDataHelper = $configDataHelper;
    }


    /**
     * Upgrades data for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.2', '<')) {
            $this->updateOn002($setup);
        }

        $setup->endSetup();
    }

    public function updateOn002(SchemaSetupInterface $setup)
    {
        $defaultStatus = $this->configDataHelper->getGeneralConfig('default_request_status');
        if($defaultStatus == null) {
            $defaultStatus = 0;
        }

        /** @var AdapterInterface $connection */
        $connection = $setup->getConnection();

        $requestTable = $setup->getTable('smile_contact_us_request');

        $connection->addColumn(
            $requestTable,
            'status',
            [
                'type' => Table::TYPE_SMALLINT,
                'nullable' => false,
                'default' => $defaultStatus,
                'comment' => 'Status',
            ]
        );

    }
}
