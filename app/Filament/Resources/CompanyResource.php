<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Company Identity')
                    ->description('Basic information shown across profiles.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('legal_name')
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('logo_url')
                            ->disk('public')
                            ->directory('companies')
                            ->image(),
                        Forms\Components\TextInput::make('tagline')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('about')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Contact Details')
                    ->schema([
                        Forms\Components\TextInput::make('website')
                            ->url()
                            ->prefixIcon('heroicon-o-globe-alt'),
                        Forms\Components\TextInput::make('main_email')
                            ->email()
                            ->prefixIcon('heroicon-o-envelope'),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->prefixIcon('heroicon-o-phone'),
                        Forms\Components\TextInput::make('map_url')
                            ->url()
                            ->prefixIcon('heroicon-o-map-pin'),
                        Forms\Components\Textarea::make('bangladesh_office_address')
                            ->rows(3),
                        Forms\Components\Textarea::make('uk_office_address')
                            ->rows(3),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Social Links & Status')
                    ->schema([
                        Forms\Components\TextInput::make('facebook_url')
                            ->url(),
                        Forms\Components\TextInput::make('linkedin_url')
                            ->url(),
                        Forms\Components\TextInput::make('instagram_url')
                            ->url(),
                        Forms\Components\TextInput::make('youtube_url')
                            ->url(),
                        Forms\Components\Toggle::make('is_active')
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),
                Tables\Columns\TextColumn::make('website')
                    ->searchable()
                    ->toggleable()
                    ->limit(35)
                    ->copyable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M j, Y h:i A')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
