<?php
namespace Training\FeedbackProduct\Plugin\Model;


class FeedbackExtension
{
    private  $extensionAttributesFactory;

    public function __construct(
        \Training\Feedback\Api\Data\FeedbackExtensionInterfaceFactory $extensionAttributesFactory
    )
    {
        $this->extensionAttributesFactory = $extensionAttributesFactory;
    }

    public function afterGetExtensionAttributes(
        \Training\Feedback\Api\Data\FeedbackInterface $subject,
        $result
    ){
        if(!is_null($result)){
            return $result;
        }
        $extensionAttributes = $this->extensionAttributesFactory->create();
        $subject->setExtensionAttributes($extensionAttributes);

        return $extensionAttributes;
    }
}