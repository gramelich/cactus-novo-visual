<style>
.input-wrapper {
    position: relative;
    margin: 20px 0;
}

/* Estilo do input */
input {
    border-radius: 4px;
    padding: 10px;
    font-size: 16px;
    width: 100%;
    box-sizing: border-box;
}
.gap-xs {
    gap: 0.2rem;
}

.menu-item {
    display: flex;
    align-items: center;
    gap: 0.5rem; /* Espaço entre ícone e texto */
}

.menu-item span {
    display: flex;
    align-items: center;
}

.menu-item p {
    margin: 0;
    line-height: 1.2;
}

/* Estilo do label (placeholder) */
.label-formularios {
    position: absolute;
    top: 50%;
    left: 20px;
    font-size: 15px;
    color: #adafb0;
    pointer-events: none;
    transform: translateY(-50%);
}

/* Quando o input tem foco ou contém texto */
input:focus + label,
input:not(:placeholder-shown) + label {
    top: 20%;
    left: 20px;
    font-size: 10px;
    color: #adafb0;
}

html {
    font-family: Montserrat, -apple-system, Segoe UI, Roboto, Helvetica Neue,
        Arial, sans-serif;
}
body {
    font-family: Montserrat, -apple-system, Segoe UI, Roboto, Helvetica Neue,
        Arial, sans-serif;
}
.pad-modal-profile {
    padding: 0px 4%;
}
.hover-menu:hover {
    background-color: #0f2b39;
    border-radius: 10px;
}
.sair-menu:hover {
    background-color: #27171a;
    border-radius: 10px;
    color: #d3345d;
}
.sairp-menu:hover {
    color: #d3345d;
}
.notificacao-sino {
    font-size: 20px;
    color: gold;
}
.button-login-model {
    color: var(--ci-primary-color);
    border: 0.1rem solid var(--ci-primary-color);
    border-radius: 30px;
    color: white;
    font-weight: bold;
    font-size: 0.9rem;
    padding-top: 3px;
    padding-bottom: 3px;
}
.button-register-model {
    color: #acafa7;
    border: 0.1rem solid var(--ci-primary-color);
    border-radius: 30px;
    color: var(--sub-text-color);
    font-weight: bold;
    font-size: 0.9rem;
    padding-top: 3px;
    padding-bottom: 3px;
    z-index: 1;
    background-color: var(--ci-primary-color);
}
.a-gift {
    box-shadow: -1px 3px 11px 0px rgba(0, 0, 0, 0.082);
    -webkit-box-shadow: -1px 3px 11px 0px rgba(0, 0, 0, 0.082);
    -moz-box-shadow: -1px 3px 11px 0px rgba(0, 0, 0, 0.082);
    padding: 5px;
    max-height: 26px;
    border-radius: 3px;
    background-color: var(--ci-primary-color);
}
.tirar-div {
    display: none;
}
.padding-register {
    padding: 0px 8%;
}
.nav-indexx {
    z-index: 998;
}
.login-register-100vh {
    background-color: var(--carousel-banners-dark);
    border-radius: 20px;
    max-width: 450px;
    margin: 0 auto;
    border-radius: 8px;
}
.login-register-100vh2 {
    background-color: var(--carousel-banners-dark);
    border-radius: 20px;
    max-width: 450px;
    margin: 0 auto;
    border-radius: 8px;
}
.x-mark-scale {
    opacity: 0.9;
    transition: 0.3s;
}
.x-mark-scale:hover {
    opacity: 0.8;
}
.msg-alerta {
    background-color: #0474cc;
    height: 30px;
    width: 100%;
    position: fixed;
    top: 0;
    display: flex;
    justify-content: center;
}
.msg-alerta-text {
    color: white;
    font-weight: 400;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
}
.texto-esportes {
    opacity: 0.5;
    transition: 0.3s;
}

.texto-esportes:hover {
    opacity: 1;
}
@media (max-width: 1025px) {
    #open-side-nav {
        display: none;
    }
    .tirar-esporte {
        display: none;
    }
}
@media (max-width: 768px) {
    .button-login-model {
        font-size: 0.75rem;
    }
    .button-register-model {
        font-size: 0.75rem;
    }
    .a-gift {
        box-shadow: -1px 3px 11px 0px rgba(0, 0, 0, 0.082);
        -webkit-box-shadow: -1px 3px 11px 0px rgba(0, 0, 0, 0.082);
        -moz-box-shadow: -1px 3px 11px 0px rgba(0, 0, 0, 0.082);
        padding: 5px;
        max-height: 26px;
        border-radius: 3px;
        background-color: var(--ci-primary-color);
    }
    .texto-indique {
        font-size: 14px;
        padding-top: 5px;
    }
    .texto-indique-pad {
        padding: 0 2%;
        text-align: center;
    }
    .pad-modal-profile {
        padding: 0px 0px;
    }
    .por-height-alto {
        height: 100vh;
        border-radius: 0px;
    }
    .notificacao-sino {
        font-size: 1rem;
        font-weight: 700;
        line-height: 1.25rem;
        padding: 0px 1px;
    }
    .search-menu {
        top: 0;
        min-height: 100vh;
    }
    .imagem-logo {
        max-width: 140px;
    }
    .botao-entrar-mobile {
        padding: 3px 10px;
    }
    .nav-indexx {
        z-index: 1;
    }
    .botao-mobile-register-login {
        padding: 2px 5px;
        height: auto;
    }
    .login-register-100vh {
        height: 100vh;
        border-radius: 0px;
        max-width: 1000px;
        width: 100%;
    }
    .login-register-100vh2 {
        height: 100vh;
        border-radius: 0px;
        max-width: 1000px;
        width: 100%;
    }
    .padding-register {
        padding: 0px 4%;
    }
}
@media (max-width: 600px) {
    .margin-teste {
        margin-left: 8px;
    }
    .tirar-div {
        display: block;
    }

    .pulse2 {
        width: 2px;
        height: 2px;
        margin-left: 15px;
        bottom: 0;
    }

    @media (max-width: 500px) {
        .texto-indique {
            font-size: 12px;
            padding-top: 5px;
        }
    }
}
@media (max-width: 425px) {
    .mobile {
        margin-top: 50px;
    }
}
@media (max-width: 390px) {
    .mobile {
        margin-top: 50px;
    }
    .a-gift {
        box-shadow: -1px 3px 11px 0px rgba(0, 0, 0, 0.082);
        -webkit-box-shadow: -1px 3px 11px 0px rgba(0, 0, 0, 0.082);
        -moz-box-shadow: -1px 3px 11px 0px rgba(0, 0, 0, 0.082);
        padding: 5px;
        max-height: 26px;
        right: 19px;
        border-radius: 3px;
        margin-right: -22px;
        background-color: var(--ci-primary-color);
    }
}
@media (max-width: 376px) {
    .login-register-100vh {
        height: calc(auto);
        border-radius: 0px;
        max-width: 1000px;
        width: 100%;
    }
    .login-register-100vh2 {
        height: 100vh;
        border-radius: 0px;
        max-width: 1000px;
        width: 100%;
    }
    .a-gift {
        box-shadow: -1px 3px 11px 0px rgba(0, 0, 0, 0.082);
        -webkit-box-shadow: -1px 3px 11px 0px rgba(0, 0, 0, 0.082);
        -moz-box-shadow: -1px 3px 11px 0px rgba(0, 0, 0, 0.082);
        padding: 5px;
        max-height: 26px;
        border-radius: 3px;
        margin-right: 6px;
        background-color: var(--ci-primary-color);
    }
}
</style>
<template>
    <nav
        v-if="showNavtop"
        :class="[
            'fixed w-full z-30 navtop-color nav-indexx transition-all duration-300',
            showTopBanner ? '' : '',
        ]"
        style="background-color: var(--navtop-color-dark); top: 0"
    >
     <!---   <div
            v-if="showTopBanner"
            class="fixed top-0 left-0 w-full"
            style="
                background-color: var(--ci-primary-color);
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            "
        >
            <span>📲</span>
            <p
                class="texto-indique"
                style="color: var(--title-color); font-size: 12px; margin: 0"
            >
                Faça download do nosso aplicativo!
            </p>
            <a
                href="#"
                style="
                    padding: 3px 10px;
                    border-radius: 5px;
                    margin-left: 10px;
                    background-color: var(--input-primary);
                    color: var(--text-color);
                    text-decoration: none;
                    font-size: 12px;
                "
            >
                Download
            </a>
            <button
                @click="closeTopBanner"
                style="
                    position: absolute;
                    right: 10px;
                    top: 3px;
                    background: transparent;
                    border: none;
                    color: white;
                    font-size: 18px;
                    cursor: pointer;
                "
            >
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>   --->
        <ModalRegister
            v-if="showRegisterModal && !isAuthenticated"
            :show-register-modal="showRegisterModal"
            :setting="setting"
            @close="handleCloseRegister"
            @show-login="openLogin"
        />

        <ModalLogin
            :showLogin="showLoginModal"
            :setting="setting"
            @close="showLoginModal = false"
            @show-register="openRegisterModal"
        />

            <div
                class="absolute top-0 left-5 block lg:block flex items-center pt-5"
            >
                <div class="flex items-center pr-4">
                    <!-- Botão CASSINO -->
                    <div
                        @click="voltarParaCassino"
                        :class="[
                            'flex items-center gap-xs px-4 py-1 cursor-pointer tirar-esporte transition-all',
                            abaAtiva === 'cassino'
                                ? 'border-b-4 border-primary text-white'
                                : 'text-gray-400 hover:text-white hover:border-b-4 hover:border-gray-500',
                        ]"
                    >
                        <svg
                            height="1em"
                            viewBox="0 0 640 512"
                            width="1em"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M220.7 7.468C247.3-7.906 281.4 1.218 296.8 27.85L463.8 317.1C479.1 343.8 470 377.8 443.4 393.2L250.5 504.5C223.9 519.9 189.9 510.8 174.5 484.2L7.468 194.9C-7.906 168.2 1.218 134.2 27.85 118.8L220.7 7.468zM143.8 277.3C136.9 303.2 152.3 329.1 178.3 336.9C204.3 343.9 230.1 328.5 237.9 302.5L240.3 293.6C240.4 293.3 240.5 292.9 240.6 292.5L258.4 323.2L246.3 330.2C239.6 334 237.4 342.5 241.2 349.2C245.1 355.9 253.6 358.1 260.2 354.3L308.4 326.5C315.1 322.6 317.4 314.1 313.5 307.4C309.7 300.8 301.2 298.5 294.5 302.3L282.5 309.3L264.7 278.6C265.1 278.7 265.5 278.8 265.9 278.9L274.7 281.2C300.7 288.2 327.4 272.8 334.4 246.8C341.3 220.8 325.9 194.1 299.9 187.1L196.1 159.6C185.8 156.6 174.4 163.2 171.4 174.3L143.8 277.3z"
                                fill="currentColor"
                            ></path>
                            <path
                                d="M324.1 499L459.4 420.9C501.3 396.7 515.7 343.1 491.5 301.1L354.7 64.25C356.5 64.08 358.2 64 360 64H584C614.9 64 640 89.07 640 120V456C640 486.9 614.9 512 584 512H360C346.4 512 333.8 507.1 324.1 499V499zM579.8 135.7C565.8 123.9 545.3 126.2 532.9 138.9L528.1 144.2L523.1 138.9C510.6 126.2 489.9 123.9 476.4 135.7C460.7 149.2 459.9 173.1 473.9 187.6L522.4 237.6C525.4 240.8 530.6 240.8 533.9 237.6L582 187.6C596 173.1 595.3 149.2 579.8 135.7H579.8z"
                                fill="currentColor"
                                opacity="0.4"
                            ></path>
                        </svg>
                        <span class="text-sm font-bold">CASSINO</span>
                    </div>
                    <!-- Botão ESPORTES -->
                    <div
                        v-if="custom.esportes"
                        @click="irParaEsportes(custom.esportes)"
                        :class="[
                            'flex items-center gap-xs px-4 py-1 cursor-pointer tirar-esporte transition-all',
                            abaAtiva === 'esportes'
                                ? 'border-b-4 border-primary text-white'
                                : 'text-gray-400 hover:text-white hover:border-b-4 hover:border-gray-500',
                        ]"
                    >
                        <svg
                            height="1em"
                            viewBox="0 0 512 512"
                            width="1em"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M355.5 45.53L342.4 14.98c-27.95-9.983-57.18-14.98-86.42-14.98c-29.25 0-58.51 4.992-86.46 14.97L156.5 45.53l99.5 55.13L355.5 45.53zM86.78 96.15L53.67 99.09c-34.79 44.75-53.67 99.8-53.67 156.5L.0001 256c0 2.694 .0519 5.379 .1352 8.063l24.95 21.76l83.2-77.67L86.78 96.15zM318.8 336L357.3 217.4L255.1 144L154.7 217.4l38.82 118.6L318.8 336zM512 255.6c0-56.7-18.9-111.8-53.72-156.5L425.6 96.16L403.7 208.2l83.21 77.67l24.92-21.79C511.1 260.1 512 258.1 512 255.6zM51.77 367.7l-7.39 32.46c33.48 49.11 82.96 85.07 140 101.7l28.6-16.99l-48.19-103.3L51.77 367.7zM347.2 381.5l-48.19 103.3l28.57 17c57.05-16.66 106.5-52.62 140-101.7l-7.38-32.46L347.2 381.5z"
                                fill="currentColor"
                            ></path>
                            <path
                                d="M458.3 99.08L458.3 99.08L458.3 99.08zM511.8 264c-1.442 48.66-16.82 95.87-44.28 136.1l-7.38-32.46l-113 13.86l-48.19 103.3l28.22 16.84c-23.48 6.78-47.67 10.2-71.85 10.2c-23.76 0-47.51-3.302-70.58-9.962l28.23-17.06l-48.19-103.3l-113-13.88l-7.39 32.46c-27.45-40.19-42.8-87.41-44.25-136.1l24.95 21.76l83.2-77.67L86.78 96.15L53.67 99.09c29.72-38.29 69.67-67.37 115.2-83.88l.3613 .2684L156.5 45.53l99.5 55.13l99.5-55.13L342.4 14.98c45.82 16.48 86 45.64 115.9 84.11L425.6 96.16L403.7 208.2l83.21 77.67L511.8 264zM357.3 217.4L255.1 144L154.7 217.4l38.82 118.6L318.8 336L357.3 217.4z"
                                fill="currentColor"
                                opacity="0.4"
                            ></path>
                        </svg>
                        <span class="text-sm font-bold">ESPORTES</span>
                    </div>
                </div>
            </div>
        <div :class="[sidebar === true ? 'lg:ml-[65px]' : 'lg:ml-[280px]']">
            <div class="mx-auto w-full" style="max-width: 1110px">
                <div
                    class="flex items-center justify-between"
                    style="align-items: center"
                >
                    <div
                        class="flex items-center justify-start"
                        style="align-items: center"
                    >
                        <button
                            id="open-side-nav"
                            @click.prevent="toggleMenu"
                            type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-sm"
                            style="margin: 0 auto"
                        >
                            <span class="sr-only">Open sidebar</span>
                            <svg
                                height="22px"
                                viewBox="0 0 448 512"
                                width="22px"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"
                                    fill="#fff"
                                ></path>
                            </svg>
                        </button>
                        <a
                            v-if="setting"
                            href="/"
                            class="flex items-center md:ml-3 ml-2 md:mr-26"
                        >
                            <img
                                :src="`/storage/` + setting.software_logo_black"
                                alt="Logo"
                                class="hidden dark:hidden imagem-logo opacidade-hover"
                                style="
                                    max-width: 140px;
                                    max-height: 60px;
                                    object-fit: contain;
                                "
                            />
                            <img
                                :src="`/storage/` + setting.software_logo_white"
                                alt="Logo"
                                class="block dark:block md:max-h-[60px] max-h-[50px] imagem-logo opacidade-hover"
                                style="max-width: 140px; object-fit: contain"
                            />
                            <a href="/promotion" class="ml-2">
                                <i
                                    class="fa fa-gift fa-shake a-gift opacidade-hover"
                                    style="color: var(--title-color)"
                                ></i>
                            </a>
                        </a>
                    </div>
                    <div
                        v-if="!simple"
                        class="flex items-center md:py-2"
                        style="max-height: 54px"
                    >
                        <div
                            v-if="!isAuthenticated"
                            class="flex items-center md:py-1 py-2 ml-5"
                            style="max-height: 54px"
                        >
                            <div
                                class="relative flex items-center"
                                style="margin-top: -10px"
                            >
                                <div
                                    data-v-4265f672=""
                                    class="aaDu6 flex items-center"
                                    style="
                                        border-radius: 30px;
                                        position: absolute;
                                        top: 20%;
                                        right: 0;
                                        background-color: #ffe800;
                                        margin-top: -7px;
                                        z-index: 2;
                                        padding-left: 3px;
                                        padding-right: 16px;
                                    "
                                >
                                    <img
                                        data-v-4265f672=""
                                        style="width: 15px"
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACcAAAAnCAYAAACMo1E1AAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAatSURBVHja7Zh7UFRVHMf5pyRLNERx8ZGBq4hoPkZUTIUERQJkEyFzJs3XpJCPSTNHbTCb0WawzHEGUUhAHmKgItgCymN5yIKPFYQUDNBCJRGEhX2wmL/6nulcucjD3RrzD8/MZ+7evXvP/Zzf4yyL2cvxf4ymlJljDOokmUFTOf2R5qL0TnH+Ky+MnC7VMkVX6EMGtZLatVcft2vL7mpbkgc8dxFDY+Gyds2FMBx5hLQ5VtmaRAvSNZwgQ7OcgQg+V7EbGT42TVW7qK057zEi9Ej/qwoRalU5JraeH0j6e19SW0MEA2nubh4s6l+nXhMmt9UrSqLaim+Etl8t3wPqLjhTQ2mgurVoZ7Lu0q6zrcVbG9rqj9VqVFLS3wpC9BiIbOf5sBBEnS/OUFu5yWS5+wFbldqYdDJcui7QmLWeGjKChXN9bAy1pC3V6ar9CbQ1nSL28NsqBV8QJCDbpk6t4mnX1O43aEs2UkvhmkMm1edv81c8Um/aR/rMi09kioqZYHtNCc7ZNe3OHdSc5U668kX/pFTJrreXVgO8hhDEmRQTKgkxoImajlsTut0osVKPDW9ed/2QIKitOMyiAXRVCsLErQXrSP97HIOdR/tCDnXHRJA2XEN0IAvwvr4uTQ0wJ+Z4mOBQaXTUrrkFuUDul1UL6UHFctQRE0FDIEp1e6yperMF/RFqCxABRn1EP0JzqBX2OMdr3I/7WNTUd8IIQAzlgCYzWg6RK30voKVkuyfdynOiihQHJnPvM6lA3RfWAKJMsCFhKjWneCKCEMP7LHJlSVIRmItnAw1iUs1dniaLvrlvLpuszE9Car/tpAk+hKNA88pvCHWJ97UhCew1UozmQAcjyuWxDoyyv+XB3WBXerh6MTVu82av7//0bqxJcuWRc9jEqkmOdNctkFrDk5kEIzSRnaOjdSdzSCcvJH1qPkQRQRbNG2v6IOJCVJti1uFedo8+XcloPhmhMHrfK5n1gQpyl0NHkWrkDKpylCEymJihT8iCFITwEHQuBCGNyEAIYhBkKdZcPY3P4j4c2efbcq6wo16uPGaUIBriWvIMyt9lR4X2rnTZcR7VzlqBlQtSAEJ4AMA55LCIRn8vwqZ9+7gVYE2BbsdCuBiHLexUQSU2/l7Foj2d7Uq9ZcTkPn0iV2nvSfW+G6hp71GklKeVg3NcQy3ic2gcdCuAHDoVEYSMCAhjkVyw163kir8nk0vyk1C2vQvkAFIMIIpUdwmugZtz7HiHCqDJkAGAOu7Mvfc/P9GjXMaMwCDsceiuSGcLSrGZQLmOHiyCmTZOlCOZS3k2Hr2i9BhNRTHTnxDnQlj0heFe3YJG7FHuksuSbapALzZh+ERLkg+yF+QyhrlT9lAZQzHMjx9F8PdRElyKkzNBRrm2H3fLFae1Hj3KFc32z8QGjIl/HPk65JBaADmRUM7wgC7JlnhS/v7xglRhnBspv5/PBBR2Kxm50jUiCsauquEOvcph8oj+lkglE0sb5UZZ1r5cqkfw+dzImZBiKOMXUG6gj0gmzz5QhHLy+gPPJIdVcjk8iMtlShZBsEfSB88j+azRiJggBnLdPkLERHIKh01UMGnL/aI53+7A12avcqg5yGGP43KoOcjhwR1FkGIOxNOtfSihrwOdCXpLFLXCCG+ktMu0Fk3ZHGnUF78ydt5jPCBm4AiIAdQbHg6J7oA87kHURXIFWxd1KYbosSYwZkAuYbkNtpFnljs3REaplu503MGa8o+5cjmeUpFYtnQtxFhKjf4xgwkjF1ohlWh/ADkIdAvEk/o5Y+OGHBfkKe0sBnhKjRu5UbL6+LnWIrmzgzwhwEWeAtdRb/LdjuhULoeUQgxADAjNgG8jo+WyDvt+jQ04Y3wAR5BLs/J6ClxDSlFvmUemQE4QREozRiyjc7arBTmI5Tt9VW1mykjeO/2d+KV2D9OmBRI4O2IJBDhcRgRSimhDjgui6yHWUe78mPVMrsh9334zU8cPqyQS+ezNCsidlHiLRE73d+0M30IgxsHGi4VxOSDIFcwPnWqyHP8jgMt1EEGURCS84cRSmhLyNqUdHAeY3M/OC+jMkMVckMuZntLOe97pyUGN8VZuIhEQ13eyQNRr4wk1CjkOGgMLwcK4IJfLnBr8idl/MeKHysIhByEu0pEj5lLAtp7E3UMFULNHLZwzcT9AFiBlZDp7/8v46IDZFRF9Jz4IMx9Xc9B87MUDr0qjvzOXhu81t90Z0sd2+e6Jw1QRGy3/5ERtGVyDpjJ7EQYWANBE+LHy8t+qL0cP4y+8YDcmAoXhVwAAAABJRU5ErkJggg=="
                                    /><span
                                        data-v-4265f672=""
                                        style="
                                            color: black;
                                            font-size: 8px;
                                            font-weight: bold;
                                        "
                                        >100%</span
                                    >
                                </div>
                                <!-- Botão Registre-se -->
                                <div
                                    class="flex gap-2 items-center ml-[-210px] md:ml-0"
                                >
                                    <!-- Registre-se -->
                                    <button
                                        @click.prevent="openRegister"
                                        type="button"
                                        class="flex items-center justify-center px-1 py-1 text-sm rounded-lg border border-[var(--ci-primary-color)] text-[var(--ci-primary-color)] bg-transparent hover:bg-[var(--ci-primary-color)] hover:text-white transition-all duration-200 min-w-[100px]"
                                        style="border-radius: 8px"
                                    >
                                        <strong class="whitespace-nowrap"
                                            >Registre-se</strong
                                        >
                                    </button>

                                    <!-- Entrar -->
                                    <button
                                        @click.prevent="openLogin"
                                        type="button"
                                        class="flex items-center justify-center px-1 py-1 text-sm rounded-lg border border-[var(--ci-primary-color)] bg-[var(--ci-primary-color)] text-white hover:bg-transparent hover:text-[var(--ci-primary-color)] transition-all duration-200 min-w-[100px] ml-[-6px] md:ml-0"
                                        style="border-radius: 8px"
                                    >
                                        <svg
                                            class="w-4 h-4 mr-2"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512"
                                            fill="currentColor"
                                        >
                                            <path
                                                d="M344.7 273.5l-144.1 136c-6.975 6.578-17.2 8.375-26 4.594C165.8 410.3 160.1 401.6 160.1 392V320H32.02C14.33 320 0 305.7 0 288V224c0-17.67 14.33-32 32.02-32h128.1V120c0-9.578 5.707-18.25 14.51-22.05c8.803-3.781 19.03-1.984 26 4.594l144.1 136C354.3 247.6 354.3 264.4 344.7 273.5z"
                                            ></path>
                                            <path
                                                d="M416 32h-64c-17.67 0-32 14.33-32 32s14.33 32 32 32h64c17.67 0 32 14.33 32 32v256c0 17.67-14.33 32-32 32h-64c-17.67 0-32 14.33-32 32s14.33 32 32 32h64c53.02 0 96-42.98 96-96V128C512 74.98 469 32 416 32z"
                                                opacity="0.4"
                                            ></path>
                                        </svg>
                                        <strong class="whitespace-nowrap"
                                            >Entrar</strong
                                        >
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div v-if="isAuthenticated" class="flex items-center">
                            <MakeDeposit
                                ref="depositRef"
                                :showMobile="false"
                                :title="$t('Depositar')"
                            />
                            <WalletBalance />
                            <div
                                class="flex items-center ml-3 margin-teste"
                                style="margin-top: -10px"
                            >
                                <div>
                                    <button
                                        type="button"
                                        class="flex items-center justify-center bg-red rounded-full border-2 border-[var(--primary-color)] p-1"
                                        aria-expanded="false"
                                        data-dropdown-toggle="dropdown-user2"
                                    >
                                        <span class="sr-only"
                                            >Open user menu</span
                                        >
                                        <img
                                            class="rounded-full"
                                            style="
                                                width: 25px;
                                                height: 25px;
                                                object-fit: cover;
                                            "
                                            :src="`/storage/guardbronze.png`"
                                            alt="User avatar"
                                        />
                                    </button>
                                </div>
                                <div
                                    class="z-50 hidden text-left list-none bg-[white] rounded shadow p-2"
                                    id="dropdown-user2"
                                    style="background-color: white"
                                >
                                    <div
                                        class=""
                                        style="
                                            background-color: #323637;
                                            border-radius: 8px;
                                        "
                                    >
                                        <div class="p-2">
                                            <div class="flex items-center">
                                                <div>
                                                    <div
                                                        class="flex items-center gap-1"
                                                        style="
                                                            margin-top: -8px;
                                                            margin-right: 10px;
                                                        "
                                                    >
                                                        <input
                                                            style="
                                                                font-weight: bold;
                                                                font-size: 12px;
                                                                width: auto;
                                                                text-align: right;
                                                                padding: 2px 6px;
                                                            "
                                                            @change.prevent="
                                                                updateName
                                                            "
                                                            v-model="
                                                                profileName
                                                            "
                                                            type="text"
                                                            :readonly="
                                                                !readonly
                                                            "
                                                            class="bg-transparent border-none"
                                                            :placeholder="
                                                                profileName
                                                            "
                                                        />
                                                        <button
                                                            @click="
                                                                showModal = true
                                                            "
                                                            style="
                                                                display: flex;
                                                                align-items: center;
                                                                padding: 0;
                                                                margin: 0;
                                                            "
                                                        >
                                                            <svg
                                                                style="
                                                                    width: 10px;
                                                                    height: 10px;
                                                                    margin-left: 4px;
                                                                    color: var(
                                                                        --ci-primary-color
                                                                    );
                                                                "
                                                                viewBox="0 0 512 512"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                role="none"
                                                            >
                                                                <path
                                                                    d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"
                                                                    fill="currentColor"
                                                                ></path>
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <div
                                                        class="flex items-center"
                                                        style="
                                                            margin-top: -20px;
                                                        "
                                                    >
                                                        <div>
                                                            <input
                                                                ref="fileInput"
                                                                type="file"
                                                                style="
                                                                    display: none;
                                                                "
                                                                @change="
                                                                    handleFileChange
                                                                "
                                                            />
                                                            <button
                                                                style="
                                                                    margin-right: -30px;
                                                                    margin-bottom: -10px;
                                                                "
                                                                @click="
                                                                    openFileInput
                                                                "
                                                                type="button"
                                                                class=""
                                                            >
                                                                <img
                                                                    style="
                                                                        width: 63px;
                                                                        max-width: 63px;
                                                                        border-radius: 50%;
                                                                        height: 60px;
                                                                        max-height: 60px;
                                                                        border: 2px
                                                                            solid
                                                                            var(
                                                                                --ci-primary-color
                                                                            );
                                                                    "
                                                                    class="rounded-full opacidade-hover"
                                                                    :src="`/storage/padrao.webp`"
                                                                    alt=""
                                                                />
                                                            </button>
                                                        </div>
                                                        <div
                                                            style="
                                                                background-color: #232626;
                                                                border-radius: 5px;
                                                                padding: 4%;
                                                                position: absolute;
                                                                right: 8%;
                                                                top: 30px;
                                                                z-index: 1;
                                                                display: flex;
                                                                flex-direction: column;
                                                            "
                                                        >
                                                            <p
                                                                style="
                                                                    position: absolute;
                                                                    top: 0;
                                                                    left: 25%;
                                                                    font-size: 10px;
                                                                    opacity: 0.5;
                                                                    padding-bottom: 3px;
                                                                "
                                                            >
                                                                Próximo nível:
                                                            </p>
                                                            <div
                                                                class="flex items-center"
                                                            >
                                                                <img
                                                                    style="
                                                                        width: 20px;
                                                                        height: 20px;
                                                                    "
                                                                    :src="`/storage/guardbronze.png`"
                                                                    alt=""
                                                                    class="h-16"
                                                                />
                                                                <p
                                                                    class="flex items-center"
                                                                >
                                                                    <strong
                                                                        style="
                                                                            padding-right: 3px;
                                                                        "
                                                                        >Bronze</strong
                                                                    >
                                                                </p>
                                                                <p
                                                                    style="
                                                                        opacity: 0.5;
                                                                        font-size: 10px;
                                                                        margin-bottom: -5px;
                                                                    "
                                                                >
                                                                    Nível
                                                                    {{
                                                                        nextLevel?.bet_level
                                                                    }}
                                                                </p>
                                                            </div>
                                                            <RouterLink
                                                                :to="{
                                                                    name: 'vipPage',
                                                                }"
                                                            >
                                                                <div
                                                                    class="flex items-center gap-1 justify-center opacidade-hover px-2 py-1"
                                                                    style="
                                                                        background-color: #393c3c;
                                                                        border-radius: 3px;
                                                                    "
                                                                >
                                                                    <svg
                                                                        style="
                                                                            color: var(
                                                                                --ci-primary-color
                                                                            );
                                                                            width: 12px;
                                                                            height: 12px;
                                                                        "
                                                                        fill="currentColor"
                                                                        viewBox="0 0 140.599 140.599"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        role="none"
                                                                    >
                                                                        <path
                                                                            d="M132.861,56.559c-4.27,0-7.742,3.473-7.742,7.741c0,1.893,0.685,3.626,1.815,4.973l-15.464,15.463
                                c-2.754,2.754-4.557,1.857-4.027-2l0.062-0.445c0.528-3.857-1.39-4.876-4.286-2.273l-0.531,0.479
                                c-2.898,2.603-5.828,1.609-6.544-2.219l-5.604-29.964c-0.717-3.828-2.129-3.886-3.156-0.129l-7.023,25.689
                                c-1.025,3.757-2.295,3.677-2.834-0.181L71.93,33.674c3.488-0.751,6.111-3.856,6.111-7.566c0-4.268-3.473-7.741-7.741-7.741
                                c-4.269,0-7.742,3.473-7.742,7.741c0,3.709,2.625,6.815,6.112,7.566l-5.592,40.019c-0.539,3.857-1.809,3.938-2.835,0.181
                                l-7.023-25.69c-1.027-3.757-2.44-3.699-3.156,0.129l-5.605,29.964c-0.716,3.828-3.645,4.82-6.543,2.219l-0.533-0.479
                                c-2.897-2.604-4.816-1.586-4.287,2.272l0.061,0.445c0.529,3.858-1.274,4.753-4.028,2L13.667,69.273
                                c1.132-1.347,1.816-3.08,1.816-4.973c0-4.269-3.473-7.741-7.741-7.741C3.473,56.559,0,60.032,0,64.3
                                c0,4.269,3.473,7.742,7.742,7.742c0.478,0,0.942-0.05,1.396-0.132l10.037,33.949c1.104,3.734,3.534,9.637,7.161,11.055
                                c8.059,3.153,24.72,5.318,43.964,5.318c19.245,0,35.905-2.165,43.965-5.318c3.626-1.418,6.058-7.32,7.161-11.055l10.037-33.949
                                c0.453,0.083,0.918,0.132,1.396,0.132c4.268,0,7.739-3.473,7.739-7.742C140.6,60.032,137.127,56.559,132.861,56.559z"
                                                                        />
                                                                    </svg>
                                                                    <span
                                                                        class="text-xs text-white"
                                                                        >Ver
                                                                        mais</span
                                                                    >
                                                                </div>
                                                            </RouterLink>
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="
                                                            background-color: #393c3c;
                                                            text-align: center;
                                                        "
                                                        v-if="
                                                            profileUser != null
                                                        "
                                                    >
                                                        <p
                                                            style="
                                                                font-size: 10px;
                                                                font-weight: bold;
                                                                color: #777979;
                                                                text-align: center;
                                                            "
                                                        >
                                                            Membro desde:
                                                            {{
                                                                profileUser.dateHumanReadable
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div></div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul
                                        class="py-1 px-5 mt-3 space-y-1"
                                        role="none"
                                    >
                                        <li class="opacidade-hover">
                                            <a
                                                href="/promotion"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="menu-item flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300"
                                                style="
                                                    color: var(--title-color);
                                                "
                                                role="menuitem"
                                            >
                                                <span
                                                    class="w-5 flex justify-center"
                                                >
                                                    <i class="fa fa-bell"></i>
                                                </span>
                                                <p
                                                    class="ml-2 font-bold whitespace-nowrap"
                                                >
                                                    Promoções
                                                </p>
                                            </a>
                                        </li>

                                        <li class="opacidade-hover">
                                            <RouterLink
                                                :to="{ name: 'profileWallet' }"
                                                active-class="profile-menu-active"
                                                class="menu-item flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300"
                                                style="
                                                    color: var(--title-color);
                                                "
                                                role="menuitem"
                                            >
                                                <span
                                                    class="w-5 flex justify-center"
                                                >
                                                    <i class="fa fa-wallet"></i>
                                                </span>
                                                <p
                                                    class="ml-2 font-bold whitespace-nowrap"
                                                >
                                                    Carteira
                                                </p>
                                            </RouterLink>
                                        </li>

                                        <li class="opacidade-hover">
                                            <a
                                                :href="`/games/play/1458/sport`"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="menu-item flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300"
                                                style="
                                                    color: var(--title-color);
                                                "
                                                role="menuitem"
                                            >
                                                <span
                                                    class="w-5 flex justify-center"
                                                >
                                                    <i class="fa fa-bell"></i>
                                                </span>
                                                <p
                                                    class="ml-2 font-bold whitespace-nowrap"
                                                >
                                                    Apostas
                                                </p>
                                            </a>
                                        </li>

                                        <li class="opacidade-hover">
                                            <a
                                                href="/profile/affiliate"
                                                class="menu-item flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300"
                                                style="
                                                    color: var(--title-color);
                                                "
                                                role="menuitem"
                                            >
                                                <span
                                                    class="w-5 flex justify-center"
                                                >
                                                    <i class="fa fa-users"></i>
                                                </span>
                                                <p
                                                    class="ml-2 font-bold whitespace-nowrap"
                                                >
                                                    Indicações
                                                </p>
                                            </a>
                                        </li>
                                        <li class="opacidade-hover">
                                            <RouterLink
                                                :to="{
                                                    name: 'profileAffiliate',
                                                }"
                                                active-class="profile-menu-active"
                                                class="menu-item flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300"
                                                style="
                                                    color: var(--title-color);
                                                "
                                                role="menuitem"
                                            >
                                                <span
                                                    class="w-5 flex justify-center"
                                                >
                                                    <i class="fa fa-users"></i>
                                                </span>
                                                <p
                                                    class="ml-2 font-bold whitespace-nowrap"
                                                >
                                                    Seja um Afiliado
                                                </p>
                                            </RouterLink>
                                        </li>
                                        <li class="opacidade-hover">
                                            <a
                                                href="/profile/ProfilePage"
                                                class="menu-item flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300"
                                                style="
                                                    color: var(--title-color);
                                                "
                                                role="menuitem"
                                            >
                                                <span
                                                    class="w-5 flex justify-center"
                                                >
                                                    <i class="fa fa-user"></i>
                                                </span>
                                                <p
                                                    class="ml-2 font-bold whitespace-nowrap"
                                                >
                                                    Meu Perfil
                                                </p>
                                            </a>
                                        </li>
                                        <li
                                            v-if="custom.Suporte"
                                            class="opacidade-hover"
                                        >
                                            <a
                                                :href="custom.Suporte"
                                                class="menu-item flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300"
                                                style="
                                                    color: var(--title-color);
                                                "
                                                role="menuitem"
                                            >
                                                <span
                                                    class="w-5 flex justify-center"
                                                >
                                                    <i
                                                        class="fa fa-headset"
                                                    ></i>
                                                </span>
                                                <p
                                                    class="ml-2 font-bold whitespace-nowrap"
                                                >
                                                    Suporte Ao Vivo
                                                </p>
                                            </a>
                                        </li>
                                        <div
                                            style="
                                                height: 1px;
                                                background-color: #27292a;
                                                width: 100%;
                                                margin-top: 10px;
                                                margin-bottom: 10px;
                                            "
                                        ></div>

                                        <li class="opacidade-hover mb-3">
                                            <a
                                                href="#"
                                                @click.prevent="logoutAccount"
                                                class="menu-item flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300"
                                                style="
                                                    color: var(--title-color);
                                                "
                                                role="menuitem"
                                            >
                                                <span
                                                    class="w-5 flex justify-center"
                                                >
                                                    <i
                                                        class="fa fa-right-from-bracket"
                                                    ></i>
                                                </span>
                                                <p
                                                    class="ml-2 whitespace-nowrap"
                                                >
                                                    Sair
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <transition name="fade">
            <div
                style="
                    z-index: 999;
                    background-color: rgba(0, 0, 0, 0.47);
                    backdrop-filter: none;
                    height: 100vh;
                "
                v-if="showSearchMenu"
                class="fixed left-0 right-0 bottom-0 flex items-center justify-center mx-auto w-full"
            >
                <div
                    @click="toggleSearch"
                    class="absolute inset-0 opacity-50 cursor-pointer"
                ></div>

                <!-- Start searchbar action -->

                <div class="search-menu mx-auto w-full p-4">
                    <a
                        class="login-register-x"
                        @click.prevent="toggleSearch"
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
                    <div class="mb-5 w-full mx-auto w-full p-4">
                        <div class="mx-auto">
                            <div class="flex flex-col">
                                <div class="relative w-full">
                                    <input
                                        style="
                                            -webkit-box-shadow: 0px 0px 14px -22px
                                                rgba(43, 43, 43, 1);
                                            -moz-box-shadow: 0px 0px 14px -22px rgba(43, 43, 43, 1);
                                            box-shadow: 0px 0px 14px -22px rgba(43, 43, 43, 1);
                                            background-color: var(
                                                --ci-gray-dark
                                            );
                                            border-radius: 3px;
                                            font-size: 14px;
                                            padding-left: 40px;
                                            padding-top: 5px;
                                            padding-bottom: 5px;
                                        "
                                        type="search"
                                        v-model.lazy="searchTerm"
                                        class="block p-2.5 w-full z-20 text-sm text-gray-900 dark:placeholder-gray-400 dark:text-white placeholder-search p-2.5 lg:p-0 search-mobile"
                                        placeholder="Pesquise um nome de cassino..."
                                        required
                                    />

                                    <button
                                        v-if="searchTerm.length > 0"
                                        @click.prevent="clearData"
                                        type="button"
                                        class="absolute end-0 h-full p-2.5 text-sm font-medium text-white"
                                    ></button>
                                </div>
                                <div
                                    class="text-center mt-4 justify-center p-2"
                                    style="
                                        background-color: #383028;
                                        border-radius: 5px;
                                    "
                                >
                                    <h3
                                        style="
                                            color: #ff9f43;
                                            font-size: 0.75rem;
                                        "
                                    >
                                        Mínimo 3 caracteres
                                    </h3>
                                </div>
                            </div>

                            <div
                                v-if="!isLoadingSearch"
                                class="mt-8 grid grid-cols-4 md:grid-cols-12 gap-4 py-5"
                            >
                                <CassinoGameCard
                                    v-if="games"
                                    v-for="(game, index) in games?.data"
                                    :index="index"
                                    :title="game.game_name"
                                    :cover="game.cover"
                                    :gamecode="game.game_code"
                                    :type="game.distribution"
                                    :game="game"
                                />
                            </div>
                            <div
                                v-else
                                class="relative items-center block max-w-sm p-6 bg-white border border-gray-100 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-800 dark:hover:bg-gray-700"
                            >
                                <h5
                                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white opacity-20"
                                >
                                    Noteworthy technology acquisitions 2021
                                </h5>
                                <p
                                    class="font-normal text-gray-700 dark:text-gray-400 opacity-20"
                                >
                                    Here are the biggest enterprise technology
                                    acquisitions of 2021 so far, in reverse
                                    chronological order.
                                </p>
                                <div
                                    role="status"
                                    class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2"
                                >
                                    <i
                                        class="fa fa-spinner-third fa-spin"
                                        style="
                                            font-size: 45px;
                                            --fa-primary-color: var(
                                                --ci-primary-color
                                            );
                                            --fa-secondary-color: #000000;
                                        "
                                    ></i>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End searchbar action -->
            </div>
        </transition>
    </nav>
    <div
        v-if="showModal"
        class="modal-overlay"
        @click="saveNameAndClose"
        style="
            z-index: 999;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: none;
            height: 100vh;
        "
    >
        <div
            class="modal-content"
            @click.stop
            style="background-color: var(--carousel-banners-dark)"
        >
            <div class="relative">
                <div class="flex justify-between items-center">
                    <h2
                        style="
                            font-size: 12px;
                            display: flex;
                            justify-content: start;
                            padding-top: 20px;
                        "
                    >
                        Nome de usuário
                    </h2>
                    <button
                        @click="closeModal"
                        style="
                            border-radius: 3px;
                            font-size: 16px;
                            margin-top: -10px;
                        "
                    >
                        x
                    </button>
                </div>
                <input
                    style="
                        border: none;
                        outline: none;
                        border-bottom: 1px solid white;
                        border-radius: 0;
                    "
                    @change.prevent="updateName"
                    v-model="profileName"
                    type="text"
                    class="appearance-none border border-gray-300 rounded-md p-2 bg-transparent border-none text-center"
                    :placeholder="profileName"
                />
            </div>

            <button
                @click="saveNameAndClose"
                style="
                    background-color: #008000;
                    border-radius: 3px;
                    font-size: 12px;
                    padding: 1px 8px;
                "
            >
                Ok
            </button>
        </div>
    </div>

    <div
        style="
            z-index: 999;
            backdrop-filter: none;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.8);
        "
        id="modalcupom"
        tabindex="-1"
        aria-hidden="true"
        class="fixed top-0 left-0 right-0 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-screen md:h-[calc(100%-1rem)] max-h-full"
    >
        <div class="relative w-full max-w-3xl max-h-full">
            <div
                v-if="isLoadingRegister"
                class="absolute top-0 left-0 right-0 bottom-0 z-[999]"
            >
                <div
                    role="status"
                    class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2"
                >
                    <i
                        class="fa fa-spinner-third fa-spin"
                        style="
                            font-size: 45px;
                            --fa-primary-color: var(--ci-primary-color);
                            --fa-secondary-color: #000000;
                        "
                    ></i>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="flex md:justify-between h-full relative">
                <div class="w-full relative p-5 m-auto login-register-100vh">
                    <form
                        @submit.prevent="registerSubmit"
                        method="post"
                        action=""
                        class="padding-register"
                    >
                        <a
                            class="login-register-x"
                            @click.prevent="modalcupomToggle"
                            href=""
                            style="position: absolute; right: 2%; top: 2%"
                        >
                            <div
                                class="x-mark-scale"
                                style="
                                    box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.5);
                                    background-color: var(
                                        --carousel-banners-dark
                                    );
                                    padding: 7px 13px;
                                    border-radius: 5px;
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

                        <!--copiar para fechar modal-->

                        <!--fim copiar para fechar modal-->

                        <p
                            style="
                                text-align: center;
                                font-size: 25px;
                                padding-bottom: 10px;
                                padding-top: 65px;
                                line-height: 30px;
                            "
                        >
                            Tem certeza que deseja cancelar seu registro?
                        </p>

                        <p
                            style="
                                text-align: center;
                                font-size: 14px;
                                padding-bottom: 30px;
                                opacity: 0.6;
                            "
                        >
                            Cadastre-se e deposite agora e ganhe o dobro do seu
                            depósito até R$ 1.000
                        </p>
                        <div
                            style="
                                display: flex;
                                flex-direction: column;
                                justify-content: center;
                                gap: 10px;
                                align-items: center;
                                width: 100%;
                            "
                        >
                            <button
                                style="
                                    color: white;
                                    padding-bottom: 30px;
                                    font-size: 18px;
                                    width: 100%;
                                    padding: 12px;
                                    border-radius: 3px;
                                    background-color: var(--ci-primary-color);
                                "
                                href=""
                                @click.prevent="hideCupomShowRegisterToggle"
                            >
                                Continuar
                            </button>

                            <a
                                style="
                                    color: white;
                                    opacity: 0.5;
                                    padding-top: 10px;
                                    padding-bottom: 20px;
                                "
                                href=""
                                @click.prevent="modalcupomToggle"
                                ><strong style="font-weight: 500"
                                    >Sim, quero cancelar</strong
                                ></a
                            >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div
        id="modalProfileEl"
        tabindex="-1"
        aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-screen md:h-[calc(100%-1rem)] max-h-full pad-modal-profile"
    >
        <div
            class="relative w-full max-w-2xl md:max-w-lg max-h-full bg-white dark:bg-gray-900 rounded-lg shadow-lg por-height-alto"
        >
            <div v-if="!isLoadingProfile" class="flex flex-col">
                <!-- PROFILE HEADER -->
                <div class="flex justify-between w-full p-4">
                    <h1 class="text-2xl font-bold pt-2 p-4">
                        {{ $t("Seu Perfil") }}
                    </h1>
                    <button
                        @click.prevent="profileToggle"
                        type="button"
                        class="text-1xl"
                    >
                        <div
                            class="x-mark-scale"
                            style="
                                box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.5);
                                background-color: #212425;
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
                    </button>
                </div>

                <a
                    class="login-register-x"
                    @click.prevent="toggleSearch"
                    href=""
                >
                </a>

                <!-- PROFILE BODY -->
                <div
                    v-if="profileUser != null"
                    class="flex flex-col w-full p-4"
                    style="
                        background-color: #1c1e22;
                        border-bottom-left-radius: 8px;
                        border-bottom-right-radius: 8px;
                    "
                >
                    <!-- PROFILE INFO -->
                    <div
                        class="flex items-center self-center justify-between w-full pt-4"
                    >
                        <div
                            class="text-center flex flex-col justify-center self-center items-center"
                        >
                            <div class="relative">
                                <img
                                    style="max-width: 100px"
                                    class=""
                                    :src="
                                        userData?.avatar
                                            ? '/storage/' + userData.avatar
                                            : `https://static3.smr.vc/fb020020-e232-4ece-a510-3082026ff106/37.png`
                                    "
                                    alt=""
                                />
                                <input
                                    ref="fileInput"
                                    type="file"
                                    style="display: none"
                                    @change="handleFileChange"
                                />
                                <button
                                    style="
                                        margin-right: -30px;
                                        margin-bottom: -10px;
                                    "
                                    @click="openFileInput"
                                    type="button"
                                    class="absolute bottom-0 right-0 text-3xl"
                                >
                                    <i style="" class="fa fa-camera-retro"></i>
                                </button>
                            </div>
                            <div class="relative">
                                <input
                                    @change.prevent="updateName"
                                    v-model="profileName"
                                    type="text"
                                    :readonly="!readonly"
                                    class="mt-4 appearance-none border border-gray-300 rounded-md p-2 bg-transparent border-none text-center"
                                    :placeholder="profileName"
                                />
                                <p
                                    style="font-weight: bold"
                                    class="text-sm font-medium text-gray-900 truncate dark:text-gray-300"
                                    role="none"
                                >
                                    {{ userData?.email }}
                                </p>
                            </div>
                        </div>
                        <div class="">
                            <button
                                @click.prevent="readonly = !readonly"
                                type="button"
                                class="bg-gray-200 hover:bg-gray-400 dark:bg-gray-600 hover:dark:bg-gray-700 w-10 h-10 rounded"
                            >
                                <i
                                    v-if="!readonly"
                                    class="fa-sharp fa-light fa-pen"
                                ></i>
                                <i
                                    v-if="readonly"
                                    class="fa-solid fa-xmark"
                                ></i>
                            </button>
                        </div>
                    </div>

                    <div
                        class="mt-3 shadow flex flex-col bg-gray-100 dark:bg-gray-900 rounded-lg"
                    >
                        <div class="flex justify-between px-4 pt-4">
                            <h1>
                                <span class="mr-2"
                                    ><i class="fa-solid fa-chart-mixed"></i
                                ></span>
                                {{ $t("Statistics") }}
                            </h1>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-3 gap-4">
                                <div
                                    class="bg-gray-200 dark:bg-gray-700 text-center p-4"
                                >
                                    <p class="text-[12px]">
                                        {{ $t("Total winnings") }}
                                    </p>
                                    <p class="text-2xl font-bold">
                                        {{ totalEarnings }}
                                    </p>
                                </div>
                                <div
                                    class="bg-gray-200 dark:bg-gray-700 text-center p-4"
                                >
                                    <p class="text-[12px]">
                                        {{ $t("Total bets") }}
                                    </p>
                                    <p class="text-2xl font-bold">
                                        {{ totalBets }}
                                    </p>
                                </div>
                                <div
                                    class="bg-gray-200 dark:bg-gray-700 text-center p-4"
                                >
                                    <p class="text-[12px]">
                                        {{ $t("Total bet") }}
                                    </p>
                                    <p class="text-2xl font-bold">
                                        {{ sumBets }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="isLoadingProfile" class="flex flex-col w-full h-full">
                <div
                    role="status"
                    class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2"
                >
                    <i
                        class="fa fa-spinner-third fa-spin"
                        style="
                            font-size: 45px;
                            --fa-primary-color: var(--ci-primary-color);
                            --fa-secondary-color: #000000;
                        "
                    ></i>
                    <span class="sr-only">{{ $t("Loading") }}...</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { RouterLink, useRoute } from "vue-router";
import { sidebarStore } from "@/Stores/SideBarStore.js";
import { useAuthStore } from "@/Stores/Auth.js";
import { useToast } from "vue-toastification";
import { useRouter } from "vue-router";
import { onMounted, ref, watch } from "vue";

import DropdownDarkLight from "@/Components/UI/DropdownDarkLight.vue";
import LanguageSelector from "@/Components/UI/LanguageSelector.vue";
import WalletBalance from "@/Components/UI/WalletBalance.vue";
import HttpApi from "@/Services/HttpApi.js";
import MakeDeposit from "@/Components/UI/MakeDeposit.vue";
import { useSettingStore } from "@/Stores/SettingStore.js";
import { searchGameStore } from "@/Stores/SearchGameStore.js";
import CassinoGameCard from "@/Pages/Cassino/Components/CassinoGameCard.vue";
import { useBannerStore } from "@/Stores/useBannerStore.js";
import ModalRegister from "@/Pages/Auth/ModalRegister.vue";
import PrivacyPolicy from "@/Pages/Terms/PrivacyPolicy.vue";
import ModalLogin from "@/Pages/Auth/ModalLogin.vue";

export default {
    props: {
        simple: {
            type: Boolean,
            default: false,
        },
        disableAuthModals: {
            type: Boolean,
            default: false,
        },
    },

    components: {
        CassinoGameCard,
        MakeDeposit,
        WalletBalance,
        LanguageSelector,
        DropdownDarkLight,
        RouterLink,
        ModalLogin,
        ModalRegister,
        PrivacyPolicy,
    },

    data() {
        return {
            showRegisterModal: true,
            showLoginModal: false,
            showPrivacyPolicyModal: false,
            selectedPolicySection: "terms",
            setting: {},
            nextLevel: null,
            vipPoints: 0,
            form: {
                email: "",
            },
            showModal2: false,
            isClosed: false,
            showModal: false,
            sidebar: /iPhone|iPad|iPod|Android/i.test(navigator.userAgent)
                ? false
                : localStorage.getItem("sidebarStatus")
                ? JSON.parse(localStorage.getItem("sidebarStatus"))
                : false,
            showNavtop: true,
            isLoadingLogin: false,
            isLoadingRegister: false,
            isReferral: false,
            typeInputPassword: "password",
            readonly: false,
            profileUser: null,
            custom: null,
            modalDepositNav: null,
            showTopBanner: true,
            loginForm: {
                email: "",
                password: "",
            },
            registerForm: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
                reference_code: "",
                term_a: false,
                agreement: false,
            },
            avatarUrl: "${baseUrl}/storage/padrao.png",
            isLoadingProfile: false,
            profileName: "",
            sumBets: 0,
            totalBets: 0,
            totalEarnings: 0,
            showSearchMenu: false,
            games: null,
            searchTerm: "",
            isLoadingSearch: true,
        };
    },

    setup() {
        const route = useRoute();
        const router = useRouter();
        const abaAtiva = ref("cassino");
        const sidebar = sidebarStore();
        const bannerStore = useBannerStore();

        const closeTopBanner = () => {
            bannerStore.closeBanner();
        };

        const checkRoute = () => {
            if (route.path.includes("/games/play/1458/sport")) {
                abaAtiva.value = "esportes";
            } else {
                abaAtiva.value = "cassino";
            }
        };

        watch(() => route.path, checkRoute, { immediate: true });
        onMounted(checkRoute);

        const voltarParaCassino = () => {
            abaAtiva.value = "cassino";
            router.push("/");
        };

        const irParaEsportes = (url) => {
            abaAtiva.value = "esportes";

            sidebar.setSidebarStatus(false);

            if (url.startsWith("http")) {
                window.location.href = url;
            } else {
                router.push(url);
            }
        };

        return {
            route,
            router,
            abaAtiva,
            voltarParaCassino,
            irParaEsportes,
            sidebar,
            bannerStore,
            closeTopBanner,
        };
    },

    computed: {
        isAuthenticated() {
            const authStore = useAuthStore();
            return authStore.isAuth;
        },
        sidebarMenu() {
            return this.sidebar.getSidebarStatus;
        },

        searchGameDataStore() {
            return searchGameStore();
        },
        searchGameMenu() {
            const search = searchGameStore();
            return search.getSearchGameStatus;
        },
        sidebarMenuStore() {
            return sidebarStore();
        },
        sidebarMenu() {
            const sidebar = sidebarStore();
            return sidebar.getSidebarStatus;
        },
        isAuthenticated() {
            const authStore = useAuthStore();
            return authStore.isAuth;
        },
        userData() {
            const authStore = useAuthStore();
            return authStore.user;
        },
        setting() {
            const settingStore = useSettingStore();
            return settingStore.setting;
        },
    },

    mounted() {
        const depositModalEl = document.getElementById("modalElDeposit");
        if (depositModalEl) {
            this.modalDeposit = new Modal(depositModalEl, {
                placement: "center",
                backdrop: "dynamic",
                backdropClasses:
                    "bg-gray-900/50 fixed inset-0 z-1 backmodaldeposit",
                closable: true,
                onHide: () => {
                    this.paymentType = null;
                    const divsToDelete =
                        document.querySelectorAll(".backmodaldeposit");
                    divsToDelete.forEach((div) => div.remove());
                },
            });
        } else {
            console.warn("⚠️ modalElDeposit não encontrado no DOM.");
        }

        // evento de abrir modal login
        window.addEventListener("open-login-modal", () => {
            this.showLoginModal = true;
            this.showRegisterModal = false;
        });
    },
    methods: {
        handleCloseRegister() {
            this.showRegisterModal = false;
            document.body.style.overflow = "";
            document.body.classList.remove("modal-open");
        },
        openRegister() {
            this.showLoginModal = false;
            this.showRegisterModal = true;
            document.body.style.overflow = "hidden";
            document.body.classList.add("modal-open");
        },
        openLogin() {
            this.showLoginModal = true;
            this.showRegisterModal = false;
        },
        closeRegister() {
            this.showRegisterModal = false;
        },
        closeLogin() {
            this.showLoginModal = false;
        },
        openRegisterModal() {
            this.showLoginModal = false;
            this.showRegisterModal = true;
        },
        toggleMenu() {
            const store = sidebarStore();
            store.setSidebarStatus(!store.getSidebarStatus);
        },
        async loginSubmit() {
            const _toast = useToast();
            const authStore = useAuthStore();
            this.isLoadingLogin = true;

            try {
                const response = await HttpApi.post(
                    "auth/login",
                    this.loginForm
                );

                authStore.setToken(response.data.access_token);
                authStore.setUser(response.data.user);
                authStore.setIsAuth(true);

                this.loginForm.email = "";
                this.loginForm.password = "";

                this.closeLogin();
                _toast.success("Usuário autenticado com sucesso");

                if (this.isCasinoPlayPage) {
                    this.$router.go();
                }
            } catch (error) {
                const errors = JSON.parse(error.request.responseText);
                for (const [, value] of Object.entries(errors)) {
                    _toast.error(value);
                }
            } finally {
                this.isLoadingLogin = false;
            }
        },

        async registerSubmit() {
            if (response.data.access_token) {
                authStore.setToken(response.data.access_token);
                authStore.setUser(response.data.user);
                authStore.setIsAuth(true);

                // Atualize variáveis imediatamente
                this.profileName = response.data.user.name;
                this.profileUser = response.data.user;

                // Aguarde perfil completo (caso haja dados adicionais)
                await this.getProfile();

                this.registerForm = {
                    name: "",
                    email: "",
                    password: "",
                    password_confirmation: "",
                    reference_code: "",
                    term_a: false,
                    agreement: false,
                };

                this.closeRegister();
                _toast.success("Sua conta foi criada com sucesso");
                setTimeout(() => {
                    this.modalDepositNav.toggle();
                }, 200);

                if (this.isCasinoPlayPage) {
                    location.reload();
                }
            }
        },

        logoutAccount() {
            const authStore = useAuthStore();
            const _toast = useToast();

            HttpApi.post("auth/logout", {})
                .then(() => {
                    authStore.logout();
                    this.router.push({ name: "home" });
                    _toast.success("Usuário desconectado com sucesso");
                })
                .catch((error) => {
                    const errors = JSON.parse(error.request.responseText);
                    for (const [, value] of Object.entries(errors)) {
                    }
                });
        },

        // Alterna entre modais ao clicar nos botões correspondentes
        // Exemplo: botão Entrar no registro fecha o registro e abre login, vice-versa
        toggleToLoginFromRegister() {
            this.showRegisterModal = false;
            this.showLoginModal = true;
        },

        toggleToRegisterFromLogin() {
            this.showLoginModal = false;
            this.showRegisterModal = true;
        },

        togglePassword() {
            this.typeInputPassword =
                this.typeInputPassword === "password" ? "text" : "password";
        },

        // Função para buscar perfil do usuário
        async getProfile() {
            this.isLoadingProfile = true;

            try {
                const response = await HttpApi.get("/profile/");
                const user = response.data.user;
                this.profileName = user.name;
                this.profileUser = user;
            } catch (error) {
                console.error("Erro ao carregar perfil:", error);
            } finally {
                this.isLoadingProfile = false;
            }
        },
        async getSearch() {
            try {
                const response = await HttpApi.get(
                    "/search/games?searchTerm=" + this.searchTerm
                );
                this.games = response.data.games;
                this.isLoadingSearch = false;
            } catch (error) {
                this.isLoadingSearch = false;
            }
        },

        async clearData() {
            this.searchTerm = "";
            await this.getSearch();
        },

        openPolicyModal(section) {
            this.selectedPolicySection = section;
            this.showPrivacyPolicyModal = true;
        },

        closePolicyModal() {
            this.showPrivacyPolicyModal = false;
        },

        closeTopBanner() {
            this.showTopBanner = false;
            document.body.style.marginTop = "0px";
        },
        saveNameAndClose() {
            this.updateName().then(() => {
                this.getProfile(); // Atualiza os dados no frontend
                this.showModal = false;
            });
        },

        checkBannerStatus() {
            const lastClosed = localStorage.getItem("bannerLastClosed");
            if (lastClosed) {
                const twelveHours = 12 * 60 * 60 * 1000;
                if (Date.now() - lastClosed < twelveHours) {
                    this.isClosed = true;
                }
            }
        },

        closeBanner() {
            this.isClosed = true;
            localStorage.setItem("bannerLastClosed", Date.now());
        },

        toggleSearch() {
            this.searchGameDataStore.setSearchGameToogle();
        },

        redirectSocialTo() {
            return "/auth/redirect/google";
        },

        like: async function (id) {
            const _toast = useToast();
            try {
                await HttpApi.post("/profile/like/" + id, {});
                this.getProfile();
                _toast.success(this.$t("Curtir efetuado com sucesso"));
            } catch (error) {
                const errors = JSON.parse(error.request.responseText);
                for (const [, value] of Object.entries(errors)) {
                    _toast.error(value);
                }
            }
        },

        updateName: async function () {
            this.isLoadingProfile = true;
            try {
                await HttpApi.post("/profile/updateName", {
                    name: this.profileName,
                });
                authStore.setUser({
                    ...authStore.user,
                    name: this.profileName,
                });
            } catch (error) {
                // Erro silencioso
            } finally {
                this.isLoadingProfile = false;
            }
        },

        openFileInput() {
            this.$refs.fileInput.click();
        },

        async handleFileChange(event) {
            const file = event.target.files[0];
            const formData = new FormData();
            formData.append("avatar", file);

            const reader = new FileReader();
            reader.onload = () => {
                this.avatarUrl = reader.result;
            };
            reader.readAsDataURL(file);

            try {
                await HttpApi.post("/profile/upload-avatar", formData, {
                    headers: { "Content-Type": "multipart/form-data" },
                });
                window.location.reload();
            } catch (error) {
                console.error("Erro ao atualizar avatar", error);
            }
        },

        getVips: async function () {
            try {
                const response = await HttpApi.get(`/profile/vip/`);
                this.vipPoints = response.data.vipPoints;
                this.nextLevel = response.data.nextLevel;
                this.nivelToday = response.data.nivelToday;
                this.nivelWeekly = response.data.nivelWeekly;
                this.nivelMonthly = response.data.nivelMonthly;
                this.nivelYearly = response.data.nivelYearly;
                this.loadingVipTab();
            } catch {
                // Falha silenciosa
            }
        },

        loadingVipTab: function () {
            const tabsElement = document.getElementById("tabs-vip");
            if (!tabsElement) return;

            const tabElements = [
                {
                    id: "vipdefault",
                    triggerEl: document.querySelector("#vipdefault-tab"),
                    targetEl: document.querySelector("#vipdefault-panel"),
                },
                {
                    id: "weeklybonus",
                    triggerEl: document.querySelector("#weeklybonus-tab"),
                    targetEl: document.querySelector("#weeklybonus-panel"),
                },
                {
                    id: "monthlybonus",
                    triggerEl: document.querySelector("#monthlybonus-tab"),
                    targetEl: document.querySelector("#monthlybonus-panel"),
                },
                {
                    id: "yearlybonus",
                    triggerEl: document.querySelector("#yearlybonus-tab"),
                    targetEl: document.querySelector("#yearlybonus-panel"),
                },
            ];

            tabElements.forEach(({ triggerEl, targetEl }) => {
                triggerEl.addEventListener("click", () => {
                    tabElements.forEach(({ targetEl: tEl }) => {
                        tEl.classList.add("hidden");
                    });
                    targetEl.classList.remove("hidden");
                });
            });
        },

        getSetting: async function () {
            try {
                const response = await HttpApi.get("settings/all");
                this.setting = response.data;
            } catch {
                // Silencioso
            }
        },

        openModalDeposit() {
            if (this.modalDepositNav) {
                this.modalDepositNav.show();
            }
        },
    },

    created() {
        this.getVips();
        this.checkBannerStatus();
        this.getSetting();
        this.custom = custom;
        if (this.isAuthenticated) {
            this.getProfile();
        }

        if (this.isCasinoPlayPage) {
            this.showNavtop = /iPhone|iPad|iPod|Android/i.test(
                navigator.userAgent
            )
                ? false
                : true;
        }
    },

    watch: {
        sidebarMenu(newVal) {
            this.sidebar = newVal;
        },
        searchTerm() {
            this.getSearch();
        },
        async searchGameMenu() {
            await this.getSearch();
            this.showSearchMenu = !this.showSearchMenu;
        },
    },
};
</script>

<style scoped>
.hidden {
    display: none;
}
.container {
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: Arial, sans-serif;
}
.message {
    margin-left: 10px;
    font-size: 16px;
}
.spinner {
    animation: spin 1s linear infinite;
}
@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
.hidden {
    display: none;
}
.container {
    display: flex;
    align-items: center;
    justify-content: center;
}
.message {
    color: #6a6d6d;
    margin-left: 10px;
    font-size: 12px;
}
.spinner {
    animation: spin 1s linear infinite;
}
@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
.modal2-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.47);
    backdrop-filter: none;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal2-content {
    background: white;
    padding: 20px;
    border-radius: 5px;
    position: relative;
    max-width: 450px;
    height: 450px;
    width: 100%;
}

.close2 {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    font-size: 24px;
    font-weight: bold;
}
.top-banner {
    position: fixed; /* Fixa a div no topo da tela */
    top: 0;
    left: 0;
    right: 0;
    background-color: #f4f4f4;
    padding: 10px;
    border-bottom: 1px solid #ddd;
    z-index: 1000; /* Garante que a div fique acima dos outros elementos */
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.top-banner p {
    margin: 0;
}

.top-banner button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
}

.top-banner button:hover {
    background-color: #0056b3;
}
/* Estilo para o overlay do modal */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
}

/* Estilo para o conteúdo do modal */
.modal-content {
    background: white;
    padding: 20px;
    padding-top: 0;
    border-radius: 8px;
    width: 300px;
    text-align: center;
}

/* Estilo para o botão de fechar */
button {
    margin-top: 10px;
}
.item-game-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Alinhamento à esquerda do contêiner da bolinha */
}

.online-indicator {
    margin-top: 5px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: flex-start; /* Alinhamento à esquerda dos itens dentro do indicador */
}

.pulse2 {
    position: absolute;
    right: 0;
    bottom: 8%;
    margin-left: 12px; /* Ajuste conforme necessário para alinhar com o card */
    width: 10px;
    height: 10px;
    background-color: #00ff00;
    border-radius: 50%;
    margin-right: 3px;
    box-shadow: 0 0 5px #00ff00, 0 0 20px #00ff00;
}
</style>
