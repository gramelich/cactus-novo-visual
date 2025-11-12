<style>
    .item-sombra {
            position: relative;

        }

        .item-sombra::after {
            content: "";
            position: absolute;
            bottom: 0;
            right: 0;
            width: 50px; /* Largura da sombra */
            height: 50px;
            background: linear-gradient(to right, rgba(240, 240, 240, 0), #323637e7); /* Gradiente de transparência */
            

        }
    #placeholder-input::placeholder {
        color: white;
    }
    .texto-valor {
        font-size: 15px;
    }
    @media (max-width:600px) {
        .texto-valor {
            font-size: 12px;
        }
        
    }
</style>

<template>
   
   <div class="">
            <div class="">
               
                <div class="col-span-2 relative" >
                    <div v-if="setting != null && wallet != null && isLoading === false" class="flex flex-col w-full shadow-lg p-4 rounded mx-auto sm:max-w-[690px] lg:max-w-[710px]">
                        <form v-if="wallet.currency === 'USD'" action="" @submit.prevent="submitWithdrawBank">
                            <div class="flex items-center justify-between">
                               <div>
                                   <i class="fa-regular fa-building-columns text-lg mr-3"></i>
                                   <span class="ml-3">{{ $t('BANK') }}</span>
                               </div>
                                <button @click.prevent="$router.push('/profile/wallet')" type="button" class="flex justify-center items-center mr-3 pt-1">
                                    <div>{{ wallet.currency }}</div>
                                    <div class="mr-2 ml-2">
                                        <img :src="`/assets/images/coin/`+wallet.currency+`.png`" alt="" width="32">
                                    </div>
                                    <div class="ml-2 text-sm">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </button>
                            </div>

                            <div class="mt-5">
                                <div class="mb-3 text-sm">
                                    <label for="">Nome do titular da conta</label>
                                    <input v-model="withdraw_deposit.name" type="text" class="input" placeholder="Digite o nome do titular da conta" required>
                                </div>

                                <div class="mt-5">
                                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $t('Banking information') }}</label>
                                    <textarea v-model="withdraw_deposit.bank_info" id="message" cols="30" rows="10" class="input min-h-[250px]" :placeholder="$t('Enter bank information')"></textarea>
                                </div>

                                <div class="mb-3 mt-4">
                                    <div class="flex justify-between text-sm">
                                        <p>Valor ({{ setting.min_withdrawal }} ~ {{ setting.max_withdrawal }})</p>
                                        <p>Saldo: {{ state.currencyFormat(parseFloat(wallet.balance_withdrawal), wallet.currency) }}</p>
                                    </div>
                                    <div class="flex bg-white">
                                        <input type="text"
                                               class="input"
                                               v-model="withdraw_deposit.amount"
                                               :min="setting.min_withdrawal"
                                               :max="setting.max_withdrawal"
                                               placeholder=""
                                               required>
                                        <div class="flex items-center pr-1">
                                            <div class="inline-flex shadow-sm" role="group">
                                                <button @click.prevent="setMinAmount" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200  hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:text-white dark:hover:text-white dark:focus:ring-blue-500 dark:focus:text-white">
                                                    min
                                                </button>
                                                <button @click.prevent="setPercentAmount(50)" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700  dark:border-gray-600 dark:text-white dark:hover:text-white dark:focus:ring-blue-500 dark:focus:text-white">
                                                    50%
                                                </button>
                                                <button @click.prevent="setPercentAmount(100)" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200  hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700  dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                                                    100%
                                                </button>
                                                <button @click.prevent="setMaxAmount" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200  hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                                                    max
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-between mt-2 text-sm">
                                        <p>{{ $t('Available') }}: {{ state.currencyFormat(parseFloat(wallet.balance_withdrawal), wallet.currency) }} {{ wallet.currency }}</p>
                                        <p>{{ $t('Balance Rollback') }}: {{ state.currencyFormat(parseFloat(wallet.balance_bonus), wallet.currency) }} {{ wallet.currency }}</p>
                                    </div>
                                </div>

                                <div class="mb-3 mt-5">
                                    <div class="flex items-center mb-4">
                                        <input id="accept_terms_checkbox" v-model="withdraw_deposit.accept_terms"
                                               type="checkbox"
                                               value=""
                                               class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2">
                                        <label for="accept_terms_checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                                            {{ $t('I accept the transfer terms') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 w-full flex items-center justify-center">
                                <button type="submit" class="ui-button-blue w-full">
                                    <span class="uppercase font-semibold text-sm">{{ $t('Request withdrawal') }}</span>
                                </button>
                            </div>
                        </form>

                        <form style="background-color: white;border-radius: 8px;padding: 20px" v-if="wallet.currency === 'BRL'" action="" @submit.prevent="submitWithdraw">
                            <div class="flex items-center justify-between">
                          
                               
                                 
                                  
                             
                            </div>

                            <div class="mt-5">
                               
                                <div class="w-full flex items-center justify-between">
                                    <div class="flex w-full items-center">
                                        <img :src="`/assets/images/pix.png`" alt="" width="100">
                                     
                                    </div>
                                 
                                </div>
                            </div>

                            <div class="mt-5">
                                <div class="dark:text-gray-400 mb-3">
                                    <label style="color: var(--title-color);" for="">Nome do titular da conta</label>
                                    <input style="background-color: #253663;" v-model="withdraw.name" type="text" class="input" placeholder="Digite o nome do titular da conta" required>
                                </div>

                                <div class="dark:text-gray-400 mb-3">
                                    <label style="color: var(--title-color);" for="">Chave Pix</label>
                                    <input style="background-color: #253663;" v-model="withdraw.pix_key" 
                                   v-maska
                                   data-maska="[
                                    '###.###.###-##'
                                   ]" type="text" class="input" placeholder="Digite a sua Chave pix" required>
                                </div>

                                <div class="dark:text-gray-400 mb-3">
                                    <label style="color: var(--title-color);" for="">Tipo de Chave</label>
                                    <select style="background-color: #253663;" v-model="withdraw.pix_type" name="type_document" class="input" required>
                                        <option value="">Selecione uma chave</option>
                                        <option value="document">CPF/CNPJ</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <div class="flex justify-between mb-3">
                                        <p style="color: var(--title-color);">Valor ({{ setting.min_withdrawal }} ~ {{ setting.max_withdrawal }})</p>
                                        <p style="color: var(--title-color);">Saldo: {{ state.currencyFormat(parseFloat(wallet.balance_withdrawal), wallet.currency) }}</p>
                                    </div>
                                    <div class="flex bg-white">
                                        <input style="background-color: #253663;" type="text"
                                               class="input"
                                               v-model="withdraw.amount"
                                               :min="setting.min_withdrawal"
                                               :max="setting.max_withdrawal"
                                               placeholder=""
                                               required>
                                        <div class="flex items-center pr-1">
                                            <div class="inline-flex shadow-sm" role="group">
                                                <button @click.prevent="setMinAmount" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200  hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                                                    min
                                                </button>
                                                <button @click.prevent="setPercentAmount(50)" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                                                    50%
                                                </button>
                                                <button @click.prevent="setPercentAmount(100)" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200  hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                                                    100%
                                                </button>
                                                <button @click.prevent="setMaxAmount" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200  hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                                    max
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        <p style="color: var(--title-color);">{{ $t('Available') }}: {{ state.currencyFormat(parseFloat(wallet.balance_withdrawal), wallet.currency) }} {{ wallet.currency }}</p>
                                        <p style="color: var(--title-color);">{{ $t('Balance Rollback') }}: {{ state.currencyFormat(parseFloat(wallet.balance_bonus), wallet.currency) }} {{ wallet.currency }}</p>
                                    </div>
                                </div>

                                <div class="mb-3 mt-5">
                                    <div class="flex items-center mb-4">
                                        <input id="accept_terms_checkbox" v-model="withdraw.accept_terms"
                                               type="checkbox"
                                               value=""
                                               class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500">
                                        <label for="accept_terms_checkbox" class="ms-2 text-sm font-medium text-gray-900">
                                            {{ $t('I accept the transfer terms') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 w-full flex items-center justify-center">
                                <button type="submit" class="ui-button-blue w-full">
                                    <span class="uppercase font-semibold text-sm">{{ $t('Request withdrawal') }}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div v-if="isLoading" role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
                        <i class="fa fa-spinner-third fa-spin" style="font-size: 45px;--fa-primary-color: var(--ci-primary-color); --fa-secondary-color: #000000;"></i>
                        <span class="sr-only">{{ $t('Loading') }}...</span>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import {useToast} from "vue-toastification";
    import HttpApi from "@/Services/HttpApi.js";
    import QRCodeVue3 from "qrcode-vue3";
    import {useAuthStore} from "@/Stores/Auth.js";
    import { StripeCheckout } from '@vue-stripe/vue-stripe';
    import {useSettingStore} from "@/Stores/SettingStore.js";
    import WalletSideMenu from "@/Pages/Profile/Components/WalletSideMenu.vue";

    export default {
        props: ['showMobile', 'title', 'isFull'],
        components: { QRCodeVue3, StripeCheckout, WalletSideMenu },
        data() {

            return {
                sidebar:  /iPhone|iPad|iPod|Android/i.test(navigator.userAgent) ? false : (localStorage.getItem('sidebarStatus') ? JSON.parse(localStorage.getItem('sidebarStatus')) : false),
                setting: null,
                wallet: null,
                withdraw: {
                name: '',
                pix_key: '',
                pix_type: '',
                amount: '',
                type: 'pix',
                currency: '',
                symbol: '',
                accept_terms: false
            },
            withdraw_deposit: {
                name: '',
                bank_info: '',
                amount: '',
                type: 'bank',
                currency: '',
                symbol: '',
                accept_terms: false
            },
    
                isModalOpen: true,
                isLoading: false,
                minutes: 15,
                seconds: 0,
                timer: null,
                setting: null,
                wallet: null,
                deposit: {
                    amount: '',
                    cpf: '',
                    gateway: '',
                    accept_bonus: true
                },
                selectedAmount: 0,
                showPixQRCode: false,
                qrcodecopypast: '',
                idTransaction: '',
                intervalId: null,
                paymentType: null,

                /// stripe
                elementsOptions: {
                    appearance: {}, // appearance options
                },
                confirmParams: {
                    return_url: null, // success url
                },
                successURL: null,
                cancelURL: null,
                amount: null,
                currency: null,
                publishableKey: null,
                sessionId: null,
                paymentGateway: '',
            }
        },
        setup(props) {


            return {};
        },
        computed: {
            isAuthenticated() {
                const authStore = useAuthStore();
                return authStore.isAuth;
            },
        },
        mounted() {
            
        },
       
mounted() {
    if (this.setting.suitpay_is_enable) {
        this.setPaymentMethod('pix', 'suitpay');
    }
},

        beforeUnmount() {
            clearInterval(this.timer);
            this.paymentType = null;
        },
        methods: {
            setMinAmount: function() {
            this.withdraw.amount = this.setting.min_withdrawal;
        },
        setMaxAmount: function() {
            this.withdraw.amount = this.setting.max_withdrawal;
        },
        setPercentAmount: function(percent) {
            this.withdraw.amount = ( percent / 100 ) * this.wallet.balance_withdrawal;
        },
        getWallet: function() {
            const _this = this;
            const _toast = useToast();
            _this.isLoadingWallet = true;

            HttpApi.get('profile/wallet')
                .then(response => {
                    _this.wallet = response.data.wallet;

                    _this.withdraw.currency = response.data.wallet.currency;
                    _this.withdraw.symbol = response.data.wallet.symbol;

                    _this.withdraw_deposit.currency = response.data.wallet.currency;
                    _this.withdraw_deposit.symbol = response.data.wallet.symbol;

                    _this.isLoadingWallet = false;
                })
                .catch(error => {
                    const _this = this;
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                    _this.isLoadingWallet = false;
                });
        },
        getSetting: function() {
            const _this = this;
            const settingStore = useSettingStore();
            const settingData = settingStore.setting;

            if(settingData) {
                _this.setting                   = settingData;
                _this.withdraw.amount           = settingData.min_withdrawal;
                _this.withdraw_deposit.amount   = settingData.min_withdrawal;
            }

            _this.isLoading                 = false;
        },
        submitWithdrawBank: function(event) {
            const _this = this;
            const _toast = useToast();
            _this.isLoading = true;

            HttpApi.post('wallet/withdraw/request', _this.withdraw_deposit).then(response => {
                _this.isLoading = false;
                _this.withdraw_deposit = {
                    name: '',
                    bank_info: '',
                    amount: '',
                    type: '',
                    accept_terms: false
                }

                _this.router.push({ name: 'profileTransactions' });
                _toast.success(response.data.message);
            }).catch(error => {
                Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                    _toast.error(`${value}`);
                });
                _this.isLoading = false;
            });
        },
        submitWithdraw: function(event) {
            const _this = this;
            const _toast = useToast();
            _this.isLoading = true;

            HttpApi.post('wallet/withdraw/request', _this.withdraw).then(response => {
                _this.isLoading = false;
                _this.withdraw = {
                    name: '',
                    pix_key: '',
                    pix_type: '',
                    amount: '',
                    type: '',
                    accept_terms: false
                }

                _this.router.push({ name: 'profileTransactions' });
                _toast.success(response.data.message);
            }).catch(error => {
                Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                    _toast.error(`${value}`);
                });
                _this.isLoading = false;
            });
        },
            closeModal() {
      this.isModalOpen = false;
    },
  
            getSession: function() {
                const _this = this;
                HttpApi.post('stripe/session', { amount: _this.amount, currency: _this.currency}).then(response => {
                    if(response.data.id) {
                        _this.sessionId = response.data.id;
                    }
                }).catch(error => { });
            },
            checkoutStripe: function() {
                const _toast = useToast();
                if(this.amount <= 0 || this.amount === '') {
                    _toast.error('Você precisa digitar um valor');
                    return;
                }

                this.$refs.checkoutRef.redirectToCheckout();
            },
            getPublicKeyStripe: function() {
                const _this = this;
                HttpApi.post('stripe/publickey', {}).then(response => {
                    _this.$nextTick(() => {
                        _this.publishableKey = response.data.stripe_public_key;
                        _this.elementsOptions.clientSecret  = response.data.stripe_secret_key;
                        _this.confirmParams.return_url      = response.data.successURL;
                    });

                }).catch(error => { });
            },
            setPaymentMethod: function(type, gateway) {
                if(type === 'stripe') {
                    this.getPublicKeyStripe();
                }
                this.paymentType = type;
                this.paymentGateway = gateway;
            },
            submitQRCode: function(event) {
                const _this = this;
                const _toast = useToast();
                if(_this.deposit.amount === '' || _this.deposit.amount === undefined) {
                    _toast.error(_this.$t('You need to enter a value'));
                    return;
                }

                if(_this.deposit.cpf === '' || _this.deposit.cpf === undefined) {
                    _toast.error(_this.$t('Do you need to enter your CPF or CNPJ'));
                    return;
                }

                if(parseFloat(_this.deposit.amount) < parseFloat(_this.setting.min_deposit)) {
                    _toast.error('O valor mínimo de depósito é de '+ _this.setting.min_deposit);
                    return;
                }

                if(parseFloat(_this.deposit.amount) > parseFloat(_this.setting.max_deposit)) {
                    _toast.error('O valor máximo de depósito é de '+ _this.setting.min_deposit);
                    return;
                }

                _this.deposit.paymentType = _this.paymentType;
                _this.deposit.gateway = _this.paymentGateway;

                _this.isLoading = true;
                HttpApi.post('wallet/deposit/payment', _this.deposit).then(response => {
                    _this.showPixQRCode = true;
                    _this.isLoading = false;

                    _this.idTransaction = response.data.idTransaction;
                    _this.qrcodecopypast = response.data.qrcode;

                    _this.intervalId = setInterval(function () {
                        _this.checkTransactions(_this.idTransaction);
                    }, 5000);

                }).catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                    _this.showPixQRCode = false;
                    _this.isLoading = false;
                });
            },
            checkTransactions: function(idTransaction) {
                const _this = this;
                const _toast = useToast();

                HttpApi.post(_this.paymentGateway+'/consult-status-transaction', { idTransaction: idTransaction }).then(response => {
                    _toast.success('Pedido concluído com sucesso');
                    clearInterval(_this.intervalId);
                }).catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        // _toast.error(`${value}`);
                    });
                });
            },
            copyQRCode: function(event) {
                const _toast = useToast();
                var inputElement = document.getElementById("pixcopiaecola");
                inputElement.select();
                inputElement.setSelectionRange(0, 99999);  // Para dispositivos móveis

                // Copia o conteúdo para a área de transferência
                document.execCommand("copy");
                _toast.success('Pix Copiado com sucesso');
            },
            setAmount: function(amount) {
                this.deposit.amount = amount;
                this.selectedAmount = amount;
            },
            getWallet: function() {
                const _this = this;
                const _toast = useToast();
                _this.isLoadingWallet = true;

                HttpApi.get('profile/wallet')
                    .then(response => {
                        _this.wallet = response.data.wallet;
                        _this.currency = response.data.wallet.currency;
                        _this.isLoadingWallet = false;
                    })
                    .catch(error => {
                        const _this = this;
                        Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                            _toast.error(`${value}`);
                        });
                        _this.isLoadingWallet = false;
                    });
            },
            getSetting: function() {
                const _this = this;
                const settingStore = useSettingStore();
                const settingData = settingStore.setting;

                if(settingData) {
                    _this.setting = settingData;
                    _this.amount  = settingData.max_deposit;

                    if(_this.paymentType === 'stripe' && settingData.stripe_is_enable) {
                        _this.getSession();
                    }
                }
            },
        },
        created() {
            this.getWallet();
            this.getSetting();
            if(this.isAuthenticated) {
                this.getWallet();
                this.getSetting();

                if(this.paymentType === 'stripe') {
                    this.getSession();
                    this.currency = 'USD';
                }
            }
        },
        watch: {
            amount(oldValue, newValue) {
                if(this.paymentType === 'stripe') {
                    this.getSession();
                    this.currency = 'USD';
                }

            },
            currency(oldValue, newValue) {
                if(this.paymentType === 'stripe') {
                    this.getSession();
                }
            }
        },
    };
</script>

<style scoped>

</style>
