<?php
namespace Elgentos\Faq\Model;
class Category extends \Magento\Framework\Model\AbstractModel implements \Elgentos\Faq\Api\Data\CategoryInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'elgentos_faq_category';

    protected function _construct()
    {
        $this->_init('Elgentos\Faq\Model\ResourceModel\Category');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
