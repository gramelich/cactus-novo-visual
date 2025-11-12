<template>
    <div
        v-if="showRegisterModal"
        id="modalElRegister"
        class="fixed inset-0 z-[9999] flex items-start md:items-center justify-center w-full min-h-screen bg-black bg-opacity-80 p-4 md:p-0 overflow-auto"
        @click.self="$emit('close')"
    >
        <div
            class="relative flex flex-col md:flex-row w-full md:max-w-[900px] max-w-full bg-[#0f172a] rounded-lg overflow-y-auto md:overflow-hidden h-auto md:h-[750px]"
            :style="
                isMobile
                    ? 'height: 100vh;'
                    : 'min-height: 750px; align-items: stretch;'
            "
            @click.stop
        >
            <!-- Banner Desktop -->
            <div
                v-if="setting && !isMobile"
                class="flex-shrink-0"
                style="width: 450px; height: 750px"
            >
                <img
                    :src="'/storage/' + setting.software_banner_register"
                    alt="Banner"
                    class="w-full h-full object-cover"
                />
            </div>

            <!-- Formulário -->
            <form
                @submit.prevent="registerSubmit"
                class="flex-1 p-5 text-white flex flex-col relative"
                :class="{ 'overflow-y-auto max-h-[750px]': !isMobile }"
                style="min-height: 100%"
            >
                <!-- Topo: Contate-nos + Entrar + Fechar -->
                <div
                    class="flex justify-between items-center mb-4 flex-wrap md:flex-nowrap"
                >
                    <button
                        type="button"
                        class="contact-button px-4 py-2 rounded font-semibold hover:brightness-110 transition"
                    >
                        Suporte
                    </button>

                    <div class="flex items-center gap-3 ml-auto">
                        <p
                            class="signup-text m-0 text-white text-sm font-semibold whitespace-nowrap"
                        >
                            Já possui uma conta?
                            <a
                                href="#"
                                @click.prevent="hideLoginShowRegisterToggle"
                                class="text-blue-400 underline"
                                >Entrar</a
                            >
                        </p>
                        <button
                            @click.prevent="hideRegisterShowCupomToggle"
                            aria-label="Fechar modal"
                            class="close-button text-white hover:text-red-500"
                        >
                            &times;
                        </button>
                    </div>
                </div>

                <!-- Banner Mobile -->
                <div
                    v-if="setting && isMobile"
                    class="w-full flex justify-center"
                >
                    <div
                        class="mobile-banner w-full mb-4 overflow-hidden rounded-lg"
                    >
                        <img
                            v-if="
                                setting.software_mobile_register &&
                                setting.software_mobile_register !== ''
                            "
                            :src="
                                '/storage/' + setting.software_mobile_register
                            "
                            alt="Banner Mobile"
                            class="object-contain max-h-[150px]"
                        />
                        <img
                            v-else
                            :src="
                                '/storage/' + setting.software_mobile_register
                            "
                            alt="Banner Mobile"
                            class="object-contain max-h-[150px]"
                        />
                    </div>
                </div>

                <!-- Inputs -->
                <div class="space-y-4 w-full max-w-md mx-auto">
                    <div>
                        <label for="name" class="text-xs mb-1 block"
                            >Nome *</label
                        >
                        <input
                            id="name"
                            type="name"
                            placeholder="Insira Nome completo"
                            v-model="registerForm.name"
                            required
                            class="w-full p-2 rounded bg-[#1e293b] text-white text-sm"
                        />
                    </div>
                    <div>
                        <label for="cpf" class="text-xs mb-1 block"
                            >CPF *</label
                        >
                        <input
                            id="cpf"
                            type="text"
                            v-model="registerForm.cpf"
                            @input="formatCPF"
                            maxlength="14"
                            placeholder="Insira CPF"
                            required
                            class="w-full p-2 rounded bg-[#1e293b] text-white text-sm"
                        />
                    </div>
                    <div>
                        <label for="email" class="text-xs mb-1 block"
                            >E-mail *</label
                        >
                        <input
                            id="email"
                            type="email"
                            placeholder="Insira um email"
                            v-model="registerForm.email"
                            required
                            class="w-full p-2 rounded bg-[#1e293b] text-white text-sm"
                        />
                    </div>
                    <div>
                        <label for="phone" class="text-xs mb-1 block"
                            >Telefone *</label
                        >
                        <div class="phone-group">
                            <select
                                v-model="registerForm.countryCode"
                                aria-label="Código do país"
                            >
                                <option
                                    v-for="country in countries"
                                    :key="country.code"
                                    :value="country.dial_code"
                                >
                                    {{ country.flag }} {{ country.dial_code }}
                                </option>
                            </select>
                            <input
                                id="phone"
                                type="tel"
                                v-model="registerForm.phone"
                                placeholder="(31) 99876-xxxx"
                                required
                                @input="formatPhone"
                            />
                        </div>
                    </div>
                    <div class="relative">
                        <label for="password" class="text-xs mb-1 block"
                            >Senha *</label
                        >
                        <input
                            :type="typeInputPassword"
                            id="password"
                            placeholder="Insira uma senha"
                            v-model="registerForm.password"
                            required
                            class="w-full p-2 rounded bg-[#1e293b] text-white pr-10 text-sm"
                        />
                        <button
                            type="button"
                            @click.prevent="togglePassword"
                            class="absolute mt-3 right-2 top-1/2 transform -translate-y-1/2 text-white text-sm"
                            aria-label="Mostrar/Ocultar senha"
                        >
                            <i
                                :class="
                                    typeInputPassword === 'password'
                                        ? 'fa fa-eye'
                                        : 'fa fa-eye-slash'
                                "
                            ></i>
                        </button>
                    </div>
                    <div v-if="isReferral">
                        <label for="reference_code" class="text-xs mb-1 block"
                            >Código de referência</label
                        >
                        <input
                            id="reference_code"
                            type="text"
                            v-model="registerForm.reference_code"
                            class="w-full p-2 rounded bg-[#1e293b] text-white text-sm"
                            placeholder="Opcional"
                        />
                    </div>

                    <div class="text-center">
                        <button
                            type="button"
                            @click="isReferral = !isReferral"
                            class="text-xs text-blue-400 underline"
                        >
                            Tenho um código de referência
                        </button>
                    </div>
                    <!-- Checkbox maior de 18 anos -->
                    <div class="mt-6 flex items-start">
                        <input
                            type="checkbox"
                            id="isAdult"
                            v-model="registerForm.isAdult"
                            required
                            class="mt-1 w-5 h-5 rounded border border-gray-500 text-blue-600 bg-gray-700 focus:ring-blue-500 cursor-pointer"
                        />
                        <label
                            for="isAdult"
                            class="ml-3 text-xs text-gray-300 select-none leading-snug"
                        >
                            <p class="fqcHw mb-0">
                                Confirmo que <b>tenho mais de 18 anos</b> e
                                aceito os
                                <a
                                    href="#"
                                    @click.prevent="openModal('terms')"
                                    class="underline text-blue-400 cursor-pointer"
                                    >Termos e Condições</a
                                >
                                e a
                                <a
                                    href="#"
                                    @click.prevent="openModal('privacy')"
                                    class="underline text-blue-400 cursor-pointer"
                                    >Política de Privacidade</a
                                >.
                            </p>
                        </label>
                    </div>

                    <!-- Botão Criar Conta -->
                    <button
                        type="submit"
                        class="w-full py-2 mt-4 bg-[var(--ci-primary-color)] rounded font-semibold text-sm"
                    >
                        Criar Conta <i class="fa fa-arrow-right ml-2"></i>
                    </button>
                </div>
                <!-- Captcha Cloudflare -->
                <div
                    class="w-full mt-4 flex justify-center"
                    id="cf-turnstile"
                    data-sitekey="SUA_SITE_KEY"
                    data-theme="dark"
                ></div>
                <!-- Loader -->
                <div
                    v-if="isLoadingRegister"
                    class="absolute inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 rounded-lg"
                >
                    <div class="text-white text-center">
                        <i class="fa fa-spinner fa-spin fa-2x"></i>
                        <p class="mt-2 text-sm">Carregando...</p>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Termos e Privacidade -->
        <PrivacyPolicy
            v-if="showModal"
            :visible="showModal"
            :section="modalType"
            @close="showModal = false"
        />
    </div>
</template>

<script>
import { useToast } from "vue-toastification";
import { useAuthStore } from "@/Stores/Auth";
import HttpApi from "@/Services/HttpApi";
import PrivacyPolicy from "@/Pages/Terms/PrivacyPolicy.vue";

export default {
    name: "ModalRegister",
    components: { PrivacyPolicy },
    props: {
        showRegisterModal: Boolean,
        setting: Object,
    },
    data() {
        return {
            isLoadingRegister: false,
            isReferral: false,
            typeInputPassword: "password",
            registerForm: {
                name: "",
                email: "",
                password: "",
                cpf: "",
                phone: "",
                countryCode: "+55",
                reference_code: "",
                isAdult: false,
            },
            isMobile: false,
            countries: [
                { code: "BR", dial_code: "+55", flag: "🇧🇷" },
                { code: "US", dial_code: "+1", flag: "🇺🇸" },
                { code: "PT", dial_code: "+351", flag: "🇵🇹" },
                { code: "AR", dial_code: "+54", flag: "🇦🇷" },
                { code: "GB", dial_code: "+44", flag: "🇬🇧" },
            ],
            showModal: false,
            modalType: null,
        };
    },
    mounted() {
        this.checkIsMobile();
        window.addEventListener("resize", this.checkIsMobile);
        document.body.style.overflow = "hidden";
        document.body.classList.add("modal-open");
    },
    beforeUnmount() {
        window.removeEventListener("resize", this.checkIsMobile);
        document.body.style.overflow = "";
        document.body.classList.remove("modal-open");
    },
    methods: {
        checkIsMobile() {
            this.isMobile = window.innerWidth < 768;
        },
        togglePassword() {
            this.typeInputPassword =
                this.typeInputPassword === "password" ? "text" : "password";
        },
        hideRegisterShowCupomToggle() {
            this.$emit("close");
        },
        hideLoginShowRegisterToggle() {
            this.$emit("show-login");
        },
        formatCPF() {
            let v = this.registerForm.cpf.replace(/\D/g, "");
            if (v.length > 11) v = v.slice(0, 11);
            v = v
                .replace(/^(\d{3})(\d)/, "$1.$2")
                .replace(/^(\d{3})\.(\d{3})(\d)/, "$1.$2.$3")
                .replace(/^(\d{3})\.(\d{3})\.(\d{3})(\d)/, "$1.$2.$3-$4");
            this.registerForm.cpf = v;
        },
        formatPhone() {
            let v = this.registerForm.phone.replace(/\D/g, "");

            if (v.startsWith("0")) {
                v = v.slice(1);
            }

            if (v.length > 11) v = v.slice(0, 11);

            if (v.length <= 10) {
                v = v.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, "($1) $2-$3");
            } else {
                v = v.replace(/^(\d{2})(\d{5})(\d{0,4}).*/, "($1) $2-$3");
            }
            this.registerForm.phone = v;
        },
        openModal(type) {
            this.modalType = type;
            this.showModal = true;
        },
        async registerSubmit() {
            const _toast = useToast();
            const authStore = useAuthStore();
            this.isLoadingRegister = true;

            const payload = {
                name: this.registerForm.name,
                email: this.registerForm.email,
                password: this.registerForm.password,
                cpf: this.registerForm.cpf,
                phone: `${this.registerForm.countryCode} ${this.registerForm.phone}`,
                reference_code: this.registerForm.reference_code,
                isAdult: this.registerForm.isAdult,
            };

            try {
                const response = await HttpApi.post("auth/register", payload);

                if (response.data.access_token) {
                    authStore.setToken(response.data.access_token);
                    authStore.setUser(response.data.user);
                    authStore.setIsAuth(true);

                    // Limpar formulário
                    this.registerForm = {
                        name: "",
                        email: "",
                        password: "",
                        cpf: "",
                        phone: "",
                        countryCode: "+55",
                        reference_code: "",
                        isAdult: false,
                    };

                    _toast.success("Sua conta foi criada com sucesso!");
                    this.$emit("close");
                    this.$router.push({ name: "home" });
                }
            } catch (error) {
                if (error?.response?.data) {
                    const errors = error.response.data;
                    Object.values(errors).forEach((msg) => _toast.error(msg));
                } else {
                    _toast.error("Erro ao criar conta. Tente novamente.");
                }
            } finally {
                this.isLoadingRegister = false;
            }
        },
    },
};
</script>

<style scoped>
html,
body {
    overscroll-behavior: none;
    touch-action: none;
}
body.modal-open .mobile-menu-wrapper {
    display: none !important;
}
#modalElRegister {
    z-index: 2147483647 !important;
}

/* Botão fechar */
.close-button {
    flex-shrink: 0;
    font-size: 2rem;
    line-height: 1;
    border: none;
    background: transparent;
    padding: 0;
    cursor: pointer;
    color: white;
}
body.modal-open {
    overflow: hidden !important;
    position: fixed;
    width: 100%;
    height: 100%;
}

.phone-group {
    display: flex;
    width: 100%; /* garantido */
    border-radius: 0.375rem;
    background-color: #1e293b;
    overflow: hidden;
}

.phone-group select {
    flex: 0 0 90px; /* reduzido para melhor proporção */
    padding: 0.5rem 0.75rem;
    background-color: #1e293b;
    border: none;
    color: white;
    font-size: 0.875rem;
    cursor: pointer;
    outline: none;
}

.phone-group input[type="tel"] {
    flex: 1;
    padding: 0.5rem 0.75rem;
    border: none;
    background-color: #1e293b;
    color: white;
    font-size: 0.875rem;
    border-left: 1px solid #334155;
    outline: none;
}

/* Hover nos links */
.fqcHw a:hover {
    text-decoration: underline;
}
body.modal-open .mobile-menu-wrapper .mobile-menu {
    display: none !important;
}
#modalElRegister {
    z-index: 2147483647 !important;
}

/* Cor do botão Contate-nos */
button[type="button"].contact-button {
    background-color: var(--ci-primary-color) !important;
    color: white !important;
    padding: 0.5rem 0.15rem;
}

/* Cor do link "Entrar" */
a.text-blue-400 {
    color: var(--ci-primary-color) !important;
}

/* Estilo do banner mobile */
.mobile-banner {
    width: 100%;
    border-radius: 0.5rem;
    overflow: hidden;
    margin-bottom: 1rem;
}

.mobile-banner img {
    width: 100%;
    height: auto;
    object-fit: cover;
    display: block;
    border-radius: 0.5rem;
}

/* Estilo e ajuste mobile */
@media (max-width: 767px) {
    #modalElRegister {
        padding: 0 !important;
    }
    .close-button {
        font-size: 2.5rem !important;
        position: relative !important;
        top: auto !important;
        right: -13px !important;
        margin-left: -0.75rem !important;
        margin-top: -25px;
    }
    #modalElRegister > div {
        width: 100vw !important;
        height: 100dvh !important;
        max-height: 100dvh !important;
        max-width: 100vw !important;
        overflow-y: auto !important;
        border-radius: 0 !important;
    }

    form {
        padding: 1rem !important;
    }

    .phone-group {
        max-width: 100%;
    }

    input,
    select {
        font-size: 14px;
    }

    .text-xs {
        font-size: 12px;
    }

    .text-sm {
        font-size: 12px;
    }

    button {
        font-size: 14px;
    }

    .fqcHw {
        font-size: 12px;
    }
    .close-button:hover {
        color: var(--ci-primary-color); /* vermelho claro */
    }
}
</style>
