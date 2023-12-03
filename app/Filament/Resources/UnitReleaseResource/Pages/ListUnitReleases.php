<?php

namespace App\Filament\Resources\UnitReleaseResource\Pages;

use App\Enums\ApplicationStatus;
use App\Enums\ReleaseStatus;
use App\Filament\Resources\UnitReleaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnitReleases extends ListRecords
{
    protected static string $resource = UnitReleaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


    // ->modifyQueryUsing(fn (Builder $query) => $query->where('application_status', ApplicationStatus::ACTIVE_STATUS->value)
    //                                                     ->where('release_status', ReleaseStatus::UN_RELEASED->value))
    public function getTabs(): array
    {
        return [
            ReleaseStatus::UN_RELEASED->value => ListRecords\Tab::make()->query(fn ($query) => $query->where('release_status', ReleaseStatus::UN_RELEASED->value)->orwhere('application_status', ApplicationStatus::ACTIVE_STATUS->value)),
        ];
    }
}
