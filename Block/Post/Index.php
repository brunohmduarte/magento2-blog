<?php

namespace BrunoDuarte\Blog\Block\Post;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;

class Index extends Template
{
    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function getHelloWorldTxt()
    {
        $collection = $this->getCollection();
        if ($collection && $collection->getSize()) {
            return 'Hello World!';
        }
        return 'Deu ruim!';

        /**
         * @todo Próximo passo
         *
         * 1. ok criar as tabelas no banco
         * 2. puxar as informações dos posts
         * 3. criar o método que irão fornecer o conteúdo para tela
         */

    }
}
