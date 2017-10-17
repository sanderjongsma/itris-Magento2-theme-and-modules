<?php
namespace Elgentos\Faq\Model\Item;

use Elgentos\Faq\Model\ResourceModel\Item\CollectionFactory;
use Elgentos\Faq\Model\ResourceModel\Item;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{

    protected $collection;

    protected $resourceItem;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param Item $resourceItem
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        Item $resourceItem,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->resourceItem = $resourceItem;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->meta = $this->prepareMeta($this->meta);
    }

    /**
     * Prepares Meta
     *
     * @param array $meta
     * @return array
     */
    public function prepareMeta(array $meta)
    {
        return $meta;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();

        foreach ($items as $item) {
            $itemData = $item->getData();
            if ($stores = $this->resourceItem->lookupStoreIds($item->getId())) {
                $itemData['store_id'] = $stores;
            }
            if ($categories = $this->resourceItem->lookupCategoryIds($item->getId())) {
                $itemData['category_id'] = $categories;
            }
            $this->loadedData[$item->getId()] = $itemData;
        }

        $data = $this->dataPersistor->get('elgentos_faq_item');
        if (!empty($data)) {
            $item = $this->collection->getNewEmptyItem();
            $item->setData($data);
            $this->loadedData[$item->getId()] = $itemData;
            $this->dataPersistor->clear('elgentos_faq_item');
        }

        return $this->loadedData;
    }
}
