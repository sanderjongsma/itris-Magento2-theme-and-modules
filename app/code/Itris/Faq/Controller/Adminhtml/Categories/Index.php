<?php
namespace Elgentos\Faq\Controller\Adminhtml\Categories;
class Index extends \Magento\Backend\App\Action
{
    
    const ADMIN_RESOURCE = 'Elgentos_Faq::categories';
        
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
