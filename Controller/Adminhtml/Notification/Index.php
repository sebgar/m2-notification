<?php
namespace Sga\Notification\Controller\Adminhtml\Notification;

use Magento\Framework\Controller\ResultFactory;
use Sga\Notification\Controller\Adminhtml\Notification as ParentClass;

class Index extends ParentClass
{
    public function execute()
    {
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $this->initPage($result);
        return $result;
    }
}
