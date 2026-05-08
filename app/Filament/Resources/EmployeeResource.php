<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                Forms\Components\TextInput::make('full_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('employee_code')
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('designation')
                    ->maxLength(255),
                Forms\Components\TextInput::make('department')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel(),
                Forms\Components\TextInput::make('whatsapp')
                    ->tel(),
                Forms\Components\TextInput::make('email')
                    ->email(),
                Forms\Components\FileUpload::make('photo_url')
                    ->disk('public')
                    ->directory('employees')
                    ->image(),
                Forms\Components\Textarea::make('bio'),
                Forms\Components\TextInput::make('linkedin_url')
                    ->url(),
                Forms\Components\TextInput::make('facebook_url')
                    ->url(),
                Forms\Components\TextInput::make('instagram_url')
                    ->url(),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->default('active'),
                Forms\Components\Toggle::make('public_profile_enabled')
                    ->default(true),
                Forms\Components\Toggle::make('show_phone')
                    ->default(true),
                Forms\Components\Toggle::make('show_whatsapp')
                    ->default(true),
                Forms\Components\Toggle::make('show_email')
                    ->default(true),
                Forms\Components\Toggle::make('show_photo')
                    ->default(true),
                Forms\Components\Toggle::make('show_company_address')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo_url'),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('designation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status'),
                Tables\Columns\IconColumn::make('public_profile_enabled')
                    ->boolean(),
                Tables\Columns\TextColumn::make('scan_count'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status'),
                Tables\Filters\TernaryFilter::make('public_profile_enabled'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('viewProfile')
                    ->label('View Profile')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Employee $record) => route('employee.public.show', $record->slug), shouldOpenInNewTab: true),
                Action::make('downloadQr')
                    ->label('Download QR')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (Employee $record) => route('employee.qr.download', $record), shouldOpenInNewTab: true),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
