<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CardsWidgets extends StatsOverviewWidget
{
    protected ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $chartData = collect(range(6,0))
            ->map(function ($day) {
                $date = Carbon::today()->subDays($day);
                return Category::whereDate('created_at', $date)->count();
            })
            ->toArray();

        return [
           /*  Forma basica
            Stat::make('Categories', Category::query()->count()),
            Stat::make('Products', Product::query()->count()),
            Stat::make('Suppliers', Supplier::query()->count()) */

            Stat::make('Categories', Category::query()->count())
                ->description('Total Categories')
                ->descriptionIcon('heroicon-m-tag', IconPosition::Before)
                ->chart($chartData)
                ->color('primary'),

            Stat::make('Products', Product::query()->count())
                ->description('Total available Products')
                ->descriptionIcon('heroicon-m-squares-2x2', IconPosition::Before)
                ->chart([7, 2, 10, 3, 14, 4, 17])
                ->color('success'),

            Stat::make('Suppliers', Supplier::query()->count())
                ->description('Total Suppliers')
                ->descriptionIcon('heroicon-m-truck', IconPosition::Before)
                ->chart([3, 5, 2, 8, 6, 4, 9])
                ->color('danger'),
        ];
    }
}
