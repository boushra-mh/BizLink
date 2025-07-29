<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Services\Web\Admin\RolesAndPermissions\RoleService;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;
      protected function handleRecordCreation(array $data): \App\Models\Role
    {
        return app(RoleService::class)->create($data);
    }

   protected function afterCreate(): void
{
$this->redirect(route('filament.resources.roles.index'));
}
}
