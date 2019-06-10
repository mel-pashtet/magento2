<?php
namespace Training\Feedback\Controller\Index;


use Magento\Framework\App\Action\Context;

class Test extends \Magento\Framework\App\Action\Action
{
    private $feedbackFactory;
    private $feedbackRepository;
    private $searchCriteriaBuilder;
    private $sortOrderBuilder;

    public function __construct(
        Context $context,
        \Training\Feedback\Api\Data\FeedbackInterfaceFactory $feedbackFactory,
        \Training\Feedback\Api\FeedbackRepositoryInterface $feedbackRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder
    )
    {
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackRepository = $feedbackRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        parent::__construct($context);
    }

    public function execute()
    {
        //create new item
        $newFeedback = $this->feedbackFactory->create();
        $newFeedback->setAuthorName('some name');
        $newFeedback->setAuthorEmail('test@test.com');
        $newFeedback->setMessage('qdqfsjv fasjfb efkawjfkj dbsddadbdvvz');
        $newFeedback->setIsActive(1);
        $this->feedbackRepository->save($newFeedback);

//         load item by id
        $feedback = $this->feedbackRepository->getById(1);
        $this->printFeedback($feedback);

//        update item
        $feedbackToUpdate = $this->feedbackRepository->getById(2);
        $feedbackToUpdate->setMessage('CUSTOM'.$feedbackToUpdate->getMessage());
        $this->feedbackRepository->save($feedbackToUpdate);

//        delete feedback
        $this->feedbackRepository->deleteById(21);

        // load multiple items
        $this->searchCriteriaBuilder
            ->addFilter('is_active', 1);
        $sortOrder = $this->sortOrderBuilder
            ->setField('feedback_id')
            ->setAscendingDirection()
            ->create();
        $this->searchCriteriaBuilder->addSortOrder($sortOrder);

        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResult = $this->feedbackRepository->getList($searchCriteria);
        foreach ($searchResult->getItems() as $item){
            $this->printFeedback($item);

        }
        exit();
    }

    private function printFeedback($feedback)
    {
        echo $feedback->getId() . ':'
            . $feedback->getAuthorName().' : '
            . $feedback->getMessage().' - '
            .'('.$feedback->getAuthorEmail(). ')';
        echo"<br/>\n";
    }
}