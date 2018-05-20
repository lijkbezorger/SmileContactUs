<?php
/**
 * Resource model interface of Request entity
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Api\Data;


interface RequestInterface
{
    /**#@+
     * Consts table columns
     */
    const ID = 'id';
    const TOPIC = 'topic';
    const EMAIL = 'email';
    const REQUEST_TEXT = 'request_text';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**@#-*/

    /**
     *
     */
    const TABLE_NAME = 'smile_contact_us_request';

    /**
     * Get topic
     *
     * @return string
     */
    public function getTopic();

    /**
     * Set topic
     *
     * @param string $topic
     *
     * @return RequestInterface
     */
    public function setTopic($topic);

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set email
     *
     * @param string $email
     *
     * @return RequestInterface
     */
    public function setEmail($email);


    /**
     * Get request text
     *
     * @return string
     */
    public function getRequestText();

    /**
     * Set request text
     *
     * @param string $requestText
     *
     * @return RequestInterface
     */
    public function setRequestText($requestText);

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus();

    /**
     * Set status
     *
     * @param int $status
     *
     * @return RequestInterface
     */
    public function setStatus($status);

    /**
     * Get created at
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Get updated at
     *
     * @return string
     */
    public function getUpdatedAt();


}