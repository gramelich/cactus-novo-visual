<template>
    <div
        v-if="showLogin"
        id="modalElAuth"
        class="fixed inset-0 z-[9999] flex items-start md:items-center justify-center w-full min-h-screen bg-black bg-opacity-80 p-4 md:p-0 overflow-auto"
        @click.self="emitClose"
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
            <!-- Imagem esquerda (desktop only) -->
            <div
                v-if="setting && !isMobile"
                class="flex-shrink-0"
                style="width: 450px; height: 750px"
            >
                <img
                    :src="'/storage/' + setting.software_banner_login"
                    alt="Banner"
                    class="w-full h-full object-cover"
                />
            </div>

            <!-- Conteúdo direito -->
            <div
                class="flex-1 p-6 overflow-y-auto flex flex-col text-white relative"
            >
                <!-- TOPO -->
                <div class="top-bar">
                    <!-- Precisa de ajuda -->
                    <button
                        class="help-button text-sm font-medium px-3 py-1 rounded bg-[var(--ci-primary-color)] text-white"
                    >
                        Precisa de ajuda?
                    </button>

                    <!-- Criar conta -->
                    <div class="signup-wrapper">
                        <p
                            class="signup-text m-0 text-white text-sm font-semibold whitespace-nowrap"
                        >
                            Ainda não tem uma conta?
                        </p>
                        <button @click="emitRegister" class="signup-link">
                            Criar conta
                        </button>
                    </div>

                    <!-- Botão fechar -->
                    <button
                        @click.prevent="emitClose"
                        aria-label="Fechar modal"
                        class="close-button text-white hover:text-red-500"
                    >
                        &times;
                    </button>
                </div>

                <!-- Banner mobile -->
                <div
                    v-if="setting && isMobile"
                    class="w-full flex justify-center mb-6"
                >
                    <div class="mobile-banner max-w-md w-full">
                        <img
                            :src="'/storage/' + setting.software_mobile_login"
                            alt="Banner Mobile"
                            class="object-contain max-h-[150px]"
                        />
                    </div>
                </div>

                <!-- Logo -->
                <div class="flex justify-center mb-6">
                    <img
                        v-if="setting?.software_logo_black"
                        :src="'/storage/' + setting.software_logo_black"
                        alt="Logo"
                        class="h-10 object-contain"
                    />
                </div>

                <!-- Formulário Login -->
                <form
                    v-if="!forgotPasswordOpen"
                    @submit.prevent="loginSubmit"
                    class="flex flex-col space-y-4"
                >
                    <div class="flex flex-col">
                        <label for="email" class="text-xs mb-1">Email *</label>
                        <input
                            id="email"
                            v-model="loginForm.email"
                            type="text"
                            placeholder="E-mail ou CPF"
                            required
                            class="w-full p-2 pr-10 rounded bg-[#1e293b] text-white text-sm"
                        />
                    </div>

                    <div class="relative">
                        <label for="password" class="text-xs mb-1"
                            >Senha *</label
                        >
                        <input
                            :type="typeInputPassword"
                            id="password"
                            v-model="loginForm.password"
                            required
                            placeholder="Insira sua senha"
                            class="w-full p-2 pr-10 rounded bg-[#1e293b] text-white text-sm"
                        />
                        <button
                            type="button"
                            @click="togglePassword"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 text-white text-sm"
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
                        <a
                            href="#"
                            @click.prevent="forgotPasswordOpen = true"
                            class="block mt-3 text-right text-sm text-gray-400 hover:text-gray-200"
                        >
                            Esqueceu a senha?
                        </a>
                    </div>

                    <button
                        type="submit"
                        class="w-full py-3 bg-[var(--ci-primary-color)] rounded font-semibold text-sm hover:bg-opacity-90 transition"
                    >
                        Entrar
                    </button>
                </form>

                <!-- Recuperar senha -->
                <form
                    v-else
                    @submit.prevent="submitForgotPassword"
                    class="flex flex-col space-y-4"
                >
                    <h3 class="text-lg font-semibold text-center mb-2">
                        Recuperar Senha
                    </h3>
                    <input
                        v-model="forgotEmail"
                        type="email"
                        placeholder="Digite chicobets.site e-mail"
                        required
                        class="w-full py-2.5 px-3 rounded bg-[#1e293b] text-white border border-gray-600"
                    />
                    <button
                        type="submit"
                        class="w-full py-3 bg-[var(--ci-primary-color)] rounded font-semibold text-sm hover:bg-opacity-90 transition"
                    >
                        Enviar Link de Recuperação
                    </button>
                    <a
                        href="#"
                        @click.prevent="forgotPasswordOpen = false"
                        class="block text-center text-sm text-gray-400 hover:text-gray-200"
                    >
                        Voltar para login
                    </a>
                </form>
                <!-- Caixa de aviso -->
                <div
                    class="mt-6 p-4 rounded-lg border border-gray-600 bg-[#1e293b] text-xs text-gray-300 leading-relaxed"
                >
                    Esteja atento aos riscos de dependência. Em caso de dúvidas,
                    acesse a nossa Central de Jogo Responsável
                </div>

                <!-- Botões sociais -->
                <div class="mt-6 flex flex-col gap-3 w-full">
                    <!-- Google -->
                    <button
                        type="button"
                        class="flex items-center justify-center gap-3 w-full py-3 rounded-lg border border-gray-600 hover:border-[var(--ci-primary-color)] transition text-white bg-[#1e293b]"
                        @click="socialLogin('google')"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 533.5 544.3"
                            class="w-5 h-5"
                        >
                            <path
                                fill="#4285F4"
                                d="M533.5 278.4c0-18.5-1.5-37-4.7-54.7H272.1v103.6h146.9c-6.3 34-25.1 62.8-53.6 82v68h86.7c50.8-46.8 80.4-115.7 80.4-198.9z"
                            />
                            <path
                                fill="#34A853"
                                d="M272.1 544.3c72.6 0 133.6-24 178.1-65.2l-86.7-68c-24 16.3-54.7 25.9-91.4 25.9-70.4 0-130-47.6-151.5-111.4H33.2v69.9c44.3 87.2 135.3 149.8 238.9 149.8z"
                            />
                            <path
                                fill="#FBBC05"
                                d="M120.6 323.6c-10.6-31.7-10.6-65.9 0-97.6v-69.9H33.2c-40.6 79.1-40.6 173.3 0 252.4l87.4-69.9z"
                            />
                            <path
                                fill="#EA4335"
                                d="M272.1 107.6c38.8 0 73.7 13.4 101.3 39.5l75.9-75.9C405.1 24 344.1 0 272.1 0 168.5 0 77.5 62.6 33.2 149.8l87.4 69.9c21.5-63.8 81.1-111.4 151.5-111.4z"
                            />
                        </svg>
                        Entrar com Google
                    </button>

                    <!-- Twitch -->
                    <button
                        type="button"
                        class="flex items-center justify-center gap-3 w-full py-3 rounded-lg border border-gray-600 hover:border-purple-600 transition text-white bg-[#1e293b]"
                        @click="socialLogin('twitch')"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-twitch"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M3.857 0 1 2.857v10.286h3.429V16l2.857-2.857H9.57L14.714 8V0zm9.714 7.429-2.285 2.285H9l-2 2v-2H4.429V1.143h9.142z"
                            />
                            <path
                                d="M11.857 3.143h-1.143V6.57h1.143zm-3.143 0H7.571V6.57h1.143z"
                            />
                        </svg>
                        Entrar com Twitch
                    </button>
                </div>

                <!-- Loader -->
                <div
                    v-if="isLoadingLogin"
                    class="absolute inset-0 bg-black bg-opacity-70 flex items-center justify-center rounded-lg"
                >
                    <i
                        class="fa fa-spinner fa-spin fa-2x text-[var(--ci-primary-color)]"
                    ></i>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useToast } from "vue-toastification";
import { useAuthStore } from "@/Stores/Auth";
import HttpApi from "@/Services/HttpApi";

export default {
    name: "ModalLogin",
    props: {
        showLogin: Boolean,
        setting: Object,
    },
    data() {
        return {
            loginForm: { email: "", password: "" },
            forgotEmail: "",
            typeInputPassword: "password",
            isLoadingLogin: false,
            forgotPasswordOpen: false,
            isMobile: false,
        };
    },
    mounted() {
        this.isMobile = window.innerWidth < 768;
        window.addEventListener("resize", this.handleResize);
        // Sincroniza o estado inicial caso showLogin já esteja true
        if (this.showLogin) {
            document.body.classList.add("modal-open");
            document.body.style.overflow = "hidden";
        }
    },
    beforeUnmount() {
        window.removeEventListener("resize", this.handleResize);
        document.body.classList.remove("modal-open");
        document.body.style.overflow = "";
    },
    watch: {
        showLogin(newVal) {
            if (newVal) {
                document.body.classList.add("modal-open");
                document.body.style.overflow = "hidden";
            } else {
                document.body.classList.remove("modal-open");
                document.body.style.overflow = "";
            }
        },
    },
    methods: {
        handleResize() {
            this.isMobile = window.innerWidth < 768;
        },
        togglePassword() {
            this.typeInputPassword =
                this.typeInputPassword === "password" ? "text" : "password";
        },
        emitClose() {
            this.$emit("close");
        },
        emitRegister() {
            this.$emit("close");
            this.$emit("show-register");
        },
        socialLogin(provider) {
            window.location.href = `/auth/redirect/${provider}`;
        },
        async loginSubmit() {
            const toast = useToast();
            const authStore = useAuthStore();
            this.isLoadingLogin = true;

            try {
                const response = await HttpApi.post(
                    "auth/login",
                    this.loginForm
                );
                if (response.data.access_token) {
                    authStore.setToken(response.data.access_token);
                    authStore.setUser(response.data.user);
                    authStore.setIsAuth(true);
                    this.loginForm = { email: "", password: "" };
                    toast.success("Usuário autenticado com sucesso!");
                    this.emitClose();
                    this.$router.push({ name: "home" });
                }
            } catch (error) {
                toast.error(
                    error?.response?.data?.message || "Erro ao fazer login."
                );
            } finally {
                this.isLoadingLogin = false;
            }
        },
        async submitForgotPassword() {
            const toast = useToast();
            if (!this.forgotEmail)
                return toast.error("Informe um e-mail válido.");
            try {
                await HttpApi.post("auth/forgot-password", {
                    email: this.forgotEmail,
                });
                toast.success("Verifique chicobets.site e-mail para redefinir a senha.");
                this.forgotPasswordOpen = false;
                this.forgotEmail = "";
            } catch {
                toast.error("Não foi possível enviar o link. Tente novamente.");
            }
        },
    },
};
</script>

<style scoped>
/* Banner mobile ocupa toda a largura do container do formulário */
.mobile-banner {
    width: 100%;
    max-width: 400px; /* mesma largura dos inputs */
    margin: 0 auto 1rem auto;
    border-radius: 0.5rem;
    overflow: hidden;
}

.mobile-banner img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 0.5rem;
    display: block;
}
body.modal-open .mobile-menu-wrapper {
    display: none !important;
}
body.modal-open {
    overflow: hidden !important;
    position: fixed;
    width: 100%;
    height: 100%;
}
#modalElAuth {
    z-index: 2147483647 !important;
}

/* Container modal mobile ocupa 100vw e 100vh, sem bordas arredondadas */
@media (max-width: 767px) {
    #modalElAuth {
        padding: 0 !important;
    }

    #modalElAuth > div {
        width: 100vw !important;
        height: 100dvh !important;
        max-height: 100dvh !important;
        max-width: 100vw !important;
        overflow-y: auto !important;
        border-radius: 0 !important;
    }

    /* form {
        padding: 1rem !important;
    } */
    .close-button {
        font-size: 2.5rem !important;
        position: relative !important;
        top: -10px !important;
        right: -15px !important;
        margin-left: -0.75rem !important;
        margin-top: -25px;
    }
}

/* Ajuste da altura mínima para telas baixas */
@media (max-height: 800px) {
    #modalElAuth > div {
        min-height: auto !important;
    }
}

/* Top bar layout */
.top-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: nowrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
    position: relative;
    width: 100%;
    user-select: none;
}

/* Botão precisa de ajuda */
.help-button {
    flex-shrink: 0;
    background-color: var(--ci-primary-color);
    color: white;
    padding: 0.5rem 0.15rem;
    font-size: 0.875rem;
    border-radius: 0.375rem;
    white-space: nowrap;
}

/* Texto + link criar conta */
.signup-wrapper {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: white;
    flex-grow: 1;
    justify-content: center;
    min-width: 0;
    flex-wrap: wrap;
}

/* Texto "Ainda não tem uma conta?" */
.signup-text {
    margin: 0;
    white-space: nowrap;
}

/* Link "Criar conta" */
.signup-link {
    cursor: pointer;
    color: var(--ci-primary-color);
    text-decoration: underline;
    background: none;
    border: none;
    padding: 0;
    font-weight: 600;
    font-size: 0.875rem;
    white-space: nowrap;
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

.close-button:hover {
    color: var(--ci-primary-color); /* vermelho claro */
}
</style>
