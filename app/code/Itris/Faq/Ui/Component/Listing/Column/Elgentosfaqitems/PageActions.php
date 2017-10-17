<?php
namespace Elgentos\Faq\Ui\Component\Listing\Column\Elgentosfaqitems;

class PageActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource["data"]["items"])) {
            foreach ($dataSource["data"]["items"] as & $item) {
                $name = $this->getData("name");
                $id = "X";
                if(isset($item["elgentos_faq_item_id"]))
                {
                    $id = $item["elgentos_faq_item_id"];
                }
                $item[$name]["view"] = [
                    "href"=>$this->getContext()->getUrl(
                        "elgentos_faq/item/edit",["elgentos_faq_item_id"=>$id]),
                    "label"=>__("Edit")
                ];
            }
        }

        return $dataSource;
    }    
    
}
