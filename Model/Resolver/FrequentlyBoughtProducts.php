<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_FrequentlyBoughtGraphQl
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */
declare(strict_types=1);

namespace Mageplaza\FrequentlyBoughtGraphQl\Model\Resolver;

use Magento\Catalog\Model\Product;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\FieldTranslator;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageplaza\FrequentlyBought\Helper\Data;
use Mageplaza\FrequentlyBought\Model\FrequentlyBought as FrequentlyBoughtModel;
use Mageplaza\FrequentlyBought\Model\FrequentlyBoughtFactory;

/**
 * Class FrequentlyBoughtProducts
 * @package Mageplaza\FrequentlyBoughtGraphQl\Model\Resolver
 */
class FrequentlyBoughtProducts implements ResolverInterface
{
    /**
     * @var FrequentlyBoughtModel
     */
    protected $fbtModelFactory;

    /**
     * @var Data
     */
    protected $helperData;
    /**
     * @var ProductFieldsSelector
     */
    protected $productFieldsSelector;
    /**
     * @var FieldTranslator
     */
    protected $fieldTranslator;

    public function __construct(
        Data $helperData,
        FrequentlyBoughtFactory $fbtModelFactory,
        FieldTranslator $fieldTranslator
    ) {
        $this->helperData = $helperData;
        $this->fbtModelFactory = $fbtModelFactory;
        $this->fieldTranslator = $fieldTranslator;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (!$this->helperData->isEnabled()) {
            throw new LocalizedException(__('The module is disabled'));
        }
        if (!isset($value['model'])) {
            throw new LocalizedException(__('"model" value should be specified'));
        }

        /** @var Product $product */
        $product = $value['model'];
        $fields = $this->getProductFieldsFromInfo($info, 'fbt_products');
        $data = [];
        if ($this->helperData->hasProductLinks($product->getId())) {
            /** @var FrequentlyBoughtModel $model */
            $model = $this->fbtModelFactory->create();
            $collection = $model->getProductCollection($product);
            foreach ($fields as $fieldProduct) {
                $collection->addAttributeToSelect($fieldProduct);
            }
            $collection->setPositionOrder()->addStoreFilter();
            foreach ($collection->getItems() as $fbtProduct) {
                $productData = $fbtProduct->getData();
                $productData['model'] = $fbtProduct;
                $data[] = $productData;
            }
        }

        return $data;
    }

    /**
     * Return field names for all requested product fields.
     *
     * @param ResolveInfo $info
     * @param string $productNodeName
     * @return string[]
     */
    public function getProductFieldsFromInfo(ResolveInfo $info, string $productNodeName = 'product') : array
    {
        $fieldNames = [];
        foreach ($info->fieldNodes as $node) {
            if ($node->name->value !== $productNodeName) {
                continue;
            }
            foreach ($node->selectionSet->selections as $selectionNode) {
                if ($selectionNode->kind === 'InlineFragment') {
                    foreach ($selectionNode->selectionSet->selections as $inlineSelection) {
                        if ($inlineSelection->kind === 'InlineFragment') {
                            continue;
                        }
                        $fieldNames[] = $this->fieldTranslator->translate($inlineSelection->name->value);
                    }
                    continue;
                }
                $fieldNames[] = $this->fieldTranslator->translate($selectionNode->name->value);
            }
        }

        return $fieldNames;
    }
}
