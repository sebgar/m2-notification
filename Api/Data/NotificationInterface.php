<?php
namespace Sga\Notification\Api\Data;

interface NotificationInterface
{
    const NOTIFICATION_ID = 'notification_id';
    const CODE = 'code';
    const ENTITY = 'entity';
    const ENTITY_ID = 'entity_id';
    const PARAMETERS = 'parameters';
    const STATUS = 'status';
    const USER_ID = 'user_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'created_at';

    const STATUS_NEW = 'new';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETE = 'complete';

    /**
     * Get notification id
     *
     * @return int|null
     */
    public function getNotificationId();

    /**
     * Set notification id
     *
     * @param int $id
     * @return NotificationInterface
     */
    public function setNotificationId($id);

    /**
     * Get code
     *
     * @return string|null
     */
    public function getCode();

    /**
     * Set code
     *
     * @param string $value
     * @return NotificationInterface
     */
    public function setCode($value);

    /**
     * Get entity
     *
     * @return string|null
     */
    public function getEntity();

    /**
     * Set entity
     *
     * @param string $value
     * @return NotificationInterface
     */
    public function setEntity($value);

    /**
     * Get entity_id
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Set entity_id
     *
     * @param int $value
     * @return NotificationInterface
     */
    public function setEntityId($value);

    /**
     * Get parameters
     *
     * @return string|null
     */
    public function getParameters();

    /**
     * Set parameters
     *
     * @param string $value
     * @return NotificationInterface
     */
    public function setParameters($value);

    /**
     * Get status
     *
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     *
     * @param string $value
     * @return NotificationInterface
     */
    public function setStatus($value);

    /**
     * Get user_id
     *
     * @return int|null
     */
    public function getUserId();

    /**
     * Set user_id
     *
     * @param int $value
     * @return NotificationInterface
     */
    public function setUserId($value);

    /**
     * Get created_at
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     *
     * @param string $value
     * @return NotificationInterface
     */
    public function setCreatedAt($value);

    /**
     * Get updated_at
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     *
     * @param string $value
     * @return NotificationInterface
     */
    public function setUpdatedAt($value);

}
