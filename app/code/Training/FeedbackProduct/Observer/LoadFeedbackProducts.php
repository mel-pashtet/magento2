<?php

namespace Training\FeedbackProduct\Observer;

use Magento\Framework\Event\ObserverInterface;

class LoadFeedbackProducts implements ObserverInterface
{
    private $feedbackProducts;
    public function __construct(
        \Training\FeedbackProduct\Model\FeedbackProducts $feedbackProducts
    ) {
        $this->feedbackProducts = $feedbackProducts;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $feedback = $observer->getFeedback();
        $this->feedbackProducts->loadProductRelations($feedback);
    }
}