<?php

namespace BrunoDuarte\Blog\Model;

use Magento\Framework\{
        DataObject\IdentityInterface,
        Model\AbstractModel,
        Model\Context,
        Registry
    };
use BrunoDuarte\Blog\Model\ResourceModel\Post as PostResourceModel;

class Post extends AbstractModel implements IdentityInterface
{
    const NOROUTE_ENTITY_ID = 'no-route';
    const ENTITY_ID = 'post_id';
    const CACHE_TAG = 'blog_post';

    protected $_cacheTag = 'blog_post';
    protected $_eventPrefix = 'blog_post';

    public function __construct(Context $context, Registry $registry)
    {
        parent::__construct($context, $registry);
    }

    public function _construct()
    {
        $this->_init(PostResourceModel::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }

    public function load($id, $field = null)
    {
        if ($id === null) {
            return $this->noRoute();
        }
        return parent::load($id, $field);
    }

    public function noRoute()
    {
        return  $this->load(self::NOROUTE_ENTITY_ID, $this->getIdFieldName());
    }

    public function getId()
    {
        return parent::getData(self::ENTITY_ID);
    }

    public function setId($id)
    {
        return $this->getData(self::ENTITY_ID, $id);
    }

}

