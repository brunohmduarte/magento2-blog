<?php

namespace BrunoDuarte\Blog\Controller\Adminhtml\Author;

use Magento\Framework\App\Action\{Action, Context};
use Magento\Framework\Stdlib\DateTime\DateTime;
use BrunoDuarte\Blog\Model\Author;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Save extends Action
{
    // protected $request;

    /** @var Author */
    protected $_authorFactory;

    /** @var RedirectFactory */
    protected $_resultRedirectFactory;

    /** @var Data */
    protected $_jsonHelper;

    /** @var DateTime */
    protected $_date;

    /**
     *
     * @param Context $context
     * @param Author $authorFactory
     * @param Data $jsonHelper
     * @param DateTime $date
     */
    public function __construct(
        Context $context,
        Author $authorFactory,
        RedirectFactory $redirectFactory,
        DateTime $date
    ) {
        $this->_authorFactory = $authorFactory;
        $this->_resultRedirectFactory = $redirectFactory;
        $this->_date = $date;

        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     * @return void
     */
    public function execute()
    {
        /** @var RedirectFactory $resultRedirect */
        $resultRedirect = $this->_resultRedirectFactory->create();

        $data = $this->getRequest()->getPostValue('author');

        try {
            $date = $this->_date->gmtDate();
            $id = (int) $data['author_id'];

            if ($id > 0) {
                $this->_authorFactory->load($id);
                $data['updated_at'] = $date;
            } else {
                unset($data['author_id']);
                $data['created_at'] = $date;
                $data['updated_at'] = $date;
            }

            $data['about'] = strip_tags($data['about']);

            $this->_authorFactory->setData($data)->save();

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
            return $resultRedirect->setPath('*/*/edit', ['id' => $id, '_current' => true]);
        }

        if (empty($redirectState)) {
            $this->messageManager->addSuccessMessage(__('The Author has been saved with success.'));
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
