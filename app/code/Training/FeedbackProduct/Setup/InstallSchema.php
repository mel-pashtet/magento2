<?php
namespace Training\FeedbackProduct\Setup;

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
            $installer->getTable('training_feedback_product')
        )->addColumn(
            'row_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Row ID'
        )->addColumn(
                'feedback_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['nullable' => false],
                'Feedback ID'
        )->addColumn(
            'product_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true],
            'Product ID'
        )->addForeignKey(
            $installer->getFkName(
                'training_feedback_product',
                'feedback_id',
                'training_feedback',
                'feedback_id'
            ),
            'feedback_id',
            $installer->getTable('training_feedback'),
            'feedback_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->addForeignKey(
            $installer->getFkName(
                'training_feedback_product',
                'product_id',
                'catalog_product_entity',
                'entity_id'
            ),
            'product_id',
            $installer->getTable('catalog_product_entity'),
            'entity_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->setComment(
            'Feedback Product Table'
        );
        $installer->getConnection()->createTable($table);


        $installer->endSetup();
    }
}
