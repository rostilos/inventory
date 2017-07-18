<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Inventory\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Inventory\Model\ResourceModel\SourceItem\SaveMultiple;
use Magento\InventoryApi\Api\SourceItemSaveInterface;
use Psr\Log\LoggerInterface;

/**
 * @inheritdoc
 */
class SourceItemSave implements SourceItemSaveInterface
{
    /**
     * @var SaveMultiple
     */
    private $saveMultiple;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * SourceItemSaveMultiple constructor
     *
     * @param SaveMultiple $saveMultiple
     * @param LoggerInterface $logger
     */
    public function __construct(
        SaveMultiple $saveMultiple,
        LoggerInterface $logger
    ) {
        $this->saveMultiple = $saveMultiple;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function execute(array $sourceItems)
    {
        try {
            $this->saveMultiple->execute($sourceItems);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__('Could not save Source Item'), $e);
        }
    }
}
