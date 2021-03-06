<?php
namespace Sga\Notification\Model;

use Sga\Notification\Api\NotificationRepositoryInterface;
use Sga\Notification\Api\Data\NotificationInterface as ModelInterface;
use Sga\Notification\Api\Data\NotificationInterfaceFactory as ModelInterfaceFactory;
use Sga\Notification\Model\NotificationFactory as ModelFactory;
use Sga\Notification\Model\ResourceModel\Notification as ResourceModel;
use Sga\Notification\Model\ResourceModel\Notification\CollectionFactory as ModelCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterface as SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

class NotificationRepository implements NotificationRepositoryInterface
{
    protected $resource;
    protected $modelFactory;
    protected $modelCollectionFactory;
    protected $searchResultsFactory;
    protected $dataObjectHelper;
    protected $dataObjectProcessor;
    protected $dataFactory;
    private $storeManager;
    private $collectionProcessor;

    public function __construct(
        ResourceModel $resource,
        ModelFactory $modelFactory,
        ModelInterfaceFactory $dataFactory,
        ModelCollectionFactory $modelCollectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->modelFactory = $modelFactory;
        $this->dataFactory = $dataFactory;
        $this->modelCollectionFactory = $modelCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
    }

    public function save(ModelInterface $model)
    {

        try {
            $this->resource->save($model);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $model;
    }

    public function getById($id)
    {
        $model = $this->modelFactory->create();
        $this->resource->load($model, $id);
        if (!$model->getId()) {
            throw new NoSuchEntityException(__('The "%1" ID doesn\'t exist.', $id));
        }
        return $model;
    }

    public function getList(SearchCriteriaInterface $criteria)
    {
        $collection = $this->modelCollectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    public function count(SearchCriteriaInterface $criteria = null)
    {
        $collection = $this->modelCollectionFactory->create();
        if ($criteria !== null) {
            $this->collectionProcessor->process($criteria, $collection);
        }
        return $collection->getSize();
    }

    public function delete(ModelInterface $model)
    {
        try {
            $this->resource->delete($model);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }
}
