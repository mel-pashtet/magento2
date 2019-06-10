<?php
namespace Training\Feedback\Model;

use Training\Feedback\Api\Data;
use Training\Feedback\Api\FeedbackRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Training\Feedback\Model\ResourceModel\Feedback as FeedbackResource;
use Training\Feedback\Api\Data\FeedbackInterfaceFactory as FeedbackFactory;
use Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory as FeedbackCollectionFactory;

class FeedbackRepository implements FeedbackRepositoryInterface
{
    /**
     * @var FeedbackResource
     */
    private $resource;

    /**
     * @var FeedbackFactory
     */
    private $feedbackFactory;

    /**
     * @var FeedbackCollectionFactory
     */
    private $feedbackCollectionFactory;

    /**
     * @var Data\FeedbackSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param FeedbackResource $resource
     * @param FeedbackFactory $feedbackFactory
     * @param FeedbackCollectionFactory $feedbackCollectionFactory
     * @param Data\FeedbackSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        FeedbackResource $resource,
        FeedbackFactory $feedbackFactory,
        FeedbackCollectionFactory $feedbackCollectionFactory,
        Data\FeedbackSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackCollectionFactory = $feedbackCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Save Feedback data
     *
     * @param \Training\Feedback\Api\Data\FeedbackInterface $feedback
     * @return \Training\Feedback\Api\Data\FeedbackInterface
     * @throws CouldNotSaveException
     */
    public function save(\Training\Feedback\Api\Data\FeedbackInterface $feedback)
    {
        try {
            $this->resource->save($feedback);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the feedback: %1', $exception->getMessage()),
                $exception
            );
        }
        return $feedback;
    }

    /**
     * Load Feedback data by given Feedback Identity
     *
     * @param string $feedbackId
     * @return \Training\Feedback\Api\Data\FeedbackInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($feedbackId)
    {
        $feedback = $this->feedbackFactory->create();
        $this->resource->load($feedback, $feedbackId);
        if (!$feedback->getId()) {
            throw new NoSuchEntityException(__('feedback with id "%1" does not exist.', $feedbackId));
        }
        return $feedback;
    }






    /**
     * Load feedback data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Training\Feedback\Api\Data\FeedbackSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var \Training\Feedback\Model\ResourceModel\Feedback\Collection $collection */
        $collection = $this->feedbackCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /** @var Data\FeedbackSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete Feedback
     *
     * @param \Training\Feedback\Api\Data\FeedbackInterface $feedback
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\Training\Feedback\Api\Data\FeedbackInterface $feedback)
    {
        try {
            $this->resource->delete($feedback);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Feedback: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * Delete Feedback by given Feedback Identity
     *
     * @param string $feedbackId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($feedbackId)
    {
        return $this->delete($this->getById($feedbackId));
    }
}
