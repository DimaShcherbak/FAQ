<?php
namespace RockLab\FAQ\Observer;

use \Magento\Framework\Event\Observer;
use \Magento\Framework\Event\ObserverInterface;
use \Magento\Framework\Serialize\Serializer\Json;

/**
 * Class SerializedAttractionHighlights
 * @package RockLab\FAQ\Observer
 */
class SerializedAttractionHighlights implements ObserverInterface
{
//    const ATTR_ATTRACTION_HIGHLIGHTS_CODE = 'attraction_highlights';

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    protected $json;
    /**
     * @var  \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * SerializedAttractionHighlights constructor.
     * @param \Magento\Framework\App\RequestInterface $request
     * @param Json $json
     */
    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Serialize\Serializer\Json $json
    )
    {
        $this->request = $request;
        $this->json = $json;
    }
    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        /** @var $product \Magento\Catalog\Model\Product */
        $product = $observer->getEvent()->getDataObject();
        $rowsItem = $product->getData()['dynamic_rows_faq']['dynamic_rows'];
        usort($rowsItem, function($a, $b) {
            return $a['position'] <=> $b['position'];
        });
        $product -> setCustomAttribute("dynamic_rows_faq", $this->json->serialize($rowsItem));
    }
}
