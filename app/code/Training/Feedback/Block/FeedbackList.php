<?php
namespace Training\Feedback\Block;


class FeedbackList extends \Magento\Framework\View\Element\Template
{
    const PAGE_SIZE = 5;

    private $collectionFactory;
    private $collection;
    private $feedbackResource;
    private $timezone;

    public function  __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory $collectionFactory,
        \Training\Feedback\Model\ResourceModel\Feedback $feedbackResource,
        \Magento\Framework\Stdlib\DateTime\Timezone $timezone,
        array $data = [])
    {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->feedbackResource = $feedbackResource;
        $this->timezone = $timezone;
    }

    public function getFeedbackCollection()
    {
        if(!$this->collection){
            $this->collection = $this->collectionFactory->create();
            $this->collection->addFieldToFilter('is_active', 1);
            $this->collection->setOrder('creation_time', 'DESC');
        }
        return $this->collection;
    }

    public function getPagerHtml()
    {
        $pagerBlock = $this->getChildBlock('feedback_list_pager');
         if ($pagerBlock instanceof \Magento\Framework\DataObject){
            $pagerBlock
                ->setUseContainer(false)
                ->setShowPerPage(false)
                ->setShowAmounts(false)
                ->setLimit($this->getLimit())
                ->setCollection($this->getFeedbackCollection());
            return $pagerBlock->toHtml();
        }
        return '';
    }

    public function getLimit()
    {
        return static::PAGE_SIZE;
    }

    public function getAddFeedbackUrl()
    {
        return $this->getUrl('training_feedback/index/form');
    }

    public function getFeedbackDate($feedback)
    {
        return $this->timezone->formatDateTime($feedback->getCreationTime());
    }

    public function getAllFeedbackNumber()
    {
        return $this->feedbackResource->getAllFeedbackNumber();
    }

    public function getActiveFeedbackNumber()
    {
        return $this->feedbackResource->getActiveFeedbackNumber();
    }

}