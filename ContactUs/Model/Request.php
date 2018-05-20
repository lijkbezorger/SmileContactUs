<?php
/**
 *  Model for request
 *
 * @category  Smile
 * @package   Smile\ContactUs
 * @author    Yaroslav Velychko <lijkbezorger@gmail.com>
 * @copyright 2018 Yaroslav Velychko
 */

namespace Smile\ContactUs\Model;


use Magento\Framework\Model\AbstractModel;
use Smile\ContactUs\Api\Data\RequestInterface;

class Request extends AbstractModel implements RequestInterface
{

    protected function _construct()
    {
        $this->_init('Smile\ContactUs\Model\ResourceModel\Request');
    }

    /**
     * Name of object id field
     *
     * @var string
     */
    protected $idFieldName = RequestInterface::ID;

    /**
     * Get topic
     *
     * @return string
     */
    public function getTopic()
    {
        return $this->getData(RequestInterface::TOPIC);
    }

    /**
     * Set topic
     *
     * @param string $topic
     *
     * @return RequestInterface
     */
    public function setTopic($topic)
    {
        $this->setData(RequestInterface::TOPIC, $topic);

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(RequestInterface::EMAIL);
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return RequestInterface
     */
    public function setEmail($email)
    {
        $this->setData(RequestInterface::EMAIL, $email);

        return $this;
    }

    /**
     * Get request text
     *
     * @return string
     */
    public function getRequestText()
    {
        return $this->getData(RequestInterface::REQUEST_TEXT);
    }

    /**
     * Set request text
     *
     * @param string $requestText
     *
     * @return RequestInterface
     */
    public function setRequestText($requestText)
    {
        $this->setData(RequestInterface::REQUEST_TEXT, $requestText);

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(RequestInterface::STATUS);
    }

    /**
     * Set status
     *
     * @param int $status
     *
     * @return RequestInterface
     */
    public function setStatus($status)
    {
        $this->setData(RequestInterface::STATUS, $status);

        return $this;
    }

    /**
     * Get created at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(RequestInterface::CREATED_AT);
    }


    /**
     * Get status
     *
     * @return int
     */
    public function getUpdatedAt()
    {
        return $this->getData(RequestInterface::UPDATED_AT);
    }

}