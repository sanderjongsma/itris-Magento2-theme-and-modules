<?php
namespace Itris\Faq\Controller\Adminhtml\Item;

class Delete extends \Magento\Backend\App\Action
{  
    const ADMIN_RESOURCE = 'Itris_Faq::items';
          
    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('object_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $title = "";
            try {
                // init model and delete
                $model = $this->_objectManager->create('Itris\Faq\Model\Item');
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('You have deleted the question.'));
                // go to grid
                return $resultRedirect->setPath('*/items/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/item/edit', ['itris_faq_item_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can not find an object to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/items/');
        
    }    
    
}
