<?php
namespace Elgentos\Faq\Ui\Component\Listing\DataProviders\Elgentos\Faq;

class Items extends \Magento\Ui\DataProvider\AbstractDataProvider
{    
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Elgentos\Faq\Model\ResourceModel\Item\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}
