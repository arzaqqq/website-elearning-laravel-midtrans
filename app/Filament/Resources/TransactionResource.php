<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Pricing;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Wizard\Step;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Product and Price')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    Select::make('pricing_id')
                                        ->relationship('pricing', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->columnspanfull()
                                        ->live()
                                        ->reactive() // Penting agar otomatis memperbarui field lain
                                        ->afterStateUpdated(function (callable $set, $state) {
                                            $pricing = Pricing::find($state);

                                            if ($pricing) {
                                                $price = $pricing->price;
                                                $duration = $pricing->duration;

                                                $subTotal = $price; // Karena quantity tidak ada, hanya pakai harga
                                                $totalPpn = $subTotal * 0.11;
                                                $totalAmount = $subTotal + $totalPpn;

                                                $set('total_tax_amount', $totalPpn);
                                                $set('grand_total_amount', $totalAmount);
                                                $set('sub_total_amount', $subTotal);
                                                $set('duration', $duration);
                                            } else {
                                                // Reset jika tidak ada pilihan
                                                $set('total_tax_amount', 0);
                                                $set('grand_total_amount', 0);
                                                $set('sub_total_amount', 0);
                                                $set('duration', 0);
                                            }
                                        }),
                                        TextInput::make('duration')
                                        ->required()
                                        ->columnspanfull()
                                        ->numeric()
                                        ->readonly()
                                        ->prefix('Months'),
                                ]),

                            Grid::make(3)
                                ->schema([


                                    TextInput::make('sub_total_amount')
                                        ->required()
                                        ->numeric()
                                        ->prefix('IDR')
                                        ->readOnly(),

                                    TextInput::make('total_tax_amount')
                                        ->required()
                                        ->numeric()
                                        ->prefix('IDR')
                                        ->readOnly(),

                                    TextInput::make('grand_total_amount')
                                        ->required()
                                        ->numeric()
                                        ->prefix('IDR')
                                        ->readOnly(),
                                ]),


                                Grid::make(2)
                                ->schema([
                                    DatePicker::make('started_at')
                    ->live() // Pastikan live update
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $duration = $get('duration'); // Ambil nilai duration
                        if ($state && $duration) {
                            $endedAt = Carbon::parse($state)->addMonths($duration);
                            $set('ended_at', $endedAt->format('Y-m-d')); // Set ended_at secara otomatis
                        }
                    })
                    ->required(),

                                    DatePicker::make('ended_at')
                                        ->readOnly()
                                        ->required(),
                                ])

                        ]),
                ])
                ->columnSpanFull()
                ->columns(1)
                ->skippable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
