<?php
namespace Sga\Notification\Model\System\Message;

use Magento\Framework\UrlInterface;
use Magento\Framework\Notification\MessageInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Sga\Notification\Api\Data\NotificationInterface;
use Sga\Notification\Model\NotificationRepository;

class Notification implements MessageInterface
{
    protected $_urlBuilder;
    protected $_notificationRepository;
    protected $_searchCriteriaBuilder;

    public function __construct(
        UrlInterface $urlBuilder,
        NotificationRepository $notificationRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->_urlBuilder = $urlBuilder;
        $this->_notificationRepository = $notificationRepository;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getIdentity()
    {
        return 'sga_notification';
    }

    public function isDisplayed()
    {
        return $this->_notificationRepository->count() > 0;
    }

    public function getText()
    {
        $url = $this->_urlBuilder->getUrl('notification/notification');

        $searchCriteria = $this->_searchCriteriaBuilder
            ->addFilter('status', NotificationInterface::STATUS_NEW)
            ->create();

        $nb = $this->_notificationRepository->count($searchCriteria);

        return __('<a href="%1">There is %2 notification(s)</a>', $url, $nb);
    }

    public function getSeverity()
    {
        return \Magento\Framework\Notification\MessageInterface::SEVERITY_NOTICE;
    }
}
