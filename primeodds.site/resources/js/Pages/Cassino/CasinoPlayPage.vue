<template>
    <GameLayout>
        <LoadingComponent :isLoading="isLoading">
            <div class="text-center">
                <span>{{ $t("Loading game information") }}</span>
            </div>
        </LoadingComponent>

        <div
            v-if="!isLoading && game"
            :class="{
                'w-full h-[calc(100vh-8px)] p-0 m-0 absolute top-0 left-0 z-10':
                    game.id === 1458,
                'w-full mx-auto': modeMovie && game.id !== 1458,
                'lg:w-2/3 mx-auto': !modeMovie && game.id !== 1458,
            }"
            class="py-2 lg:py-6 relative"
        >
            <div
                class="game-screen"
                :class="{ 'h-screen': game.id === 1458 }"
                id="game-screen"
            >
                <fullscreen v-model="fullscreen" :page-only="pageOnly">
                    <div
                        v-if="
                            showButton &&
                            game.game_type === 'live' &&
                            game.distribution === 'evergame'
                        "
                        class="game-full fullscreen-wrapper flex items-center justify-center"
                    >
                        <button
                            @click.prevent="openModal(gameUrl)"
                            type="button"
                            class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                        >
                            Clique para começar
                        </button>
                    </div>

                    <iframe
                        v-else
                        :src="gameUrl"
                        :class="{
                            'w-full h-screen border-none': game.id === 1458,
                            'game-full fullscreen-wrapper': game.id !== 1458,
                        }"
                    ></iframe>
                </fullscreen>
            </div>

            <!-- Rodapé só aparece se não for o jogo 1458 -->
            <div
                v-if="game.id !== 1458"
                class="flex justify-between items-center w-full px-4 py-4 bg-gray-300/20 dark:bg-gray-800 game-footer"
            >
                <div class="flex flex-col">
                    <p class="capitalize font-bold">{{ game.game_name }}</p>
                    <p>{{ game?.provider.name }}</p>
                </div>

                <div class="text-gray-500 flex items-center gap-3">
                    <div class="flex items-center gap-2">
                        <button
                            @click.prevent="toggleLike"
                            :class="{
                                'text-[var(--ci-primary-color)]': game.hasLike,
                            }"
                        >
                            <svg
                                height="1em"
                                viewBox="0 0 512 512"
                                width="1em"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                            >
                                <path
                                    d="M512 224.112C512 197.608 490.516 176.133 464 176.133H317.482C340.25 138.226 352.005 95.257 352.005 80.11C352.005 56.523 333.495 32 302.54 32C239.411 32 276.176 108.148 194.312 173.618L178.016 186.644C166.23 196.06 160.285 209.903 160.215 223.897C160.191 223.921 160 224.112 160 224.112V384.042C160 399.146 167.113 413.368 179.198 422.427L213.336 448.02C241.027 468.779 274.702 480 309.309 480H368C394.516 480 416 458.525 416 432.021C416 428.386 415.52 424.878 414.754 421.475C434 415.228 448 397.37 448 376.045C448 366.897 445.303 358.438 440.861 351.164C463.131 347.002 480 327.547 480 304.077C480 291.577 475.107 280.298 467.275 271.761C492.234 270.051 512 249.495 512 224.112Z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    d="M128 448V224C128 206.328 113.674 192 96 192H32C14.326 192 0 206.328 0 224V448C0 465.674 14.326 480 32 480H96C113.674 480 128 465.674 128 448Z"
                                    fill="currentColor"
                                    opacity="0.4"
                                ></path>
                            </svg>
                        </button>
                        <p class="font-bold text-sm mt-[-5px] text-[#727576]">
                            {{ game.totalLikes }}
                        </p>
                        <svg
                            style="transform: scaleX(-1); cursor: pointer"
                            height="1em"
                            viewBox="0 0 512 512"
                            width="1em"
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                        >
                            <path
                                d="M467.275 240.239C475.107 231.702 480 220.423 480 207.923C480 184.453 463.131 164.998 440.861 160.836C445.303 153.562 448 145.103 448 135.955C448 114.63 434 96.772 414.754 90.525C415.52 87.122 416 83.614 416 79.979C416 53.475 394.516 32 368 32H309.309C274.702 32 241.027 43.221 213.336 63.98L179.198 89.573C167.113 98.632 160 112.854 160 127.958V287.888C160 287.888 160.191 288.079 160.215 288.103C160.285 302.097 166.23 315.94 178.016 325.356L194.312 338.382C276.176 403.852 239.411 480 302.54 480C333.495 480 352.005 455.477 352.005 431.89C352.005 416.743 340.25 373.774 317.482 335.867H464C490.516 335.867 512 314.392 512 287.888C512 262.505 492.234 241.949 467.275 240.239Z"
                                fill="currentColor"
                            ></path>
                            <path
                                d="M96 32H32C14.326 32 0 46.326 0 64V288C0 305.672 14.326 320 32 320H96C113.674 320 128 305.672 128 288V64C128 46.326 113.674 32 96 32Z"
                                fill="currentColor"
                                opacity="0.4"
                            ></path>
                        </svg>
                    </div>

                    <button
                        data-tooltip-target="tooltip-mode-expand"
                        type="button"
                        @click.prevent="togglefullscreen"
                    >
                        <svg
                            height="1em"
                            viewBox="0 0 512 512"
                            width="1em"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M128 64H32C14.31 64 0 78.31 0 96v96c0 17.69 14.31 32 32 32s32-14.31 32-32V128h64c17.69 0 32-14.31 32-32S145.7 64 128 64zM480 288c-17.69 0-32 14.31-32 32v64h-64c-17.69 0-32 14.31-32 32s14.31 32 32 32h96c17.69 0 32-14.31 32-32v-96C512 302.3 497.7 288 480 288z"
                                fill="currentColor"
                            ></path>
                            <path
                                d="M480 64h-96c-17.69 0-32 14.31-32 32s14.31 32 32 32h64v64c0 17.69 14.31 32 32 32s32-14.31 32-32V96C512 78.31 497.7 64 480 64zM128 384H64v-64c0-17.69-14.31-32-32-32s-32 14.31-32 32v96c0 17.69 14.31 32 32 32h96c17.69 0 32-14.31 32-32S145.7 384 128 384z"
                                fill="currentColor"
                                opacity="0.4"
                            ></path>
                        </svg>
                    </button>
                    <div
                        id="tooltip-mode-expand"
                        role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
                    >
                        Modo Fullscreen
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
            </div>
        </div>
    </GameLayout>
</template>

<script>
import { initFlowbite, Tabs, Modal } from "flowbite";
import { RouterLink, useRoute, useRouter } from "vue-router";
import { useAuthStore } from "@/Stores/Auth.js";
import { component as fullscreen } from "vue-fullscreen";
import LoadingComponent from "@/Components/UI/LoadingComponent.vue";
import GameLayout from "@/Layouts/GameLayout.vue";
import HttpApi from "@/Services/HttpApi.js";

import { defineComponent, toRefs, reactive } from "vue";

export default defineComponent({
    components: {
        GameLayout,
        LoadingComponent,
        RouterLink,
        fullscreen,
    },
    data() {
        return {
            isLoading: true,
            game: null,
            modeMovie: false,
            gameUrl: null,
            token: null,
            gameId: null,
            tabs: null,
            undermaintenance: false,
            showButton: false,
        };
    },
    setup() {
        const router = useRouter();
        const state = reactive({
            fullscreen: false,
            pageOnly: false,
        });

        function togglefullscreen() {
            state.fullscreen = !state.fullscreen;
        }

        return {
            ...toRefs(state),
            togglefullscreen,
            router,
        };
    },
    computed: {
        userData() {
            const authStore = useAuthStore();
            return authStore.user;
        },
        isAuthenticated() {
            const authStore = useAuthStore();
            return authStore.isAuth;
        },
        isSportsRoute() {
            const route = useRoute();
            return route.path === "/sports";
        },
    },
    mounted() {
        const userAgent = navigator.userAgent.toLowerCase();
        const isSafari =
            userAgent.includes("safari") && !userAgent.includes("chrome");
        const isSamsungInternet =
            userAgent.includes("samsung") &&
            userAgent.includes("safari") &&
            !userAgent.includes("chrome");
        const isIOS =
            userAgent.includes("iphone") || userAgent.includes("ipad");

        if (isSafari || isSamsungInternet || isIOS) {
            this.showButton = true;
        }
    },
    methods: {
        loadingTab() {
            const tabsElement = document.getElementById("tabs-info");
            if (tabsElement) {
                const tabElements = [
                    {
                        id: "default",
                        triggerEl: document.querySelector("#default-tab"),
                        targetEl: document.querySelector("#default-panel"),
                    },
                    {
                        id: "descriptions",
                        triggerEl: document.querySelector("#description-tab"),
                        targetEl: document.querySelector("#description-panel"),
                    },
                    {
                        id: "reviews",
                        triggerEl: document.querySelector("#reviews-tab"),
                        targetEl: document.querySelector("#reviews-panel"),
                    },
                ];

                const options = {
                    defaultTabId: "default",
                    activeClasses:
                        "text-green-600 hover:text-green-600 dark:text-green-500 dark:hover:text-green-400 border-green-600 dark:border-green-500",
                    inactiveClasses:
                        "text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300",
                    onShow: () => {},
                };

                const instanceOptions = {
                    id: "default",
                    override: true,
                };

                this.tabs = new Tabs(
                    tabsElement,
                    tabElements,
                    options,
                    instanceOptions
                );
            }
        },
        openModal(gameUrl) {
            window.open(gameUrl);
        },
        async getGame() {
            try {
                const response = await HttpApi.get(
                    "games/single/" + this.gameId
                );

                if (response.data?.action === "deposit") {
                    this.$nextTick(() => {
                        this.router.push({ name: "profileDeposit" });
                    });
                }

                const game = response.data.game;
                this.game = game;

                this.gameUrl = response.data.gameUrl;
                this.token = response.data.token;
                this.isLoading = false;

                this.$nextTick(() => {
                    this.loadingTab();
                });
            } catch (error) {
                this.isLoading = false;
                this.undermaintenance = true;

                try {
                    const errors = JSON.parse(error.request.responseText);
                    Object.entries(errors).forEach(([key, value]) => {
                        // Aqui você pode fazer algo com os erros
                    });
                } catch {
                    // Se o JSON não for válido, ignore
                }
            }
        },
        async toggleFavorite() {
            try {
                await HttpApi.post("games/favorite/" + this.game.id, {});
                await this.getGame();
                this.isLoading = false;
            } catch (error) {
                this.isLoading = false;
            }
        },
        async toggleLike() {
            try {
                await HttpApi.post("games/like/" + this.game.id, {});
                await this.getGame();
                this.isLoading = false;
            } catch (error) {
                this.isLoading = false;
            }
        },
    },
    async created() {
        if (this.isAuthenticated) {
            const route = useRoute();
            this.gameId = route.params.id;

            await this.getGame();
        } else {
            this.router.push({ name: "home", params: { action: "openlogin" } });
        }
    },
});
</script>

<style scoped>
.game-screen {
    margin-top: 30px;
    width: 100%;
    min-height: 650px;
}

.game-screen .game-full {
    width: 100%;
    min-height: 650px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.game-footer {
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
}
</style>
