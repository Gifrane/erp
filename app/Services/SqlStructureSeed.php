<?php

namespace App\Services;

class SqlStructureSeed
{
    public static array $order_calls = [
        'company', 'group', 'user', 'group_user', 'account_admin', 'account_setting', 'user_module',
        'user_permission', 'user_setting', 'api_keys', 'crm_company', 'crm_group', 'crm_contact',
        'crm_contact_group', 'crm_contact_company', 'product', 'product_option', 'supplier',
        'product_spare_part', 'billing', 'explorer_directory', 'explorer_file', 'explorer_file_meta',
        'bookmark', 'tag', 'tag_link',
    ];

    public static array $links = [
        'account_admin' => [
            'with_timestamps' => true,
            'cols' => [
                'user_id' => [ 'integer' ],
                'giver_id' => [ 'integer', 'nullable' ],
            ]
        ],
        'account_setting' => [
            'cols' => [
                'option' => [ 'string' ],
                'type' => [ 'string' ],
                'value' => [ 'string', 'nullable', 'with_quotes' ],
            ]
        ],
        'api_keys' => [
            'with_timestamps' => true,
            'cols' => [
                'generated_by_user_id' => [ 'integer', 'nullable' ],
                'name' => [ 'string', 'nullable', 'with_quotes' ],
                'public_key' => [ 'string' ],
                'private_key' => [ 'string' ],
                'expired_at' => [ 'string', 'nullable' ],
                'modules' => [ 'string', 'nullable', 'with_quotes' ],
            ]
        ],
        'billing' => [
            'with_timestamps' => true,
            'cols' => [
                'creator_id' => [ 'integer', 'nullable' ],
                'billing_id' => [ 'integer' ],
                'direction' => [ 'string' ],
                'title' => [ 'string', 'nullable', 'with_quotes' ],
                'amount_ht' => [ 'integer', 'nullable' ],
                'amount_ttc' => [ 'integer', 'nullable' ],
                'emitted_at' => [ 'string', 'nullable' ],
                'completed_at' => [ 'string', 'nullable' ],
                'step' => [ 'string', 'nullable' ],
                'receiver' => [ 'string', 'nullable', 'with_quotes' ],
                'receiver_type' => [ 'string', 'nullable' ],
                'receiver_id' => [ 'integer', 'nullable' ],
                'emitter' => [ 'string', 'nullable', 'with_quotes' ],
                'emitter_type' => [ 'string', 'nullable' ],
                'emitter_id' => [ 'integer', 'nullable' ],
            ]
        ],
        'bookmark' => [
            'cols' => [
                'user_id' => [ 'integer' ],
                'entity_type' => [ 'string' ],
                'entity_id' => [ 'integer' ],
            ]
        ],
        'company' => [
            'with_timestamps' => true,
            'cols' => [
                'name' => [ 'string' ],
            ]
        ],
        'crm_company' => [
            'with_timestamps' => true,
            'cols' => [
                'creator_id' => [ 'integer', 'nullable' ],
                'source' => [ 'string' ],
                'name' => [ 'string', 'with_quotes' ],
                'description' => [ 'string', 'nullable', 'with_quotes' ],
                'interval_employee' => [ 'string', 'nullable' ],
                'city' => [ 'string', 'nullable', 'with_quotes' ],
                'website' => [ 'string', 'nullable', 'with_quotes' ],
                'postal_address' => [ 'string', 'nullable', 'with_quotes' ],
                'postal_code' => [ 'integer', 'nullable' ],
                'annual_revenues' => [ 'integer', 'nullable' ],
                'sectors' => [ 'string', 'nullable', 'with_quotes' ],
                'i18n_country_id' => [ 'integer', 'nullable' ],
            ]
        ],
        'crm_contact' => [
            'with_timestamps' => true,
            'cols' => [
                'source' => [ 'string' ],
                'lastname' => [ 'string', 'nullable', 'with_quotes' ],
                'firstname' => [ 'string', 'nullable', 'with_quotes' ],
                'email' => [ 'string' ],
                'phone' => [ 'string', 'nullable' ],
                'i18n_country_id' => [ 'integer', 'nullable' ],
                'creator_id' => [ 'integer', 'nullable' ],
            ]
        ],
        'crm_contact_company' => [
            'cols' => [
                'crm_contact_id' => [ 'integer' ],
                'crm_company_id' => [ 'integer' ],
                'function' => [ 'string', 'nullable', 'with_quotes' ],
                'email' => [ 'string', 'nullable' ],
                'phone' => [ 'string', 'nullable' ],
            ]
        ],
        'crm_contact_data' => [
            'cols' => []
        ],
        'crm_contact_group' => [
            'cols' => [
                'crm_contact_id' => [ 'integer' ],
                'crm_group_id' => [ 'integer' ],
            ]
        ],
        'crm_group' => [
            'with_timestamps' => true,
            'cols' => [
                'source' => [ 'string' ],
                'name' => [ 'string', 'with_quotes' ],
                'description' => [ 'string', 'nullable', 'with_quotes' ],
                'filters' => [ 'string', 'nullable', 'with_quotes' ],
                'creator_id' => [ 'integer', 'nullable' ],
            ]
        ],
        'explorer_directory' => [
            'with_timestamps' => true,
            'cols' => [
                'parent_id' => [ 'integer', 'nullable' ],
                'creator_id' => [ 'integer', 'nullable' ],
                'name' => [ 'string', 'with_quotes' ],
            ]
        ],
        'explorer_file' => [
            'with_timestamps' => true,
            'cols' => [
                'directory_id' => [ 'integer' ],
                'creator_id' => [ 'integer', 'nullable' ],
                'filename' => [ 'string', 'with_quotes' ],
                'extension' => [ 'string' ],
                'size' => [ 'integer' ],
            ]
        ],
        'explorer_file_meta' => [
            'cols' => [
                'file_id' => [ 'integer' ],
                'name' => [ 'string', 'with_quotes' ],
                'value' => [ 'string', 'with_quotes' ],
            ]
        ],
        'group' => [
            'with_timestamps' => true,
            'cols' => [
                'name' => [ 'string' ],
            ]
        ],
        'group_user' => [
            'cols' => [
                'group_id' => [ 'integer' ],
                'user_id' => [ 'integer' ],
            ]
        ],
        'product' => [
            'with_timestamps' => true,
            'cols' => [
                'parent_id' => [ 'integer', 'nullable' ],
                'name' => [ 'string', 'with_quotes' ],
                'family' => [ 'string', 'nullable', 'with_quotes' ],
                'price_before_tax' => [ 'integer', 'nullable' ],
                'price_with_tax' => [ 'integer', 'nullable' ],
                'tva' => [ 'integer', 'nullable' ],
                'subscription_period' => [ 'string', 'nullable' ],
                'fabrication_cost' => [ 'integer', 'nullable' ],
                'started_at' => [ 'string', 'nullable' ],
                'stopped_at' => [ 'string', 'nullable' ],
            ]
        ],
        'product_option' => [
            'with_timestamps' => true,
            'cols' => [
                'product_id' => [ 'integer' ],
                'name' => [ 'string', 'with_quotes' ],
                'price' => [ 'integer', 'nullable' ],
            ]
        ],
        'product_spare_part' => [
            'with_timestamps' => true,
            'cols' => [
                'product_id' => [ 'integer' ],
                'product_used_id' => [ 'integer', 'nullable' ],
                'name' => [ 'string', 'with_quotes' ],
                'supplier_provider_id' => [ 'integer', 'nullable' ],
                'supplier_manufacturer_id' => [ 'integer', 'nullable' ],
                'amount' => [ 'integer', 'nullable' ],
                'price' => [ 'integer', 'nullable' ],
            ]
        ],
        'supplier' => [
            'with_timestamps' => true,
            'cols' => [
                'crm_company_id' => [ 'integer', 'nullable' ],
                'name' => [ 'string', 'with_quotes' ],
                'is_provider' => [ 'boolean' ],
                'is_manufacturer' => [ 'boolean' ],
            ]
        ],
        'tag' => [
            'cols' => [
                'name' => [ 'string', 'with_quotes' ],
                'module' => [ 'string' ],
            ]
        ],
        'tag_link' => [
            'cols' => [
                'tag_id' => [ 'integer' ],
                'entity_type' => [ 'string' ],
                'entity_id' => [ 'integer' ],
                'parent_type' => [ 'string', 'nullable' ],
                'parent_id' => [ 'integer', 'nullable' ],
            ]
        ],
        'user' => [
            'with_timestamps' => true,
            'cols' => [
                'company_id' => [ 'integer' ],
                'email' => [ 'string' ],
                'password' => [ 'string', 'with_quotes' ],
                'firstname' => [ 'string', 'with_quotes' ],
                'lastname' => [ 'string', 'with_quotes' ],
                'avatar' => [ 'string', 'nullable' ],
                'token_enable' => [ 'string', 'nullable', 'with_quotes' ],
                'active' => [ 'boolean' ],
                'enabled_at' => [ 'string', 'nullable' ],
                'i18n_country_id' => [ 'integer', 'nullable' ],
                'lang' => [ 'string' ],
                'timezone' => [ 'string' ],
                'date_format' => [ 'string' ],
                'role' => [ 'string', 'nullable', 'with_quotes' ],
                'deleted_at' => [ 'string', 'nullable' ],
            ]
        ],
        'user_module' => [
            'with_timestamps' => true,
            'cols' => [
                'user_id' => [ 'integer' ],
                'module_id' => [ 'integer' ],
            ]
        ],
        'user_permission' => [
            'with_timestamps' => true,
            'cols' => [
                'user_id' => [ 'integer' ],
                'module_id' => [ 'integer' ],
                'permission' => [ 'string' ],
                'type' => [ 'string' ],
                'value' => [ 'string', 'nullable', 'with_quote' ],
            ]
        ],
        'user_setting' => [
            'cols' => [
                'user_id' => [ 'integer' ],
                'setting' => [ 'string' ],
                'type' => [ 'string' ],
                'value' => [ 'string', 'nullable', 'with_quotes' ],
            ]
        ],
    ];
}