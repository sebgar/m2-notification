<?php
namespace Sga\Notification\Model\Config\Source;

use Sga\Notification\Api\Data\NotificationInterface;

class Status implements \Magento\Framework\Data\OptionSourceInterface
{
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
        return [
            NotificationInterface::STATUS_NEW => __('New'),
            NotificationInterface::STATUS_PROCESSING => __('Processing'),
            NotificationInterface::STATUS_COMPLETE => __('Complete')
        ];
    }
}
