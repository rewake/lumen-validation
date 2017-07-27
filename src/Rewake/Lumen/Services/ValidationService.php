<?php

namespace Rewake\Lumen\Services;


use Illuminate\Translation\Translator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
use Rewake\Lumen\Validation\ValidationRuleInterface;

/**
 * Class ValidationService
 *
 * @package Rewake\Lumen\Services
 */
class ValidationService
{
    /** @var Validator */
    private $validator;

    /** @var Translator */
    private $translator;

    public function __construct(Validator $validator = null, Translator $translator = null)
    {
        // Store or instantiate Validator
        $this->validator = $validator ?: new Validator();

        // Store or instantiate Translator
        $this->translator = $translator ?: new Translator();
    }

    /**
     * Validate an object or array against a ValidationRuleInterface class
     *
     * NOTE:
     * This will not work recursively as, ultimately, the Illuminate Validator does not work recursively either.
     *
     * @param $input
     * @param $rules
     * @param array $messages
     * @param array $customAttributes
     * @throws ValidationException
     * @internal param $model
     * @internal param $validationClass
     */
    public function validate($input, $rules, array $messages = [], array $customAttributes = [])
    {
        // See if we should be validating against a ValidationRuleInterface
        if ($rules instanceof ValidationRuleInterface) {

            // Create ArrayObject from $input & get data as array
            $data = (new \ArrayObject($input, \ArrayObject::STD_PROP_LIST))->getArrayCopy();

            // Get default messages and apply overrides
            /** @var ValidationRuleInterface $validationClass */
            $messages = array_replace_recursive($this->defaultMessages(), $rules::messages());

            // Add descriptor if provided by
            if (!is_null($rules::descriptor())) {

                $messages = $this->translator->trans('validation');

                // Replace message text with descriptor
                array_walk_recursive($messages, function (&$message) use ($rules) {
                    $message = $rules::descriptor() . ' / ' . $message;
                });
            }
        }

        // Validate the model data
        $this->validator->validate($data, $validationClass::rules(), $messages, $customAttributes);

        // Check for validation failure
        if ($this->validator->fails()) {

            // Throw validation exception
            throw new ValidationException($this->validator, $this->validator->errors()->getMessages());
        }
    }
}