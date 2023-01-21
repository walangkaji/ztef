<?php

/**
 * Penjelasan contoh Config: https://mlocati.github.io/php-cs-fixer-configurator/#version:3.6
 */
$config = (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setUsingCache(false)
    ->setRules([
        '@PSR1'                                         => true,
        '@PSR2'                                         => true,
        'align_multiline_comment'                       => ['comment_type' => 'phpdocs_like'],
        'array_indentation'                             => true,
        'array_syntax'                                  => ['syntax' => 'short'],
        'binary_operator_spaces'                        => ['default' => 'align_single_space_minimal'],
        'blank_line_after_opening_tag'                  => true,
        'blank_line_before_statement'                   => ['statements' => ['return', 'do', 'if', 'switch', 'try', 'throw']],
        'cast_spaces'                                   => true,
        'class_attributes_separation'                   => ['elements' => ['method' => 'one']],
        'compact_nullable_typehint'                     => true,
        'concat_space'                                  => ['spacing' => 'one'],
        'declare_equal_normalize'                       => ['space' => 'single'],
        'fully_qualified_strict_types'                  => true,
        'function_typehint_space'                       => true,
        'increment_style'                               => true,
        'lowercase_cast'                                => true,
        'lowercase_keywords'                            => true,
        'magic_method_casing'                           => true,
        'modernize_types_casting'                       => true,
        'multiline_comment_opening_closing'             => true,
        'native_constant_invocation'                    => true,
        'native_function_invocation'                    => ['include' => ['@compiler_optimized']],
        'no_alias_functions'                            => true,
        'no_alternative_syntax'                         => true,
        'no_blank_lines_after_class_opening'            => true,
        'no_blank_lines_after_phpdoc'                   => true,
        'no_empty_comment'                              => true,
        'no_empty_phpdoc'                               => true,
        'no_extra_blank_lines'                          => true,
        'no_leading_import_slash'                       => true,
        'no_leading_namespace_whitespace'               => true,
        'no_singleline_whitespace_before_semicolons'    => true,
        'no_spaces_around_offset'                       => true,
        'no_trailing_comma_in_singleline_array'         => true,
        'no_trailing_whitespace_in_comment'             => true,
        'no_unneeded_control_parentheses'               => true,
        'no_unset_cast'                                 => true,
        'no_unused_imports'                             => true,
        'no_useless_else'                               => true,
        'no_useless_return'                             => true,
        'no_whitespace_before_comma_in_array'           => true,
        'no_whitespace_in_blank_line'                   => true,
        'normalize_index_brace'                         => true,
        'ordered_imports'                               => true,
        'phpdoc_add_missing_param_annotation'           => true,
        'phpdoc_align'                                  => true,
        'phpdoc_annotation_without_dot'                 => true,
        'phpdoc_line_span'                              => true,
        'phpdoc_indent'                                 => true,
        'phpdoc_order'                                  => ['order' => ['param', 'return', 'throws']],
        'phpdoc_return_self_reference'                  => true,
        'phpdoc_scalar'                                 => true,
        'phpdoc_separation'                             => true,
        'phpdoc_single_line_var_spacing'                => true,
        'phpdoc_trim'                                   => true,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'phpdoc_types'                                  => true,
        'phpdoc_types_order'                            => ['null_adjustment' => 'always_last', 'sort_algorithm' => 'none'],
        'phpdoc_var_without_name'                       => true,
        'return_assignment'                             => true,
        'return_type_declaration'                       => ['space_before' => 'none'],
        'self_static_accessor'                          => true,
        'short_scalar_cast'                             => true,
        'single_blank_line_before_namespace'            => true,
        'single_line_comment_style'                     => true,
        'single_line_after_imports'                     => true,
        'single_quote'                                  => true,
        'single_trait_insert_per_statement'             => true,
        'space_after_semicolon'                         => true,
        'standardize_not_equals'                        => true,
        'ternary_operator_spaces'                       => true,
        'ternary_to_null_coalescing'                    => true,
        'trailing_comma_in_multiline'                   => true,
        'trim_array_spaces'                             => true,
        'visibility_required'                           => true,
        'yoda_style'                                    => true,
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->notPath('vendor')
            ->notPath('node_modules')
            ->notPath('bootstrap')
            ->notPath('storage')
            ->notPath('config')
            ->notPath('public/assets/plugins')
            ->notPath('resources/assets/plugins')
            ->notPath('marketbot-lib')
            ->exclude('public/index.php')
            ->in(__DIR__)
            ->name('*.php')
            ->notName('*.blade.php')
            ->notName('index.php')
            ->notName('server.php')
            ->ignoreDotFiles(true)
            ->ignoreVCS(true)
    )
;

return $config;
