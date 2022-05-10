<?php
namespace Sga\Notification\Model\Config\Source;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Code implements \Magento\Framework\Data\OptionSourceInterface
{
    protected $_scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->_scopeConfig = $scopeConfig;
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
        $entities = $this->_scopeConfig->get('system', 'default/sga_notification/entities');
        $list = [];
        foreach ($entities as $k => $entity) {
            $list[$k] = $entity['label'];
        }
        return $list;
    }
}
