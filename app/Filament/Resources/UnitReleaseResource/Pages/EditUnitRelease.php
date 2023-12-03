<?php

namespace App\Filament\Resources\UnitReleaseResource\Pages;

use App\Enums\ApplicationStatus;
use App\Models;
use App\Filament\Resources\UnitReleaseResource\Pages;
use App\Enums\ReleaseStatus;
use App\Filament\Resources\UnitReleaseResource;
use App\Models\CustomerApplication;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditUnitRelease extends EditRecord
{
    protected static string $resource = UnitReleaseResource::class;

    protected function getRedirectUrl(): ?string
    {
        return Pages\ListUnitReleases::getUrl();
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        //calculates due date.
        $customer_application = new CustomerApplication;
        $due_date = $customer_application->calculateDueDate(Carbon::now());
        $data["due_date"] = $due_date;
        $data["application_status"] = ApplicationStatus::APPROVED_STATUS->value;
        $data["release_status"] = ReleaseStatus::RELEASED->value;
        Models\Unit::query()->where("id", $data['units_id'])
                ->update(['customer_application_id' => $this->record->id]);
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
