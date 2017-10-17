<?php
namespace Itris\Faq\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Category extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('itris_faq_category','itris_faq_category_id');
    }

    protected function _afterSave(AbstractModel $object)
    {
        $connection = $this->getConnection();
        $table = $this->getTable('itris_faq_category_store');

        $oldStores = $this->lookupStoreIds((int)$object->getId());
        $newStores = (array)$object->getStoreId();

        $delete = array_diff($oldStores, $newStores);
        if ($delete) {
            $where = [
                'itris_faq_category_id' . ' = ?' => (int)$object->getId(),
                'store_id IN (?)' => $delete,
            ];
            $connection->delete($table, $where);
        }

        $insert = array_diff($newStores, $oldStores);
        if ($insert) {
            $data = [];
            foreach ($insert as $storeId) {
                $data[] = [
                    'itris_faq_category_id' => (int)$object->getId(),
                    'store_id' => (int)$storeId
                ];
            }
            $connection->insertMultiple($table, $data);
        }

        return $this;
    }

    public function lookupStoreIds($categoryId)
    {
        $connection = $this->getConnection();

        $select = $connection->select()
            ->from(['itris_faq_category_store' => $this->getTable('itris_faq_category_store')], 'store_id')
            ->where('itris_faq_category_id = ?', $categoryId);

        return $connection->fetchCol($select, ['itris_faq_category_id' => (int)$categoryId]);
    }
}
