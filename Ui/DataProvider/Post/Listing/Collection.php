<?php

namespace BrunoDuarte\Blog\Ui\DataProvider\Post\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    /**
     * Override _initSelect to add custom columns
     *
     * @return void
     */
    protected function _initSelect()
    {
        $this->addFilterToMap('post_id', 'main_table.post_id');
        parent::_initSelect();
    }
}
