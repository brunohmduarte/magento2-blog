<?php

namespace BrunoDuarte\Blog\Ui\DataProvider\Author;

use BrunoDuarte\Blog\Model\ResourceModel\Author\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
// use Magento\Store\Model\Store;
// use Magento\Ui\DataProvider\Modifier\PoolInterface;

/**
 * Summary of AuthorDataProvider
 */
class AuthorDataProvider extends AbstractDataProvider
{
    /**
     * Author collection
     *
     * @var \BrunoDuarte\Blog\Model\ResourceModel\Author\Grid\Collection
     */
    protected $collection;

    /**
     * @var \Magento\Ui\DataProvider\AddFieldToCollectionInterface[]
     */
    protected $addFieldStrategies;

    /**
     * @var \Magento\Ui\DataProvider\AddFilterToCollectionInterface[]
     */
    protected $addFilterStrategies;

    /**
     * @var PoolInterface
     */
    private $modifiersPool;

    /**
     * @param mixed $name
     * @param mixed $primaryFieldName
     * @param mixed $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        // array $addFieldStrategies,
        // array $addFilterStrategies,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        // $this->addFieldStrategies = $addFieldStrategies;
        // $this->addFilterStrategies = $addFilterStrategies;
        // $this->collection->setStoreId(Store::DEFAULT_STORE_ID);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }
        $items = $this->getCollection()->toArray();

        $data = [
            'totalRecords' => $this->getCollection()->getSize(),
            'items' => array_values($items),
        ];

        /* @var ModifierInterface $modifier *
        foreach ($this->modifiersPool->getModifiersInstances() as $modifier) {
            $data = $modifier->modifyData($data);
        }*/

        return $data;
    }

    /**
     * Add field to select
     *
     * @param string|array $field
     * @param string|null $alias
     * @return void
     */
    public function addField($field, $alias = null)
    {
        parent::addField($field, $alias);
        // if (isset($this->addFieldStrategies[$field])) {
        //     $this->addFieldStrategies[$field]->addField($this->getCollection(), $field, $alias);
        // } else {
        //     parent::addField($field, $alias);
        // }
    }

    /**
     * @inheritdoc
     */
    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        parent::addFilter($filter);
        // if (isset($this->addFilterStrategies[$filter->getField()])) {
        //     $this->addFilterStrategies[$filter->getField()]
        //         ->addFilter(
        //             $this->getCollection(),
        //             $filter->getField(),
        //             [$filter->getConditionType() => $filter->getValue()]
        //         );
        // } else {
        //     parent::addFilter($filter);
        // }
    }

    /**
     * @inheritdoc
     * @since 103.0.0
     */
    public function getMeta()
    {
        $meta = parent::getMeta();

        /* @var ModifierInterface $modifier *
        foreach ($this->modifiersPool->getModifiersInstances() as $modifier) {
            $meta = $modifier->modifyMeta($meta);
        }*/

        return $meta;
    }
}

