<?php
namespace Sga\Notification\Controller\Adminhtml;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\Auth\Session as AuthSession;
use Magento\Ui\Component\MassAction\Filter as MassActionFilter;
use Sga\Notification\Model\NotificationFactory as ModelFactory;
use Sga\Notification\Model\ResourceModel\Notification\CollectionFactory;
use Sga\Notification\Api\NotificationRepositoryInterface as ModelRepository;

abstract class Notification extends Action
{
    const ADMIN_RESOURCE = 'Sga_Notification::notification';

    protected $_modelFactory;
    protected $_modelRepository;
    protected $_collectionFactory;
    protected $_massActionFilter;
    protected $_dataPersistor;
    protected $_authSession;

    public function __construct(
        Context $context,
        ModelFactory $modelFactory,
        ModelRepository $modelRepository,
        CollectionFactory $collectionFactory,
        MassActionFilter $massActionFilter,
        DataPersistorInterface $dataPersistor,
        AuthSession $authSession
    ) {
        $this->_modelFactory = $modelFactory;
        $this->_modelRepository = $modelRepository;
        $this->_collectionFactory = $collectionFactory;
        $this->_massActionFilter = $massActionFilter;
        $this->_dataPersistor = $dataPersistor;
        $this->_authSession = $authSession;

        parent::__construct($context);
    }

    protected function initPage(Page $resultPage)
    {
        $resultPage->setActiveMenu('Sga_Notification::notification')
            ->addBreadcrumb(__('Notifications'), __('Notifications'));

        $resultPage->getConfig()->getTitle()->prepend(__('Notifications'));

        return $resultPage;
    }
}
