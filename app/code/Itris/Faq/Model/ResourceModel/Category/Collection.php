<?php
namespace Elgentos\Faq\Model\ResourceModel\Category;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Elgentos\Faq\Model\Category','Elgentos\Faq\Model\ResourceModel\Category');
    }

    /**
     * Retrieve option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return parent::_toOptionArray('elgentos_faq_category_id', 'title');
    }
}
