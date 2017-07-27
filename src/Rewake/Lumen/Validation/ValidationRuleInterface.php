<?php
namespace Rewake\Lumen\Validation;

/**
 * Interface ValidationRuleInterface
 * @package Rewake\Lumen\Validation
 */
interface ValidationRuleInterface
{
    /**
     * Object descriptor to be used in validation exception messages, or null
     *
     * @return null|string
     */
    public static function descriptor();

    /**
     * Array of Validation rules
     *
     * @return array
     */
    public static function rules();

    /**
     * Array of Validation message overrides
     *
     * @return array
     */
    public static function messages();
}