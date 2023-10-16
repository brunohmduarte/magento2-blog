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
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $id = $this->getRequest()->getParam('id');
        if (empty($id)) {
            $this->messageManager->addError(__('Invalid author identifier.'));
            return $resultRedirect->setPath('*/*/edit', ['id'=>$id]);
        }

        try {
            /** @var \BrunoDuarte\Blog\Model\Author $author */
            $author = $this->_objectManager->create(Author::class);

            $author->load($id);
            if (empty($author->getData())) {
                $this->messageManager->addError(__('Author not found.'));
                return $resultRedirect->setPath('*/*/edit', ['id'=>$id]);
            }

            $author->delete();

            $this->messageManager->addSuccess(__('The Author has been removed.'));
            return $resultRedirect->setPath('*/*/index');

        } catch (Exception $e) {
            $this->messageManager->addError($e->getMessage());
            return $resultRedirect->setPath('*/*/edit', ['id'=>$id]);
        }
    }
}

