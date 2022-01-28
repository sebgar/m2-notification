<?php
namespace Sga\Notification\Controller\Adminhtml\Notification;

use Magento\Framework\Controller\ResultFactory;
use Sga\Notification\Controller\Adminhtml\Notification as ParentClass;
use Sga\Notification\Api\Data\NotificationInterface;

class MassProcessing extends ParentClass
{
    public function execute()
    {
        $collection = $this->_massActionFilter->getCollection($this->_collectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $item) {
            $item->setStatus(NotificationInterface::STATUS_PROCESSING)
                ->setUserId($this->_authSession->getUser()->getId())
                ->save();
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been set to processing.', $collectionSize));

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
