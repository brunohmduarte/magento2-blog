<?php

namespace BrunoDuarte\Blog\Block\Adminhtml\Post\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

abstract class GenericButton
{
    /**
     * Url Builder
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    protected $context;

    public function __construct(Context $context, Registry $registry)
    {
        $this->urlBuilder = $context->getUrlBuilder();
        // $this->context  =  $context;
        $this->registry = $registry;
    }

    public function getId()
    {
        // return $this->context->getRequest()->getParam('id');
        $post = $this->registry->registry('post');
        return $post ? $post->getId() : null;
    }

    public function getUrl($route = '', $params = [])
    {
        // return $this->context->getUrlBuilder()->getUrl($route, $params);
        return $this->urlBuilder->getUrl($route, $params);
    }
}
