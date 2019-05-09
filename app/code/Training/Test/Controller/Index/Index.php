<?php
/**
 * Created by PhpStorm.
 * User: pavelmelnichuk
 * Date: 5/9/19
 * Time: 7:47 PM
 */

namespace Training\Test\Controller\Index;


use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    private $resultRawFactory;
    public function __construct(Context $context, \Magento\Framework\Controller\Result\RawFactory $factory)
    {
        $this->resultRawFactory = $factory;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->resultRawFactory->create()->setContents('simple text');
    }
}