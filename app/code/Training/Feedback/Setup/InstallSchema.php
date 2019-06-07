<?php
namespace Training\Feedback\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
//use Magento\Framework\DB\Adapter\AdapterInterface;


class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();


        $table = $installer->getConnection()->newTable(
            $installer->getTable('training_feedback')
        )->addColumn(
            'feedback_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Feedback ID'
        )->addColumn(
            'author_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Feedback Author Name'
        )->addColumn(
            'author_email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '255',
            ['nullable' => false],
            'Feedback Author email'
        )->addColumn(
            'message',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
            ['nullable' => false],
            'Feedback Content'
        )->addColumn(
            'creation_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false,'default'=> \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT ],
            'Feedback  Creation Time'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false,'default'=> \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
            'Feedback Modification Time'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '1'],
            'Is Feedback Active'
        )->addIndex(
            $installer->getIdxName('training_feedback', ['is_active']),
            ['is_active']
        )->setComment(
            'Feedback Table'
        );
        $installer->getConnection()->createTable($table);


        $installer->endSetup();
    }
}
