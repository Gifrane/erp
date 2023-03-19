<?php
namespace App\Actions\Crm\Company;

use function app;

class DetailsAction
{
    /**
     * @return array
     */
    public function execute(): array
    {
        try {
            $company = app()->company;

            return [ 'success' => true, 'data' => $company ];
        } catch (\Exception $e) {
            throw new \Exception('crm.companies.details.error_during_retrieving', 500, $e);
        }
    }
}
