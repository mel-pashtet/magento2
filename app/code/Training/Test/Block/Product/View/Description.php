<?php
/**
 * Created by PhpStorm.
 * User: pavelmelnichuk
 * Date: 5/24/19
 * Time: 12:13 AM
 */

namespace Training\Test\Block\Product\View;


class Description extends \Magento\Catalog\Block\Product\View\Description
{
    public function beforeToHtml(

        \Magento\Catalog\Block\Product\View\Description $subject
    ) {
        $subject->getProduct()->setDescription('Test description');
    }

}