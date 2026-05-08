<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseLogin;

class CustomLogin extends BaseLogin
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->autofocus()
                    ->autocomplete()
                    ->extraInputAttributes(['class' => 'rounded-lg'])
                    ->placeholder('admin@alineglobalbd.com'),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->extraInputAttributes(['class' => 'rounded-lg'])
                    ->placeholder('Enter your password'),

                Checkbox::make('remember')
                    ->label('Remember me'),
            ])
            ->statePath('data');
    }
}
