<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, Get $get, ?string $state, ?string $old): void {
                                $currentSlug = (string) ($get('slug') ?? '');
                                $previousNameSlug = Str::slug((string) ($old ?? ''));

                                // Auto-generate only when slug is blank or still tracking previous name.
                                if ($currentSlug === '' || $currentSlug === $previousNameSlug) {
                                    $set('slug', static::generateUniqueSlugFromName((string) $state));
                                }
                            })
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->helperText('Auto-generated from full name. You can edit it manually.')
                            ->validationMessages([
                                'unique' => 'This slug is already used. Please choose a different slug.',
                            ])
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
                            ->required()
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

    protected static function generateUniqueSlugFromName(string $name): string
    {
        $baseSlug = Str::slug($name);

        if ($baseSlug === '') {
            return '';
        }

        $slug = $baseSlug;
        $suffix = 2;

        while (Employee::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo_url')
                    ->getStateUsing(fn (Employee $record): ?string => filled($record->photo_url) && Storage::disk('public')->exists($record->photo_url) ? $record->photo_url : null)
                    ->defaultImageUrl(fn (Employee $record): string => 'https://ui-avatars.com/api/?name=' . urlencode((string) $record->full_name) . '&background=f3e8ef&color=8e1d56&size=96')
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
            ->actionsPosition(ActionsPosition::BeforeColumns)
            ->recordUrl(null)
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
