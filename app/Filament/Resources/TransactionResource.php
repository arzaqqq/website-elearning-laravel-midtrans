<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Pricing;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Wizard\Step;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TransactionResource\Pages;
use Illuminate\Database\Eloquent\Factories\Relationship;
use App\Filament\Resources\TransactionResource\RelationManagers;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Customer';


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


                        Step::make('customer Information')
                        ->schema([
                            Forms\Components\Select::make('user_id')
                            ->relationship('student', 'email')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $user = User::find($state);
                                if ($user) {
                                    $set('name', $user->name);
                                    $set('email', $user->email);
                                }
                            })
                            ->afterStateHydrated(function (callable $set, $state) {
                                if ($state) {
                                    $user = User::find($state);
                                    if ($user) {
                                        $set('name', $user->name);
                                        $set('email', $user->email);
                                    }
                                }
                            }),

                            TextInput::make('name')
                            ->required()
                            ->readonly()
                            ->maxLength(255),

                            TextInput::make('email')
                            ->required()
                            ->readonly()

                            ->maxLength(255),
                        ]),

                        Forms\Components\Wizard\Step::make('Payment Information')
                            ->schema([
                                ToggleButtons::make('is_paid')
                                    ->label('Apakah sudah membayar?')
                                    ->boolean()
                                    ->grouped()
                                    ->icons([
                                        'true' => 'heroicon-o-pencil',
                                        'false' => 'heroicon-o-clock',
                                    ])
                                    ->required(),

                                Forms\Components\Select::make('payment_type')
                                    ->options([
                                        'Midtrans' => 'Midtrans',
                                        'Manual' => 'Manual',
                                    ])
                                    ->required(),

                                Forms\Components\FileUpload::make('proof')
                                    ->image(),
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
            ->columns([
                ImageColumn::make('student.photo')
                ->circular(),

                TextColumn::make('student.name')
                ->searchable(),

                TextColumn::make('booking_trx_id')
                ->searchable(),

                TextColumn::make('pricing.name'),

                TextColumn::make('created_at'),

                IconColumn::make('is_paid')
                    ->boolean()
                    ->trueColor('success')
                    ->falsecolor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Terverifikasi')

            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('approve')
                ->label('Approve')
                ->action(function (Transaction $record) {
                    $record->update(['is_paid' => true]);

                    // Send notification
                    Notification::make()
                        ->title('Order Approved')
                        ->success()
                        ->body('The order has been successfully approved.')
                        ->send();

                    // Additional actions can be added here:
                    // - Send email
                    // - Send SMS
                    // - Trigger other events
                })
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Approve Transaction')
                ->modalDescription('Are you sure you want to approve this transaction?')
                ->modalSubmitActionLabel('Yes, approve')
                ->visible(fn (Transaction $record): bool => !$record->is_paid),
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
