<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The <code>:attribute</code> must be accepted.',
    'active_url' => 'The <code>:attribute</code> is not a valid URL.',
    'after' => 'The <code>:attribute</code> must be a date after :date.',
    'after_or_equal' => 'The <code>:attribute</code> must be a date after or equal to :date.',
    'alpha' => 'The <code>:attribute</code> may only contain letters.',
    'alpha_dash' => 'The <code>:attribute</code> may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The <code>:attribute</code> may only contain letters and numbers.',
    'array' => 'The <code>:attribute</code> must be an array.',
    'before' => 'The <code>:attribute</code> must be a date before :date.',
    'before_or_equal' => 'The <code>:attribute</code> must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The <code>:attribute</code> must be between :min and :max.',
        'file' => 'The <code>:attribute</code> must be between :min and :max kilobytes.',
        'string' => 'The <code>:attribute</code> must be between :min and :max characters.',
        'array' => 'The <code>:attribute</code> must have between :min and :max items.',
    ],
    'boolean' => 'The <code>:attribute</code> field must be true or false.',
    'confirmed' => 'The <code>:attribute</code> confirmation does not match.',
    'date' => 'The <code>:attribute</code> is not a valid date.',
    'date_equals' => 'The <code>:attribute</code> must be a date equal to :date.',
    'date_format' => 'The <code>:attribute</code> does not match the format :format.',
    'different' => 'The <code>:attribute</code> and :other must be different.',
    'digits' => 'The <code>:attribute</code> must be :digits digits.',
    'digits_between' => 'The <code>:attribute</code> must be between :min and :max digits.',
    'dimensions' => 'The <code>:attribute</code> has invalid image dimensions.',
    'distinct' => 'The <code>:attribute</code> field has a duplicate value.',
    'email' => 'The <code>:attribute</code> must be a valid email address.',
    'ends_with' => 'The <code>:attribute</code> must end with one of the following: :values.',
    'exists' => 'The selected <code>:attribute</code> is invalid.',
    'file' => 'The <code>:attribute</code> must be a file.',
    'filled' => 'The <code>:attribute</code> field must have a value.',
    'gt' => [
        'numeric' => 'The <code>:attribute</code> must be greater than :value.',
        'file' => 'The <code>:attribute</code> must be greater than :value kilobytes.',
        'string' => 'The <code>:attribute</code> must be greater than :value characters.',
        'array' => 'The <code>:attribute</code> must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The <code>:attribute</code> must be greater than or equal :value.',
        'file' => 'The <code>:attribute</code> must be greater than or equal :value kilobytes.',
        'string' => 'The <code>:attribute</code> must be greater than or equal :value characters.',
        'array' => 'The <code>:attribute</code> must have :value items or more.',
    ],
    'image' => 'The <code>:attribute</code> must be an image.',
    'in' => 'The selected <code>:attribute</code> is invalid.',
    'in_array' => 'The <code>:attribute</code> field does not exist in :other.',
    'integer' => 'The <code>:attribute</code> must be an integer.',
    'ip' => 'The <code>:attribute</code> must be a valid IP address.',
    'ipv4' => 'The <code>:attribute</code> must be a valid IPv4 address.',
    'ipv6' => 'The <code>:attribute</code> must be a valid IPv6 address.',
    'json' => 'The <code>:attribute</code> must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The <code>:attribute</code> must be less than :value.',
        'file' => 'The <code>:attribute</code> must be less than :value kilobytes.',
        'string' => 'The <code>:attribute</code> must be less than :value characters.',
        'array' => 'The <code>:attribute</code> must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The <code>:attribute</code> must be less than or equal :value.',
        'file' => 'The <code>:attribute</code> must be less than or equal :value kilobytes.',
        'string' => 'The <code>:attribute</code> must be less than or equal :value characters.',
        'array' => 'The <code>:attribute</code> must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The <code>:attribute</code> may not be greater than :max.',
        'file' => 'The <code>:attribute</code> may not be greater than :max kilobytes.',
        'string' => 'The <code>:attribute</code> may not be greater than :max characters.',
        'array' => 'The <code>:attribute</code> may not have more than :max items.',
    ],
    'mimes' => 'The <code>:attribute</code> must be a file of type: :values.',
    'mimetypes' => 'The <code>:attribute</code> must be a file of type: :values.',
    'min' => [
        'numeric' => 'The <code>:attribute</code> must be at least :min.',
        'file' => 'The <code>:attribute</code> must be at least :min kilobytes.',
        'string' => 'The <code>:attribute</code> must be at least :min characters.',
        'array' => 'The <code>:attribute</code> must have at least :min items.',
    ],
    'not_in' => 'The selected <code>:attribute</code> is invalid.',
    'not_regex' => 'The <code>:attribute</code> format is invalid.',
    'numeric' => 'The <code>:attribute</code> must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The <code>:attribute</code> field must be present.',
    'regex' => 'The <code>:attribute</code> format is invalid.',
    'required' => 'The <code>:attribute</code> field is required.',
    'required_if' => 'The <code>:attribute</code> field is required when :other is :value.',
    'required_unless' => 'The <code>:attribute</code> field is required unless :other is in :values.',
    'required_with' => 'The <code>:attribute</code> field is required when :values is present.',
    'required_with_all' => 'The <code>:attribute</code> field is required when :values are present.',
    'required_without' => 'The <code>:attribute</code> field is required when :values is not present.',
    'required_without_all' => 'The <code>:attribute</code> field is required when none of :values are present.',
    'same' => 'The <code>:attribute</code> and :other must match.',
    'size' => [
        'numeric' => 'The <code>:attribute</code> must be :size.',
        'file' => 'The <code>:attribute</code> must be :size kilobytes.',
        'string' => 'The <code>:attribute</code> must be :size characters.',
        'array' => 'The <code>:attribute</code> must contain :size items.',
    ],
    'starts_with' => 'The <code>:attribute</code> must start with one of the following: :values.',
    'string' => 'The <code>:attribute</code> must be a string.',
    'timezone' => 'The <code>:attribute</code> must be a valid zone.',
    'unique' => 'The <code>:attribute</code> has already been taken.',
    'uploaded' => 'The <code>:attribute</code> failed to upload.',
    'url' => 'The <code>:attribute</code> format is invalid.',
    'uuid' => 'The <code>:attribute</code> must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'check_array' => 'At least one <code>:attribute</code> field is required',

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
