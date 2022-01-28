<?php
namespace Sga\Notification\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Sga\Notification\Api\Data\NotificationInterface as ModelInterface;
use Sga\Notification\Model\ResourceModel\Notification as ResourceModel;

class Notification extends AbstractModel implements IdentityInterface, ModelInterface
{
    const CACHE_TAG = 'notification_notification';

    protected $_eventPrefix = 'notification_notification';

    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getNotificationId()
    {
        return $this->getData(self::NOTIFICATION_ID);
    }

    public function setNotificationId($id)
    {
        return $this->setData(self::NOTIFICATION_ID, $id);
    }

    public function getCode()
    {
        return $this->getData(self::CODE);
    }

    public function setCode($value)
    {
        return $this->setData(self::CODE, $value);
    }

    public function getEntity()
    {
        return $this->getData(self::ENTITY);
    }

    public function setEntity($value)
    {
        return $this->setData(self::ENTITY, $value);
    }

    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function setEntityId($value)
    {
        return $this->setData(self::ENTITY_ID, $value);
    }

    public function getParameters()
    {
        return $this->getData(self::PARAMETERS);
    }

    public function setParameters($value)
    {
        return $this->setData(self::PARAMETERS, $value);
    }

    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    public function setStatus($value)
    {
        return $this->setData(self::STATUS, $value);
    }

    public function getUserId()
    {
        return $this->getData(self::USER_ID);
    }

    public function setUserId($value)
    {
        return $this->setData(self::USER_ID, $value);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function setCreatedAt($value)
    {
        return $this->setData(self::CREATED_AT, $value);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setUpdatedAt($value)
    {
        return $this->setData(self::UPDATED_AT, $value);
    }
}
