<?php

namespace BrunoDuarte\Blog\Controller\Adminhtml\Author;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Json\Helper\Data;
use Magento\Framework\Stdlib\DateTime\DateTime;
use BrunoDuarte\Blog\Model\Author;

class Save extends Action
{
    protected $request;
    protected $_authorFactory;
    protected $resultRedirectFactory;
    protected $jsonHelper;
    protected $date;

    public function __construct(
        Context $context,
        Author $authorFactory,
        Data $jsonHelper,
        DateTime $date
    ) {
        $this->jsonHelper = $jsonHelper;
        $this->date = $date;
        $this->_authorFactory = $authorFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue('author');
// var_dump($this->getRequest()->getParam('back')); exit;
        try {
            /** @var \BrunoDuarte\Blog\Model\Author $author */
            $author = $this->_objectManager->create(Author::class);
            $date = $this->date->gmtDate();
            $id = (int) $data['author_id'];

            if ($id > 0) {
                $author->load($id);
                $data['updated_at'] = $date;
            } else {
                unset($data['author_id']);
                $data['created_at'] = $date;
                $data['updated_at'] = $date;
            }

            $author->setData($data);
            $author->save();

        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(nl2br($e->getMessage()));
            return $resultRedirect->setPath('*/*/edit');
        }

        /**
         * @todo Verificar o redirecionamento correto do salvar e permanecer na tela de editar ou grid.
         */
        $redirectState = $this->getRequest()->getParam('back');
        if (!empty($redirectState) && $redirectState[0] == 'edit') {
            $this->messageManager->addSuccessMessage(__('The Author has been updated with success.'));
            return $resultRedirect->setPath('*/*/edit', ['author_id' => $id, '_current' => true]);
        }

        if (empty($redirectState)) {
            $this->messageManager->addSuccessMessage(__('The Author has been saved with success.'));
            return $resultRedirect->setPath('*/*/index');
        }

    }
}
