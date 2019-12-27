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

namespace Mageplaza\FrequentlyBoughtGraphQl\Model;

use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\TypeResolverInterface;

/**
 * Class ProductLinkTypeResolverComposite
 * @package Mageplaza\FrequentlyBoughtGraphQl\Model
 */
class ProductLinkTypeResolverComposite implements TypeResolverInterface
{
    /**
     * TypeResolverInterface[]
     */
    private $productLinksTypeNameResolvers = [];

    /**
     * @param TypeResolverInterface[] $productLinksTypeNameResolvers
     */
    public function __construct(array $productLinksTypeNameResolvers = [])
    {
        $this->productLinksTypeNameResolvers = $productLinksTypeNameResolvers;
    }

    /**
     * @inheritdoc
     */
    public function resolveType(array $data) : string
    {
        $resolvedType = null;

        foreach ($this->productLinksTypeNameResolvers as $productLinksTypeNameResolvers) {
            $resolvedType = $productLinksTypeNameResolvers->resolveType($data);

            if ($resolvedType) {
                return $resolvedType;
            }
        }
        throw new GraphQlInputException(__('Cannot resolve type'));
    }
}
