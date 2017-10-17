<?php
namespace Itris\Faq\Api;

use Itris\Faq\Api\Data\CategoryInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SearchCriteriaInterface;

interface CategoryRepositoryInterface 
{
    public function save(CategoryInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(CategoryInterface $page);

    public function deleteById($id);
}
