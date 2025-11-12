<template>
    <AuthLayout>
        <LoadingComponent :isLoading="isLoading">
            <div class="text-center">
                <span>{{ $t('Loading') }}</span>
            </div>
        </LoadingComponent>

        <div v-if="!isLoading" class="my-auto mt-36">
            <div class="px-4 py-5">
                <div class="min-h-[calc(100vh-565px)] text-center flex flex-col items-center justify-center">
                    <div class="w-full rounded-lg shadow-lg border-none md:mt-0 sm:max-w-md xl:p-0 bg-base">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="mb-8 text-3xl text-center">{{ $t('Reset Password') }}</h1>

                            <div class="mt-4 px-4">
                                <form @submit.prevent="resetPasswordSubmit" method="post">
                                    <!-- E-mail / Telefone -->
                                    <div class="relative mb-3">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <i class="fa-regular fa-envelope text-success-emphasis"></i>
                                        </div>
                                        <input type="email"
                                               name="email"
                                               v-model="form.email"
                                               class="input-group"
                                               :placeholder="$t('Enter email or phone')"
                                               required
                                        >
                                    </div>

                                    <!-- Nova senha -->
                                    <div class="relative mb-3">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <i class="fa-regular fa-lock text-success-emphasis"></i>
                                        </div>
                                        <input :type="typeInputPassword"
                                               name="password"
                                               v-model="form.password"
                                               class="input-group pr-[40px]"
                                               :placeholder="$t('Type the password')"
                                               required
                                        >
                                        <button type="button" @click.prevent="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3.5 ">
                                            <i v-if="typeInputPassword === 'password'" class="fa-regular fa-eye"></i>
                                            <i v-if="typeInputPassword === 'text'" class="fa-sharp fa-regular fa-eye-slash"></i>
                                        </button>
                                    </div>

                                    <!-- Confirmação -->
                                    <div class="relative mb-3">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <i class="fa-regular fa-lock text-success-emphasis"></i>
                                        </div>
                                        <input :type="typeInputPassword"
                                               name="password_confirmation"
                                               v-model="form.password_confirmation"
                                               class="input-group pr-[40px]"
                                               :placeholder="$t('Confirm the Password')"
                                               required
                                        >
                                        <button type="button" @click.prevent="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3.5">
                                            <i v-if="typeInputPassword === 'password'" class="fa-regular fa-eye"></i>
                                            <i v-if="typeInputPassword === 'text'" class="fa-sharp fa-regular fa-eye-slash"></i>
                                        </button>
                                    </div>

                                    <!-- Botão -->
                                    <div class="mt-5 w-full">
                                        <button type="submit" class="ui-button-blue rounded w-full mb-3">
                                            {{ $t('Submit') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>

<script>
import { useToast } from "vue-toastification";
import { useAuthStore } from "@/Stores/Auth.js";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { useRoute, useRouter } from 'vue-router';
import LoadingComponent from "@/Components/UI/LoadingComponent.vue";
import { onMounted, ref } from "vue";
import HttpApi from "@/Services/HttpApi.js";

export default {
    components: { LoadingComponent, AuthLayout },
    data() {
        return {
            isLoading: false,
            typeInputPassword: 'password',
            form: {
                email: '',
                password: '',
                password_confirmation: '',
                token: '',
            },
        };
    },
    setup() {
        const route = useRoute();
        const token = ref('');
        const email = ref('');

        onMounted(() => {
            token.value = route.query.token || '';
            email.value = route.query.email || '';
        });

        return {
            token,
            email
        };
    },
    computed: {
        isAuthenticated() {
            const authStore = useAuthStore();
            return authStore.isAuth;
        },
    },
    mounted() {
        const router = useRouter();

        // Só redireciona se estiver autenticado e não for uma página de redefinição
        if (this.isAuthenticated && !this.token) {
            router.push({ name: 'home' });
        }

        // Preenche o form.email se foi passado pela query
        if (this.email) {
            this.form.email = this.email;
        }

        // Preenche o token
        this.form.token = this.token;
    },
    methods: {
        togglePassword() {
            this.typeInputPassword = this.typeInputPassword === 'password' ? 'text' : 'password';
        },
        async resetPasswordSubmit() {
            const _toast = useToast();
            this.isLoading = true;

            try {
                await HttpApi.post('auth/reset-password/' + this.form.token, this.form);
                _toast.success('Senha restaurada com sucesso!');
                this.isLoading = false;
                window.location.href = "/login";
            } catch (error) {
                if (error.request?.responseText) {
                    const errors = JSON.parse(error.request.responseText);
                    Object.values(errors).forEach((message) => {
                        _toast.error(message);
                    });
                } else {
                    _toast.error('Erro ao redefinir senha.');
                }
                this.isLoading = false;
            }
        },
    },
};
</script>

<style scoped>
/* chicobets.site CSS customizado aqui */
</style>
