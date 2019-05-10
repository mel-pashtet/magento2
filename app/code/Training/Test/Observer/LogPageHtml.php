<?php
/**
 * Created by PhpStorm.
 * User: pavelmelnichuk
 * Date: 5/7/19
 * Time: 9:08 PM
 */

namespace Training\Test\Observer;

use Magento\Framework\Event\ObserverInterface;

class LogPageHtml implements ObserverInterface
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;
    /**
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $response = $observer->getEvent()->getData('response');
        $this->logger->info($response->getBody());
    }
}