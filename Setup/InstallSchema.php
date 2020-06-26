<?php
/**
 * Megantic Mgc Extension
 *
 * @category Megantic
 * @package Megantic_Mgc
 * @copyright Copyright (c) Megantic 2020
 * @author Aleksandar Stojanov - Pirate
 */

namespace Megantic\Mgc\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * InstallSchema
 *
 * @category Megantic
 * @package Megantic_Mgc
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if ($installer->getConnection()->isTableExists('magento_git')) {
            $installer->getConnection()->dropTable('magento_git');
        }

        $table = $installer->getConnection()
            ->newTable($installer->getTable('magento_git'))
            ->addColumn('magento_git_id', Table::TYPE_SMALLINT, null, ['identity' => true, 'nullable' => false, 'primary' => true], 'ID')
            ->addColumn('url_key', Table::TYPE_TEXT, 100, ['nullable' => true, 'default' => null], 'URL Key')
            ->addColumn('name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Name')
            ->addColumn('is_active', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => '1'], 'Is Active?')
            ->addColumn('creation_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Creation Time')
            ->addColumn('update_time', Table::TYPE_DATETIME, null, ['nullable' => false], 'Update Time')
            ->addIndex($installer->getIdxName('magento_git_idx', ['url_key']), ['url_key'])
            ->setComment('Megantic Mgc Table');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
