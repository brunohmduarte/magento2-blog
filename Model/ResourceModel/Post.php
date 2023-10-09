<?php

namespace BrunoDuarte\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\{ AbstractDb, Context };

class Post extends AbstractDb
{
    public function __construct( Context $context )
    {
        parent::__construct( $context  );
    }

    public function _construct()
    {
        $this->_init('blog_post', 'post_id');
    }
}
