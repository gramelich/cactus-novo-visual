<?php

namespace App\Filament\Admin\Pages;

use App\Models\Gateway;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\HtmlString;
use Filament\Support\Exceptions\Halt;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use App\Models\Report;

class GatewayPage extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.gateway-page';

    public ?array $data = [];
    public Gateway $setting;

    /**
     * @dev @victormsalatiel
     * @return bool
     */
    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $gateway = Gateway::first();
        if(!empty($gateway)) {
            $this->setting = $gateway;
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
                   Section::make('Safira Cash')
                    ->description(new HtmlString('Site Oficial: <a href="https://dash.safira.cash/auth/jwt/login" target="_blank" style="color: red;">https://dash.safira.cash/auth/jwt/login</a>'))
                     ->description(new HtmlString('
                                    <div style="display: flex; align-items: center;">
                                        Precisa de uma conta na SafiraCash? Responda o formulário de contato e solicite sua conta.:
                                        <a class="dark:text-white" 
                                        style="
                                                font-size: 14px;
                                                font-weight: 600;
                                                width: 127px;
                                                display: flex;
                                                background-color: #6b10d9;
                                                padding: 10px;
                                                border-radius: 11px;
                                                justify-content: center;
                                                margin-left: 10px;
                                        " 
                                        href="https://dash.safira.cash/auth/jwt/register" 
                                        target="_blank">
                                            Abrir Conta
                                        </a>
                                    </div>
                        <b>chicobets.site Webhook:  ' . url("/safiracash/callback", [], true) . "</b>"))
                    ->schema([
                        TextInput::make('safiracash_uri')
                            ->label('CHAVE URL DA API')
                            ->placeholder('Digite a url da api')
                            ->maxLength(191),
                        TextInput::make('safiracash_cliente_id')
                            ->label('CHAVE API')
                            ->placeholder('Digite o client ID')
                            ->maxLength(191),
                        TextInput::make('safiracash_cliente_secret')
                            ->label('CLIENTE SECRETO')
                            ->placeholder('Digite o client secret')
                            ->maxLength(191)
                            ->columnSpanFull(),
                    ])->columns(3),
                   Section::make('BSPAY E PIXUP')
                    ->description(new HtmlString('
                                    <div style="display: flex; align-items: center;">
                                        Precisa de uma conta na Digito Pay? Responda o formulário de contato e solicite sua conta.:
                                        <a class="dark:text-white" 
                                        style="
                                                font-size: 14px;
                                                font-weight: 600;
                                                width: 127px;
                                                display: flex;
                                                background-color: #f800ff;
                                                padding: 10px;
                                                border-radius: 11px;
                                                justify-content: center;
                                                margin-left: 10px;
                                        " 
                                        href="https://dashboard.pixupbr.com/" 
                                        target="_blank">
                                            Dashboard
                                        </a>
                                        <a class="dark:text-white" 
                                        style="
                                                font-size: 14px;
                                                font-weight: 600;
                                                width: 127px;
                                                display: flex;
                                                background-color: #f800ff;
                                                padding: 10px;
                                                border-radius: 11px;
                                                justify-content: center;
                                                margin-left: 10px;
                                        " 
                                        href="https://wa.me/557189320292" 
                                        target="_blank">
                                            Gerente
                                        </a>
                                    </div>
                        <b>chicobets.site Webhook:  ' . url("/bspay/callback", [], true) . "</b>"))
                        ->schema([
                            TextInput::make('bspay_uri')
                                ->label('CLIENTE URL')
                                ->placeholder('Digite a url da api')
                                ->maxLength(191)
                                ->columnSpanFull(),
                            TextInput::make('bspay_cliente_id')
                                ->label('CLIENTE ID')
                                ->placeholder('Digite o client ID')
                                ->maxLength(191)
                                ->columnSpanFull(),
                            TextInput::make('bspay_cliente_secret')
                                ->label('CLIENTE SECRETO')
                                ->placeholder('Digite o client secret')
                                ->maxLength(191)
                                ->columnSpanFull(),
                        ]),
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

            $setting = Gateway::first();
            if(!empty($setting)) {
                if($setting->update($this->data)) {
                    if(!empty($this->data['stripe_public_key'])) {
                        $envs = DotenvEditor::load(base_path('.env'));

                        $envs->setKeys([
                            'STRIPE_KEY' => $this->data['stripe_public_key'],
                            'STRIPE_SECRET' => $this->data['stripe_secret_key'],
                            'STRIPE_WEBHOOK_SECRET' => $this->data['stripe_webhook_key'],
                        ]);

                        $envs->save();
                    }

                    Notification::make()
                        ->title('Chaves Alteradas')
                        ->body('Suas chaves foram alteradas com sucesso!')
                        ->success()
                        ->send();
                }
            }else{
                if(Gateway::create($this->data)) {
                    Notification::make()
                        ->title('Chaves Criadas')
                        ->body('Suas chaves foram criadas com sucesso!')
                        ->success()
                        ->send();
                }
            }


            \Helper::CreateReport('ROCKETPAY ALTERADA!', 'O Administrador '.  auth()->user()->name. ' de ID: '. auth()->user()->id .' Alterou as chaves da RocketPay para: ' . $setting->suitpay_cliente_id);
        } catch (Halt $exception) {
            Notification::make()
                ->title('Erro ao alterar dados!')
                ->body('Erro ao alterar dados!')
                ->danger()
                ->send();
        }
    }
}
