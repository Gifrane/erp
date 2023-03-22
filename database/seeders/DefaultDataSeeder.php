<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultDataSeeder extends Seeder
{
    // Start list registered entities
    private array $registered_company = [];
    private array $registered_group = [];
    private array $registered_user = [];
    private array $registered_group_user = [];
    private array $registered_account_admin = [];
    private array $registered_account_setting = [];
    private array $registered_user_module = [];
    private array $registered_user_permission = [];
    private array $registered_user_setting = [];
    private array $registered_api_keys = [];
    private array $registered_crm_company = [];
    private array $registered_crm_group = [];
    private array $registered_crm_contact = [];
    private array $registered_crm_contact_group = [];
    private array $registered_crm_contact_company = [];
    private array $registered_product = [];
    private array $registered_product_option = [];
    private array $registered_supplier = [];
    private array $registered_product_spare_part = [];
    private array $registered_billing = [];
    private array $registered_explorer_directory = [];
    private array $registered_explorer_file = [];
    private array $registered_explorer_file_meta = [];
    private array $registered_bookmark = [];
    private array $registered_tag = [];
    private array $registered_tag_link = [];
    // End list registered entities

    public function run()
    {
        // Start list order calls
        $this->company();
        $this->group();
        $this->user();
        $this->group_user();
        $this->account_admin();
        $this->account_setting();
        $this->user_module();
        $this->user_permission();
        $this->user_setting();
        $this->api_keys();
        $this->crm_company();
        $this->crm_group();
        $this->crm_contact();
        $this->crm_contact_group();
        $this->crm_contact_company();
        $this->product();
        $this->product_option();
        $this->supplier();
        $this->product_spare_part();
        $this->billing();
        $this->explorer_directory();
        $this->explorer_file();
        $this->explorer_file_meta();
        $this->bookmark();
        $this->tag();
        $this->tag_link();
        // End list order calls
    }

    // Start account_admin datas
    private function account_admin(?int $entity_id = null)
    {
    }
    // End account_admin datas

    // Start account_setting datas
    private function account_setting(?int $entity_id = null)
    {
    }
    // End account_setting datas

    // Start api_keys datas
    private function api_keys(?int $entity_id = null)
    {
    }
    // End api_keys datas

    // Start billing datas
    private function billing(?int $entity_id = null)
    {
    }
    // End billing datas

    // Start bookmark datas
    private function bookmark(?int $entity_id = null)
    {
    }
    // End bookmark datas

    // Start company datas
    private function company(?int $entity_id = null)
    {
    }
    // End company datas

    // Start crm_company datas
    private function crm_company(?int $entity_id = null)
    {
    }
    // End crm_company datas

    // Start crm_contact datas
    private function crm_contact(?int $entity_id = null)
    {
    }
    // End crm_contact datas

    // Start crm_contact_company datas
    private function crm_contact_company(?int $entity_id = null)
    {
    }
    // End crm_contact_company datas

    // Start crm_contact_data datas
    // End crm_contact_data datas

    // Start crm_contact_group datas
    private function crm_contact_group(?int $entity_id = null)
    {
    }
    // End crm_contact_group datas

    // Start crm_group datas
    private function crm_group(?int $entity_id = null)
    {
    }
    // End crm_group datas

    // Start explorer_directory datas
    private function explorer_directory(?int $entity_id = null)
    {
    }
    // End explorer_directory datas

    // Start explorer_file datas
    private function explorer_file(?int $entity_id = null)
    {
    }
    // End explorer_file datas

    // Start explorer_file_meta datas
    private function explorer_file_meta(?int $entity_id = null)
    {
    }
    // End explorer_file_meta datas

    // Start group datas
    private function group(?int $entity_id = null)
    {
    }
    // End group datas

    // Start group_user datas
    private function group_user(?int $entity_id = null)
    {
    }
    // End group_user datas

    // Start product datas
    private function product(?int $entity_id = null)
    {
    }
    // End product datas

    // Start product_option datas
    private function product_option(?int $entity_id = null)
    {
    }
    // End product_option datas

    // Start product_spare_part datas
    private function product_spare_part(?int $entity_id = null)
    {
    }
    // End product_spare_part datas

    // Start supplier datas
    private function supplier(?int $entity_id = null)
    {
    }
    // End supplier datas

    // Start tag datas
    private function tag(?int $entity_id = null)
    {
    }
    // End tag datas

    // Start tag_link datas
    private function tag_link(?int $entity_id = null)
    {
    }
    // End tag_link datas

    // Start user datas
    private function user(?int $entity_id = null)
    {
    }
    // End user datas

    // Start user_module datas
    private function user_module(?int $entity_id = null)
    {
    }
    // End user_module datas

    // Start user_permission datas
    private function user_permission(?int $entity_id = null)
    {
    }
    // End user_permission datas

    // Start user_setting datas
    private function user_setting(?int $entity_id = null)
    {
    }
    // End user_setting datas
}
