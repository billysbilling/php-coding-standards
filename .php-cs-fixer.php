<?php

declare(strict_types=1);

$rules = [
    // PSR Standards
    '@PSR12' => true,

    // Formatting and Syntax
    'array_syntax' => ['syntax' => 'short'],
    'binary_operator_spaces' => ['default' => 'single_space'],
    'braces' => true,
    'cast_spaces' => true,
    'method_chaining_indentation' => true,
    'ternary_to_null_coalescing' => true,
    'concat_space' => ['spacing' => 'none'],

    // Spacing and Blank Lines
    'blank_line_after_namespace' => true,
    'blank_line_after_opening_tag' => true,
    'blank_line_before_statement' => ['statements' => ['return']],
    'no_extra_blank_lines' => [
        'tokens' => [
            'extra', 'break', 'continue', 'curly_brace_block', 'parenthesis_brace_block',
            'return', 'square_brace_block', 'throw', 'use', 'use_trait',
        ],
    ],
    'no_whitespace_in_blank_line' => true,
    'no_spaces_inside_parenthesis' => true,

    // Typing and Casting
    'nullable_type_declaration_for_default_null_value' => true,
    'declare_strict_types' => true,
    'modernize_types_casting' => true,
    'strict_comparison' => true,
    'strict_param' => true,
    'void_return' => true,

    // Classes and Methods
    'class_attributes_separation' => ['elements' => ['method' => 'one']],
    'class_definition' => true,
    'visibility_required' => ['elements' => ['method', 'property', 'const']],
    'method_argument_space' => true,

    // Constants and Functions
    'constant_case' => ['case' => 'upper'],
    'native_constant_invocation' => true,
    'native_function_casing' => true,
    'global_namespace_import' => ['import_constants' => true],

    // PHPDoc
    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_order' => true,
    'phpdoc_no_empty_return' => true,
    'phpdoc_no_useless_inherit' => true,
    'phpdoc_align' => ['align' => 'vertical'],
    'no_superfluous_phpdoc_tags' => ['remove_inheritdoc' => true],
    'phpdoc_scalar' => true,

    // Clean-up
    'no_unused_imports' => true,
    'no_unused_local_variables' => true,
    'no_useless_else' => true,
    'no_duplicate_imports' => true,

    // Tags
    'php_tag_syntax' => ['short' => false],

    // Deprecated Functions
    'no_alias_functions' => true,

    // Optional Grouping
    'group_import' => true,
];

return $rules;
