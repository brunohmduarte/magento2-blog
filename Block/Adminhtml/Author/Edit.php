<?php

namespace BrunoDuarte\Blog\Block\Adminhtml\Author;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Registry;
use BrunoDuarte\Blog\Model\Author;

class Edit extends Container
{
    const ACTION_DELETE_URL = 'delete';
    const ACTION_EDIT_URL = 'edit';

    /**
     * @var Registry
     */
    public $coreRegistry;

    /**
     * Edit constructor.
     *
     * @param Context $context
     * @param Registry $coreRegistry
     * @param array $data
     */
    public function __construct( Context $context, Registry $coreRegistry, array $data = [] )
    {
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize Post edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'author_id';
        $this->_blockGroup = 'BrunoDuarte_Blog';
        $this->_controller = 'adminhtml_author';

        parent::_construct();

        $this->buttonList->add('save-and-continue', [
            'label' => __('Save And Continue Edit'),
            'data_attribute' => [
                'mage-init' => [
                    'button' => [
                        'event' => 'saveAndContinueEdit',
                        'target' => '#edit_form'
                    ]
                ]
            ]
        ], -100);

        $this->buttonList->add('delete', [
            'label' => __('Delete'),
            'class' => 'delete',
            'onclick' => 'deleteConfirm(\''
                . __('Are you sure you want to delete this author?')
                . '\', \'' . $this->getEditPageUrl(self::ACTION_DELETE_URL) . '\')',
        ], -101);

        // $this->buttonList->add(
        //     'delete',
        //     [
        //         'label' => __('Delete'),
        //         'class' => 'delete',
        //         'onclick' => "setLocation('{$this->getUrl('blog/author/delete', [
        //             'id' => $this->getCurrentAuthor()->getId(),
        //             '_current' => true,
        //             'back' => 'edit'
        //         ])}')",
        //     ],
        //     -101
        // );
    }

    /**
     * Retrieve text for header element depending on loaded Post
     *
     * @return string
     */
    public function getHeaderText()
    {
        /** @var Author $author */
        $author = $this->getCurrentAuthor();
        if ($author->getId()) {
            return __("Edit Author '%1'", $this->escapeHtml($author->getName()));
        }

        return __('New Author');
    }

    /**
     * @return Author
     */
    public function getCurrentAuthor()
    {
        return $this->coreRegistry->registry('brunoduarte_blog_author');
    }

    /**
    * Get URL for delete button
    *
    * @return string
    */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['id'=>$this->getRequest()->getParam('id')]);
    }

    /**
     * Get URL for Edit Page with Action currect.
     *
     * @return string
     */
    public function getEditPageUrl(String $action)
    {
        return $this->getUrl("*/*/{$action}", ['id'=>$this->getRequest()->getParam('id')]);
    }
}
