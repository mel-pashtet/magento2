<?php
/**
 * Created by PhpStorm.
 * User: pavelmelnichuk
 * Date: 5/6/19
 * Time: 10:20 PM
 */

namespace Training\Test\Plugin\Controller\Product;


class View
{
    protected $customerSession;
    protected $redirectFactory;
    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory
    ) {
        $this->customerSession = $customerSession;
        $this->redirectFactory = $redirectFactory;
    }
    public function aroundExecute(
        \Magento\Catalog\Controller\Product\View $subject,
        \Closure $proceed
    ) {
        if (!$this->customerSession->isLoggedIn()) {
            return $this->redirectFactory->create()->setPath('customer/account/login');
        }
        return $proceed();
    }

}