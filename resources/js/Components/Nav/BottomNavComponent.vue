<style>
@media (max-width: 1025px) {
    .aparecer-menu {
        display: block;
    }
}
</style>
<template>
    <div
        class="mobile-menu-wrapper aparecer-menu"
        style="background-color: var(--ci-gray-medium)"
    >
        <div class="mobile-menu">
            <button @click.prevent="toggleMenu" class="btn">
                <svg
                    height="1em"
                    viewBox="0 0 448 512"
                    width="1em"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"
                        fill="currentColor"
                    ></path>
                </svg>
                <span style="font-size: 12px; font-weight: bold">Menu</span>
            </button>

            <a v-if="custom.esportes" :href="custom.esportes" class="btn">
                <svg
                    width="25"
                    height="24"
                    viewBox="0 0 25 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g clip-path="url(#clip0_2269_1776)">
                        <path
                            d="M24.0682 14.781C22.936 14.6028 22.0672 13.6203 22.0672 12.4389L22.0672 11.6023C22.0672 10.4207 22.936 9.43817 24.0682 9.26001L24.25 9.26001L24.25 14.781L24.0682 14.781Z"
                            fill="#8B8FB1"
                        ></path>
                        <path
                            opacity="0.6"
                            d="M13.3402 8.23187C15.1306 8.56348 16.4911 10.1356 16.4911 12.0205C16.4911 13.9054 15.1306 15.4775 13.3402 15.8091L13.3402 21.873C13.3402 21.9254 13.334 21.9763 13.3232 22.0254L20.7344 22.0254C22.6729 22.0254 24.25 20.4483 24.25 18.5098L24.25 16.2114C22.2543 16.1129 20.6609 14.4584 20.6609 12.4389L20.6609 11.6023C20.6609 9.58264 22.2543 7.9281 24.25 7.82977L24.25 5.53125C24.25 3.59271 22.6729 2.01562 20.7344 2.01562L13.3232 2.01562C13.334 2.0647 13.3402 2.1156 13.3402 2.16797L13.3402 8.23187Z"
                            fill="#585B72"
                        ></path>
                        <path
                            opacity="0.6"
                            d="M11.934 15.8091C10.1436 15.4775 8.7829 13.9054 8.7829 12.0205C8.7829 10.1356 10.1436 8.56348 11.934 8.23187L11.934 2.16797C11.934 2.1156 11.94 2.0647 11.951 2.01562L3.76562 2.01562C1.82709 2.01562 0.25 3.59271 0.25 5.53125L0.25 7.82977C2.24567 7.9281 3.83905 9.58264 3.83905 11.6023L3.83905 12.4389C3.83905 14.4586 2.24567 16.1129 0.249999 16.2114L0.249999 18.5098C0.249999 20.4483 1.82709 22.0254 3.76562 22.0254L11.951 22.0254C11.94 21.9763 11.934 21.9254 11.934 21.873L11.934 15.8091Z"
                            fill="#585B72"
                        ></path>
                        <path
                            d="M2.4328 12.4388L2.4328 11.6022C2.4328 10.3582 1.46967 9.33557 0.25 9.23926L0.25 14.8016C1.46967 14.7053 2.4328 13.6827 2.4328 12.4388Z"
                            fill="#8B8FB1"
                        ></path>
                        <path
                            d="M13.3402 14.3649C14.3482 14.0619 15.0848 13.1259 15.0848 12.0204C15.0848 10.915 14.3482 9.979 13.3402 9.67615L13.3402 14.3649Z"
                            fill="#8B8FB1"
                        ></path>
                        <path
                            d="M11.934 9.67615C10.926 9.979 10.1891 10.915 10.1891 12.0204C10.1891 13.1259 10.926 14.0619 11.934 14.3649L11.934 9.67615Z"
                            fill="#8B8FB1"
                        ></path>
                    </g>
                    <defs>
                        <clipPath id="clip0_2269_1776">
                            <rect
                                width="24"
                                height="24"
                                fill="white"
                                transform="translate(24.25) rotate(90)"
                            ></rect>
                        </clipPath>
                    </defs>
                </svg>
                <span style="font-size: 12px; font-weight: bold">Esportes</span>
            </a>

            <!-- Depositar (Espaço reservado, mas o botão fica elevado com absolute) -->
            <div class="flex-1 flex justify-center relative">
                <a
                    @click.prevent="toggleModalDeposit"
                    class="absolute left-1/2 -translate-x-1/2 -top-5 flex flex-col items-center text-white"
                    style="z-index: 50"
                >
                    <!-- Círculo -->
                    <div
                        class="mt-[-32px] rounded-full w-[50px] h-[50px] flex items-center justify-center shadow-lg"
                        style="background-color: var(--ci-primary-color)"
                    >
                        <!-- Ícone Dinheiro -->
                        <svg
                            viewBox="0 0 30 32"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g filter="url(#filter0_d_2208_893)">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M16.7853 20.3557V24.4941C16.7853 24.6757 16.988 25.1319 18.0049 25.5941C18.9413 26.0198 20.2976 26.3064 21.8434 26.3064C23.3892 26.3064 24.7454 26.0198 25.6818 25.5941C26.6987 25.1319 26.9015 24.6757 26.9015 24.4941V20.3557H28.6867V24.4941C28.6867 25.8063 27.5573 26.7026 26.4205 27.2193C25.2031 27.7727 23.584 28.0916 21.8434 28.0916C20.1027 28.0916 18.4836 27.7727 17.2662 27.2193C16.1294 26.7026 15.0001 25.8063 15.0001 24.4941V20.3557H16.7853Z"
                                    fill="var(--title-color)"
                                ></path>
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M21.8434 16.7853C20.0495 16.7853 18.3963 17.1303 17.1693 17.7145C15.9867 18.2777 15.0001 19.1719 15.0001 20.3557C15.0001 21.5395 15.9867 22.4337 17.1693 22.9969C18.3963 23.5811 20.0495 23.9261 21.8434 23.9261C23.6372 23.9261 25.2904 23.5811 26.5174 22.9969C27.7 22.4337 28.6867 21.5395 28.6867 20.3557C28.6867 19.1719 27.7 18.2777 26.5174 17.7145C25.2904 17.1303 23.6372 16.7853 21.8434 16.7853ZM19.7606 19.4631V21.2483H23.9261V19.4631H19.7606Z"
                                    fill="var(--title-color)"
                                ></path>
                                <path
                                    d="M28.6867 3.09863H1.31342V22.1409H13.2173C13.2163 21.548 13.2148 20.9548 13.2148 20.3557H3.09863V4.88384H26.9014V15.931C27.0319 15.9859 27.1598 16.0431 27.2849 16.1027C27.7234 16.3115 28.2191 16.5976 28.6867 16.9687V3.09863Z"
                                    fill="var(--title-color)"
                                ></path>
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M4.88385 8.45428C5.86979 8.45428 6.66906 7.65504 6.66906 6.66907H23.331C23.331 7.65504 24.1303 8.45428 25.1162 8.45428V15.361C24.0899 15.1228 22.9783 15.0001 21.8434 15.0001C19.8442 15.0001 17.9176 15.381 16.4018 16.1027C15.4662 16.5482 14.2703 17.3453 13.643 18.5705H6.66906C6.66906 17.5845 5.86979 16.7853 4.88385 16.7853V8.45428ZM15 15.5951C16.6433 15.5951 17.9754 14.263 17.9754 12.6198C17.9754 10.9765 16.6433 9.64442 15 9.64442C13.3568 9.64442 12.0247 10.9765 12.0247 12.6198C12.0247 14.263 13.3568 15.5951 15 15.5951ZM23.0335 11.7272H20.0581V13.5124H23.0335V11.7272ZM6.9666 13.5124V11.7272H9.94195V13.5124H6.9666Z"
                                    fill="var(--title-color)"
                                ></path>
                            </g>
                            <defs>
                                <filter
                                    id="filter0_d_2208_893"
                                    x="1.31342"
                                    y="3.09863"
                                    width="32.3733"
                                    height="32.9929"
                                    filterUnits="userSpaceOnUse"
                                    color-interpolation-filters="sRGB"
                                >
                                    <feFlood
                                        flood-opacity="0"
                                        result="BackgroundImageFix"
                                    ></feFlood>
                                    <feColorMatrix
                                        in="SourceAlpha"
                                        type="matrix"
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                        result="hardAlpha"
                                    ></feColorMatrix>
                                    <feOffset dy="3"></feOffset>
                                    <feComposite
                                        in2="hardAlpha"
                                        operator="out"
                                    ></feComposite>
                                    <feColorMatrix
                                        type="matrix"
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"
                                    ></feColorMatrix>
                                    <feBlend
                                        mode="normal"
                                        in2="BackgroundImageFix"
                                        result="effect1_dropShadow_2208_893"
                                    ></feBlend>
                                    <feBlend
                                        mode="normal"
                                        in="SourceGraphic"
                                        in2="effect1_dropShadow_2208_893"
                                        result="shape"
                                    ></feBlend>
                                </filter>
                            </defs>
                        </svg>
                    </div>
                    <span class="text-xs font-bold" style="margin-top: 0.2rem"
                        >Depositar</span
                    >
                </a>
            </div>

            <a v-if="custom.cassino" :href="custom.cassino" class="btn">
                <svg
                    width="25"
                    height="24"
                    viewBox="0 0 25 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g clip-path="url(#clip0_2269_1785)">
                        <path
                            opacity="0.6"
                            d="M2.25 2.5H23.25C23.5152 2.5 23.7696 2.60536 23.9571 2.79289C24.1446 2.98043 24.25 3.23478 24.25 3.5V5.5H1.25V3.5C1.25 3.23478 1.35536 2.98043 1.54289 2.79289C1.73043 2.60536 1.98478 2.5 2.25 2.5Z"
                            fill="#585B72"
                        ></path>
                        <path
                            opacity="0.6"
                            d="M1.25 18.5H24.25V20.5C24.25 20.7652 24.1446 21.0196 23.9571 21.2071C23.7696 21.3946 23.5152 21.5 23.25 21.5H2.25C1.98478 21.5 1.73043 21.3946 1.54289 21.2071C1.35536 21.0196 1.25 20.7652 1.25 20.5V18.5Z"
                            fill="#585B72"
                        ></path>
                        <path
                            d="M8.25 17.5V6.5H1.25V17.5H8.25ZM2.25 8.75C2.25 8.6837 2.27634 8.62011 2.32322 8.57322C2.37011 8.52634 2.4337 8.5 2.5 8.5H7C7.0663 8.5 7.12989 8.52634 7.17678 8.57322C7.22366 8.62011 7.25 8.6837 7.25 8.75V10.358C7.24979 10.4002 7.23902 10.4416 7.21867 10.4786C7.19832 10.5155 7.16904 10.5468 7.1335 10.5695C6.718 10.8395 5.3335 12.4485 5.2535 15.2525C5.2535 15.3184 5.22751 15.3816 5.18116 15.4284C5.13482 15.4752 5.07187 15.5018 5.006 15.5025H3.0105C2.97643 15.5029 2.94262 15.4964 2.91116 15.4833C2.87971 15.4702 2.85126 15.4508 2.82756 15.4264C2.80387 15.4019 2.78543 15.3728 2.77338 15.3409C2.76133 15.309 2.75593 15.275 2.7575 15.241C2.9235 12.3845 5.75 10 5.75 10H3.75C3.61739 10 3.49021 10.0527 3.39645 10.1464C3.30268 10.2402 3.25 10.3674 3.25 10.5V10.75C3.25 10.8163 3.22366 10.8799 3.17678 10.9268C3.12989 10.9737 3.0663 11 3 11H2.5C2.4337 11 2.37011 10.9737 2.32322 10.9268C2.27634 10.8799 2.25 10.8163 2.25 10.75V8.75Z"
                            fill="#8B8FB1"
                        ></path>
                        <path
                            d="M24.25 17.5V6.5H17.25V17.5H24.25ZM18.25 8.75C18.25 8.6837 18.2763 8.62011 18.3232 8.57322C18.3701 8.52634 18.4337 8.5 18.5 8.5H23C23.0663 8.5 23.1299 8.52634 23.1768 8.57322C23.2237 8.62011 23.25 8.6837 23.25 8.75V10.358C23.2498 10.4002 23.239 10.4416 23.2187 10.4786C23.1983 10.5155 23.169 10.5468 23.1335 10.5695C22.718 10.8395 21.331 12.4485 21.2535 15.2525C21.2535 15.3184 21.2275 15.3816 21.1812 15.4284C21.1348 15.4752 21.0719 15.5018 21.006 15.5025H19.0105C18.9764 15.5029 18.9426 15.4964 18.9112 15.4833C18.8797 15.4702 18.8513 15.4508 18.8276 15.4264C18.8039 15.4019 18.7854 15.3728 18.7734 15.3409C18.7613 15.309 18.7559 15.275 18.7575 15.241C18.9235 12.3845 21.75 10 21.75 10H19.75C19.6174 10 19.4902 10.0527 19.3964 10.1464C19.3027 10.2402 19.25 10.3674 19.25 10.5V10.75C19.25 10.8163 19.2237 10.8799 19.1768 10.9268C19.1299 10.9737 19.0663 11 19 11H18.5C18.4337 11 18.3701 10.9737 18.3232 10.9268C18.2763 10.8799 18.25 10.8163 18.25 10.75V8.75Z"
                            fill="#8B8FB1"
                        ></path>
                        <path
                            d="M16.25 17.5V6.5H9.25V17.5H16.25ZM10.25 8.75C10.25 8.6837 10.2763 8.62011 10.3232 8.57322C10.3701 8.52634 10.4337 8.5 10.5 8.5H15C15.0663 8.5 15.1299 8.52634 15.1768 8.57322C15.2237 8.62011 15.25 8.6837 15.25 8.75V10.358C15.2498 10.4002 15.239 10.4416 15.2187 10.4786C15.1983 10.5155 15.169 10.5468 15.1335 10.5695C14.718 10.8395 13.331 12.4485 13.2535 15.2525C13.2535 15.3188 13.2272 15.3824 13.1803 15.4293C13.1334 15.4762 13.0698 15.5025 13.0035 15.5025H11.0105C10.9764 15.5029 10.9426 15.4964 10.9112 15.4833C10.8797 15.4702 10.8513 15.4508 10.8276 15.4264C10.8039 15.4019 10.7854 15.3728 10.7734 15.3409C10.7613 15.309 10.7559 15.275 10.7575 15.241C10.9235 12.3845 13.75 10 13.75 10H11.75C11.6174 10 11.4902 10.0527 11.3964 10.1464C11.3027 10.2402 11.25 10.3674 11.25 10.5V10.75C11.25 10.8163 11.2237 10.8799 11.1768 10.9268C11.1299 10.9737 11.0663 11 11 11H10.5C10.4337 11 10.3701 10.9737 10.3232 10.9268C10.2763 10.8799 10.25 10.8163 10.25 10.75V8.75Z"
                            fill="#8B8FB1"
                        ></path>
                    </g>
                    <defs>
                        <clipPath id="clip0_2269_1785">
                            <rect
                                width="24"
                                height="24"
                                fill="white"
                                transform="translate(0.75)"
                            ></rect>
                        </clipPath>
                    </defs>
                </svg>
                <span style="font-size: 12px; font-weight: bold">Cassino</span>
            </a>
            <a
                v-if="custom.cassinoaovivo"
                :href="custom.cassinoaovivo"
                class="btn"
            >
                <span class="badge-live dot"></span
                ><svg
                    height="1em"
                    viewBox="0 0 640 512"
                    width="1em"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M591.1 192l-118.7 0c4.418 10.27 6.604 21.25 6.604 32.23c0 20.7-7.865 41.38-23.63 57.14l-136.2 136.2v46.37C320 490.5 341.5 512 368 512h223.1c26.5 0 47.1-21.5 47.1-47.1V240C639.1 213.5 618.5 192 591.1 192zM479.1 376c-13.25 0-23.1-10.75-23.1-23.1s10.75-23.1 23.1-23.1s23.1 10.75 23.1 23.1S493.2 376 479.1 376zM96 200c-13.25 0-23.1 10.75-23.1 23.1s10.75 23.1 23.1 23.1s23.1-10.75 23.1-23.1S109.3 200 96 200zM352 248c13.25 0 23.1-10.75 23.1-23.1s-10.75-23.1-23.1-23.1S328 210.8 328 224S338.8 248 352 248zM224 328c-13.25 0-23.1 10.75-23.1 23.1s10.75 23.1 23.1 23.1c13.25 0 23.1-10.75 23.1-23.1S237.3 328 224 328zM224 200c-13.25 0-23.1 10.75-23.1 23.1s10.75 23.1 23.1 23.1s23.1-10.75 23.1-23.1S237.3 200 224 200zM224 72c-13.25 0-23.1 10.75-23.1 23.1s10.75 23.1 23.1 23.1c13.25 0 23.1-10.75 23.1-23.1S237.3 72 224 72z"
                        fill="currentColor"
                    ></path>
                    <path
                        d="M447.1 224c0-12.56-4.782-25.13-14.35-34.76l-174.9-174.9C249.1 4.784 236.5 0 223.1 0C211.4 0 198.9 4.784 189.2 14.35L14.35 189.2C4.784 198.9-.0011 211.4-.0011 223.1c0 12.56 4.786 25.18 14.35 34.8l174.9 174.9c9.626 9.563 22.19 14.35 34.75 14.35c12.56 0 25.13-4.782 34.75-14.35l174.9-174.9C443.2 249.1 447.1 236.6 447.1 224zM96 248c-13.25 0-23.1-10.75-23.1-23.1s10.75-23.1 23.1-23.1s23.1 10.75 23.1 23.1S109.3 248 96 248zM224 376c-13.25 0-23.1-10.75-23.1-23.1s10.75-23.1 23.1-23.1c13.25 0 23.1 10.75 23.1 23.1S237.3 376 224 376zM224 248c-13.25 0-23.1-10.75-23.1-23.1s10.75-23.1 23.1-23.1s23.1 10.75 23.1 23.1S237.3 248 224 248zM224 120c-13.25 0-23.1-10.75-23.1-23.1s10.75-23.1 23.1-23.1c13.25 0 23.1 10.75 23.1 23.1S237.3 120 224 120zM352 248c-13.25 0-23.1-10.75-23.1-23.1s10.75-23.1 23.1-23.1s23.1 10.75 23.1 23.1S365.3 248 352 248z"
                        fill="currentColor"
                        opacity="0.4"
                    ></path>
                </svg>
                <span id="texto2" style="font-size: 12px; font-weight: bold"
                    >Ao vivo
                </span>
            </a>
        </div>
    </div>
</template>

<script>
import { sidebarStore } from "@/Stores/SideBarStore.js";
import { useSettingStore } from "@/Stores/SettingStore.js";
import { useAuthStore } from "@/Stores/Auth.js";

export default {
    props: [],
    components: {},
    data() {
        return {
            modalDeposit: null,
            isLoading: false,
            custom: null,
        };
    },
    setup(props) {
        return {};
    },
    computed: {
        isAuthenticated() {
            const authStore = useAuthStore();
            return authStore.isAuth;
        },
        sidebarMenuStore() {
            return sidebarStore();
        },
        sidebarMenu() {
            const sidebar = sidebarStore();
            return sidebar.getSidebarStatus;
        },
    },
    mounted() {
        // Define os textos para o segundo elemento
        const textos2 = ["Ao vivo", "Cassino"];
        let index2 = 0;

        const textoElemento2 = document.getElementById("texto2");

        // Função para alternar o texto do segundo elemento
        function alternarTexto2() {
            index2 = (index2 + 1) % textos2.length; // Alterna o índice entre 0 e 1
            textoElemento2.textContent = textos2[index2]; // Atualiza o conteúdo do elemento
        }

        // Defina o intervalo para alternar os textos a cada segundo (1000 ms)
        setInterval(alternarTexto2, 2000); // Alterna texto no segundo elemento
        window.addEventListener("open-login-modal", () => {
            this.showLoginModal = true;
            this.showRegisterModal = false;
        });
    },
    methods: {
        getSetting: function () {
            const _this = this;
            const settingStore = useSettingStore();
            const settingData = settingStore.setting;

            if (settingData) {
                _this.setting = settingData;
            }
        },
        toggleMenu: function () {
            this.sidebarMenuStore.setSidebarToogle();
        },
        toggleModalDeposit: function () {
            if (this.isAuthenticated) {
                if (!this.modalDeposit) {
                    const el = document.getElementById("modalElDeposit");
                    if (el) {
                        this.modalDeposit = new Modal(el, {
                            placement: "center",
                            backdrop: "dynamic",
                            backdropClasses:
                                "bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-1 backmodaldeposit",
                            closable: true,
                            onHide: () => {
                                this.paymentType = null;
                                const divsToDelete =
                                    document.querySelectorAll(
                                        ".backmodaldeposit"
                                    );
                                divsToDelete.forEach((div) => div.remove());
                            },
                        });
                    } else {
                        console.warn(
                            "❌ Não encontrou #modalElDeposit no DOM."
                        );
                        return;
                    }
                }

                this.modalDeposit.toggle();
            } else {
                const event = new CustomEvent("open-login-modal");
                window.dispatchEvent(event);
            }
        },
    },
    created() {
        this.getSetting();
        this.custom = custom;
    },
    watch: {},
};
</script>

<style scoped></style>
