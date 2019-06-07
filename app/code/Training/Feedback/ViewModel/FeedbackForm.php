<?php
namespace Training\Feedback\ViewModel;


class FeedbackForm implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    private $urlBuilder;

    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }
    public function getActionUrl()
    {
        return $this->urlBuilder->getUrl('training_feedback/index/save/');
    }


}