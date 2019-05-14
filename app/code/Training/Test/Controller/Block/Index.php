<?php


namespace Training\Test\Controller\Block;


class Index extends \Magento\Framework\App\Action\Action
{
    private $rawFactory;
    /**
     * @var \Magento\Framework\View\LayoutFactory
     */
    private $layoutFactory;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\LayoutFactory $layoutFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Magento\Framework\Controller\Result\RawFactory $rawFactory
    ) {
        $this->layoutFactory = $layoutFactory;
        $this->rawFactory = $rawFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock('Training\Test\Block\Test');
        return $this->rawFactory->create()->setContents($block->toHtml());

    }
}