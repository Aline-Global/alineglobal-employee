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
use Filament\Tables\Actions\ActionGroup;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Employee Information')
                    ->description('Core profile information for your directory.')
                    ->schema([
                        Forms\Components\Select::make('company_id')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
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
                        Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->default('active'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Contact & Social')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->tel(),
                        Forms\Components\TextInput::make('whatsapp')
                            ->tel(),
                        Forms\Components\TextInput::make('email')
                            ->email(),
                        Forms\Components\TextInput::make('linkedin_url')
                            ->url(),
                        Forms\Components\TextInput::make('facebook_url')
                            ->url(),
                        Forms\Components\TextInput::make('instagram_url')
                            ->url(),
                        Forms\Components\Textarea::make('bio')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Profile Visibility')
                    ->schema([
                        Forms\Components\FileUpload::make('photo_url')
                            ->disk('public')
                            ->directory('employees')
                            ->image(),
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
                    ])
                    ->columns(2),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo_url')
                    ->circular(),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),
                Tables\Columns\TextColumn::make('designation')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->copyable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'active' ? 'success' : 'gray'),
                Tables\Columns\IconColumn::make('public_profile_enabled')
                    ->boolean()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('scan_count')
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M j, Y h:i A')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status'),
                Tables\Filters\TernaryFilter::make('public_profile_enabled'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                ActionGroup::make([
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
                    ->icon('heroicon-m-ellipsis-horizontal')
                    ->label('Actions'),
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
