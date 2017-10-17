<?php
namespace Itris\Faq\Model\ResourceModel\Category;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Itris\Faq\Model\Category','Itris\Faq\Model\ResourceModel\Category');
    }

    /**
     * Retrieve option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return parent::_toOptionArray('itris_faq_category_id', 'title');
    }
}
