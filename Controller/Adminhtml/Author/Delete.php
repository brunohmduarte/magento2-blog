<?php

namespace BrunoDuarte\Blog\Controller\Adminhtml\Author;

use BrunoDuarte\Blog\Model\Author;
use Exception;
use Magento\Framework\App\Action\Action;

class Delete extends Action
{
    protected $resultRedirectFactory;

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if (empty($id)) {
            $this->messageManager->addError(__('Unable to remove author.'));
            return $resultRedirect->setPath('*/*/index');
        }

        try {
            /** @var \BrunoDuarte\Blog\Model\Author $author */
            $author = $this->_objectManager->create(Author::class);
            $author->load($id);
            $author->delete();

            $this->messageManager->addSuccess(__('The Author has been removed.'));
            return $resultRedirect->setPath('*/*/index');

        } catch (Exception $e) {
            $this->messageManager->addError($e->getMessage());
            return $resultRedirect->setPath('*/*/edit', ['id'=>$id]);
        }
    }
}

