<?php

namespace Training\Feedback\Controller\Adminhtml\Index;

use Magento\Framework\Exception\NoSuchEntityException;

class Edit extends \Training\Feedback\Controller\Adminhtml\Index
{
    const ADMIN_RESOURCE = 'Training_Feedback::feedback_save';
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;
    private $feedbackRepository;
    private $feedbackFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Training\Feedback\Api\FeedbackRepositoryInterface $feedbackRepository,
        \Training\Feedback\Model\FeedbackFactory $feedbackFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->feedbackRepository = $feedbackRepository;
        $this->feedbackFactory = $feedbackFactory;
        parent::__construct($context);
    }


    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('feedback_id');
        $model = $this->feedbackFactory->create();
        
        // 2. Initial checking VIA REPOSITORY
        if ($id) {
            try {
                $model = $this->feedbackRepository->getById($id);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This feedback no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        
        // 2. Initial checking VIA RESOURCE MODEL
//        if ($id) {
//            $this->postResource->load($model, $id);
//            if (!$model->getId()) {
//                $this->messageManager->addErrorMessage(__('This post no longer exists.'));
//                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
//                $resultRedirect = $this->resultRedirectFactory->create();
//                return $resultRedirect->setPath('*/*/');
//            }
//        }

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit feedback') : __('New feedback'),
            $id ? __('Edit feedback') : __('New feedback')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Feedback'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New feedback'));
        return $resultPage;
    }
}
