<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('User information'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->maxLength(100)
                            ->required(),
                        TextInput::make('email')
                            ->label(__('E-mail'))
                            ->email()
                            ->required()
                            ->unique(User::class, ignoreRecord: true)
                            ->maxLength(255),
                        TextInput::make('password')
                            ->label(__('Password'))
                            ->password()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrated(fn ($state): bool => filled($state))
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->minLength(8)
                            ->helperText('Must be at least 8 characters.')
                            ->visibleOn('create'),
                    ])
                    ->columns(2),
                Section::make('Roles and Permissions')
                    ->schema([
                        Select::make('roles')
                            ->label(__('Roles'))
                            ->multiple()
                            ->relationship('roles', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Select roles')
                            ->helperText('If you do not select any roles, the "guest" role will be assigned by default.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
