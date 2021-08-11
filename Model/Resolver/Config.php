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

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageplaza\FrequentlyBought\Helper\Data;
use Mageplaza\FrequentlyBought\Api\FrequentlyBoughtRepositoryInterface as FBRepositoryInterface;

/**
 * Class Config
 * @package Mageplaza\FrequentlyBoughtGraphQl\Model\Resolver
 */
class Config implements ResolverInterface
{
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var FBRepositoryInterface
     */
    protected $boughtRepository;

    /**
     * @param Data $helperData
     * @param FBRepositoryInterface $boughtRepository
     */
    public function __construct(
        Data $helperData,
        FBRepositoryInterface $boughtRepository
    )
    {
        $this->helperData = $helperData;
        $this->boughtRepository = $boughtRepository;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (!$this->helperData->isEnabled()) {
            throw new LocalizedException(__('The module is disabled'));
        }

        return $this->boughtRepository->config();
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return [
            "isEnable" => $this->helperData->isEnabled(),
            "product_method" => $this->helperData->getConfigGeneral('product_method'),
            "block_name" => $this->helperData->getConfigGeneral('block_name'),
            "item_limit" => $this->helperData->getConfigGeneral('item_limit'),
            "enable_add_to_wishlist" => $this->helperData->getConfigGeneral('enable_add_to_wishlist'),
            "remove_related_block" => $this->helperData->getConfigGeneral('remove_related_block'),
            "separator_image" => $this->helperData->getConfigGeneral('separator_image'),
            "use_popup" => $this->helperData->getConfigGeneral('use_popup')
        ];
    }
}
