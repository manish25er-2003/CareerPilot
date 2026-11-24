<?php

return [
    'accepted' => 'The :attribute must be accepted.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'email' => 'Enter a valid email address.',
    'lowercase' => 'The :attribute must be lowercase.',
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'string' => 'The :attribute may not be greater than :max characters.',
    ],
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'required' => 'The :attribute field is required.',
    'same' => 'The :attribute and :other must match.',
    'string' => 'The :attribute must be a string.',
    'unique' => 'The :attribute has already been taken.',
    'custom' => [
        'email' => [
            'unique' => 'This email address is already registered.',
        ],
    ],
    'attributes' => [
        'email' => 'email address',
        'name' => 'full name',
        'password' => 'password',
        'password_confirmation' => 'password confirmation',
        'terms' => 'terms and conditions',
    ],
];
