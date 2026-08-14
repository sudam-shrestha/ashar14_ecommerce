<?php

namespace App\Filament\Resources\Dokans\Pages;

use App\Filament\Resources\Dokans\DokanResource;
use App\Mail\DokanApprovalNotification;
use App\Models\Dokan;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;
use Override;

class EditDokan extends EditRecord
{
    protected static string $resource = DokanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    #[Override]
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $dokan = $this->record;
        if ($dokan->password == null && $data["status"] == "approved") {
            $password = rand(100000, 999999);
            $data['password'] = $password;
            Mail::to($dokan->email)->send(new DokanApprovalNotification($dokan, $password));
        }
        return parent::mutateFormDataBeforeSave($data);
    }
}
