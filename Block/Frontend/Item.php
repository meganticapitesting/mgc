<?php
/**
 * Megantic Mgc Extension
 *
 * @category Megantic
 * @package Megantic_Mgc
 * @copyright Copyright (c) Megantic 2020
 * @author Aleksandar Stojanov - Pirate
 */

namespace Megantic\Mgc\Block\Frontend;

use Megantic\Mgc\Model\ItemFactory;
use Magento\Framework\View\Element\Template;

/**
 * Item
 *
 * @category Megantic
 * @package Megantic_Mgc
 */
class Item extends Template
{
    /**
     * @var ItemFactory
     */
    private $itemFactory;

    /**
     * Construct
     * 
     * @param Template\Context $context
     * @param array $data
     * @param ItemFactory $itemFactory
     */
    public function __construct(
        Template\Context $context,
        array $data = [],
        ItemFactory $itemFactory
    ) {
        parent::__construct($context, $data);
        $this->itemFactory = $itemFactory;
    }

    /**
     * Get items
     * 
     * @return array $items
     */
    public function getItems()
    {
        $itemModel = $this->itemFactory->create();
        $itemCollection = $itemModel->getCollection();
        $items = $itemCollection->getData();
        return $items;
    }
}