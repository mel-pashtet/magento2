<?php

namespace Training\Feedback\Controller\Adminhtml;

abstract class Index extends \Magento\Backend\App\Action
{
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Training_Feedback::feedback')
            ->addBreadcrumb(__('Feedback'), __('Feedback'));
        return $resultPage;
    }
}
