<style>
.teste-place {
    color: #999b9b;
}
</style>
<template>
    <BaseLayout>
        <div
            class="container mx-auto mt-20 relative min-h-[calc(100vh-565px)] px-[4%]"
        >
            <div
                v-if="wallet && !isLoading"
                class="grid grid-cols-1 mx-auto w-full sm:max-w-[690px] lg:max-w-[710px]"
            >
                <div
                    v-if="isShowForm"
                    class="col-span-1 shadow-lg mb-3 md:mt-[30px] mt-[10px] rounded"
                    style="background-color: var(--footer-color-dark)"
                >
                    <div class="flex flex-col">
                        <div
                            class="w-full flex justify-center mb-5 rounded-t-lg"
                        >
                            <a
                                v-if="setting"
                                class="w-full flex justify-center"
                            >
                                <img
                                    class="w-full rounded-t-lg block"
                                    :src="
                                        `/storage/` +
                                        setting.software_banner_afiliado
                                    "
                                    alt="Logo"
                                />
                            </a>
                        </div>

                        <div class="p-4">
                            <h1
                                class="user-page-title mb-3 md:text-2xl text-lg font-bold"
                                style="color: var(--ci-primary-color)"
                            >
                                Indique um amigo e ganhe dinheiro
                            </h1>

                            <p
                                class="refers-text warning xl:text-sm mb-3 text-white text-sm font-semibold"
                            >
                                Ganhe muito dinheiro! receba
                                {{
                                    userData.affiliate_revenue_share_fake
                                        ? userData.affiliate_revenue_share_fake
                                        : userData.affiliate_revenue_share
                                }}% de todos depósitos que chicobets.sites indicados
                                fizerem na plataforma, e acompanhe progresso
                                em tempo real.
                            </p>

                            <!-- Botão de regras -->
                            <div class="flex justify-end mb-4">
                                <button
                                    @click.prevent="toggleCommissionRewards"
                                    class="text-sm font-semibold px-4 py-2 rounded text-white"
                                    style="
                                        background-color: var(
                                            --ci-primary-color
                                        );
                                    "
                                >
                                    Ver Regras
                                </button>
                            </div>

                            <!-- Link de referência -->
                            <div v-if="showReferral" class="flex flex-col">
                                <label
                                    for="referenceLink"
                                    class="text-sm font-semibold text-gray-900 dark:text-white opacity-50"
                                >
                                    {{ $t("chicobets.site link:") }}
                                </label>
                                <div class="relative w-full">
                                    <input
                                        id="referenceLink"
                                        type="text"
                                        readonly
                                        v-model="referencelink"
                                        :placeholder="$t('Reference Link')"
                                        class="block p-3 w-full text-sm text-gray-900 rounded-lg bg-gray-50 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white opacity-50"
                                        style="
                                            font-size: 0.775em;
                                            background-color: var(
                                                --input-primary
                                            );
                                        "
                                    />
                                    <button
                                        @click.prevent="copyLink"
                                        type="submit"
                                        class="w-full mt-2 mb-3 text-white font-semibold text-sm rounded px-4 py-2"
                                        style="
                                            background-color: var(
                                                --ci-primary-color
                                            );
                                        "
                                    >
                                        <i
                                            class="fa fa-copy text-white text-xl pr-1"
                                        ></i>
                                        Copiar link
                                    </button>
                                </div>
                            </div>
                            <!-- Código de referência
                                <label
                                    for="referenceCode"
                                    class="text-sm font-semibold text-gray-900 dark:text-white opacity-50"
                                >
                                    {{ $t("chicobets.site Código de referência:") }}
                                </label>
                                <div class="relative w-full">
                                    <input
                                        id="referenceCode"
                                        type="text"
                                        readonly
                                        v-model="referencecode"
                                        :placeholder="$t('Reference Code')"
                                        class="mb-3 block p-3 w-full text-sm text-gray-900 rounded-lg bg-gray-50 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white opacity-50"
                                        style="
                                            font-size: 0.775em;
                                            background-color: var(--input-primary);
                                        "
                                    />
                                    <button
                                        @click.prevent="copyCode"
                                        type="submit"
                                        class="w-full mt-2 mb-3 text-white font-semibold text-sm rounded px-4 py-2"
                                        style="
                                            background-color: var(
                                                --ci-primary-color
                                            );
                                        "
                                    >
                                        <i
                                            class="fa fa-copy text-white text-xl pr-1"
                                        ></i>
                                        Copiar link
                                    </button>
                                </div> -->

                            <!-- Estatísticas -->
                            <h1
                                class="user-page-title mb-3 font-bold text-xl"
                                style="color: var(--ci-primary-color)"
                            >
                                Estatísticas
                            </h1>

                            <label
                                class="text-sm font-semibold text-gray-900 dark:text-white opacity-50"
                            >
                                {{ $t("CPA (R$)") }}
                            </label>
                            <div class="relative w-full">
                                <input
                                    type="text"
                                    readonly
                                    :placeholder="
                                        state.currencyFormat(
                                            parseFloat(userData.affiliate_cpa),
                                            wallet.currency
                                        )
                                    "
                                    class="mb-3 block p-3 w-full text-sm text-gray-900 rounded-lg bg-gray-50 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    style="
                                        font-size: 0.775em;
                                        background-color: var(--input-primary);
                                    "
                                />
                            </div>

                            <label
                                class="text-sm font-semibold text-gray-900 dark:text-white opacity-50"
                            >
                                {{ $t("RevShare (%)") }}
                            </label>
                            <div class="relative w-full">
                                <input
                                    type="text"
                                    readonly
                                    :placeholder="
                                        userData.affiliate_revenue_share_fake
                                            ? userData.affiliate_revenue_share_fake
                                            : userData.affiliate_revenue_share
                                    "
                                    class="mb-3 block p-3 w-full text-sm text-gray-900 rounded-lg bg-gray-50 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    style="
                                        font-size: 0.775em;
                                        background-color: var(--input-primary);
                                    "
                                />
                            </div>

                            <label
                                class="text-sm font-semibold text-gray-900 dark:text-white opacity-50"
                            >
                                {{ $t("Pessoas que você indicou") }}
                            </label>
                            <div class="relative w-full">
                                <input
                                    type="text"
                                    readonly
                                    :placeholder="indications"
                                    class="mb-3 block p-3 w-full text-sm text-gray-900 rounded-lg bg-gray-50 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    style="
                                        font-size: 0.775em;
                                        background-color: var(--input-primary);
                                    "
                                />
                            </div>

                            <label
                                class="text-sm font-semibold text-gray-900 dark:text-white opacity-50"
                            >
                                {{ $t("Valor disponível") }}
                            </label>
                            <div class="relative w-full">
                                <input
                                    type="text"
                                    readonly
                                    :placeholder="
                                        state.currencyFormat(
                                            parseFloat(wallet.refer_rewards),
                                            wallet.currency
                                        )
                                    "
                                    class="mb-3 block p-3 w-full text-sm text-white rounded-lg bg-gray-700"
                                    style="
                                        font-size: 0.775em;
                                        background-color: var(--input-primary);
                                    "
                                />
                            </div>

                            <button
                                @click.prevent="openModalWithdrawal"
                                type="button"
                                class="ui-button-blue w-full flex justify-center items-center text-white font-semibold text-sm"
                            >
                                <i
                                    class="fa fa-envelope-open-text pr-1 text-white text-sm"
                                ></i>
                                <span style="color: #fff">Solicitar saque</span>
                            </button>

                            <a
                                href="/affiliate"
                                class="ui-button-blue w-full flex justify-center items-center text-white font-semibold text-sm mt-3"
                            >
                                <i
                                    class="fa fa-envelope-open-text pr-1 text-white text-sm"
                                ></i>
                                <span style="color: #fff"
                                    >Acessar Painel Afiliado</span
                                >
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div
                v-else
                role="status"
                class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2 h-full mt-16"
            >
                <div
                    class="text-center flex flex-col justify-center items-center"
                >
                    <i
                        class="fa fa-spinner fa-spin"
                        style="
                            font-size: 45px;
                            --fa-primary-color: var(--ci-primary-color);
                            --fa-secondary-color: #000000;
                        "
                    ></i>
                    <span class="mt-3">{{ $t("Carregando") }}...</span>
                </div>
            </div>
        </div>

        <!-- MODAL RECOMPENSAS DE REFERÊNCIA -->
        <div
            id="referenceRewardsEl"
            tabindex="-1"
            aria-hidden="true"
            class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0"
        >
            <div class="relative max-h-full w-full max-w-2xl">
                <!-- Modal content -->
                <div
                    class="relative rounded-lg bg-white shadow dark:bg-gray-700"
                >
                    <!-- Modal header -->
                    <div
                        class="flex justify-between p-4 dark:bg-gray-600 rounded-t-lg"
                    >
                        <h1>{{ $t("Referral Reward Rules") }}</h1>
                        <button
                            class=""
                            @click.prevent="toggleReferenceRewards"
                        >
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="w-full flex justify-center p-4">
                        <div class="flex items-center">
                            <div class="l"></div>
                            <div class="text-white px-3">
                                Regras de Desbloqueio
                            </div>
                            <div class="r"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL RECOMPENSAS POR COMISSÃO -->
        <div
            id="commissionRewardsEl"
            tabindex="-1"
            aria-hidden="true"
            class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0"
        >
            <div class="relative max-h-full w-full max-w-2xl">
                <!-- Modal content -->
                <div
                    class="relative rounded-lg bg-white shadow dark:bg-gray-700"
                >
                    <!-- Modal header -->
                    <div
                        class="flex justify-between p-4 dark:bg-gray-600 rounded-t-lg"
                    >
                        <h1>Regras de recompensas por comissão</h1>
                        <button
                            class=""
                            @click.prevent="toggleCommissionRewards"
                        >
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="flex flex-col w-full justify-center p-4">
                        <div
                            class="flex items-center text-center w-full justify-center"
                        >
                            <div class="l"></div>
                            <div class="text-white px-3">
                                Taxas de comissões
                            </div>
                            <div class="r"></div>
                        </div>

                        <div class="mt-5">
                            <ul>
                                <li
                                    class="flex dark:bg-gray-800 shadow rounded-lg aposta-1 w-full p-4 mb-3"
                                >
                                    <div>
                                        <h1
                                            class="font-mono text-4xl font-bold"
                                        >
                                            7%
                                        </h1>
                                        <p class="text-gray-400 text-sm">
                                            <strong class="text-gray-400"
                                                >Jogo:</strong
                                            >
                                            Os Jogos Originais
                                        </p>
                                    </div>
                                </li>
                                <li
                                    class="flex dark:bg-gray-800 shadow rounded-lg aposta-2 w-full p-4 mb-3"
                                >
                                    <div>
                                        <h1
                                            class="font-mono text-4xl font-bold"
                                        >
                                            7%
                                        </h1>
                                        <p class="text-gray-400 text-sm">
                                            <strong class="text-gray-400"
                                                >Jogo:</strong
                                            >
                                            slots de terceiros, cassino ao vivo
                                        </p>
                                    </div>
                                </li>
                                <li
                                    class="flex dark:bg-gray-800 shadow rounded-lg aposta-3 w-full p-4 mb-3"
                                >
                                    <div>
                                        <h1
                                            class="font-mono text-4xl font-bold"
                                        >
                                            25%
                                        </h1>
                                        <p class="text-gray-400 text-sm">
                                            <strong class="text-gray-400"
                                                >Jogo:</strong
                                            >
                                            Esportes
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-5 ml-4">
                            <ul class="list-outside list-disc">
                                <li class="mb-3">
                                    Em qualquer ambiente público (por exemplo,
                                    universidades, escolas, bibliotecas e
                                    espaços de escritório), apenas uma comissão
                                    pode ser paga para cada usuário, endereço
                                    IP, dispositivo eletrônico, residência,
                                    número de telefone, método de cobrança,
                                    endereço de e-mail e computador e IP
                                    endereço compartilhado com outras pessoas.
                                </li>
                                <li class="mb-3">
                                    Nossa decisão de fazer uma aposta será
                                    baseada inteiramente em nosso critério
                                    depois que um depósito for feito e uma
                                    aposta for feita com sucesso.
                                </li>
                                <li class="mb-3">
                                    As comissões podem ser retiradas em nossa
                                    carteira CREDK interna do painel a qualquer
                                    momento. (Veja a extração de sua comissão no
                                    painel e visualize o saldo na carteira).
                                </li>
                                <li class="mb-3">
                                    Apoiamos a maioria das moedas no mercado.
                                </li>
                                <li class="mb-3">
                                    O sistema calcula a comissão a cada 24
                                    horas.
                                </li>
                            </ul>
                        </div>

                        <div
                            class="mt-5 w-full border dark:border-gray-500 p-4 rounded"
                        >
                            Se você tiver alguma dúvida sobre nossas regras, por
                            favor
                            <a
                                href="https://t.me/sportesbets"
                                class="text-green-500 font-bold"
                            >
                                Contate-nos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL SAQUE -->
        <div
            id="withdrawalEl"
            tabindex="-1"
            aria-hidden="true"
            class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0"
        >
            <div class="relative max-h-full w-full max-w-2xl">
                <!-- Modal content -->
                <div
                    class="relative rounded-lg bg-white shadow dark:bg-gray-700"
                >
                    <!-- Modal header -->
                    <div
                        class="flex justify-between p-4 dark:bg-gray-600 rounded-t-lg"
                    >
                        <h1>RSolicite chicobets.site saque</h1>
                        <button class="" @click.prevent="opemModalWithdrawal">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="flex flex-col w-full justify-center p-4">
                        <form action="" @submit.prevent="makeWithdrawal">
                            <div class="dark:text-gray-400 mb-3">
                                <label for="">Valor do Saque</label>
                                <input
                                    v-model="withdrawalForm.amount"
                                    type="number"
                                    class="input"
                                    placeholder="Valor do saque"
                                    required
                                />
                                <span v-if="wallet" class="text-sm italic"
                                    >Saldo:
                                    {{
                                        state.currencyFormat(
                                            parseFloat(wallet?.refer_rewards),
                                            wallet?.currency
                                        )
                                    }}</span
                                >
                            </div>

                            <div class="dark:text-gray-400 mb-3">
                                <label for="">Chave Pix</label>
                                <input
                                    v-model="withdrawalForm.pix_key"
                                    v-maska
                                    data-maska="[
                                    '###.###.###-##',
                                    '##.###.###/####-##'
                                   ]"
                                    type="text"
                                    class="input"
                                    placeholder="Digite a sua Chave pix"
                                    required
                                />
                            </div>

                            <div class="dark:text-gray-400 mb-3">
                                <label for="">Tipo de Chave</label>
                                <select
                                    v-model="withdrawalForm.pix_type"
                                    name="type_document"
                                    class="input"
                                    required
                                >
                                    <option value="">
                                        Selecione uma chave
                                    </option>
                                    <option value="document">CPF/CNPJ</option>
                                </select>
                            </div>

                            <button
                                type="submit"
                                class="mt-5 w-full bg-[var(--ci-primary-color)] text-white hover:bg-transparent hover:text-[var(--ci-primary-color)] text-white hover:bg-transparent hover:text-white px-4 py-2 transition duration-700"
                            >
                                Solicitar agora
                                <i class="fa fa-arrow-right ml-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BaseLayout>
</template>

<script>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Modal } from "flowbite";
import HttpApi from "@/Services/HttpApi.js";
import { useToast } from "vue-toastification";
import { useAuthStore } from "@/Stores/Auth.js";
import { useSettingStore } from "@/Stores/SettingStore.js";
import { useRouter } from "vue-router";

export default {
    props: [],
    components: { BaseLayout, Modal },
    data() {
        return {
            isLoading: false,
            referenceRewards: null,
            commissionRewards: null,
            isShowForm: false,
            showReferral: false,
            isLoadingGenerate: false,
            code: "",
            urlCode: "",
            setting: null,
            referencecode: "",
            referencelink: "",
            wallet: null,
            indications: 0,
            histories: null,
            withdrawalModal: null,
            withdrawalForm: {
                amount: 0,
                pix_key: "",
                pix_type: "",
            },
        };
    },
    setup(props) {
        const router = useRouter();
        return {
            router,
        };
    },
    computed: {
        userData() {
            const authStore = useAuthStore();
            return authStore.user;
        },
    },
    mounted() {
        window.scrollTo(0, 0);
        this.generateCode();
        this.referenceRewards = new Modal(
            document.getElementById("referenceRewardsEl"),
            {
                placement: "center",
                backdrop: "dynamic",
                backdropClasses:
                    "bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40",
                closable: true,
                onHide: () => {},
                onShow: () => {},
                onToggle: () => {},
            }
        );

        this.commissionRewards = new Modal(
            document.getElementById("commissionRewardsEl"),
            {
                placement: "center",
                backdrop: "dynamic",
                backdropClasses:
                    "bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40",
                closable: true,
                onHide: () => {},
                onShow: () => {},
                onToggle: () => {},
            }
        );

        this.withdrawalModal = new Modal(
            document.getElementById("withdrawalEl"),
            {
                placement: "center",
                backdrop: "dynamic",
                backdropClasses:
                    "bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40",
                closable: false,
                onHide: () => {},
                onShow: () => {},
                onToggle: () => {},
            }
        );
    },
    methods: {
        getSetting: function () {
            const _this = this;
            const settingStore = useSettingStore();
            const settingData = settingStore.setting;

            if (settingData) {
                _this.setting = settingData;
                _this.amount = settingData.max_deposit;

                if (
                    _this.paymentType === "stripe" &&
                    settingData.stripe_is_enable
                ) {
                    _this.getSession();
                }
            }
        },
        copyCode: function (event) {
            const _toast = useToast();
            var inputElement = document.getElementById("referenceCode");
            inputElement.select();
            inputElement.setSelectionRange(0, 99999); // Para dispositivos móveis
        },
        copyLink: function (event) {
            const _toast = useToast();
            var inputElement = document.getElementById("referenceLink");
            inputElement.select();
            inputElement.setSelectionRange(0, 99999); // Para dispositivos móveis

            // Copia o conteúdo para a área de transferência
            document.execCommand("copy");
            _toast.success(this.$t("Link copiado"));
        },
        getCode: function () {
            const _this = this;
            const _toast = useToast();
            _this.isLoadingGenerate = true;

            HttpApi.get("profile/affiliates/")
                .then((response) => {
                    if (
                        response.data.code !== "" &&
                        response.data.code !== undefined &&
                        response.data.code !== null
                    ) {
                        _this.isShowForm = true;
                        _this.code = response.data.code;
                        _this.referencecode = response.data.code;

                        // ⚠️ Aqui montamos o link correto:
                        const host = window.location.origin;
                        _this.referencelink = `${host}/register?code=${response.data.code}`;
                        _this.showReferral = true;
                    }

                    _this.indications = response.data.indications;
                    _this.wallet = response.data.wallet;
                    _this.withdrawalForm.amount =
                        response.data.wallet.refer_rewards;

                    _this.isLoadingGenerate = false;
                })
                .catch((error) => {
                    _this.isShowForm = false;
                    _this.isLoadingGenerate = false;
                });
        },

        generateCode() {
            const _this = this;
            const _toast = useToast();

            if (_this.referencecode) {
                // Já gerado
                _toast.info(_this.$t("chicobets.site código já foi gerado."));
                return;
            }

            _this.isLoadingGenerate = true;

            HttpApi.get("profile/affiliates/generate")
                .then((response) => {
                    if (response.data.status) {
                        _this.getCode();
                        _toast.success(
                            _this.$t("chicobets.site link foi gerado com sucesso")
                        );
                    }
                    _this.isLoadingGenerate = false;
                })
                .catch((error) => {
                    Object.entries(
                        JSON.parse(error.request.responseText)
                    ).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                    _this.isLoadingGenerate = false;
                });
        },
        toggleCommissionRewards: function (event) {
            this.commissionRewards.toggle();
        },
        toggleReferenceRewards: function (event) {
            this.referenceRewards.toggle();
        },
        opemModalWithdrawal: function () {
            this.withdrawalModal.toggle();
        },
        makeWithdrawal: async function () {
            const _this = this;
            const _toast = useToast();

            _this.isLoading = true;

            HttpApi.post("profile/affiliates/request", _this.withdrawalForm)
                .then((response) => {
                    _this.opemModalWithdrawal();

                    _toast.success(_this.$t(response.data.message));
                    _this.isLoading = false;
                    _this.router.push({ name: "profileWallet" });
                })
                .catch((error) => {
                    Object.entries(
                        JSON.parse(error.request.responseText)
                    ).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                    _this.isLoading = false;
                });
        },
    },
    created() {
        this.getSetting();
    },
    watch: {},
};
</script>

<style scoped></style>
