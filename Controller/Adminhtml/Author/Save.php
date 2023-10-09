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

        try {
            /** @var \BrunoDuarte\Blog\Model\Author $author */
            $author = $this->_objectManager->create(Author::class);
            $date = $this->date->gmtDate();
            $id = (int) $data['author_id'];

            if ($id) {
                $postdata = array(
                    'name' => $data['name'],
                    'about' => $data['about'],
                    // 'image_path' = $data['image_path'],
                    'updated_at' => $date
                );

                $author->load($id)->setData($postdata)->save(); // <---- Verificar com funciona o  update

            } else {
                $postdata = array(
                    'name' => $data['name'],
                    'about' => $data['about'],
                    // 'image_path' = $data['image_path'],
                    'created_at' => $date,
                    'updated_at' => $date
                );

                $author->setData($postdata)->save();
            }

            $this->messageManager->addSuccessMessage(__('The Author has been saved.'));
            return $resultRedirect->setPath('*/*/index');

        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(nl2br($e->getMessage()));
            return $resultRedirect->setPath('*/*/edit');
        }

        if ($this->getRequest()->getParam('back')) {
            $this->messageManager->addSuccessMessage(__('The Author has been saved.'));
            return $resultRedirect->setPath('*/*/index', ['author_id' => $id, '_current' => true]);
        }
    }
}
