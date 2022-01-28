<?php
namespace Sga\Notification\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Sga\Notification\Api\Data\NotificationInterface as ModelInterface;

interface NotificationRepositoryInterface
{
    public function save(ModelInterface $model);

    public function getById($id);

    public function getList(SearchCriteriaInterface $searchCriteria);

    public function delete(ModelInterface $model);

    public function deleteById($id);

    public function count(SearchCriteriaInterface $searchCriteria);
}
