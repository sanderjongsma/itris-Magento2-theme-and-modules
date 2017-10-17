<?php
namespace Elgentos\Faq\Controller\Adminhtml\Item;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Elgentos_Faq::items';  
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/items/index');
        return $resultRedirect;
    }     
}
