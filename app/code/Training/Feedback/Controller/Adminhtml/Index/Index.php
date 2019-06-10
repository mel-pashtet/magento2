<?php
namespace Training\Feedback\Controller\Adminhtml\Index;

use Magento\Framework\App\Request\DataPersistorInterface;

class Index extends  \Training\Feedback\Controller\Adminhtml\Index
{

    const ADMIN_RESOURCE = 'Training_Feedback::feedback';


    protected $resultPageFactory;
    protected $dataPersistor;


    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        DataPersistorInterface $dataPersistor
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }


    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->getConfig()->getTitle()->prepend(__('Feedback'));

        $this->dataPersistor->clear('feedback');

        return $resultPage;
    }



}