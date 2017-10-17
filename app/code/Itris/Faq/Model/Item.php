<?php
namespace Elgentos\Faq\Model;
class Item extends \Magento\Framework\Model\AbstractModel implements \Elgentos\Faq\Api\Data\ItemInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'elgentos_faq_item';

    protected function _construct()
    {
        $this->_init('Elgentos\Faq\Model\ResourceModel\Item');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
