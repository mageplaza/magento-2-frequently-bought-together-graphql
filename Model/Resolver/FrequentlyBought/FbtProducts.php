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

namespace Mageplaza\FrequentlyBoughtGraphQl\Model\Resolver\FrequentlyBought;

use Exception;
use Magento\Catalog\Model\Product;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageplaza\FrequentlyBought\Api\FrequentlyBoughtRepositoryInterface;
use Mageplaza\FrequentlyBought\Helper\Data;
use Mageplaza\FrequentlyBought\Model\FrequentlyBought;

/**
 * Class ProductLinks
 * @package Mageplaza\FrequentlyBoughtGraphQl\Model\Resolver\FrequentlyBought
 */
class FbtProducts implements ResolverInterface
{

    /**
     * @var FrequentlyBoughtRepositoryInterface
     */
    protected $fbtRepository;
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * ProductLinks constructor.
     *
     * @param FrequentlyBoughtRepositoryInterface $frequentlyBoughtRepository
     * @param Data $helperData
     */
    public function __construct(
        FrequentlyBoughtRepositoryInterface $frequentlyBoughtRepository,
        Data $helperData
    ) {
        $this->fbtRepository = $frequentlyBoughtRepository;
        $this->helperData    = $helperData;
    }

    /**
     * @inheritdoc
     *
     * Format product links data to conform to GraphQL schema
     *
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     *
     * @return null|array
     * @throws Exception
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (!isset($value['model'])) {
            throw new LocalizedException(__('"model" value should be specified'));
        }

        /** @var Product $product */
        $product = $value['model'];

        $links = null;
        if ($this->helperData->hasProductLinks($product->getId())) {
            $links = [];
            foreach ($this->fbtRepository->getList($product->getSku()) as $productLink) {
                /** @var FrequentlyBought $productLink */
                $links[] = $productLink->getData();
            }
        }

        return $links;
    }
}
