<?php
namespace Elgentos\Faq\Model\ResourceModel\Item;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Elgentos\Faq\Model\Item','Elgentos\Faq\Model\ResourceModel\Item');
    }
}
