<?php

namespace BrunoDuarte\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\{ AbstractDb, Context };

class PostResource extends AbstractDB
{
    const TABLE_NAME = 'blog_post';
    const FIELD_NAME = 'post_id';
    
    public function __construct( Context $context )
    {
        parent::__construct( $context );
    }

    public function _construct(): void
    {
        $this->_init( self::TABLE_NAME, self::FIELD_NAME );
    }
}
