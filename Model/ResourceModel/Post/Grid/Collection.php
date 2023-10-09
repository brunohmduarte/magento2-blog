<?php

namespace BrunoDuarte\Blog\Model\ResourceModel\Post\Grid;

use BrunoDuarte\Blog\Model\Post;
use BrunoDuarte\Blog\Model\ResourceModel\Post as PostResourceModel;
use Magento\Framework\Data\Collection\{ EntityFactoryInterface, Db\FetchStrategyInterface };
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\{ Collection\AbstractCollection, AbstractDb };
use Psr\Log\LoggerInterface;


class Collection extends AbstractCollection
{
    protected $_idFieldName = 'post_id';

    protected $_eventPrefix = 'blog_post_collection';

    protected $_eventObject = 'blog_post_collection';

    protected $_storeManager;

    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        AdapterInterface  $connection = null,
        AbstractDb $resource = null
    ){
        parent::__construct(
            $entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource
        );
        // $this->_storeManager = $storeManager;
    }

    protected function _construct()
    {
        $this->_init(Post::class, PostResourceModel::class);
        $this->_map['fields']['post_id'] = 'main_table.post_id';
    }

    public function addStoreFilter($store, $withAdmin = true)
    {
        if ( !$this->getFlag('store_filter_added') ){
            // $this->performAddStoreFilter($store, $withAdmin);
        }
        return $this;
    }

    protected function _initSelect()
    {
        // parent::_initSelect();
        $this->getSelect()
            ->from(
                ['main_table' => $this->getResource()->getMainTable()]
            )->join(
                [ 'post_author' => $this->getTable('blog_authors_post') ],
                'main_table.author_id = post_author.author_id'
            );
        return $this;
    }

}
