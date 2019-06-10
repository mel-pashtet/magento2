<?php
namespace Training\Feedback\Model\ResourceModel\Feedback;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_eventPrefix = 'training_feedback_collection';
    protected $_eventObject = 'feedback_collection';

    protected function _construct()
    {
        $this->_init(
            \Training\Feedback\Model\Feedback::class,
            \Training\Feedback\Model\ResourceModel\Feedback::class
        );
    }

}