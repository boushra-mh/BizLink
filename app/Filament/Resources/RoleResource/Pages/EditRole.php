<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Services\Web\Admin\RolesAndPermissions\RoleService;
use Filament\Resources\Pages\EditRecord;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class; protected function handleRecordUpdate($record, array $data): \Illuminate\Database\Eloquent\Model
    {
        app(RoleService::class)->update($record, $data);
        return $record->refresh();
    }

    protected function afterSave(): void
    {
           session()->flash('success', 'Role Updated successfully.');
    }
}
