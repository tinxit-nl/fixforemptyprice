<?php
/*
 * Tinx-IT
 *
 * DISCLAIMER
 *
 *  Do not edit or add to this file if you wish to upgrade this extension to newer version in the future.
 *
 *  @category    TinxIT
 *  @package     TinxIT_Emptyprice
 *  @copyright   Copyright (c) Tinx-IT (http://www.tinx-it.com/)
 *  @Author      Rene Donkers
 */

namespace TinxIT\Emptyprice\Plugin\Framework\Webapi;

use Magento\Framework\Webapi\ServiceInputProcessor;
use Magento\Framework\Reflection\TypeProcessor;

/**
 * Class ServiceInputProcessorPlugin
 * @package TinxIT\Emptyprice\Plugin\Framework\Webapi
 */
class ServiceInputProcessorPlugin
{

    /**
     * @var Request
     */
    protected $typeProcessor;

    public function __construct(
        TypeProcessor $typeProcessor
    ) {
        $this->typeProcessor = $typeProcessor;
    }


    /**
     * Don't convert value if it is empty, because that way you are not able to empty values like prices.
     *
     * @param ServiceInputProcessor $subject
     * @param \Closure $proceed
     * @param $data
     * @param $type
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function aroundConvertValue(
        ServiceInputProcessor $subject,
        \Closure $proceed,
        $data,
        $type
    ) {
        if ($this->typeProcessor->isTypeSimple($type)) {
            if ($data === ""){
                return $data;
            }
        }
        return $proceed($data, $type);
    }
}