<?php

namespace BrunoDuarte\Blog\Controller\Index;

use BrunoDuarte\Blog\Controller\AbstractPost;
use Magento\Framework\App\Action\{Context, HttpGetActionInterface};
use Magento\Framework\View\Result\PageFactory;

class Index extends AbstractPost implements HttpGetActionInterface
{
    protected PageFactory $_resultPageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->_resultPageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->_resultPageFactory->create();
    }
}

