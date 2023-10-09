<?php

namespace BrunoDuarte\Blog\Ui\DataProvider\Author\Listing;

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
        $this->addFilterToMap('author_id', 'main_table.author_id');
        parent::_initSelect();
    }
}
