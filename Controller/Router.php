<?php
/**
 * Megantic Mgc Extension
 *
 * @category Megantic
 * @package Megantic_Mgc
 * @copyright Copyright (c) Megantic 2020
 * @author Aleksandar Stojanov - Pirate
 */

namespace Megantic\Mgc\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

/**
 * Router
 *
 * @category Megantic
 * @package Megantic_Mgc
 */
class Router implements RouterInterface
{
    /**
     * @var ActionFactory
     */
    private $actionFactory;

    /**
     * Construct
     *
     * @param ActionFactory $actionFactory
     */
    public function __construct(ActionFactory $actionFactory)
    {
        $this->actionFactory = $actionFactory;
    }

    /**
     * Match application action by request
     *
     * @param RequestInterface $request
     * @return ActionInterface
     */
    public function match(RequestInterface $request)
    {
        $pathInfo = $request->getPathInfo();
        if (preg_match("%/Mgc/(.*?).html$%", $pathInfo, $m)) {
            $request->setModuleName('Mgc')->setControllerName('index')->setActionName('detail');
            return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
        }
    }
}