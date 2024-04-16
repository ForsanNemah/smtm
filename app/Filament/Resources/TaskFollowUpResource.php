<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Task;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TaskFollowUp;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use function Laravel\Prompts\select;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TaskFollowUpResource\Pages;
use App\Filament\Resources\TaskFollowUpResource\RelationManagers;
use App\Models\TaskStatus;

class TaskFollowUpResource extends Resource
{
    protected static ?string $model = TaskFollowUp::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('New Task Follow Up')->schema([

                    Select::make('task_id')
                        ->label('Task')
                        ->options(fn (Get $get): Collection => Task::query()
                            ->where('task_sender_id', auth()->user()->id)
                            ->orWhere('task_reciver_id', auth()->user()->id)
                            ->pluck('des', 'id')),



                    Select::make('task_status_id')
                        ->label('Task Status')
                        ->relationship('taskStatus', 'name')
                        ->searchable()
                        ->required()
                        ->preload()
                        ->columnSpan(1),

                    // Select::make('task_status_id')
                    //     ->label('Task Status')
                    //     ->options(TaskStatus::pluck('name', 'id'))
                    //     ->disableOptionWhen(fn (Get $get): bool => filled('only_for_admin' == true)),

                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('user.name'),
                TextColumn::make('task.des'),
                TextColumn::make('taskStatus.name'),

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
            'index' => Pages\ListTaskFollowUps::route('/'),
            'create' => Pages\CreateTaskFollowUp::route('/create'),
            'edit' => Pages\EditTaskFollowUp::route('/{record}/edit'),
        ];
    }
}
