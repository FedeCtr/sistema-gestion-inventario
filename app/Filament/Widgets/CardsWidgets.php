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

            Stat::make(__('Categories'), Category::query()->count())
                ->description(__('Total Categories'))
                ->descriptionIcon('heroicon-m-tag', IconPosition::Before)
                ->chart($chartData)
                ->color('primary'),

            Stat::make(__('Products'), Product::query()->count())
                ->description(__('Total available Products'))
                ->descriptionIcon('heroicon-m-squares-2x2', IconPosition::Before)
                ->chart([7, 2, 10, 3, 14, 4, 17])
                ->color('success'),

            Stat::make(__('Suppliers'), Supplier::query()->count())
                ->description(__('Total Suppliers'))
                ->descriptionIcon('heroicon-m-truck', IconPosition::Before)
                ->chart([3, 5, 2, 8, 6, 4, 9])
                ->color('danger'),
        ];
    }
}
