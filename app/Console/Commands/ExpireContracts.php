<?php

namespace App\Console\Commands;

use App\Models\Contract;
use App\Services\AuditLogService;
use Illuminate\Console\Command;

class ExpireContracts extends Command
{
    protected $signature = 'contracts:expire';

    protected $description = 'Mark active contracts whose end_date has passed as expired.';

    public function handle(AuditLogService $auditLog): int
    {
        $contracts = Contract::query()
            ->where('status', 'active')
            ->whereNotNull('end_date')
            ->whereDate('end_date', '<', now())
            ->get();

        foreach ($contracts as $contract) {
            $contract->update([
                'status' => 'expired',
            ]);

            $auditLog->log(
                'contract.expired',
                "Contract {$contract->contract_number} automatically marked as expired (end date passed)",
                $contract
            );
        }

        $this->info("Expired {$contracts->count()} contract(s).");

        return self::SUCCESS;
    }
}
