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
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('legal_name')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('logo_url')
                    ->disk('public')
                    ->directory('companies')
                    ->image(),
                Forms\Components\TextInput::make('website')
                    ->url(),
                Forms\Components\TextInput::make('main_email')
                    ->email(),
                Forms\Components\TextInput::make('phone')
                    ->tel(),
                Forms\Components\TextInput::make('tagline')
                    ->maxLength(255),
                Forms\Components\Textarea::make('about'),
                Forms\Components\Textarea::make('bangladesh_office_address'),
                Forms\Components\Textarea::make('uk_office_address'),
                Forms\Components\TextInput::make('facebook_url')
                    ->url(),
                Forms\Components\TextInput::make('linkedin_url')
                    ->url(),
                Forms\Components\TextInput::make('instagram_url')
                    ->url(),
                Forms\Components\TextInput::make('youtube_url')
                    ->url(),
                Forms\Components\TextInput::make('map_url')
                    ->url(),
                Forms\Components\Toggle::make('is_active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
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
