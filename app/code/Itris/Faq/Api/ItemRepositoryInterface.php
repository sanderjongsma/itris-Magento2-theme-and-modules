<?php
namespace Itris\Faq\Api;

use Itris\Faq\Api\Data\ItemInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SearchCriteriaInterface;

interface ItemRepositoryInterface 
{
    public function save(ItemInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(ItemInterface $page);

    public function deleteById($id);
}
