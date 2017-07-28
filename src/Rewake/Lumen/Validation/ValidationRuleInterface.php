<?php
namespace Rewake\Lumen\Validation;

/**
 * Interface ValidationRuleInterface
 * @package Rewake\Lumen\Validation
 */
interface ValidationRuleInterface
{
    /**
     * Object descriptor to be used in validation exception messages, or empty array
     *
     * @return array|string
     */
    public static function descriptor();

    /**
     * Array of Validation rules, or empty array
     *
     * @return array
     */
    public static function rules();

    /**
     * Array of Validation message overrides, or empty array
     *
     * @return array
     */
    public static function messages();
}