<?php
namespace Itris\Faq\Model;
class Category extends \Magento\Framework\Model\AbstractModel implements \Itris\Faq\Api\Data\CategoryInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'itris_faq_category';

    protected function _construct()
    {
        $this->_init('Itris\Faq\Model\ResourceModel\Category');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
