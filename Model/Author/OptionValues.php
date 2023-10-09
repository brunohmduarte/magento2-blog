<?php

namespace BrunoDuarte\Blog\Model\Author;

use Magento\Framework\Option\ArrayInterface;

class OptionValues implements ArrayInterface
{
    /**
     * Labels collection array
     *
     * @var array
     */
    protected $_labelsCollection;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Design\Theme\Label\ListInterface $labelList
     */
    public function __construct(\Magento\Framework\View\Design\Theme\Label\ListInterface $labelList)
    {
        // $this->_labelsCollection = $labelList;
        $this->_labelsCollection = [
            [
                'value' => 1,
                'label' =>'Bruno H M Duarte'
            ],
            [
                'value' => 2,
                'label' =>'Felipe M Lisboa'
            ]
        ];
    }

    /**
     * Return labels collection array
     *
     * @param bool|string $label add empty values to result with specific label
     * @return array
     */
    public function getLabelsCollection($label = false)
    {
        // $options = $this->_labelsCollection->getLabels();
        $options = $this->_labelsCollection;
        if ($label) {
            array_unshift($options, ['value' => '', 'label' => $label]);
        }
    }

    /**
     * Return labels collection for backend system configuration with empty value "No Theme"
     *
     * @return array
     */
    public function getLabelsCollectionForSystemConfiguration()
    {
        return $this->toOptionArray();
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return $this->getLabelsCollection((string)new \Magento\Framework\Phrase('-- No Theme --'));
    }


    /*public function execute()
    {
        /**
         * @todo Carregar os autores do banco de dados.
         *
        return (object) [
            [
                'value' => 1,
                'label' =>'Bruno H M Duarte'
            ],
            [
                'value' => 2,
                'label' =>'Felipe M Lisboa'
            ]
        ];
    }*/
}
