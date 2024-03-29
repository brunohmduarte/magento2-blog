<?php

namespace BrunoDuarte\Blog\Block\Adminhtml\Post\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{

   public function getButtonData()
   {
       return [
           'label' => __('Save Post'),
           'class' => 'save primary',
           'data_attribute' => [
               'mage-init' => ['button' => ['event' => 'save']],
               'form-role' => 'save',
           ],
           'sort_order' => 90,
       ];
   }
}
