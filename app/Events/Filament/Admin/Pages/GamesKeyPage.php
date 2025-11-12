<?php

namespace App\Filament\Admin\Pages;

use App\Models\GamesKey;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;

class GamesKeyPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.games-key-page';

    protected static ?string $title = 'Chaves dos Jogos';

    // protected static ?string $slug = 'chaves-dos-jogos';

    /**
     * @dev @victormsalatiel
     * @return bool
     */
    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('admin');
    }


    public ?array $data = [];
    public ?GamesKey $setting;

    /**
     * @return void
     */
    public function mount(): void
    {
        $gamesKey = GamesKey::first();
        if(!empty($gamesKey)) {
            $this->setting = $gamesKey;
            $this->form->fill($this->setting->toArray());
        }else{
            $this->form->fill();
        }
    }

    /**
     * @param Form $form
     * @return Form
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Playfiver OndaGames')
                    ->description(new HtmlString('Você pode obter suas chaves de acesso no painel <a href="https://playfiver.app" target="_blank" style="color: red;">playfiver.app</a> ao criar o chicobets.site agente.'))
                        ->schema([
                            TextInput::make('playfiver_code')
                                ->label('CÓDIGO DO AGENTE')
                                ->placeholder('Digite aqui o código do agente')
                                ->maxLength(191),
                            TextInput::make('playfiver_token')
                                ->label('AGENTE TOKEN')
                                ->placeholder('Digite aqui o token do agente')
                                ->maxLength(191),
                            TextInput::make('playfiver_secret')
                                ->label('AGENTE SECRETO')
                                ->placeholder('Digite aqui o código secreto do agente')
                                ->maxLength(191),
                        ])->columns(3),
                Section::make('Drakon API')
                ->description(new HtmlString('Compre direto pelo site: <a href="https://gator.drakon.casino" target="_blank" style="color: red;">gator.drakon.casino</a> Telegram: <a href="https://t.me/drakongator" target="_blank" style="color: red;">@drakonsuporte</a>'))
                ->schema([
                    TextInput::make('drakon_agent_code')
                        ->label('Agent Code')
                        ->placeholder('Digite aqui o Agent Code')
                        ->maxLength(191),
                    TextInput::make('drakon_agent_token')
                        ->label('Agent Token')
                        ->placeholder('Digite aqui o Agent Token')
                        ->maxLength(191),
                    TextInput::make('drakon_agent_secret')
                        ->label('Agent Secret')
                        ->placeholder('Digite aqui a Agente Secret')
                        ->maxLength(191),
                ])->columns(3),
                Section::make('EverGame API')
                    ->description('Ajustes de credenciais para a EverGame')
                    ->schema([
                        TextInput::make('evergame_agent_code')
                            ->label('Agent Code')
                            ->placeholder('Digite aqui o Agent Code')
                            ->maxLength(191),
                        TextInput::make('evergame_agent_token')
                            ->label('Agent Token')
                            ->placeholder('Digite aqui o Agent Token')
                            ->maxLength(191),
                        TextInput::make('evergame_api_endpoint')
                            ->label('Api Endpoint')
                            ->placeholder('Digite aqui a API Endpoint')
                            ->maxLength(191)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('PG 16 Jogos')
                    ->description('Ajustes de credenciais para a PG 16 Panel')
                    ->schema([
                        TextInput::make('apipg12_url')
                            ->label('URL')
                            ->placeholder('Digite aqui a URL')
                            ->maxLength(191),
                        TextInput::make('apipg12_secret')
                            ->label('Agent Secret')
                            ->placeholder('Digite aqui o código secreto do agente')
                            ->maxLength(191),
                        TextInput::make('apipg12_code')
                            ->label('Agent Code')
                            ->placeholder('Digite aqui o código do agente')
                            ->maxLength(191),
                        TextInput::make('apipg12_token')
                            ->label('Agent Token')
                            ->placeholder('Digite aqui o token do agente')
                            ->maxLength(191),
                    ])
                    ->columns(3),

            ])
            ->statePath('data');
    }


    /**
     * @return void
     */
    public function submit(): void
    {
        try {
            if(env('APP_DEMO')) {
                Notification::make()
                    ->title('Atenção')
                    ->body('Você não pode realizar está alteração na versão demo')
                    ->danger()
                    ->send();
                return;
            }

            $setting = GamesKey::first();
            if(!empty($setting)) {
                if($setting->update($this->data)) {
                    Notification::make()
                        ->title('Chaves Alteradas')
                        ->body('Suas chaves foram alteradas com sucesso!')
                        ->success()
                        ->send();
                }
            }else{
                if(GamesKey::create($this->data)) {
                    Notification::make()
                        ->title('Chaves Criadas')
                        ->body('Suas chaves foram criadas com sucesso!')
                        ->success()
                        ->send();
                }
            }


        } catch (Halt $exception) {
            Notification::make()
                ->title('Erro ao alterar dados!')
                ->body('Erro ao alterar dados!')
                ->danger()
                ->send();
        }
    }
}

