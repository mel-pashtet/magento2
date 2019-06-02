<?php
/**
 * Created by PhpStorm.
 * User: pavelmelnichuk
 * Date: 6/2/19
 * Time: 12:06 PM
 */

namespace Training\Render\ViewModel;

class Form implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
//    private $urlBuilder;
    /**
     * @param \Magento\Framework\UrlInterface $urlBuilder
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }
    public function getSubmitUrl()
    {
        return $this->urlBuilder->getUrl('customer/account/login');
    }

}