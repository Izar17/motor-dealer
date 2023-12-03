<?php

namespace App\Filament\Resources\CustomerApplicationResource\Pages;

use App\Enums\ApplicationStatus;
use App\Filament\Resources\CustomerApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerApplications extends ListRecords
{
    protected static string $resource = CustomerApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'pending' => ListRecords\Tab::make()->query(fn ($query) => $query->where('application_status', ApplicationStatus::PENDING_STATUS->value)),
            'approved' => ListRecords\Tab::make()->query(fn ($query) => $query->where('application_status', ApplicationStatus::APPROVED_STATUS->value)),
            'active' => ListRecords\Tab::make()->query(fn ($query) => $query->where('application_status', ApplicationStatus::ACTIVE_STATUS->value)),
            'repo' => ListRecords\Tab::make()->query(fn ($query) => $query->where('application_status',  ApplicationStatus::REPO_STATUS->value)),
            'closed' => ListRecords\Tab::make()->query(fn ($query) => $query->where('application_status',  ApplicationStatus::CLOSED_STATUS->value)),
            'rejected' => ListRecords\Tab::make()->query(fn ($query) => $query->where('application_status', ApplicationStatus::REJECTED_STATUS->value)),
        ];
    }

}
