<?php

namespace BrunoDuarte\Blog\Model;

use Magento\Framework\{ Model\AbstractModel, Model\Context, Registry };
use BrunoDuarte\Blog\Model\ResourceModel\PostResource;

class Post extends AbstractModel
{
    protected $_cacheTag = 'blog_post';

    protected $_eventPrefix = 'blog_post';

    public function __construct( Context $context, Registry $registry )
    {
        parent::__construct($context, $registry);
    }

    public function _contruct(): void
    {
        $this->_init(PostResource::class);
    }
}

