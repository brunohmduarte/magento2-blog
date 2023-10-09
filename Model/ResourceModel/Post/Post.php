<?php

namespace BrunoDuarte\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Post extends AbstractDb
{
    protected $_store = null;
    
    protected $_storeManager;

    public function __construct(Context $context, $connectionName = null)
    {
        parent::__construct($context, $connectionName);
    }

    protected function _construct()
    {
        $this->_init('blog_post', 'post_id');
    }

    public function load(AbstractModel $object, $value, $field = null)
    {
        if ( !is_numeric($value) && is_null($field) ){
            $field = 'identities';
        }
        return parent::load($object, $value, $field);
    }

    public function setStore($store)
    {
        $this->_store = $store;
        return $this;
    }

    public function getStore()
    {
        return $this->_storeManager->getStore($this->_store);
    }
}
