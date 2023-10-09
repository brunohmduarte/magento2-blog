<?php

namespace BrunoDuarte\Blog\Model\Post;

use BrunoDuarte\Blog\Model\ResourceModel\Post\Grid\Collection;
use Magento\Ui\DataProvider\AbstractDataProvider;


//  https://www.pierrefay.com/magento2-training/form-component-backend-crud-admin.html

class DataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    public $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Collection $collectionFactory,
        array $meta=[],
        array $data=[]
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        /**
         * @todo Remover este retorno.
         */
        // return [];

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = [];

        foreach ($items as $post) {
            $this->loadedData[$post->getId()]['post'] = $post->getData();
        }

        return $this->loadedData;
    }
}
