<?php
namespace Itris\Faq\Controller\Adminhtml\Item;

class Edit extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Itris_Faq::items';
    protected $resultPageFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;        
        parent::__construct($context);
    }
    
    public function execute()
    {
        return $this->resultPageFactory->create();  
    }    
}
