<?php
namespace Training\FeedbackProduct\Controller\Index;



use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Framework\App\Action\Action
{
    private $feedbackFactory;
    private $feedbackResource;
    private $feedbackDataLoader;
    private $eventManager;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Training\Feedback\Model\FeedbackFactory $feedbackFactory,
        \Training\Feedback\Model\ResourceModel\Feedback $feedbackResource,
        \Training\FeedbackProduct\Model\FeedbackDataLoader $feedbackDataLoader

    )
    {
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackResource = $feedbackResource;
        $this->feedbackDataLoader = $feedbackDataLoader;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->resultRedirectFactory->create();
        if($post = $this->getRequest()->getPostValue()){
            try{
                $this->validatePost($post);
                $feedback = $this->feedbackFactory->create();
                $feedback->setData($post);
                $this->setProductsToFeedback($feedback, $post);
                $this->feedbackResource->save($feedback);

                $this->messageManager->addSuccessMessage(
                    __('Thank you for your feedback.')
                );
            }catch (\Exception $e){
                $this->messageManager->addErrorMessage(
                    __('An error occurred while processing your form. Please try again later.')
                );
                $result->setPath('*/*/form');
                return $result;
            }

        }
        $result->setPath('*/*/index');
        return $result;
    }

    private function setProductsToFeedback($feedback, $post)
    {
        $skus = [];
        if (isset($post['products_skus']) && !empty($post['products_skus'])){
            $skus = explode(',', $post['products_skus']);
            $skus = array_map('trim', $skus);
            $skus = array_filter($skus);
        }
        $this->feedbackDataLoader->addProductsToFeedbackBySkus($feedback, $skus);
    }


    private function validatePost($post){
        if(!isset($post['author_name']) || trim($post['author_name']) === ''){
            throw new LocalizedException(__('Name is missing'));
        }
        if(!isset($post['message']) || trim($post['message']) === ''){
            throw new LocalizedException(__('Comment is missing'));
        }
        if(!isset($post['author_email']) || false === strpos($post['author_email'],'@')){
            throw new LocalizedException(__('Invalid email address'));
        }
        if(trim($this->getRequest()->getParam('hideit')) !== ''){
            throw new \Exception();
        }
    }
}