<?php
namespace Sga\Notification\Model\Notification;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Sga\Notification\Model\ResourceModel\Notification\CollectionFactory;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    protected $collection;
    protected $dataPersistor;
    protected $loadedData = [];
    protected $pool;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
        $this->pool = $pool ?: ObjectManager::getInstance()->get(PoolInterface::class);
    }

    public function getData()
    {
        $items = $this->collection->getItems();
        foreach ($items as $item) {
            $item->getResource()->unpackData($item);
            $this->loadedData[$item->getId()] = $item->getData();
        }

        // Call modifier
        if (is_object($this->pool)) {
            foreach ($this->pool->getModifiersInstances() as $modifier) {
                $this->loadedData = $modifier->modifyData($this->loadedData);
            }
        }

        // save data
        $data = $this->dataPersistor->get('notification_notification');
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('notification_notification');
        }

        return $this->loadedData;
    }
}
