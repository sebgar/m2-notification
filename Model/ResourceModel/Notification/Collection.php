<?php
namespace Sga\Notification\Model\ResourceModel\Notification;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Sga\Notification\Model\Notification as Model;
use Sga\Notification\Model\ResourceModel\Notification as ResourceModel;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'notification_id';

    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);

    }

}
