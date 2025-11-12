<style>
.container-deposit {
    margin: 4%;
}
.ui-button-blue2 {
    font-size: 0.875rem;
    font-weight: 700;
    line-height: 1.25rem;
    border-radius: 3px;
    -webkit-box-shadow: 0px 2px 11px 0px var(--ci-primary-color);
    -moz-box-shadow: 0px 2px 11px 0px var(--ci-primary-color);
    box-shadow: 0px 2px 11px 0px var(--ci-primary-color);
    background-color: var(--ci-primary-color);
    color: var(--sub-text-color);
    width: auto;
    padding: 9px 15px;
    -webkit-flex: none;
    -ms-flex: none;
    flex: none;
}

.ui-button-blue2:hover {
    opacity: 0.9;
}
.pixFont {
    color: black;
    font-size: 10px;
    font-weight: bold;
}

@media (max-width: 768px) {
    .pixFont {
        font-size: 8px;
    }
    .container-deposit {
        margin: 0;
        width: 100vw;
        padding-bottom: 50px;
        height: 100vh;
    }
    .ui-button-blue2 {
        font-size: 0.775rem;
        font-weight: 700;
        line-height: 1.25rem;

        padding: 5px 8px;
    }
}
@media (max-width: 376px) {
    .container-deposit {
        margin: 0;
        width: 100vw;
        height: calc(auto + 160px);
    }
}
</style>
<template>
    <div class="relative flex items-center opacidade-hover">
        <div
            class="aaDu6 flex items-center"
            style="
                border-radius: 30px;
                position: absolute;
                top: 0;
                right: 10px;
                background-color: #ffe800;
                margin-top: -7px;
                padding-left: 1px;
                padding-right: 1px;
            "
        >
            <i
                style="font-size: 12px; color: #01beb0"
                class="fa-brands fa-pix"
            ></i>
            <span class="pixFont">PIX</span>
        </div>

        <button
            @click.prevent="toggleModalDeposit"
            type="button"
            class="flex items-center justify-center ml-1 md:ml-2 px-1 md:px-4 py-1 md:py-1 text-xs md:text-sm rounded-lg border border-[var(--ci-primary-color)] bg-[var(--ci-primary-color)] hover:bg-transparent hover:text-white transition-all duration-200 md:min-w-[100px]"
            style="border-radius: 8px; margin-top: -1px"
        >
            <strong class="whitespace-nowrap" style="color: var(--title-color)"
                >Depositar</strong
            >
        </button>
    </div>

    <div
        style="
            background-color: rgba(0, 0, 0, 0.47);
            backdrop-filter: none;
            height: 100vh;
            z-index: 2;
        "
        id="modalElDeposit"
        aria-hidden="true"
        class="fixed top-0 left-0 right-0 hidden w-full overflow-x-hidden overflow-y-auto"
    >
        <div
            class="relative w-full max-w-2xl container-deposit overflow-y-auto"
            style="
                background-color: #0f172a;
                border-radius: 8px;
                max-width: 550px;
                margin: 0 auto;
                z-index: 2;
            "
        >
            <div
                class="flex flex-col pb-8 my-auto relative"
                style="justify-content: flex-end; position: relative"
            >
                <a
                    style="position: absolute; right: 2%; top: 2%; z-index: 3"
                    class="login-register-x"
                    @click.prevent="toggleModalDeposit"
                    href=""
                >
                    <div
                        class="x-mark-scale"
                        style="
                            box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.5);
                            background-color: var(--carousel-banners-dark);
                            padding: 7px 13px;
                            border-radius: 5px;
                            max-width: 40px;
                        "
                    >
                        <i
                            style="
                                color: var(--ci-primary-color);
                                font-weight: bold;
                            "
                            class="fa-light fa-x"
                        ></i>
                    </div>
                </a>
                <DepositWidget />
            </div>
        </div>
    </div>
</template>

<script>
import { useAuthStore } from "@/Stores/Auth.js";
import DepositWidget from "@/Components/Widgets/DepositWidget.vue";
import { onMounted, ref, watch, watchEffect } from "vue";
import { initFlowbite } from "flowbite";
import HttpApi from "@/Services/HttpApi.js";

import { useRouter } from "vue-router";

export default {
    props: ["showMobile", "title", "isFull"],
    components: { DepositWidget },
    data() {
        return {
            isModalOpen: true,
            isLoading: false,
            modalDeposit: null,
            isLoadingWallet: true,
            wallet: null,
        };
    },
    setup(props) {
        onMounted(() => {
            initFlowbite();
        });

        const router = useRouter();
        const isCasinoPlayPage = ref(false);

        watchEffect(() => {
            checkRoute();
        });

        onMounted(() => {
            checkRoute();
        });

        function checkRoute() {
            // Verifique se a rota atual é 'casinoPlayPage'
            isCasinoPlayPage.value =
                router.currentRoute._value.name === "casinoPlayPage";
        }

        return {
            router,
            isCasinoPlayPage,
        };
    },
    computed: {
        isAuthenticated() {
            const authStore = useAuthStore();
            return authStore.isAuth;
        },
    },
    mounted() {
        window.scrollTo(0, 0);
        this.modalDeposit = new Modal(
            document.getElementById("modalElDeposit"),
            {
                placement: "center",
                backdrop: "dynamic",
                backdropClasses:
                    "bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 backmodaldeposit",
                closable: true,
                onHide: () => {
                    this.paymentType = null;
                    const divsToDelete =
                        document.querySelectorAll(".backmodaldeposit");
                    if (divsToDelete.length > 0) {
                        divsToDelete.forEach((div) => {
                            div.remove();
                        });
                    }
                },
                onShow: () => {},
                onToggle: () => {},
            }
        );
    },
    beforeUnmount() {},
    methods: {
        getWallet: async function () {
            const _this = this;

            await HttpApi.get("profile/wallet")
                .then((response) => {
                    _this.wallet = response.data.wallet;
                    _this.isLoadingWallet = false;
                })
                .catch((error) => {
                    Object.entries(
                        JSON.parse(error.request.responseText)
                    ).forEach(([key, value]) => {
                        if (value == "unauthenticated") {
                            localStorage.clear();
                            clearInterval(this.processInterval);
                        }
                    });

                    _this.isLoadingWallet = false;
                });
        },

        toggleModalDeposit: function () {
            this.modalDeposit.toggle();
        },

        show() {
            if (this.modalDeposit) {
                this.modalDeposit.show();
            }
        },
    },
    watch: {},
};
</script>

<style scoped></style>
