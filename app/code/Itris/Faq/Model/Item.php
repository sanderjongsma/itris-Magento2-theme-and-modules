<?php
namespace Itris\Faq\Model;
class Item extends \Magento\Framework\Model\AbstractModel implements \Itris\Faq\Api\Data\ItemInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'itris_faq_item';

    protected function _construct()
    {
        $this->_init('Itris\Faq\Model\ResourceModel\Item');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
