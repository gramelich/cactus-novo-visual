<?php

namespace App\Filament\Admin\Resources\SettingResource\Pages;

use App\Filament\Admin\Resources\SettingResource;
use App\Models\Setting;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class DefaultSetting extends Page implements HasForms
{
    use HasPageSidebar, InteractsWithForms;

    protected static string $resource = SettingResource::class;

    protected static string $view = 'filament.resources.setting-resource.pages.default-setting';

    public static function canView(Model $record): bool
    {
        return auth()->user()->hasRole('admin');
    }

    public function getTitle(): string | Htmlable
    {
        return __('Padrão');
    }

    public Setting $record;
    public ?array $data = [];

    public function mount(): void
    {
        $setting = Setting::first();
        $this->record = $setting;
        $this->form->fill($setting->toArray());
    }

    public function save()
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

            $setting = Setting::find($this->record->id);

            $favicon   = $this->data['software_favicon'] ?? null;
            $logoWhite = $this->data['software_logo_white'] ?? null;
            $logoBlack = $this->data['software_logo_black'] ?? null;
            $logoBlack2 = $this->data['software_logo_black2'] ?? null;
            $softwareBackground = $this->data['software_background'] ?? null;
            $mobileLogin = $this->data['software_mobile_login'] ?? null;
            $mobileRegister = $this->data['software_mobile_register'] ?? null;
            $bannerRegister = $this->data['software_banner_register'] ?? null;
            $bannerLogin = $this->data['software_banner_login'] ?? null;
            $bannerAfiliado = $this->data['software_banner_afiliado'] ?? null;

            // Upload arquivos (adiciona novos campos)
            foreach ([
                'software_background' => $softwareBackground,
                'software_favicon' => $favicon,
                'software_logo_white' => $logoWhite,
                'software_logo_black' => $logoBlack,
                'software_logo_black2' => $logoBlack2,
                'software_mobile_login' => $mobileLogin,
                'software_mobile_register' => $mobileRegister,
                'software_banner_register' => $bannerRegister,
                'software_banner_login' => $bannerLogin,
                'software_banner_afiliado' => $bannerAfiliado,
            ] as $key => $file) {
                if (is_array($file) || is_object($file)) {
                    if (!empty($file)) {
                        $uploaded = $this->uploadFile($file);
                        if ($uploaded) {
                            $this->data[$key] = $uploaded;
                        } else {
                            unset($this->data[$key]);
                        }
                    }
                }
            }

            $envs = DotenvEditor::load(base_path('.env'));
            $envs->setKeys([
                'APP_NAME' => $this->data['software_name'],
            ]);
            $envs->save();

            if ($setting->update($this->data)) {
                Cache::put('setting', $setting);

                Notification::make()
                    ->title('Dados alterados')
                    ->body('Dados alterados com sucesso!')
                    ->success()
                    ->send();

                redirect(route('filament.admin.resources.settings.index'));
            }
        } catch (Halt $exception) {
            return;
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Ajuste Visual')
                    ->description('Formulário ajustar o visual da plataforma')
                    ->schema([
                        Group::make()->schema([
                            TextInput::make('software_name')
                                ->label('Nome')
                                ->placeholder('Digite o nome do site')
                                ->required()
                                ->maxLength(191),
                            TextInput::make('software_description')
                                ->placeholder('Digite a descrição do site')
                                ->label('Descrição')
                                ->maxLength(191),
                            TextInput::make('software_notification')
                                ->placeholder('Texto do Scroll')
                                ->label('Notificação para usuários'),
                            TextInput::make('software_notification2')
                                ->placeholder('Digite a mensagem de notificação')
                                ->label('Notificação para usuários'),
                        ])->columns(2),
                        Group::make()->schema([
                            FileUpload::make('software_favicon')
                                ->label('Favicon')
                                ->placeholder('Carregue um favicon')
                                ->image(),
                            Group::make()->schema([
                                FileUpload::make('software_logo_white')
                                    ->label('Logo Branca')
                                    ->placeholder('Carregue uma logo branca')
                                    ->image()
                                    ->columnSpanFull(),
                                FileUpload::make('software_logo_black')
                                    ->label('Logo Escura')
                                    ->placeholder('Carregue uma logo escura')
                                    ->image()
                                    ->columnSpanFull(),
                                FileUpload::make('software_logo_black2')
                                    ->label('Banner Área Registro')
                                    ->placeholder('Carregue um banner para a área de registro.')
                                    ->image()
                                    ->columnSpanFull(),

                                // Novos campos de imagens/banner para mobile e registro
                                FileUpload::make('software_mobile_login')
                                    ->label('Banner Mobile Login')
                                    ->placeholder('Carregue o banner para login mobile.')
                                    ->image()
                                    ->columnSpanFull(),
                                FileUpload::make('software_mobile_register')
                                    ->label('Banner Mobile Register')
                                    ->placeholder('Carregue o banner para registro mobile.')
                                    ->image()
                                    ->columnSpanFull(),
                                FileUpload::make('software_banner_register')
                                    ->label('Banner Registro')
                                    ->placeholder('Carregue o banner para a área de registro.')
                                    ->image()
                                    ->columnSpanFull(),
                                FileUpload::make('software_banner_login')
                                    ->label('Banner Login')
                                    ->placeholder('Carregue o banner para a área de login.')
                                    ->image()
                                    ->columnSpanFull(),
                                FileUpload::make('software_banner_afiliado')
                                    ->label('Banner Afiliado')
                                    ->placeholder('Carregue o banner para afiliados.')
                                    ->image()
                                    ->columnSpanFull(),
                            ]),
                        ])->columns(2),
                    ])
            ])
            ->statePath('data');
    }

    private function uploadFile($array)
    {
        if (!empty($array) && (is_array($array) || is_object($array))) {
            foreach ($array as $temporaryFile) {
                if ($temporaryFile instanceof TemporaryUploadedFile) {
                    $path = \Helper::upload($temporaryFile);
                    if ($path) {
                        return $path['path'];
                    }
                } else {
                    return $temporaryFile;
                }
            }
        }
    }
}
