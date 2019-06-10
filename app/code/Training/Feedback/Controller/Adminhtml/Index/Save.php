<?php

namespace Training\Feedback\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Training_Feedback::feedback_save';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    private $feedbackRepository;
    
    private $feedbackFactory;


    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param \Training\Feedback\Api\FeedbackRepositoryInterface $feedbackRepository
     * @param \Training\Feedback\Model\FeedbackFactory $feedbackFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        \Training\Feedback\Api\FeedbackRepositoryInterface $feedbackRepository,
        \Training\Feedback\Model\FeedbackFactory $feedbackFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->feedbackRepository = $feedbackRepository;
        $this->feedbackFactory = $feedbackFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = \Training\Feedback\Model\Feedback::STATUS_ACTIVE;
            }
            if (empty($data['feedback_id'])) {
                $data['feedback_id'] = null;
            }

            $model = $this->feedbackFactory->create();

            $id = $this->getRequest()->getParam('feedback_id');
            if ($id) {
                try {
                    $model = $this->feedbackRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This feedbeck no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->feedbackRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the post.'));
                $this->dataPersistor->clear('feedback');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['feedback_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the post.'));
            }

            $this->dataPersistor->set('feedback', $data);
            return $resultRedirect->setPath('*/*/edit', ['post_id' => $this->getRequest()->getParam('post_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
