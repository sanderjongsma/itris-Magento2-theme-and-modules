<?php
namespace Itris\Faq\Setup;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        //START: install stuff
        //END:   install stuff
        
        //START table setup
        $table = $installer->getConnection()->newTable(
            $installer->getTable('itris_faq_item')
        )->addColumn(
            'itris_faq_item_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 'identity' => true, 'nullable' => false, 'primary' => true ],
            'Faq ID'
        )->addColumn(
            'question',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'Question'
        )->addColumn(
            'answer',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            2048,
            [ 'nullable' => false, ],
            'Answer'
        )->addColumn(
            'creation_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT, ],
            'Creation Time'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE, ],
            'Modification Time'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 'nullable' => false, 'default' => '1', ],
            'Is Active'
        );
        $installer->getConnection()->createTable($table);
        //END   table setup

        /**
         * Create table 'itris_faq_item_store'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('itris_faq_item_store')
        )->addColumn(
            'itris_faq_item_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'primary' => true],
            'Faq ID'
        )->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['unsigned' => true, 'nullable' => false, 'primary' => true],
            'Store ID'
        )->addIndex(
            $installer->getIdxName('itris_faq_item_store', ['store_id']),
            ['store_id']
        )->addForeignKey(
            $installer->getFkName('itris_faq_item_store', 'itris_faq_item_id', 'itris_faq_item', 'itris_faq_item_id'),
            'itris_faq_item_id',
            $installer->getTable('itris_faq_item'),
            'itris_faq_item_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->addForeignKey(
            $installer->getFkName('itris_faq_item_store', 'store_id', 'store', 'store_id'),
            'store_id',
            $installer->getTable('store'),
            'store_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->setComment(
            'Faq To Store Linkage Table'
        );
        $installer->getConnection()->createTable($table);

        
        //START table setup
        $table = $installer->getConnection()->newTable(
            $installer->getTable('itris_faq_category')
        )->addColumn(
            'itris_faq_category_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 'identity' => true, 'nullable' => false, 'primary' => true ],
            'Category ID'
        )->addColumn(
            'title',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'Title'
        )->addColumn(
            'creation_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT, ],
            'Creation Time'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE, ],
            'Modification Time'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 'nullable' => false, 'default' => '1', ],
            'Is Active'
        );
        $installer->getConnection()->createTable($table);
        //END   table setup

        /**
         * Create table 'itris_faq_category_store'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('itris_faq_category_store')
        )->addColumn(
            'itris_faq_category_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'primary' => true],
            'Category ID'
        )->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['unsigned' => true, 'nullable' => false, 'primary' => true],
            'Store ID'
        )->addIndex(
            $installer->getIdxName('itris_faq_category_store', ['store_id']),
            ['store_id']
        )->addForeignKey(
            $installer->getFkName('itris_faq_category_store', 'itris_faq_category_id', 'itris_faq_category', 'itris_faq_category_id'),
            'itris_faq_category_id',
            $installer->getTable('itris_faq_category'),
            'itris_faq_category_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->addForeignKey(
            $installer->getFkName('itris_faq_category_store', 'store_id', 'store', 'store_id'),
            'store_id',
            $installer->getTable('store'),
            'store_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->setComment(
            'Faq Category To Store Linkage Table'
        );

        $installer->getConnection()->createTable($table);

        /**
         * Create table 'itris_faq_category_store'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('itris_faq_category_item')
        )->addColumn(
            'itris_faq_category_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'primary' => true],
            'Category ID'
        )->addColumn(
            'itris_faq_item_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'primary' => true],
            'Faq ID'
        )->addIndex(
            $installer->getIdxName('itris_faq_category_item', ['itris_faq_item_id']),
            ['itris_faq_item_id']
        )->addForeignKey(
            $installer->getFkName('itris_faq_category_item', 'itris_faq_category_id', 'itris_faq_category', 'itris_faq_category_id'),
            'itris_faq_category_id',
            $installer->getTable('itris_faq_category'),
            'itris_faq_category_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->addForeignKey(
            $installer->getFkName('itris_faq_category_item', 'itris_faq_item_id', 'itris_faq_item', 'itris_faq_item_id'),
            'itris_faq_item_id',
            $installer->getTable('itris_faq_item'),
            'itris_faq_item_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->setComment(
            'Faq To Category Linkage Table'
        );

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
