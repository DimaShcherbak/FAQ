<?php

namespace RockLab\FAQ\Block\Product;

use Magento\Catalog\Model\Product;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Serialize\Serializer\Json;

/**
 * Class Faq
 * @package RockLab\FAQ\Block\Product
 */
class Faq extends Template
{
    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    protected $json;
    /**
     * @var Product
     */
    private $product;
    /**
     * @var Registry
     */
    private $registry;
    /**
     * @var Context
     */
    private $context;
    /**
     * @var array
     */
    private $data;

    /**
     * Faq constructor.
     * @param Json $json
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Json $json,
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->json = $json;
        $this->context = $context;
        $this->data = $data;
    }

    /**
     * Returns a Product
     *
     * @return Product|null
     */
    protected function getProduct()
    {
        if (!$this->product) {
            $this->product = $this->registry->registry('product');
        }
        return $this->product;
    }

    /**
     * Get array of questions and answers
     *
     * @return array
     */
    public function getFaq()
    {
        if (!$product = $this->getProduct()) {
            return [];
        }
        $serializedFaqAttribute = $product->getCustomAttribute('dynamic_rows_faq');
        if (!$serializedFaqAttribute) {
            return [];
        }
        $serializedFaq = $serializedFaqAttribute->getValue();
        return $this->json->unserialize($serializedFaq);
    }
}
