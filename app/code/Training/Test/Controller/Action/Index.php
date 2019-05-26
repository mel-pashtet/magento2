<?php
/**
 * Created by PhpStorm.
 * User: pavelmelnichuk
 * Date: 5/24/19
 * Time: 1:09 AM
 */

namespace Training\Test\Controller\Action;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\RawFactory
     */
    private $resultRawFactory;
    /**
     * @var \Magento\Framework\View\LayoutFactory
     */
    private $layoutFactory;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
     * @param \Magento\Framework\View\LayoutFactory $layoutFactory
     */
//\Magento\Framework\View\Element\Template
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        \Magento\Framework\View\LayoutFactory $layoutFactory
    ) {
        $this->resultRawFactory = $resultRawFactory;
        $this->layoutFactory = $layoutFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock('Magento\Framework\View\Element\Template');
        $block->setTemplate('Training_Test::test.phtml');
        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultRawFactory->create();
        return $this->resultRawFactory->create()->setContents($block->toHtml());
    }
}