<?php
namespace Training\FeedbackProduct\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SaveFeedbackProducts implements ObserverInterface
{
    private $feedbackProducts;

    public function __construct(
        \Training\FeedbackProduct\Model\FeedbackProducts $feedbackProducts
    )
    {
       $this->feedbackProducts = $feedbackProducts;
    }

    public function execute(Observer $observer)
    {
        $feedback= $observer->getEvent()->getFeedback();
        $this->feedbackProducts->saveProductRelations($feedback);
    }
}