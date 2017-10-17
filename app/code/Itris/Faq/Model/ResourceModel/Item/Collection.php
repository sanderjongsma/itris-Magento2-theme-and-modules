<?php
namespace Itris\Faq\Model\ResourceModel\Item;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Itris\Faq\Model\Item','Itris\Faq\Model\ResourceModel\Item');
    }
}
