<?php
namespace Sga\Notification\Controller\Adminhtml\Notification;

use Magento\Framework\Controller\ResultFactory;
use Sga\Notification\Controller\Adminhtml\Notification as ParentClass;

class MassDelete extends ParentClass
{
    public function execute()
    {
        $collection = $this->_massActionFilter->getCollection($this->_collectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $item) {
            $item->delete();
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
