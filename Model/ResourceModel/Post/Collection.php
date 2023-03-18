<?php

namespace BrunoDuarte\Blog\Model\ResourceModel\Post;

use BrunoDuarte\Blog\Model\{ Post\PostResource, Post };
use Magento\Framework\Data\Collection\{ Db\FetchStrategyInterface, EntityFactoryInterface };
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\{ Collection\AbstractCollection, AbstractDb };
use Psr\Log\LoggerInterface;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'post_id';

    protected $_eventPrefix = 'blog_post_collection';

    protected $_eventObject = 'blog_post_collection';

    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        AdapterInterface $connection = null,
        AbstractDb $resource = null
    ) {
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $connection,
            $resource
        );
    }

    protected function _construct(): void
    {
        $this->_init( Post::class, PostResource::class );
    }
}

