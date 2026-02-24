<?php

namespace App\Filament\Resources\Products\Tables;

use App\Filament\Exports\ProductExporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sku')
                    ->label(__('SKU'))
                    ->searchable(),
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                TextColumn::make('price')
                    ->label(__('Price'))
                    ->money()
                    ->sortable(),
                TextColumn::make('cost')
                    ->label(__('Cost'))
                    ->money()
                    ->sortable(),
                TextColumn::make('stock')
                    ->label(__('Stock'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('min_stock')
                    ->label(__('Min Stock'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label(__('Category'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('supplier.name')
                    ->label(__('Supplier'))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('Updated At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Export')
                    ->exporter(ProductExporter::class),
            ]);
    }
}
