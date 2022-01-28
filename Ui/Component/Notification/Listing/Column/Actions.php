<?php
namespace Sga\Notification\Ui\Component\Notification\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Actions extends Column
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
                $name = $this->getData('name');
                if (isset($item['notification_id'])) {

                    $url = '';
                    if (isset($entities[$item['entity']])) {
                        $url = $this->urlBuilder->getUrl($entities[$item['entity']]['route'], [$entities[$item['entity']]['object_id'] => $item['entity_id']]);
                    }
                    if ($url !== '') {
                        $item[$name]['edit'] = [
                            'href' => $url,
                            'label' => __('See')
                        ];
                    }

                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl('notification/notification/delete', ['notification_id' => $item['notification_id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete %1', $name),
                            'message' => __('Are you sure you want to delete %1 ?', $name)
                        ],
                        'post' => true
                    ];
                }
            }
        }

        return $dataSource;
    }
}
