<?php
namespace Sga\Notification\Ui\Component\Notification\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Label extends Column
{
    protected $urlBuilder;
    protected $_scopeConfig;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        ScopeConfigInterface $scopeConfig,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->_scopeConfig = $scopeConfig;

        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $entities = $this->_scopeConfig->get('system', 'default/sga_notification/entities');

            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['code']) && isset($entities[$item['code']]['label'])) {
                    $item['label'] = $entities[$item['code']]['label'];
                } else {
                    $item['label'] = $item['code'];
                }
            }
        }

        return $dataSource;
    }
}
