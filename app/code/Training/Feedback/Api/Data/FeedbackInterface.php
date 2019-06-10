<?php

namespace Training\Feedback\Api\Data;

interface FeedbackInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const FEEDBACK_ID   = 'feedback_id';
    const AUTHOR_NAME   = 'author_name';
    const AUTHOR_EMAIL  = 'author_email';
    const MESSAGE       = 'message';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME   = 'update_time';
    const IS_ACTIVE     = 'is_active';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get author name
     *
     * @return string
     */
    public function getAuthorName();

    /**
     * Get author email
     *
     * @return string|null
     */
    public function getAuthorEmail();

    /**
     * Get message
     *
     * @return string|null
     */
    public function getMessage();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    public function getExtensionAttributes();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive();

    /**
     * Set ID
     *
     * @param int $id
     * @return FeedbackInterface
     */
    public function setId($id);

    /**
     * Set author name
     *
     * @param string $authorName
     * @return FeedbackInterface
     */
    public function setAuthorName($authorName);

    /**
     * Set author email
     *
     * @param string $authorEmail
     * @return FeedbackInterface
     */
    public function setAuthorEmail($authorEmail);

    /**
     * Set message
     *
     * @param string $message
     * @return FeedbackInterface
     */
    public function setMessage($message);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return FeedbackInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return FeedbackInterface
     */
    public function setUpdateTime($updateTime);

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return FeedbackInterface
     */
    public function setIsActive($isActive);

    public function setExtensionAttributes(
        \Training\Feedback\Api\Data\FeedbackInterface $extensionAttributes
    );


}
