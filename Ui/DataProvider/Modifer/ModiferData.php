<?php

namespace RockLab\FAQ\Ui\DataProvider\Modifer;

use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Magento\Framework\Serialize\Serializer\Json;

/**
 * Class ModiferData
 * @package RockLab\FAQ\Ui\DataProvider\Modifer
 */
class ModiferData implements ModifierInterface
{
    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    protected $json;

    public function __construct(
    \Magento\Framework\Serialize\Serializer\Json $json
    )
    {
        $this->json = $json;
    }

    /**
     * @param array $meta
     * @return array
     */
    public function modifyMeta(array $meta)
    {
        $meta['dynamic_rows_faq'] = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Label For Fieldset'),
                        'sortOrder' => 50,
                        'collapsible' => true
                    ]
                ]
            ],
            'children' => [
                'test_field_name' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'formElement' => 'select',
                                'componentType' => 'field',
                                'options' => [
                                    ['value' => 'test_value_1', 'label' => 'Test Value 1'],
                                    ['value' => 'test_value_2', 'label' => 'Test Value 2'],
                                    ['value' => 'test_value_3', 'label' => 'Test Value 3'],
                                ],
                                'visible' => 1,
                                'required' => 1,
                                'label' => __('Label For Element')
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return $meta;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        return $data;
    }
}
