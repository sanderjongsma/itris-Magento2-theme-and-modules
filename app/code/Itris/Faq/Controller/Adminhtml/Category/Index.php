<?php
namespace Itris\Faq\Controller\Adminhtml\Category;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Itris_Faq::categories';
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/categories/index');
        return $resultRedirect;
    }     
}
