<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class ChartPieWidget extends ChartWidget
{
    protected ?string $heading = 'Category Chart - Pie';
    protected ?string $maxHeight = '250px';

    protected function getData(): array
    {
        $categories = Category::withCount('products')->get();
        $data = $categories->pluck('products_count')->toArray();
        $labels = $categories->pluck('name')->toArray();
        
        return [
            'datasets' => [
                [
                    'label' => 'Quantity of products',
                    'data' => $data,
                    'backgroundColor' => [
                        '#f87171', // Red 400
                        '#60a5fa', // Blue 400
                        '#34d399', // Green 400
                        '#fbbf24', // Yellow 400
                        '#a78bfa', // Purple 400
                        '#f472b6', // Pink 400
                        '#6ee7b7', // Emerald 400
                        '#fcd34d', // Amber 400
                        '#cbd5e1', // Slate 400
                        '#f87171', // Red 400 (repeated for more categories)
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
    
    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'right',
                ],
            ],
        ];
    }
}
