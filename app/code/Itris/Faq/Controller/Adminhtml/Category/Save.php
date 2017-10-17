<?php
namespace Itris\Faq\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Itris\Faq\Model\Page;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
            
class Save extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Itris_Faq::categories';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = Itris\Faq\Model\Category::STATUS_ENABLED;
            }
            if (empty($data['itris_faq_category_id'])) {
                $data['itris_faq_category_id'] = null;
            }

            /** @var Itris\Faq\Model\Category $model */
            $model = $this->_objectManager->create('Itris\Faq\Model\Category');

            $id = $this->getRequest()->getParam('itris_faq_category_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the category.'));
                $this->dataPersistor->clear('itris_faq_category');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/category/edit', ['itris_faq_category_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/categories/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->dataPersistor->set('itris_faq_category', $data);
            return $resultRedirect->setPath('*/category/edit', ['itris_faq_category_id' => $this->getRequest()->getParam('itris_faq_category_id')]);
        }
        return $resultRedirect->setPath('*/categories/');
    }    
}
