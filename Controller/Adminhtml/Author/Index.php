<?php

namespace BrunoDuarte\Blog\Controller\Adminhtml\Author;

use Magento\Backend\App\{Action, Action\Context};
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct( Context $context, PageFactory $resultPageFactory )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Author's list page
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('BrunoDuarte_Blog::author');
        $resultPage->getConfig()->getTitle()->prepend((__('Authors')));
        return $resultPage;
    }

}
