<?php

namespace BrunoDuarte\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\{ AbstractDb, Context };

class Author extends AbstractDb
{
    public function __construct( Context $context )
    {
        parent::__construct( $context  );
    }

    public function _construct()
    {
        $this->_init('blog_authors_post', 'author_id');
    }
}
