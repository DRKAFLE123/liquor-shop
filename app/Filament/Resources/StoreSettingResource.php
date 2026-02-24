<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoreSettingResource\Pages;
use App\Models\StoreSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StoreSettingResource extends Resource
{
    protected static ?string $model = StoreSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Store Settings';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form->schema([

            // ── Section 1: Basic Info ─────────────────────────────────────
            Forms\Components\Section::make('🏪 Basic Information')
                ->description('Store name, logo, and branding details.')
                ->schema([
                    Forms\Components\TextInput::make('store_name')
                        ->label('Store Name')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('51ST LIQUOR AND WINE')
                        ->columnSpanFull(),

                    Forms\Components\FileUpload::make('logo')
                        ->label('Store Logo')
                        ->image()
                        ->imageEditor()
                        ->directory('logos')
                        ->nullable()
                        ->columnSpanFull(),

                    Forms\Components\Toggle::make('show_name_in_navbar')
                        ->label('Show store name next to logo in navbar')
                        ->helperText('When enabled, the store name text appears beside the logo. If no logo is uploaded, the name always shows regardless of this setting.')
                        ->default(true)
                        ->inline(false),

                    Forms\Components\TextInput::make('tagline')
                        ->label('Tagline')
                        ->maxLength(255)
                        ->placeholder('Premium spirits, curated for the discerning palate.')
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('footer_text')
                        ->label('Footer Description')
                        ->rows(3)
                        ->maxLength(500)
                        ->placeholder('Your destination for fine spirits, premium wines, and craft beers.')
                        ->columnSpanFull(),
                ])->collapsible(),

            // ── Section 2: Address ────────────────────────────────────────
            Forms\Components\Section::make('📍 Store Address')
                ->description('Structured address used for SEO schema, footer, and contact page.')
                ->schema([
                    Forms\Components\TextInput::make('address_line_1')
                        ->label('Address Line 1')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('801 Weatherford Hwy')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('address_line_2')
                        ->label('Address Line 2 (Suite, Unit, etc.)')
                        ->maxLength(255)
                        ->placeholder('Suite B')
                        ->nullable(),

                    Forms\Components\TextInput::make('city')
                        ->label('City')
                        ->required()
                        ->maxLength(100)
                        ->placeholder('Granbury'),

                    Forms\Components\TextInput::make('county')
                        ->label('County')
                        ->maxLength(100)
                        ->placeholder('Hood County')
                        ->helperText('e.g. Hood County — used for local SEO and compliance.'),

                    Forms\Components\TextInput::make('state')
                        ->label('State')
                        ->required()
                        ->maxLength(50)
                        ->placeholder('TX'),

                    Forms\Components\TextInput::make('postal_code')
                        ->label('Postal / ZIP Code')
                        ->required()
                        ->maxLength(20)
                        ->placeholder('76049'),

                    Forms\Components\TextInput::make('country')
                        ->label('Country Code')
                        ->required()
                        ->maxLength(10)
                        ->default('US')
                        ->placeholder('US'),
                ])
                ->columns(2)
                ->collapsible(),

            // ── Section 3: Contact ────────────────────────────────────────
            Forms\Components\Section::make('📞 Contact Information')
                ->description('Phone numbers, email, and business hours.')
                ->schema([
                    Forms\Components\TextInput::make('phone')
                        ->label('Primary Phone')
                        ->tel()
                        ->required()
                        ->maxLength(30)
                        ->placeholder('(817) 579-5151'),

                    Forms\Components\TextInput::make('secondary_phone')
                        ->label('Secondary Phone (optional)')
                        ->tel()
                        ->nullable()
                        ->maxLength(30),

                    Forms\Components\TextInput::make('whatsapp')
                        ->label('WhatsApp Number')
                        ->helperText('Include country code, e.g. +18175795151. Will auto-format to wa.me link.')
                        ->nullable()
                        ->maxLength(30)
                        ->placeholder('+18175795151'),

                    Forms\Components\TextInput::make('email')
                        ->label('Email Address')
                        ->email()
                        ->required()
                        ->maxLength(255)
                        ->placeholder('info@51stliquorandwine.com'),

                    Forms\Components\Textarea::make('business_hours')
                        ->label('Business Hours')
                        ->rows(5)
                        ->helperText('Enter one line per day, e.g. "Mon–Sat: 9AM–9PM"')
                        ->placeholder("Mon–Sat: 9:00 AM – 9:00 PM\nSun: 12:00 PM – 6:00 PM")
                        ->nullable()
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->collapsible(),

            // ── Section 4: Social Media ───────────────────────────────────
            Forms\Components\Section::make('🌐 Social Media & Online Presence')
                ->schema([
                    Forms\Components\TextInput::make('facebook')
                        ->label('Facebook URL')
                        ->url()
                        ->nullable()
                        ->maxLength(255)
                        ->placeholder('https://facebook.com/51stliquor'),

                    Forms\Components\TextInput::make('instagram')
                        ->label('Instagram URL')
                        ->url()
                        ->nullable()
                        ->maxLength(255)
                        ->placeholder('https://instagram.com/51stliquor'),

                    Forms\Components\TextInput::make('google_business')
                        ->label('Google Business Profile URL')
                        ->url()
                        ->nullable()
                        ->maxLength(255)
                        ->placeholder('https://g.page/51stliquor')
                        ->helperText('Your Google Maps / Business listing URL.'),
                ])
                ->columns(1)
                ->collapsible(),

            // ── Section 5: Maps ───────────────────────────────────────────
            Forms\Components\Section::make('🗺️ Google Maps Embed')
                ->description('Paste only the full <iframe>...</iframe> code from Google Maps.')
                ->schema([
                    Forms\Components\Textarea::make('google_map_embed')
                        ->label('Google Map Embed Code')
                        ->rows(6)
                        ->placeholder('<iframe src="https://www.google.com/maps/embed?..." ...></iframe>')
                        ->helperText('Go to Google Maps → Share → Embed a map → Copy the HTML. Paste only the <iframe> tag.')
                        ->nullable()
                        ->columnSpanFull(),
                ])->collapsible(),

            // ── Section 6: US Compliance ──────────────────────────────────
            Forms\Components\Section::make('📋 US Compliance & Licensing')
                ->description('Texas TABC license number and tax details. Displayed in footer for compliance.')
                ->schema([
                    Forms\Components\TextInput::make('license_number')
                        ->label('TABC License Number')
                        ->nullable()
                        ->maxLength(100)
                        ->placeholder('TX-MB-XXXXXXX'),

                    Forms\Components\TextInput::make('tax_id')
                        ->label('Tax ID / EIN (optional)')
                        ->nullable()
                        ->maxLength(50)
                        ->placeholder('XX-XXXXXXX'),
                ])
                ->columns(2)
                ->collapsible(true)
                ->collapsed(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('store_name')
                    ->label('Store')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('City')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')
                    ->label('State'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageStoreSettings::route('/'),
        ];
    }
}
