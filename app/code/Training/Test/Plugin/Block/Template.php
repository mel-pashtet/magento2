<?php
/**
 * Created by PhpStorm.
 * User: pavelmelnichuk
 * Date: 5/6/19
 * Time: 9:22 PM
 */

namespace Training\Test\Plugin\Block;


class Template
{
    public function afterToHtml(
        \Magento\Framework\View\Element\Template $subject,
        $result
    ) {

        if ($subject->getNameInLayout() == 'top.search') {
            $result = '<div><p>' . $subject->getTemplate() . '</p>'
                . '<p>' . get_class($subject) . '</p>' . $result . '</div>';
        }
        return $result;
    }

}