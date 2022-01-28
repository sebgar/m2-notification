<?php
namespace Sga\Notification\Controller\Adminhtml\Notification;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Sga\Notification\Controller\Adminhtml\Notification as ParentClass;

class Delete extends ParentClass implements HttpPostActionInterface
{
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $id = $this->getRequest()->getParam('notification_id');
        if ($id) {
            try {
                $model = $this->_modelFactory->create();
                $model->load($id);
                $model->delete();

                $this->messageManager->addSuccessMessage(__('You deleted the notification.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['notification_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a notification to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
