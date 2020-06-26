<?php
/**
 * Megantic Mgc Extension
 *
 * @category Megantic
 * @package Megantic_Mgc
 * @copyright Copyright (c) Megantic 2020
 * @author Aleksandar Stojanov - Pirate
 */

namespace Megantic\Mgc\Model\Item\Source;

use Megantic\Mgc\Model\Item;

/**
 * IsActive
 *
 * @category Megantic
 * @package Megantic_Mgc
 */
class IsActive implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Namespace]\Mgc\Model\Item
     */
    protected $item;

    /**
     * Construct
     *
     * @param \Megantic\Mgc\Model\Item $item
     */
    public function __construct(Item $item) {
        $this->item = $item;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->item->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
