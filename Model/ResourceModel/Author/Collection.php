<?php

namespace BrunoDuarte\Blog\Model\ResourceModel\Author;

use Magento\Framework\Data\Collection\{ EntityFactoryInterface, Db\FetchStrategyInterface };
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\{ Collection\AbstractCollection, AbstractDb };
use Psr\Log\LoggerInterface;
use BrunoDuarte\Blog\Model\Author;
use BrunoDuarte\Blog\Model\ResourceModel\Author as AuthorResourceModel;
use Magento\Store\Model\StoreManagerInterface;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'author_id';

    protected $_eventPrefix = 'blog_authors_post_collection';

    protected $_eventObject = 'blog_authors_post_collection';

    protected $_storeManager;

    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        StoreManagerInterface $storeManager,
        AdapterInterface  $connection = null,
        AbstractDb $resource = null
    ){
        parent::__construct(
            $entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource
        );
        $this->_storeManager = $storeManager;
    }

    protected function _construct()
    {
        $this->_init(Author::class, AuthorResourceModel::class);
        $this->_map['fields']['author_id'] = 'main_table.author_id';
    }

}
