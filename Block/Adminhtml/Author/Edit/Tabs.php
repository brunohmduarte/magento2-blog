<?php

namespace BrunoDuarte\Blog\Block\Adminhtml\Author\Edit;

use Magento\Backend\Block\Widget\Tabs as TabsNative;

class Tabs extends TabsNative
{
    /**
     * constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();

        $this->setId('author_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Author Information'));
    }
}

