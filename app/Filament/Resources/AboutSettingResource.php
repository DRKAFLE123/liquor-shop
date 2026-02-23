<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutSettingResource\Pages;
use App\Models\AboutSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutSettingResource extends Resource
{
    protected static ?string $model = AboutSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = 'About Page';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Hero Section')
                ->description('The top banner area of the About page.')
                ->schema([
                    Forms\Components\TextInput::make('hero_subtitle')
                        ->label('Subtitle (above title)')
                        ->required(),
                    Forms\Components\TextInput::make('hero_title')
                        ->label('Main Title')
                        ->required(),
                    Forms\Components\Textarea::make('hero_intro')
                        ->label('Intro Paragraph')
                        ->rows(3),
                ])->columns(1),

            Forms\Components\Section::make('Vision Section')
                ->description('The side-by-side image and text section.')
                ->schema([
                    Forms\Components\TextInput::make('vision_heading')
                        ->label('Section Heading'),
                    Forms\Components\Textarea::make('vision_text')
                        ->label('Vision Text')
                        ->rows(4),
                    Forms\Components\FileUpload::make('image_path')
                        ->label('Section Image')
                        ->image()
                        ->disk('public')
                        ->directory('about'),
                ])->columns(1),

            Forms\Components\Section::make('Store Values')
                ->description('Two highlighted values shown below the vision text.')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('value1_title')->label('Value 1 Title'),
                        Forms\Components\Textarea::make('value1_text')->label('Value 1 Description')->rows(2),
                        Forms\Components\TextInput::make('value2_title')->label('Value 2 Title'),
                        Forms\Components\Textarea::make('value2_text')->label('Value 2 Description')->rows(2),
                    ]),
                ]),

            Forms\Components\Section::make('Compliance Section')
                ->description('The license & regulation quote box at the bottom.')
                ->schema([
                    Forms\Components\TextInput::make('compliance_heading')->label('Heading'),
                    Forms\Components\Textarea::make('compliance_quote')->label('Quote Text')->rows(3),
                    Forms\Components\TextInput::make('cert1')->label('Certification 1'),
                    Forms\Components\TextInput::make('cert2')->label('Certification 2'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_title')->label('Page Title')->limit(50),
                Tables\Columns\TextColumn::make('updated_at')->label('Last Updated')->since(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAboutSettings::route('/'),
        ];
    }
}
