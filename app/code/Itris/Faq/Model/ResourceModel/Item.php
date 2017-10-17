<?php
namespace Itris\Faq\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Item extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('itris_faq_item','itris_faq_item_id');
    }

    protected function _afterSave(AbstractModel $object)
    {
        $connection = $this->getConnection();
        $table = $this->getTable('itris_faq_item_store');

        $oldStores = $this->lookupStoreIds((int)$object->getId());
        $newStores = (array)$object->getStoreId();

        $delete = array_diff($oldStores, $newStores);
        if ($delete) {
            $where = [
                'itris_faq_item_id' . ' = ?' => (int)$object->getId(),
                'store_id IN (?)' => $delete,
            ];
            $connection->delete($table, $where);
        }

        $insert = array_diff($newStores, $oldStores);
        if ($insert) {
            $data = [];
            foreach ($insert as $storeId) {
                $data[] = [
                    'itris_faq_item_id' => (int)$object->getId(),
                    'store_id' => (int)$storeId
                ];
            }
            $connection->insertMultiple($table, $data);
        }

        $table = $this->getTable('itris_faq_category_item');

        $oldCategories = $this->lookupCategoryIds((int)$object->getId());
        $newCategories = (array)$object->getCategoryId();

        $delete = array_diff($oldCategories, $newCategories);
        if ($delete) {
            $where = [
                'itris_faq_item_id' . ' = ?' => (int)$object->getId(),
                'itris_faq_category_id IN (?)' => $delete,
            ];
            $connection->delete($table, $where);
        }

        $insert = array_filter(array_diff($newCategories, $oldCategories));
        if ($insert) {
            $data = [];
            foreach ($insert as $storeId) {
                $data[] = [
                    'itris_faq_item_id' => (int)$object->getId(),
                    'itris_faq_category_id' => (int)$storeId
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
            ->from(['itris_faq_item_store' => $this->getTable('itris_faq_item_store')], 'store_id')
            ->where('itris_faq_item_id = ?', $faqId);

        return $connection->fetchCol($select, ['itris_faq_item_id' => (int)$faqId]);
    }

    public function lookupCategoryIds($faqId)
    {
        $connection = $this->getConnection();

        $select = $connection->select()
            ->from(['itris_faq_category_item' => $this->getTable('itris_faq_category_item')], 'itris_faq_category_id')
            ->where('itris_faq_item_id = ?', $faqId);

        return $connection->fetchCol($select, ['itris_faq_item_id' => (int)$faqId]);
    }
}
