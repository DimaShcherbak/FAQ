<?php

namespace RockLab\FAQ\Plugin;

use \Magento\Framework\Serialize\Serializer\Json;
use \Psr\Log\NullLogger;

/**
 * Class DataProviderPlugin
 * @package RockLab\FAQ\Plugin
 */
class DataProviderPlugin
{
    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    protected $json;

    /**
     * DataProviderPlugin constructor.
     * @param Json $json
     */
    public function __construct(
        \Magento\Framework\Serialize\Serializer\Json $json
    ) {
        $this->json = $json;
    }

    /**
     * @param \Magento\Catalog\Ui\DataProvider\Product\Form\ProductDataProvider $subject
     * @param array $result
     * @return array
     */
    public function afterGetData(\Magento\Catalog\Ui\DataProvider\Product\Form\ProductDataProvider $subject, array $result)
    {
        if(!empty($subject->getAllIds()) )
        {
            if (array_key_exists('dynamic_rows_faq', $result[$subject->getAllIds()[0]]['product'])){
                $dataAttrib = $result[$subject->getAllIds()[0]]['product']['dynamic_rows_faq'];
                $unserializedFaq = $this->json->unserialize($dataAttrib);
                $result[$subject->getAllIds()[0]]['product']['dynamic_rows_faq'] = ['dynamic_rows' => $unserializedFaq];
            }
        }
        return $result;
    }
}
