<?php
namespace Elgentos\Faq\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Item extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('elgentos_faq_item','elgentos_faq_item_id');
    }

    protected function _afterSave(AbstractModel $object)
    {
        $connection = $this->getConnection();
        $table = $this->getTable('elgentos_faq_item_store');

        $oldStores = $this->lookupStoreIds((int)$object->getId());
        $newStores = (array)$object->getStoreId();

        $delete = array_diff($oldStores, $newStores);
        if ($delete) {
            $where = [
                'elgentos_faq_item_id' . ' = ?' => (int)$object->getId(),
                'store_id IN (?)' => $delete,
            ];
            $connection->delete($table, $where);
        }

        $insert = array_diff($newStores, $oldStores);
        if ($insert) {
            $data = [];
            foreach ($insert as $storeId) {
                $data[] = [
                    'elgentos_faq_item_id' => (int)$object->getId(),
                    'store_id' => (int)$storeId
                ];
            }
            $connection->insertMultiple($table, $data);
        }

        $table = $this->getTable('elgentos_faq_category_item');

        $oldCategories = $this->lookupCategoryIds((int)$object->getId());
        $newCategories = (array)$object->getCategoryId();

        $delete = array_diff($oldCategories, $newCategories);
        if ($delete) {
            $where = [
                'elgentos_faq_item_id' . ' = ?' => (int)$object->getId(),
                'elgentos_faq_category_id IN (?)' => $delete,
            ];
            $connection->delete($table, $where);
        }

        $insert = array_filter(array_diff($newCategories, $oldCategories));
        if ($insert) {
            $data = [];
            foreach ($insert as $storeId) {
                $data[] = [
                    'elgentos_faq_item_id' => (int)$object->getId(),
                    'elgentos_faq_category_id' => (int)$storeId
                ];
            }
            $connection->insertMultiple($table, $data);
        }

        return $this;
    }

    public function lookupStoreIds($faqId)
    {
        $connection = $this->getConnection();

        $select = $connection->select()
            ->from(['elgentos_faq_item_store' => $this->getTable('elgentos_faq_item_store')], 'store_id')
            ->where('elgentos_faq_item_id = ?', $faqId);

        return $connection->fetchCol($select, ['elgentos_faq_item_id' => (int)$faqId]);
    }

    public function lookupCategoryIds($faqId)
    {
        $connection = $this->getConnection();

        $select = $connection->select()
            ->from(['elgentos_faq_category_item' => $this->getTable('elgentos_faq_category_item')], 'elgentos_faq_category_id')
            ->where('elgentos_faq_item_id = ?', $faqId);

        return $connection->fetchCol($select, ['elgentos_faq_item_id' => (int)$faqId]);
    }
}
