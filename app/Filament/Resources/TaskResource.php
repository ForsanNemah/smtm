<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Task;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\TaskResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TaskResource\RelationManagers;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('New Task')->schema([



                    MarkdownEditor::make('des')
                        ->label('Description')
                        ->required()->columnSpanFull(),

                    Select::make('project_id')
                        ->label('Project')
                        ->relationship('project', 'name')
                        ->searchable()
                        ->required()
                        ->preload()
                        ->columnSpanFull(),


                    Select::make('task_sender_id')
                        ->label('Task Sender')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->required()
                        ->preload()
                        ->columnSpan(1),


                    Select::make('task_reciver_id')
                        ->label('Task Reciver')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->required()
                        ->preload()
                        ->columnSpan(1),


                    DatePicker::make('start_date')
                        ->label('Start Date')
                        ->required()
                        ->native(false)
                        ->displayFormat('d/m/Y')
                        ->columnSpan(1),

                    DatePicker::make('end_date')
                        ->label('End Date')
                        ->required()
                        ->native(false)
                        ->displayFormat('d/m/Y')
                        ->columnSpan(1),


                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([


                TextColumn::make('project.name'),

                TextColumn::make('task_sender_id')->label('Task Sender'),

                TextColumn::make('task_reciver_id')->label('Task Reciver'),

                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date('d-m-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('end_date')
                    ->label(' End Date')
                    ->date('d-m-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),


                TextColumn::make('created_at')
                    ->date('d-m-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'view' => Pages\ViewTask::route('/{record}'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
