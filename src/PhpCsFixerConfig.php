<?php

declare(strict_types=1);

namespace BillysBilling\PhpCodingStandards;

use PhpCsFixer\Config;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

class PhpCsFixerConfig extends Config
{
    public function __construct()
    {
        parent::__construct();

        $this->setRules([
            '@PSR12' => true,
            'array_syntax' => ['syntax' => 'short'],
            'blank_line_before_statement' => ['statements' => ['return']],
            'braces_position' => [
                'allow_single_line_anonymous_functions' => false,
                'allow_single_line_empty_anonymous_classes' => false,
                'classes_opening_brace' => 'next_line_unless_newline_at_signature_end',
                'anonymous_classes_opening_brace' => 'next_line_unless_newline_at_signature_end',
                'control_structures_opening_brace' => 'same_line',
            ],
            'class_attributes_separation' => [
                'elements' => ['method' => 'one', 'property' => 'one', 'const' => 'one', 'trait_import' => 'none'],
            ],
            'constant_case' => ['case' => 'lower'],
            'declare_parentheses' => true,
            'declare_strict_types' => true,
            'global_namespace_import' => ['import_constants' => true],
            'modernize_types_casting' => true,
            'native_constant_invocation' => true,
            'no_alias_functions' => true,
            'no_extra_blank_lines' => ['tokens' => ['extra', 'break', 'continue', 'return', 'throw']],
            'no_trailing_whitespace' => true,
            'no_unused_imports' => true,
            'normalize_index_brace' => true,
            'nullable_type_declaration_for_default_null_value' => true,
            'ordered_imports' => ['sort_algorithm' => 'alpha'],
            'phpdoc_add_missing_param_annotation' => true,
            'phpdoc_align' => ['align' => 'vertical'],
            'phpdoc_no_empty_return' => true,
            'phpdoc_no_useless_inheritdoc' => true,
            'phpdoc_order' => true,
            'phpdoc_separation' => true,
            'phpdoc_summary' => true,
            'phpdoc_trim' => true,
            'self_static_accessor' => true,
            'simplified_null_return' => true,
            'single_blank_line_at_eof' => true,
            'strict_comparison' => true,
            'strict_param' => true,
            'ternary_operator_spaces' => true,
            'ternary_to_null_coalescing' => true,
            'trailing_comma_in_multiline' => [
                'after_heredoc' => true,
                'elements' => ['arrays', 'arguments', 'parameters'],
            ],
            'trim_array_spaces' => true,
            'void_return' => true,
        ]);

        $this->setRiskyAllowed(true);
        $this->setParallelConfig(ParallelConfigFactory::detect());
    }
}
