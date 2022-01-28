<?php
namespace Sga\Notification\Model\Config\Source;

use Magento\User\Model\ResourceModel\User\CollectionFactory;
use Sga\Notification\Api\Data\NotificationInterface;

class User implements \Magento\Framework\Data\OptionSourceInterface
{
    protected $_collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory
    ){
        $this->_collectionFactory = $collectionFactory;
    }

    public function toOptionArray()
    {
        $options = $this->_getOptions();

        $list = [];
        foreach ($options as $k => $v) {
            $list[] = ['value' => $k, 'label' => $v];
        }
        return $list;
    }

    public function toArray()
    {
        return $this->_getOptions();
    }

    protected function _getOptions()
    {
        $list = [];

        $items = $this->_collectionFactory->create()->getItems();
        foreach ($items as $item) {
            $list[$item->getId()] = $item->getFirstname().' '.$item->getLastname();
        }
        return $list;
    }
}
