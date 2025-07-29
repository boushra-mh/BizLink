<?php

namespace App\Filament\Resources;

use App\Enums\StatusEnum;
use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Role;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
     protected static ?string $model = Role::class;

    protected static ?string $navigationLabel = 'Roles';
    protected static ?string $pluralModelLabel = 'Roles';
    protected static ?string $slug = 'roles';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
       return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Role Title'),
                    Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->required()
                   
                    ,
Forms\Components\CheckboxList::make('permissions')
    ->relationship('permissions', 'name')
    ->columns(3)
    ->label('Permissions')
    ->required()
    ->rules(['array', 'min:1'])
    ->helperText('Please select at least one permission.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Role Title')->sortable()->searchable(),
                 Tables\Columns\BadgeColumn::make('status')
    ->formatStateUsing(fn (string $state) => StatusEnum::from($state)->label())
    ->color(fn (string $state) => StatusEnum::from($state)->color()),
                Tables\Columns\TextColumn::make('users_count')
                    ->counts('users')
                    ->label('Number of Users'),
                Tables\Columns\BadgeColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\Filter::make('status')
                    ->form([
                        Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ]),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when($data['status'], fn($q) => $q->where('status', $data['status']));
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
