<?php
namespace Itris\Faq\Controller\Adminhtml\Item;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Itris_Faq::items';
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/items/index');
        return $resultRedirect;
    }     
}
