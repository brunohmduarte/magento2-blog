<?php

namespace BrunoDuarte\Blog\Block\Adminhtml\Author\Edit\Tab;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Data\Form;
use Magento\Framework\Data\FormFactory;
// use Magento\Framework\Exception\LocalizedException;
// use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
// use Magento\Framework\UrlInterface;
use Magento\Store\Model\System\Store;
use BrunoDuarte\Blog\Block\Adminhtml\Renderer\Image;
// use BrunoDuarte\Blog\Helper\Data;
use BrunoDuarte\Blog\Helper\Image as ImageHelper;
// use BrunoDuarte\Blog\Model\Config\Source\AuthorStatus;

class Author extends Generic implements TabInterface
{
    /**
     * @var Store
     */
    public $systemStore;

    /**
     * @var Config
     */
    public $wysiwygConfig;

    /*
     * @var ImageHelper
     */
    protected $imageHelper;

    /**
     * @var AuthorStatus
     */
    protected $authorStatus;

    /*
     * @var Data
     *
    protected $_helperData;*/

    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /*
     * Author constructor.
     *
     * @param Config $wysiwygConfig
     * @param Store $systemStore
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param ImageHelper $imageHelper
     * @param AuthorStatus $authorStatus
     * @param Data $helperData
     * @param CustomerRepositoryInterface $customerRepository
     * @param array $data
     */
    public function __construct(
        Config $wysiwygConfig,
        Store $systemStore,
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        ImageHelper $imageHelper,
        // AuthorStatus $authorStatus,
        // Data $helperData,
        CustomerRepositoryInterface $customerRepository,
        array $data = []
    ) {
        $this->wysiwygConfig = $wysiwygConfig;
        $this->systemStore = $systemStore;
        $this->imageHelper = $imageHelper;
        // $this->authorStatus = $authorStatus;
        // $this->_helperData = $helperData;
        $this->customerRepository = $customerRepository;

        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @inheritdoc
     */
    protected function _prepareForm()
    {
        /** @var \BrunoDuarte\Blog\Model\Author $author */
        $author = $this->_coreRegistry->registry('brunoduarte_blog_author');

        /** @var Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('author_');
        $form->setFieldNameSuffix('author');
        $fieldset = $form->addFieldset('base_fieldset', [
            'legend' => __('Author Information'),
            'class' => 'fieldset-wide'
        ]);

        $authorId = ($author->getId()) ? $author->getId() : 0;

        $fieldset->addField('author_id', 'hidden', [
            'name' => 'author_id',
            'value' => $authorId
        ]);

        $fieldset->addField('name', 'text', [
            'name' => 'name',
            'label' => __('Name'),
            'title' => __('Name'),
            'required' => true,
            'note' => __('This name will be displayed on frontend')
        ]);

        $fieldset->addField('about', 'editor', [
            'name' => 'about',
            'label' => __('About'),
            'title' => __('About'),
            'note' => __('About'),
            'config' => $this->wysiwygConfig->getConfig([
                'add_variables' => false,
                'add_widgets' => false,
                'add_directives' => true
            ])
        ]);

        $fieldset->addField('image_path', Image::class, [
            'name' => 'image_path',
            'label' => __('Image'),
            'title' => __('Image'),
            'path' => $this->imageHelper->getBaseMediaPath(ImageHelper::TEMPLATE_MEDIA_TYPE_AUTH)
        ]);

        $form->addValues($author->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Author Info');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Get transaction grid url
     * @return string
     */
    public function getAjaxUrl()
    {
        return $this->getUrl('blog/author/customergrid');
    }
}
