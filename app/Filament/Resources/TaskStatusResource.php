<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\TaskStatus;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TaskStatusResource\Pages;
use App\Filament\Resources\TaskStatusResource\RelationManagers;

class TaskStatusResource extends Resource
{
    protected static ?string $model = TaskStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->is_admin == 1 ? true : false;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('New Task Status')->schema([

                    TextInput::make('name')
                        ->required(),

                    Checkbox::make('only_for_admin')->inline(false)

                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                TextColumn::make('id'),


                TextColumn::make('name'),

                IconColumn::make('only_for_admin')
                    ->boolean()
                    ->label('Only For Admin'),

                TextColumn::make('created_at')
                    ->label('Date')
                    ->date('d-m-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskStatuses::route('/'),
            'create' => Pages\CreateTaskStatus::route('/create'),
            'edit' => Pages\EditTaskStatus::route('/{record}/edit'),
        ];
    }
}
