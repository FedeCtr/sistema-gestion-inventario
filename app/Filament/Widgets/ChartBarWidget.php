<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;

class ChartBarWidget extends ChartWidget
{
    protected ?string $maxHeight = '250px';

    public function getHeading(): ?string
    {
        return __('Top 10 products with the most stock');
    }

    protected function getData(): array
    {
        $toProducts = Product::orderBy('stock', 'desc')->take(10)->get();
        
        return [
            'datasets' => [
                [
                    'label' => __('Current Stock'),
                    'data' => $toProducts->pluck('stock')->toArray(),
                    'backgroundColor' => '#f59e0b',
                    'borderColor' => '#d97706', // Ámbar 600
                    'borderWidth' => 1,
                    'borderRadius' => 4,
                    'hoverBackgroundColor' => '#fbbf24'
                ],
            ],
            'labels' => $toProducts->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

      protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}
