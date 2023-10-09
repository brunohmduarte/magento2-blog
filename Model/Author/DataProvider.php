<?php

namespace BrunoDuarte\Blog\Model\Author;

use BrunoDuarte\Blog\Model\ResourceModel\Author\Grid\Collection as AuthorCollection;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    public $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        AuthorCollection $authorCollection,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $authorCollection->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        // return [];

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();

        /** @var Customer $customer */
        foreach ($items as $author) {
            $this->loadedData[$author->getId()]['author'] = $author->getData();
        }

        return $this->loadedData;
    }
}
