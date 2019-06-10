<?php
namespace Training\Feedback\Controller\Adminhtml\Index;

use Magento\Framework\Exception\LocalizedException;
use Magento\Backend\App\Action\Context;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Training_Feedback::feedback_delete';

    private $feedbackRepository;
    

    public function __construct(
        Context $context,
        \Training\Feedback\Api\FeedbackRepositoryInterface $feedbackRepository
    ) {
        $this->feedbackRepository = $feedbackRepository;
        parent::__construct($context);
    }


    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('feedback_id');
        if ($id) {
            try {
                $this->feedbackRepository->deleteById($id);
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the feedback.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['feedback_id' => $id]);
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage(__('We can\'t delete the feedback.'));
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['feedback_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a feedback to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
