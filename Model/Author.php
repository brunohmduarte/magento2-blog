<?php

namespace BrunoDuarte\Blog\Model;

use BrunoDuarte\Blog\Model\ResourceModel\Author as AuthorResourceModel;
use Magento\Framework\{
        DataObject\IdentityInterface,
        Model\AbstractModel,
        Model\Context,
        Registry
};

class Author extends AbstractModel implements IdentityInterface
{
    const NOROUTE_ENTITY_ID = 'no-route';
    const ENTITY_ID = 'author_id';
    const CACHE_TAG = 'blog_post';

    protected $_cacheTag = 'blog_authors_post';
    protected $_eventPrefix = 'blog_authors_post';

    public function __construct(Context $context, Registry $registry)
    {
        parent::__construct($context, $registry);
    }

    public function _construct()
    {
        $this->_init(AuthorResourceModel::class);
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

    public function saveOrUpdate(Array $data)
    {
        $date = $this->date->gmtDate();
        $id = (int) $data['author_id'];
        if ($id > 0) {
            // altera
        }
    }

}

