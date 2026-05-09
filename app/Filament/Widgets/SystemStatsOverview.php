<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SystemStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Companies', Company::count())
                ->description('Active: ' . Company::where('is_active', true)->count())
                ->color('primary'),
            Stat::make('Employees', Employee::count())
                ->description('Public: ' . Employee::where('public_profile_enabled', true)->count())
                ->color('success'),
            Stat::make('Total Scans', Employee::sum('scan_count'))
                ->description('Across all profiles')
                ->color('info'),
            Stat::make('Admin Users', User::count())
                ->description('Panel access accounts')
                ->color('warning'),
        ];
    }
}
