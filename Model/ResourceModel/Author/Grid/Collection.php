<?php

namespace BrunoDuarte\Blog\Model\ResourceModel\Author\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    /**
     * @return $this|SearchResult|void
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->getSelect()->joinLeft(
            ['post' => $this->getTable('blog_post')],
            'main_table.author_id = post.author_id',
            ['qty_post' => 'COUNT(post_id)']
        )->group('main_table.author_id');
        $this->addFilterToMap('name', 'main_table.name');
        return $this;
    }
    
    /**
     * @param array|string $field
     * @param null $condition
     *
     * @return SearchResult
     */
    public function addFieldToFilter($field, $condition = null)
    {
        if ($field === 'qty_post') {
            foreach ($condition as $key => $value) {
                if ($key === 'like') {
                    $this->getSelect()->having('COUNT(post_id) LIKE ?', $value);
                }
            }
            return $this;
        }
        return parent::addFieldToFilter($field, $condition);
    }
}
