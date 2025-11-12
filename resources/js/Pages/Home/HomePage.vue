<style>
.shimmer {
    margin: 0 auto;
    position: relative;
    overflow: hidden;
    border-radius: 20px;
}

.shimmer::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;

    background: linear-gradient(
        90deg,
        rgba(255, 255, 255, 0) 0%,
        rgba(255, 255, 255, 0.2) 50%,
        rgba(255, 255, 255, 0) 100%
    );
    animation: shimmer 1.5s infinite;
}

.shimmer2 {
    margin: 0 auto;
    margin-bottom: 30px;
    margin-top: 10px;
    position: relative;
    overflow: hidden;
    padding: 80px;
    border-radius: 20px;
}

.shimmer2::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;

    background: linear-gradient(
        90deg,
        rgba(255, 255, 255, 0) 0%,
        rgba(255, 255, 255, 0.2) 50%,
        rgba(255, 255, 255, 0) 100%
    );
    animation: shimmer 1.5s infinite;
}

.shimmer3 {
    margin: 0 auto;
    position: relative;
    overflow: hidden;
    border-radius: 20px;
}

.shimmer3::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;

    background: linear-gradient(
        90deg,
        rgba(255, 255, 255, 0) 0%,
        rgba(255, 255, 255, 0.2) 50%,
        rgba(255, 255, 255, 0) 100%
    );
    animation: shimmer 1.5s infinite;
}

.shimmer4 {
    margin-top: 30px;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
    border-radius: 20px;
}

.shimmer4::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;

    background: linear-gradient(
        90deg,
        rgba(255, 255, 255, 0) 0%,
        rgba(255, 255, 255, 0.2) 50%,
        rgba(255, 255, 255, 0) 100%
    );
    animation: shimmer 1.5s infinite;
}

.shimmer-estilos-banner {
    height: 400px;
}

.shimmer-estilos-banner2 {
    margin-top: 30px;
    margin-bottom: 30px;
    height: 90px;
}

@keyframes shimmer {
    0% {
        left: -100%;
    }
    100% {
        left: 100%;
    }
}
html {
    font-family: Montserrat, -apple-system, Segoe UI, Roboto, Helvetica Neue,
        Arial, sans-serif;
}
body {
    font-family: Montserrat, -apple-system, Segoe UI, Roboto, Helvetica Neue,
        Arial, sans-serif;
}
.btn-scroll-top {
    position: relative;
    z-index: 2;
    bottom: 2em;
    display: none;
    align-items: center;
    /* Outras propriedades de estilo aqui */
    background-color: #0000009a;
    border: 1px solid var(--ci-primary-color);
    color: #fff;
    cursor: pointer;
    transition: opacity 0.3s;
    font-size: 13px;
    gap: 0.5em;
    padding: 3px 12px;
    border-radius: 20px;
    margin-top: -30px;
    left: 48.5%;
    transform: translateX(-50%);
}
.titleCategories {
    font-weight: bold;
    font-size: 14px;
}
.categories-margin {
    margin-bottom: 15px;
}

.font-arrows {
    font-size: 22px;
}
.control-svgWidth {
    width: 2rem;
    height: 2rem;
}
.show-btn-scroll-top {
    display: block;
    display: flex;
}

/* Centralize verticalmente */
.btn-scroll-top {
    /* transform: translateY(-50%); */
}

/* Centralize horizontalmente */
.btn-scroll-top {
}
.search-mobile {
    -webkit-box-shadow: 0px 0px 14px -22px rgba(43, 43, 43, 1);
    -moz-box-shadow: 0px 0px 14px -22px rgba(43, 43, 43, 1);
    box-shadow: 0px 0px 14px -22px rgba(43, 43, 43, 1);
    background-color: var(--ci-gray-dark);
    border-radius: 3px;
    font-size: 14px;
    padding-left: 40px;
    padding-top: 10px;
    padding-bottom: 10px;
}
.margin-search {
    margin-top: -6px;
}
.placeholder-search::placeholder {
    color: #acafaf;
    font-size: 13px;
}
@media (max-width: 1024px) {
    .btn-scroll-top {
        bottom: 7em;
        padding: 2px 7px;
    }
    .margin-categorias {
        margin-top: -20px;
    }
    .item-sombra2 {
        position: relative;
    }

    .item-sombra2:after {
        content: "";
        position: absolute;
        bottom: 0;
        margin-right: -1px;
        right: 0;
        width: 25px;
        height: 100%;
        background: linear-gradient(
            to right,
            rgb(33 36 37 / 0%),
            var(--carousel-banners)
        );
    }
}

.padding-mobile-banner {
    padding-top: 100px;
}

@media (min-width: 769px) and (max-width: 1121px) {
    .shimmer-estilos-banner {
        height: 239px;
    }
}

@media (max-width: 768px) {
    .shimmer-estilos-banner2 {
        margin-top: 20px;
        margin-bottom: 15px;
        height: 90px;
    }
    .shimmer-estilos-banner {
        height: 153px;
    }
    .titleCategories {
        font-size: 12px;
    }
    .categories-margin {
        margin-top: 0px;
    }
    .font-arrows {
        font-size: 16px;
    }
    #svg-lupa {
        margin-top: -2px;
    }
    .search-mobile {
        padding-top: 8px;
        padding-bottom: 8px;
    }
    .margin-search {
        margin-top: 0px;
    }
    .padding-mobile-banner {
        padding: 0;
        padding-top: 35px;
    }
}
</style>
<template>
    <BaseLayout>
        <div class="">
            <!-- Banners carousel -->
            <div class="carousel-banners">
                <div
                    class="mx-auto w-full sm:max-w-[690px] lg:max-w-[1110px] p-4"
                >
                    <!-- Conteúdo da sua página aqui -->
                    <div
                        class="mx-auto w-full sm:max-w-[690px] lg:max-w-[1110px]"
                        style="
                            position: fixed;
                            bottom: 0;
                            z-index: 2;
                            pointer-events: auto;
                            height: 0px;
                            z-index: 1;
                        "
                    >
                        <button
                            style="pointer-events: auto"
                            class="btn-scroll-top"
                            @click="scrollToTop"
                        >
                            <div>
                                <svg
                                    height="1em"
                                    viewBox="0 0 384 512"
                                    width="1em"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"
                                        fill="currentColor"
                                    ></path>
                                </svg>
                            </div>
                            <div>De volta ao topo</div>
                        </button>
                    </div>
                    <div v-if="loading">
                        <!-- Aplicar o efeito shimmer enquanto os dados estão carregando -->
                        <div
                            v-if="loading"
                            class="shimmer shimmer-estilos-banner"
                            v-for="n in 1"
                            :key="n"
                        ></div>
                    </div>
                    <div v-else>
                        <div class="">
                            <Carousel
                                v-bind="settings"
                                :breakpoints="breakpoints"
                                ref="carouselBanner"
                            >
                                <Slide
                                    v-for="(banner, index) in banners"
                                    :key="index"
                                >
                                    <div class="carousel__item rounded w-full">
                                        <a
                                            :href="banner.link"
                                            class="w-full h-full bg-blue-800 rounded"
                                        >
                                            <img
                                                :src="
                                                    `/storage/` + banner.image
                                                "
                                                alt=""
                                                class="h-full w-full rounded"
                                                style="max-height: 413px"
                                            />
                                        </a>
                                    </div>
                                </Slide>

                                <template #addons>
                                    <navigation>
                                        <template #next>
                                            <i
                                                class="fa-solid fa-chevron-right text-white font-arrows"
                                            ></i>
                                        </template>
                                        <template #prev>
                                            <i
                                                class="fa-solid fa-chevron-left text-white font-arrows"
                                            ></i>
                                        </template>
                                    </navigation>
                                    <Pagination />
                                </template>
                            </Carousel>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-auto p-4 sm:max-w-[690px] lg:max-w-[1110px]">
                <!-- categories -->

                <div v-if="loading">
                    <!-- Aplicar o efeito shimmer enquanto os dados estão carregando -->
                    <div
                        v-if="loading"
                        class="shimmer3 shimmer-estilos-banner"
                        v-for="n in 1"
                        :key="n"
                        style="height: 40px"
                    ></div>
                </div>
                <div v-else>
                    <div
                        class="mx-auto sm:max-w-[690px] lg:max-w-[1110px] w-full search-margin"
                    >
                        <!-- Searchbar action -->
                        <div
                            class="cursor-pointer w-full margin-search md:mb-[39px] mb-4"
                            style="
                                background-color: #323637;
                                border-radius: 5px;
                            "
                        >
                            <div class="flex" style="border-radius: 5px">
                                <div
                                    class="relative w-full"
                                    style="border-radius: 5px"
                                >
                                    <button
                                        style="border-radius: 5px"
                                        @click="toggleSearch"
                                        type="submit"
                                        class="absolute top-0 start-0 h-full p-2.5 text-sm font-medium text-white rounded-e-lg"
                                    >
                                        <svg
                                            id="svg-lupa"
                                            data-v-49f1cded=""
                                            height="14px"
                                            viewBox="0 0 512 512"
                                            width="14px"
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="text-texts w-5 p-0 m-0"
                                            style="width: 20px; height: 16px"
                                        >
                                            <path
                                                d="M500.3 443.7l-119.7-119.7c-15.03 22.3-34.26 41.54-56.57 56.57l119.7 119.7c15.62 15.62 40.95 15.62 56.57 0C515.9 484.7 515.9 459.3 500.3 443.7z"
                                                fill="currentColor"
                                            ></path>
                                            <path
                                                d="M207.1 0C93.12 0-.0002 93.13-.0002 208S93.12 416 207.1 416s208-93.13 208-208S322.9 0 207.1 0zM207.1 336c-70.58 0-128-57.42-128-128c0-70.58 57.42-128 128-128s128 57.42 128 128C335.1 278.6 278.6 336 207.1 336z"
                                                fill="currentColor"
                                                opacity="0.4"
                                            ></path>
                                        </svg>
                                        <span class="sr-only">Search</span>
                                    </button>
                                    <a href="/casino/provider/category">
                                        <input
                                            style="
                                                cursor: pointer;
                                                background-color: #323637;
                                                border-radius: 5px;
                                            "
                                            class="w-full placeholder-search p-2.5 lg:p-0 search-mobile"
                                            type="search"
                                            readonly
                                            placeholder="Pesquise um jogo de cassino..."
                                            required
                                        />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="loading">
                    <!-- Aplicar o efeito shimmer enquanto os dados estão carregando -->
                    <div
                        v-if="loading"
                        class="shimmer4 shimmer-estilos-banner2"
                        v-for="n in 1"
                        :key="n"
                    ></div>
                </div>
                <!-- <div v-else> -->
                <!-- <div  class="category-list item-sombra2 md:mb-12 mb-4  md:mt-[0] mt-[-10px]"> -->
                <!-- <div class="flex gap-0 md:gap-4" style="max-height: 200px; overflow-x: auto; overflow-y: hidden;margin-left: -10px;"> -->
                <!-- <div class="flex flex-row justify-between items-center w-full gap-0 " style="min-width: 100%; white-space: nowrap;">
 
                            <a href="/games/play/6023/8357"
                             
                             class="flex flex-col justify-center items-center min-w-[80px] text-center ">
                                 <div class="flex items-center justify-center p-4" style="background-color: var(--ci-primary-opacity-color);border-radius: 50%;width: 62px;height: 62px;">
                                    <svg class="control-svgWidth" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M177.1 228.6L207.9 320h96.5l29.62-91.38L256 172.1L177.1 228.6zM255.1 0C114.6 0 .0001 114.6 .0001 256S114.6 512 256 512s255.1-114.6 255.1-255.1S397.4 0 255.1 0zM435.2 361.1l-103.9-1.578l-30.67 99.52C286.2 462.2 271.3 464 256 464s-30.19-1.773-44.56-4.93L180.8 359.6L76.83 361.1c-14.93-25.35-24.79-54.01-27.8-84.72L134.3 216.4L100.7 118.1c19.85-22.34 44.32-40.45 72.04-52.62L256 128l83.29-62.47c27.72 12.17 52.19 30.27 72.04 52.62L377.7 216.4l85.23 59.97C459.1 307.1 450.1 335.8 435.2 361.1z" fill="var(--ci-primary-color)"></path></svg>
                                 </div>
                                 <p class="titleCategories" style="line-height: 15px;padding-top: 5px;">Esportes</p>
                                 
                             </a>

                            <a href="/games/play/6023/8357"
                             
                             class="flex flex-col justify-center items-center min-w-[80px] text-center ">
                                 <div class="flex items-center justify-center p-4" style="background-color: var(--ci-primary-opacity-color);border-radius: 50%;width: 62px;height: 62px;margin-top: 13px">
                                     <svg class="control-svgWidth" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M448 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h384c35.35 0 64-28.65 64-64V96C512 60.65 483.3 32 448 32zM254.1 80h67.88l-80 80H174.1L254.1 80zM48 126.1L94.06 80h67.88l-80 80H48V126.1zM464 416c0 8.822-7.178 16-16 16H64c-8.822 0-16-7.178-16-16V208h416V416zM464 97.94L401.9 160h-67.88l80-80H448c8.822 0 16 7.178 16 16V97.94zM218.7 400c1.959 0 3.938-.5605 5.646-1.682l106.7-68.97C334.1 327.3 336 323.8 336 319.1s-1.896-7.34-5.021-9.354l-106.7-68.97C221.1 239.5 216.9 239.5 213.5 241.4C210.1 243.3 208 247 208 251v137.9c0 4.008 2.104 7.705 5.5 9.656C215.1 399.5 216.9 400 218.7 400z" fill="var(--ci-primary-color)"></path></svg>
                                 </div>
                                 <p class="titleCategories flex flex-col" style="line-height: 15px;padding-top: 5px;">Apostas<p style="font-weight: 550;font-size: 11px;">Ao Vivo</p></p>
                                 
                             </a>

                            <a href="/casino/provider/category"
                             
                             class="flex flex-col justify-center items-center min-w-[80px] text-center ">
                                 <div class="flex items-center justify-center p-4" style="background-color: var(--ci-primary-opacity-color);border-radius: 50%;width: 62px;height: 62px;">
                                    <svg class="control-svgWidth" viewBox="0 0 640 512" xmlns="http://www.w3.org/2000/svg"><path d="M171.4 174.3C174.4 163.2 185.8 156.6 196.1 159.6L299.9 187.1C325.9 194.1 341.3 220.8 334.4 246.8C327.4 272.8 300.7 288.2 274.7 281.2L265.9 278.9C265.5 278.8 265.1 278.7 264.7 278.6L282.5 309.3L294.5 302.4C301.2 298.5 309.7 300.8 313.5 307.4C317.4 314.1 315.1 322.6 308.4 326.5L260.2 354.3C253.6 358.1 245.1 355.9 241.2 349.2C237.4 342.5 239.6 334 246.3 330.2L258.4 323.2L240.6 292.5C240.5 292.9 240.4 293.3 240.3 293.6L237.9 302.5C230.1 328.5 204.3 343.9 178.3 336.9C152.3 329.1 136.9 303.2 143.8 277.3L171.4 174.3zM220.7 7.468C247.3-7.906 281.4 1.218 296.8 27.85L463.8 317.1C479.1 343.8 470 377.8 443.4 393.2L250.5 504.5C223.9 519.9 189.9 510.8 174.5 484.2L7.468 194.9C-7.906 168.2 1.218 134.2 27.85 118.8L220.7 7.468zM244.7 49.04L51.85 160.4C48.18 162.5 46.92 167.2 49.04 170.9L216.1 460.2C218.2 463.8 222.9 465.1 226.5 462.1L419.4 351.6C423.1 349.5 424.3 344.8 422.2 341.1L255.2 51.85C253.1 48.18 248.4 46.92 244.7 49.04H244.7zM324.1 499L459.4 420.9C501.3 396.7 515.7 343.1 491.5 301.1L354.7 64.25C356.5 64.08 358.2 63.1 360 63.1H584C614.9 63.1 640 89.07 640 119.1V456C640 486.9 614.9 512 584 512H360C346.4 512 333.8 507.1 324.1 498.1L324.1 499zM579.8 135.7C565.8 123.9 545.3 126.2 532.9 138.9L528.1 144.2L523.1 138.9C510.6 126.2 489.9 123.9 476.4 135.7C460.7 149.2 459.9 173.1 473.9 187.6L522.4 237.6C525.4 240.8 530.6 240.8 533.9 237.6L582 187.6C596 173.1 595.3 149.2 579.8 135.7H579.8z" fill="var(--ci-primary-color)"></path></svg>
                                 </div>
                                 <p class="titleCategories" style="line-height: 15px;padding-top: 5px;">Cassino</p>
                                 
                             </a>

                             <a href="/casino/provider/60/category/all"
                             
                             class="flex flex-col justify-center items-center min-w-[80px] text-center ">
                                 <div class="flex items-center justify-center p-4" style="background-color: var(--ci-primary-opacity-color);border-radius: 50%;width: 62px;height: 62px;margin-top: 13px">
                                    <svg class="control-svgWidth" viewBox="0 0 640 512" xmlns="http://www.w3.org/2000/svg"><path d="M575.1 192h-102.2c3.551 10.11 5.748 20.73 5.748 31.77c0 25.64-9.984 49.75-28.12 67.89L320 423.2v24.84C320 483.3 348.7 512 383.1 512h191.1c35.35 0 63.1-28.65 63.1-63.1v-191.1C639.1 220.7 611.3 192 575.1 192zM479.1 376c-13.25 0-23.1-10.75-23.1-23.1c0-13.26 10.75-23.1 23.1-23.1s23.1 10.74 23.1 23.1C503.1 365.3 493.3 376 479.1 376zM447.5 223.8c0-16.38-6.249-32.76-18.75-45.26L269 18.73C256.5 6.238 240.3 0 223.1 0S191 6.238 178.5 18.73l-159.8 159.8C6.235 191-.0011 207.6-.0011 223.1s6.236 32.57 18.73 45.06l159.8 159.8c12.5 12.5 28.88 18.74 45.26 18.74s32.76-6.248 45.25-18.74l159.8-159.8C441.3 256.5 447.5 240.1 447.5 223.8zM394.9 235.1l-159.8 159.8c-4.076 4.076-8.838 4.686-11.31 4.686c-2.477 0-7.238-.6094-11.31-4.686L52.67 235.1C48.59 231 47.99 226.2 47.99 223.8s.6074-7.236 4.686-11.31l159.8-159.8c4.082-4.08 8.844-4.689 11.32-4.689s7.234 .6094 11.31 4.687l159.8 159.8c4.078 4.078 4.687 8.84 4.687 11.31S398.9 231 394.9 235.1zM223.8 301.6c-12.79 0-23.1 10.29-23.1 23.1c0 13.76 11.25 23.1 23.1 23.1c13.73 0 24-11.22 24-23.1C247.8 312.8 237.5 301.6 223.8 301.6zM223.8 199.8c-13.76 0-23.1 11.25-23.1 23.1c0 12.84 10.34 23.1 23.1 23.1c13.71 0 24-11.21 24-23.1C247.8 210.1 237.5 199.8 223.8 199.8zM121.9 199.8c-13.76 0-24 11.25-24 23.1c0 12.79 10.29 23.1 24 23.1c13.71 0 23.1-11.2 23.1-23.1C145.9 210.1 135.7 199.8 121.9 199.8zM325.6 199.8c-13.76 0-24 11.25-24 23.1c0 12.79 10.29 23.1 24 23.1c13.71 0 24-11.21 24-23.1C349.6 210.1 339.3 199.8 325.6 199.8zM223.8 97.94c-12.79 0-23.1 10.29-23.1 23.1c0 13.76 11.25 23.1 23.1 23.1c13.73 0 24-11.22 24-23.1C247.8 109.1 237.5 97.94 223.8 97.94z" fill="var(--ci-primary-color)"></path></svg>
                                 </div>
                                 <p class="titleCategories flex flex-col" style="line-height: 15px;padding-top: 5px;">Cassino<p style="font-weight: 550;font-size: 11px;">Ao Vivo</p></p>
                                 
                             </a>

                             <a href="/games/play/6023/8357"
                             
                             class="flex flex-col justify-center items-center min-w-[80px] text-center p-4">
                                 <div class="flex items-center justify-center p-4" style="background-color: var(--ci-primary-opacity-color);border-radius: 50%;width: 62px;height: 62px;">
                                    <svg class="control-svgWidth" viewBox="0 0 640 512" xmlns="http://www.w3.org/2000/svg"><path d="M639.1 357.2c0-6.198-.4631-12.49-1.421-18.83l-27.5-181.3C603.5 107.4 581.8 32 319.1 32C57.05 32 36.44 106.9 28.83 157.1l-27.37 181.3C.4734 344.8 0 351.1 0 357.4C0 423.9 53.35 480 121.2 480c46.12-.125 88.37-26.5 108.6-68L243.6 384h152.7l13.75 28c20.25 41.5 62.25 67.88 108.4 68C586.5 480 639.1 423.8 639.1 357.2zM591.1 357.2c0 17.99-6.413 35.55-18.26 49.46c-13.66 16.14-33.73 25.38-54.82 25.38c-.1417 0-.2834-.0004-.4252-.0013c-27.75 0-52.75-15.75-65.25-41.13l-18.32-37.05C429.5 342.9 418.4 336 406.2 336H233.7c-12.17 0-23.29 6.907-28.69 17.82l-18.32 37.05c-4.671 9.482-23.54 41.13-65.92 41.13c-21.09 0-41.04-9.357-54.58-25.38c-11.85-13.91-18.26-31.47-18.26-49.46c0-3.839 .292-7.697 .8855-11.54l27.5-181.3C81.2 132.5 104.1 107.5 134.8 100.6C195.8 86.88 257.9 80 319.1 80s124.2 6.875 185.1 20.62c30.75 6.875 53.62 31.88 58.5 63.75l27.5 181.3C591.7 349.5 591.1 353.3 591.1 357.2zM399.1 240c-17.62 0-31.1 14.38-31.1 32s14.37 32 31.1 32s31.1-14.38 31.1-32S417.6 240 399.1 240zM247.1 200l-31.96-.011L215.1 168c0-13.2-10.78-24-23.98-24C178.8 144 167.1 154.8 167.1 168l.0367 31.99L135.1 200c-13.2 0-23.98 10.8-23.98 24c0 13.2 10.77 24 23.98 24l32.04-.0098L167.1 280c0 13.2 10.82 24 24.02 24c13.2 0 23.98-10.8 23.98-24l.0368-32.01L247.1 248c13.2 0 24.02-10.8 24.02-24C271.1 210.8 261.2 200 247.1 200zM463.1 144c-17.62 0-31.1 14.38-31.1 32s14.37 32 31.1 32c17.62 0 31.1-14.38 31.1-32S481.6 144 463.1 144z" fill="var(--ci-primary-color)"></path></svg>
                                 </div>
                                 <p class="titleCategories" style="line-height: 15px;padding-top: 5px;">E-Sports</p>
                                 
                             </a>

                             <a href="/games/play/5053/12591"
                             
                             class="flex flex-col justify-center items-center min-w-[80px] text-center ">
                                 <div class="flex items-center justify-center p-4" style="background-color: var(--ci-primary-opacity-color);border-radius: 50%;width: 62px;height: 62px;">
                                    <svg class="control-svgWidth" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" lined="true"><path d="M425.68 179.527L332.646 86.496C324.219 78.068 310.555 78.068 302.127 86.496L279.547 109.076C257.207 100.879 233.182 96.176 208 96.176C93.125 96.176 0 189.301 0 304.176S93.125 512.176 208 512.176S416 419.051 416 304.176C416 278.994 411.297 254.967 403.1 232.627L425.68 210.049C434.107 201.621 434.107 187.957 425.68 179.527ZM208 192.176C146.25 192.176 96 242.426 96 304.176C96 313.019 88.844 320.176 80 320.176S64 313.019 64 304.176C64 224.769 128.594 160.176 208 160.176C216.844 160.176 224 167.332 224 176.176S216.844 192.176 208 192.176Z" fill="var(--ci-primary-color)"></path><path d="M380.823 108.576L368 121.399L390.602 144L403.425 131.177C409.669 124.934 409.669 114.82 403.425 108.576S387.067 102.333 380.823 108.576ZM509.056 59.169L469.381 42.625L452.837 2.954C452.025 1.321 449.894 0 448.074 0C446.252 0 444.119 1.321 443.307 2.954L426.763 42.625L387.09 59.169C385.469 59.98 384.148 62.113 384.148 63.933C384.148 65.744 385.469 67.888 387.09 68.7L426.763 85.243L443.307 124.913C444.119 126.546 446.252 127.868 448.074 127.868C449.894 127.868 452.025 126.546 452.837 124.913L469.381 85.243L509.056 68.7C510.679 67.888 512 65.744 512 63.933C512 62.113 510.679 59.98 509.056 59.169Z" fill="var(--ci-primary-color)" opacity="0.4"></path></svg>
                                 </div>
                                 <p class="titleCategories" style="line-height: 15px;padding-top: 5px;">Mines</p>
                                 
                             </a>
                             <a href="/games/play/2560/126"
                             
                             class="flex flex-col justify-center items-center min-w-[80px] text-center ">
                                 <div class="flex items-center justify-center p-4" style="background-color: var(--ci-primary-opacity-color);border-radius: 50%;width: 62px;height: 62px;margin-top: 13px">
                                    <svg class="control-svgWidth" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" lined="true"><path d="M256 256C176.625 256 64 378.75 64 456.25C64 491.125 90.75 512 135.75 512C184.625 512 216.875 486.875 256 486.875C295.5 486.875 327.875 512 376.25 512C421.25 512 448 491.125 448 456.25C448 378.75 335.375 256 256 256Z" fill="var(--ci-primary-color)"></path><path d="M193.5 222.625C224.375 214.5 239.875 172.625 228 129.25C221.5 105.375 208 86.25 192 75V0L128 80C113 97.75 107.5 127.75 116 158.75C127.875 202.125 162.5 230.75 193.5 222.625ZM318.5 222.625C349.5 230.75 384.125 202.125 396 158.75C404.5 127.75 399 97.75 384 80L320 0V75C304 86.25 290.5 105.375 284 129.25C272.125 172.625 287.625 214.5 318.5 222.625ZM108.75 243.375C101.5 219.375 83.875 201.5 64 194.875V128L18.5 190.375C6.5 206.875 0 226.75 0 247.125C0 254.001 1.125 261.25 3.25 268.625C13.625 303.25 45.75 325.75 74.875 318.75S119.125 278.001 108.75 243.375ZM493.5 190.375L448 128V195C428.125 201.5 410.5 219.375 403.25 243.375C392.875 278.001 408 311.75 437.125 318.75S498.375 303.25 508.75 268.625C510.875 261.375 512 254.125 512 247.125C512 226.75 505.5 206.875 493.5 190.375Z" fill="var(--ci-primary-color)" opacity="0.4"></path></svg>
                                 </div>
                                 <p class="titleCategories flex flex-col" style="line-height: 15px;padding-top: 5px;">Fortune <p style="font-weight: 550;font-size: 11px;">Tiger</p></p>
                                 
                             </a>

                             <a href="/games/play/6405/12559"
                             
                             class="flex flex-col justify-center items-center min-w-[80px] text-center ">
                                 <div class="flex items-center justify-center p-4" style="background-color: var(--ci-primary-opacity-color);border-radius: 50%;width: 62px;height: 62px;margin-top: 13px">
                                    <svg class="control-svgWidth" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 .0003C304.1 .0003 336 73.89 336 111.8V153.8L496 253.6C506 259.6 512 269.6 512 281.6V346.5C512 356.5 508 366.5 500 372.5C492 378.4 480.1 380.4 471 377.4L336 334.5V359.5L388 398.4C396 404.4 400 413.4 400 423.4V480.3C400 489.3 396 499.3 388 505.3C380 511.3 370 513.2 360 510.3L256 480.3L152 511.3C143 513.2 133 511.3 125 505.3C117 499.3 112 489.3 112 480.3V423.4C112 413.4 117 404.4 125 398.4L176 359.5V334.5L41 377.4C32 380.4 21 378.4 13 372.5C5 366.5 0 356.5 0 346.5V281.6C0 270.6 7 258.6 16 254.6L176 154.8V112.8C176 73.89 208 0 256 0V.0003zM256 48.93C246 50.93 224 86.87 224 112.8V180.7L48 290.6V324.5L224 269.6V383.4L160 431.4V458.3L256 430.4L352 458.3V431.4L288 383.4V269.6L464 324.5V290.6L288 180.7V112.8C288 85.87 267 49.93 256 48.93V48.93z" fill="var(--ci-primary-color)"></path></svg>
                                 </div>
                                 <p class="titleCategories" style="line-height: 15px;padding-top: 5px;">Aviator <br>Crash</p>
                             </a>

                             <a href="/games/play/6409/12301"
                             
                             class="flex flex-col justify-center items-center min-w-[80px] text-center ">
                                 <div class="flex items-center justify-center p-4" style="background-color: var(--ci-primary-opacity-color);border-radius: 50%;width: 62px;height: 62px;">
                                    <svg class="control-svgWidth" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M408 143.1C408 166.1 390.1 183.1 368 183.1C345.9 183.1 328 166.1 328 143.1C328 121.9 345.9 103.1 368 103.1C390.1 103.1 408 121.9 408 143.1zM384 312.1V394.2C384 419.7 370.6 443.2 348.7 456.2L260.2 508.6C252.8 513 243.6 513.1 236.1 508.9C228.6 504.6 224 496.6 224 488V373.3C224 350.6 215 328.1 199 312.1C183 296.1 161.4 288 138.7 288H24C15.38 288 7.414 283.4 3.146 275.9C-1.123 268.4-1.042 259.2 3.357 251.8L55.83 163.3C68.79 141.4 92.33 127.1 117.8 127.1H199.9C281.7-3.798 408.8-8.546 483.9 5.272C495.6 7.411 504.6 16.45 506.7 28.07C520.5 103.2 515.8 230.3 384 312.1V312.1zM197.9 253.9C210.8 260.2 222.6 268.7 232.1 279C243.3 289.4 251.8 301.2 258.1 314.1C363.9 284.1 414.8 234.5 439.7 188C464.7 141.3 466.1 90.47 461.7 50.33C421.5 45.02 370.7 47.34 323.1 72.33C277.5 97.16 227.9 148.1 197.9 253.9H197.9zM41.98 345.5C76.37 311.1 132.1 311.1 166.5 345.5C200.9 379.9 200.9 435.6 166.5 470C117 519.5 .4765 511.5 .4765 511.5C.4765 511.5-7.516 394.1 41.98 345.5V345.5zM64.58 447.4C64.58 447.4 103.3 450.1 119.8 433.6C131.2 422.2 131.2 403.6 119.8 392.2C108.3 380.8 89.81 380.8 78.38 392.2C61.92 408.7 64.58 447.4 64.58 447.4z" fill="var(--ci-primary-color)"></path></svg>
                                 </div>
                                 <p class="titleCategories" style="line-height: 15px;padding-top: 5px;">Spaceman</p>
                                 
                             </a>

                             <a href="/games/play/4693/9328"
                             
                             class="flex flex-col justify-center items-center min-w-[80px] text-center ">
                                 <div class="flex items-center justify-center p-4" style="background-color: var(--ci-primary-opacity-color);border-radius: 50%;width: 62px;height: 62px;">
                                    <svg class="control-svgWidth" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path d="M175 141.2C184.4 131.8 199.6 131.8 208.1 141.2L291.3 223.5C313.2 245.4 313.2 280.8 291.3 302.7C269.5 324.6 234 324.6 212.1 302.7L208.1 299.5C208.7 299.2 208.3 298.9 207.1 298.6V335.1H223.1C232.8 335.1 239.1 343.2 239.1 351.1C239.1 360.8 232.8 367.1 223.1 367.1H159.1C151.2 367.1 143.1 360.8 143.1 351.1C143.1 343.2 151.2 335.1 159.1 335.1H175.1V298.6C175.7 298.9 175.3 299.2 175 299.5L171.9 302.7C149.1 324.6 114.5 324.6 92.67 302.7C70.8 280.8 70.8 245.4 92.67 223.5L175 141.2zM0 64C0 28.65 28.65 0 64 0H320C355.3 0 384 28.65 384 64V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM48 64V448C48 456.8 55.16 464 64 464H320C328.8 464 336 456.8 336 448V64C336 55.16 328.8 48 320 48H64C55.16 48 48 55.16 48 64z" fill="var(--ci-primary-color)"></path></svg>
                                 </div>
                                 <p class="titleCategories" style="line-height: 15px;padding-top: 5px;">Blackjack</p>
                                 
                             </a>

                             <a href="/games/play/4456/9568"
                             
                             class="flex flex-col justify-center items-center min-w-[80px] text-center ">
                                 <div class="flex items-center justify-center p-4" style="background-color: var(--ci-primary-opacity-color);border-radius: 50%;width: 62px;height: 62px;">
                                    <svg class="control-svgWidth" viewBox="0 0 95 95" xmlns="http://www.w3.org/2000/svg" lined="true"><path d="M59.4,10.9c-3.7-1.2-7.7-1.9-11.9-1.9v11.9c2.9,0,5.6.5,8.2,1.3l3.7-11.3ZM69,31.9l9.6-7c-2.4-3.3-5.2-6.1-8.5-8.5l-7,9.6c2.3,1.6,4.3,3.6,5.9,5.9ZM69,63.1l9.6,7c2.4-3.2,4.2-6.8,5.5-10.7l-11.3-3.7c-.8,2.7-2.1,5.2-3.8,7.4ZM35.6,84.1c3.8,1.2,7.8,1.9,11.9,1.9v-11.9c-2.9,0-5.6-.5-8.2-1.3l-3.7,11.3ZM26,63.1l-9.6,7c2.4,3.3,5.2,6.1,8.5,8.5l7-9.6c-2.3-1.6-4.3-3.6-5.9-5.9ZM20.9,47.5h-11.9c0,4.2.7,8.2,1.9,11.9l11.3-3.7c-.9-2.6-1.3-5.3-1.3-8.2ZM26,31.9l-9.6-7c-2.4,3.2-4.2,6.8-5.5,10.7l11.3,3.7c.9-2.7,2.1-5.2,3.8-7.4ZM39.3,22.2l-3.7-11.3c-3.9,1.3-7.5,3.1-10.7,5.5l7,9.6c2.2-1.7,4.7-2.9,7.4-3.8ZM74.1,47.5h11.9c0-4.2-.7-8.2-1.9-11.9l-11.3,3.7c.9,2.6,1.3,5.3,1.3,8.2ZM55.7,72.8l3.7,11.3c3.9-1.3,7.5-3.1,10.7-5.5l-7-9.6c-2.2,1.7-4.7,2.9-7.4,3.8Z" fill="var(--ci-primary-color)" opacity="0.7"></path><path d="M47.5,0C21.3,0,0,21.3,0,47.5s21.3,47.5,47.5,47.5,47.5-21.3,47.5-47.5S73.7,0,47.5,0ZM47.5,88.7c-22.7,0-41.2-18.5-41.2-41.2S24.8,6.3,47.5,6.3s41.2,18.5,41.2,41.2-18.5,41.2-41.2,41.2ZM23.6,47.5c0,13.2,10.7,23.9,23.9,23.9s23.9-10.7,23.9-23.9-10.7-23.9-23.9-23.9-23.9,10.7-23.9,23.9ZM34,44.6c.6,0,1.1.2,1.5.4,1.4.9,3.1,1.1,4.8,1.1h1.6c.5-2.1,2.1-3.7,4.2-4.2v-1.6c0-1.7-.3-3.4-1.1-4.8-.3-.4-.4-1-.4-1.5,0-1.6,1.3-2.9,2.9-2.9s2.9,1.3,2.9,2.9-.2,1.1-.4,1.5c-.9,1.4-1.1,3.1-1.1,4.8v1.6c2.1.5,3.7,2.1,4.2,4.2h1.6c1.7,0,3.4-.3,4.8-1.1.4-.3,1-.4,1.5-.4,1.6,0,2.9,1.3,2.9,2.9s-1.3,2.9-2.9,2.9-1.1-.2-1.5-.4c-1.4-.9-3.1-1.1-4.8-1.1h-1.6c-.5,2.1-2.1,3.7-4.2,4.2v1.6c0,1.7.3,3.4,1.1,4.8.3.4.4,1,.4,1.5,0,1.6-1.3,2.9-2.9,2.9s-2.9-1.3-2.9-2.9.2-1.1.4-1.5c.9-1.4,1.1-3.1,1.1-4.8v-1.6c-2.1-.5-3.7-2.1-4.2-4.2h-1.6c-1.7,0-3.4.3-4.8,1.1-.4.3-1,.4-1.5.4-1.6,0-2.9-1.3-2.9-2.9s1.3-2.9,2.9-2.9Z" fill="var(--ci-primary-color)"></path></svg>
                                 </div>
                                 <p class="titleCategories" style="line-height: 15px;padding-top: 5px;">Roleta</p>
                                 
                             </a>
                             <a href="/games/play/5197/12544"
                             
                             class="flex flex-col justify-center items-center min-w-[80px] text-center ">
                                 <div class="flex items-center justify-center p-4" style="background-color: var(--ci-primary-opacity-color);border-radius: 50%;width: 62px;height: 62px;">
                                  <svg class="control-svgWidth" viewBox="0 0 296.6 330.5" xmlns="http://www.w3.org/2000/svg" lined="true"><path d="M141.2,133.8c-.2,9.8-9,18-18.8,17.5-9.7-.4-17.5-8.9-17.1-18.6.4-9.7,8.7-17.5,18.4-17.2,9.7.3,17.7,8.7,17.5,18.3ZM123.3,48.8c0-9.8-8-17.5-17.9-17.6-9.9,0-17.9,7.7-18,17.5,0,9.9,8.1,18,18.2,17.9,9.8,0,17.8-8.1,17.7-17.9ZM70,171.4c-10.1-.2-18.4,7.7-18.5,17.6-.1,9.5,7.9,17.8,17.2,17.9,10.5.1,18.5-7.3,18.7-17.3.2-9.9-7.5-17.9-17.4-18.2ZM77.3,125.3c0-9.7-8-17.7-17.8-17.8-9.7,0-17.9,7.9-18,17.6-.2,9.7,8.4,18.2,18.2,18.1,9.7,0,17.7-8.2,17.7-18ZM166.3,228.4c-10,0-17.9,7.7-18,17.5-.1,10,7.6,17.9,17.5,17.9,10.3,0,18.5-7.9,18.4-17.7-.1-9.8-8.1-17.7-17.9-17.8ZM265.2,189.3c.1-9.6-8-17.8-17.7-17.9-10.2,0-18.2,7.8-18.1,17.9,0,9.9,7.9,17.6,17.8,17.7,9.8,0,17.9-7.9,18-17.7ZM258.3,122.7c0-9.8-7.9-17.9-17.6-18-9.8-.2-18.3,8.2-18.2,18,0,9.6,8.2,17.7,18,17.8,9.7,0,17.9-8.1,17.9-17.7Z" fill="var(--ci-primary-color)" opacity="0.4"></path><path d="M296.5,148.2c1.8-68.1-42.7-127.4-107.9-143.6C156.1-3.5,124.3-1,94,13.1,53.4,31.8,27.4,63.5,14.7,106c-8.8-1.6-14.4,1.6-14.5,8.7-.3,19-.2,38,0,57,0,6.2,5.1,10,11.1,9.3,1.1-.1,2.2-.3,3.2-.4,17,54,52.7,88,107.3,102.7v13.6c-2.1,0-3.9,0-5.7,0-20.3,0-40.7.2-61,0-14.6-.2-19.5,2.8-18.8,18.9.5,10.7,4.2,14.8,14.9,14.8,63.5,0,127,0,190.5,0,15.9,0,18.4-2.5,18.4-18.6,0-11.1-3.9-14.9-15.1-14.9-21.7,0-43.3,0-65,0-1.8,0-3.5-.2-5.3-.3v-11.7c72.4-11.9,120-72.1,121.7-136.8ZM148.4,245.9c.1-9.9,8-17.5,18-17.5,9.8,0,17.8,7.9,17.9,17.8.1,9.8-8.1,17.8-18.4,17.7-9.9,0-17.6-8-17.5-17.9ZM247.2,207c-10,0-17.8-7.8-17.8-17.7,0-10.1,7.9-17.9,18.1-17.9,9.7,0,17.8,8.3,17.7,17.9-.1,9.8-8.2,17.7-18,17.7ZM240.7,104.7c9.8.2,17.6,8.3,17.6,18,0,9.7-8.2,17.8-17.9,17.7-9.7,0-17.9-8.1-18-17.8,0-9.9,8.4-18.2,18.2-18ZM141.2,133.8c-.2,9.8-9,18-18.8,17.5-9.7-.4-17.5-8.9-17.1-18.6.4-9.7,8.7-17.5,18.4-17.2,9.7.3,17.7,8.7,17.5,18.3ZM105.4,31.2c9.9,0,17.9,7.8,17.9,17.6,0,9.8-7.9,17.8-17.7,17.9-10.1,0-18.3-8-18.2-17.9,0-9.8,8-17.6,18-17.5ZM59.5,107.6c9.8,0,17.9,8.1,17.8,17.8,0,9.8-8.1,17.9-17.7,18-9.8,0-18.3-8.4-18.2-18.1.2-9.7,8.3-17.7,18-17.6ZM51.5,189c.1-9.9,8.4-17.8,18.5-17.6,9.8.2,17.5,8.3,17.4,18.2-.2,10-8.2,17.5-18.7,17.3-9.3-.1-17.3-8.4-17.2-17.9Z" fill="var(--ci-primary-color)"></path></svg>
                                 </div>
                                 <p class="titleCategories" style="line-height: 15px;padding-top: 5px;">Bingo</p>
                                 
                             </a>

                        </div> -->
                <!-- </div> -->
                <!-- </div> -->
                <!-- </div> -->
                <div v-if="loading">
                    <!-- Aplicar o efeito shimmer enquanto os dados estão carregando -->
                    <div
                        v-if="loading"
                        class="shimmer4 shimmer-estilos-banner2"
                        v-for="n in 1"
                        :key="n"
                    ></div>
                </div>
                <div v-else>
                    <div><LastWinnersComponent></LastWinnersComponent></div>
                </div>
                <div class="mt-2">
                    <Carousel
                        v-bind="settingsRecommended"
                        :breakpoints="breakpointsRecommended"
                        ref="carouselSubBanner"
                    >
                        <Slide
                            v-for="(banner, index) in bannersHome"
                            :key="index"
                        >
                            <div
                                class="carousel__item min-h-[60px] md:min-h-[150px] rounded-2xl w-full mr-4"
                            >
                                <a
                                    :href="banner.link"
                                    class="w-full h-full rounded-2xl"
                                >
                                    <img
                                        :src="`/storage/` + banner.image"
                                        alt=""
                                        class="h-full w-full rounded-2xl"
                                    />
                                </a>
                            </div>
                        </Slide>

                        <template #addons> </template>
                    </Carousel>
                </div>

                <div v-if="loading">
                    <!-- Aplicar o efeito shimmer enquanto os dados estão carregando -->
                    <div
                        v-if="loading"
                        class="shimmer2 item-game"
                        v-for="n in 13"
                        :key="n"
                    >
                        <div v-if="featured_games" class="mt-3">
                            <div class="w-full flex justify-between">
                                <div class="flex items-center">
                                    <h2 class="text-lg providersNames">
                                        {{ $t("Recomendados") }}
                                    </h2>
                                    <button
                                        @click.prevent="ckCarousel.prev()"
                                        class="item-game px-1 py-1 rounded-lg text-[12px] celular-providers-setas disabled:opacity-75"
                                    >
                                        <svg
                                            height="1rem"
                                            viewBox="0 0 320 512"
                                            width="1rem"
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="c0rV3 zB6RE"
                                        >
                                            <path
                                                d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"
                                                fill="currentColor"
                                            ></path>
                                        </svg>
                                    </button>
                                    <button
                                        @click.prevent="ckCarousel.next()"
                                        class="item-game px-1 py-1 rounded-lg text-[12px] celular-providers-setas"
                                    >
                                        <svg
                                            height="1rem"
                                            viewBox="0 0 320 512"
                                            width="1rem"
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="c0rV3"
                                        >
                                            <path
                                                d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"
                                                fill="currentColor"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex"></div>
                            </div>

                            <Carousel
                                class="item-sombra2"
                                ref="fgCarousel"
                                v-bind="settingsGames"
                                :breakpoints="breakpointsGames"
                                @init="onCarouselInit(index)"
                                @slide-start="onSlideStart(index)"
                            >
                                <Slide
                                    v-if="loading"
                                    v-for="(i, loading) in 10"
                                    :index="loading"
                                >
                                    <div
                                        role="status"
                                        class="w-full flex items-center justify-center h-48 mr-6 max-w-sm bg-gray-300 rounded-lg animate-pulse dark:bg-gray-700 text-4xl"
                                    >
                                        <i class="fa fa-gamepad-modern"></i>
                                    </div>
                                </Slide>

                                <Slide
                                    v-if="featured_games && !loading"
                                    v-for="(game, providerId) in featured_games"
                                    :index="providerId"
                                    class="p-2"
                                >
                                    <CassinoGameCard
                                        :index="providerId"
                                        :title="game.game_name"
                                        :cover="game.cover"
                                        :gamecode="game.game_code"
                                        :type="game.distribution"
                                        :game="game"
                                    />
                                </Slide>
                            </Carousel>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <div v-if="featured_games" class="mt-3">
                        <div class="w-full flex justify-between">
                            <div class="flex items-center">
                                <h2 class="text-lg providersNames">
                                    {{ $t("MAIS JOGADOS") }}
                                </h2>
                                <button
                                    @click.prevent="fgCarousel.prev()"
                                    class="item-game px-1 py-1 rounded-lg text-[12px] celular-providers-setas disabled:opacity-75"
                                >
                                    <svg
                                        height="1rem"
                                        viewBox="0 0 320 512"
                                        width="1rem"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="c0rV3 zB6RE"
                                    >
                                        <path
                                            d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"
                                            fill="currentColor"
                                        ></path>
                                    </svg>
                                </button>
                                <button
                                    @click.prevent="fgCarousel.next()"
                                    class="item-game px-1 py-1 rounded-lg text-[12px] celular-providers-setas"
                                >
                                    <svg
                                        height="1rem"
                                        viewBox="0 0 320 512"
                                        width="1rem"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="c0rV3"
                                    >
                                        <path
                                            d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"
                                            fill="currentColor"
                                        ></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex"></div>
                        </div>

                        <Carousel
                            class="item-sombra2"
                            ref="fgCarousel"
                            v-bind="settingsGames"
                            :breakpoints="breakpointsGames"
                            @init="onCarouselInit(index)"
                            @slide-start="onSlideStart(index)"
                        >
                            <Slide
                                v-if="loading"
                                v-for="(i, loading) in 10"
                                :index="loading"
                            >
                                <div
                                    role="status"
                                    class="w-full flex items-center justify-center h-48 mr-6 max-w-sm bg-gray-300 rounded-lg animate-pulse dark:bg-gray-700 text-4xl"
                                >
                                    <i class="fa fa-gamepad-modern"></i>
                                </div>
                            </Slide>

                            <Slide
                                v-if="featured_games && !loading"
                                v-for="(game, providerId) in featured_games"
                                :index="providerId"
                                class="p-2"
                            >
                                <CassinoGameCard
                                    :index="providerId"
                                    :title="game.game_name"
                                    :cover="game.cover"
                                    :gamecode="game.game_code"
                                    :type="game.distribution"
                                    :game="game"
                                />
                            </Slide>
                        </Carousel>
                    </div>
                </div>

                <!-- <div class="grid grid-cols-2 md:grid-cols-6 gap-4 mb-5">
                        <CassinoGameCard
                            v-for="(game, index) in featured_games"
                            :index="index"
                            :title="game.game_name"
                            :cover="game.cover"
                            :gamecode="game.game_code"
                            :type="game.distribution"
                            :game="game"
                        />
                    </div> -->

                <div class="">
                    <ShowProviders
                        v-for="(provider, index) in providers"
                        :provider="provider"
                        :index="index"
                    />
                </div>
            </div>
        </div>
    </BaseLayout>
</template>

<script>
import { Carousel, Navigation, Pagination, Slide } from "vue3-carousel";
import { onMounted, ref } from "vue";

import BaseLayout from "@/Layouts/BaseLayout.vue";
import MakeDeposit from "@/Components/UI/MakeDeposit.vue";
import { RouterLink, useRoute } from "vue-router";
import { useAuthStore } from "@/Stores/Auth.js";
import LanguageSelector from "@/Components/UI/LanguageSelector.vue";
import CassinoGameCard from "@/Pages/Cassino/Components/CassinoGameCard.vue";
import HttpApi from "@/Services/HttpApi.js";
import ShowCarousel from "@/Pages/Home/Components/ShowCarousel.vue";
import { useSettingStore } from "@/Stores/SettingStore.js";
import LoadingComponent from "@/Components/UI/LoadingComponent.vue";
import ShowProviders from "@/Pages/Home/Components/ShowProviders.vue";
import { searchGameStore } from "@/Stores/SearchGameStore.js";
import CustomPagination from "@/Components/UI/CustomPagination.vue";
import LastWinnersComponent from "@/Components/UI/LastWinnersComponent.vue";

export default {
    props: [],
    components: {
        CustomPagination,
        Pagination,
        ShowProviders,
        LoadingComponent,
        ShowCarousel,
        CassinoGameCard,
        Carousel,
        Navigation,
        Slide,
        LanguageSelector,
        MakeDeposit,
        BaseLayout,
        RouterLink,
        LastWinnersComponent,
    },
    data() {
        return {
            isLoading: true,
            loading: true,
            /// banners settings
            settings: {
                itemsToShow: 1,
                snapAlign: "center",
                autoplay: 6000,
                wrapAround: true,
            },
            breakpoints: {
                700: {
                    itemsToShow: 1,
                    snapAlign: "center",
                },
                1024: {
                    itemsToShow: 1,
                    snapAlign: "center",
                },
            },

            settingsRecommended: {
                itemsToShow: 2,
                snapAlign: "start",
            },
            breakpointsRecommended: {
                700: {
                    itemsToShow: 3,
                    snapAlign: "center",
                },
                1024: {
                    itemsToShow: 3,
                    snapAlign: "start",
                },
            },

            /// banners
            banners: null,
            bannersHome: null,

            settingsGames: {
                itemsToShow: 2.5,
                snapAlign: "start",
            },
            breakpointsGames: {
                700: {
                    itemsToShow: 3.5,
                    snapAlign: "center",
                },
                1024: {
                    itemsToShow: 6,
                    snapAlign: "start",
                },
            },
            settingsImages: {
                itemsToShow: 2,
                snapAlign: "start",
            },
            providers: null,

            featured_games: null,
            categories: null,
        };
    },
    setup(props) {
        const ckCarouselOriginals = ref(null);
        const fgCarousel = ref(null);

        onMounted(() => {});

        return {
            ckCarouselOriginals,
            fgCarousel,
        };
    },
    computed: {
        searchGameStore() {
            return searchGameStore();
        },
        userData() {
            const authStore = useAuthStore();
            return authStore.user;
        },
        isAuthenticated() {
            const authStore = useAuthStore();
            return authStore.isAuth;
        },
        setting() {
            const settingStore = useSettingStore();
            return settingStore.setting;
        },
    },
    mounted() {
        window.scrollTo(0, 0);
        window.addEventListener("scroll", () => {
            const btnScrollTop = document.querySelector(".btn-scroll-top");
            if (window.scrollY > 100) {
                btnScrollTop.classList.add("show-btn-scroll-top");
            } else {
                btnScrollTop.classList.remove("show-btn-scroll-top");
            }
        });
    },
    methods: {
        scrollToTop() {
            window.scrollTo({ top: 0, behavior: "smooth" });
        },
        getCasinoCategories: async function () {
            const _this = this;
            await HttpApi.get("categories")
                .then((response) => {
                    _this.categories = response.data.categories;
                })
                .catch((error) => {
                    Object.entries(
                        JSON.parse(error.request.responseText)
                    ).forEach(([key, value]) => {});
                });
        },
        toggleSearch: function () {
            this.searchGameStore.setSearchGameToogle();
        },
        getBanners: async function () {
            const _this = this;

            try {
                const response = await HttpApi.get("settings/banners");
                const allBanners = response.data.banners;

                _this.banners = allBanners.filter(
                    (banner) => banner.type === "carousel"
                );
                _this.bannersHome = allBanners.filter(
                    (banner) => banner.type === "home"
                );
            } catch (error) {
                console.error(error);
            } finally {
            }
        },
        getAllGames: async function () {
            const _this = this;
            return await HttpApi.get("games/all")
                .then(async (response) => {
                    if (response.data !== undefined) {
                        _this.providers = response.data.providers;
                        _this.isLoading = false;
                        _this.loading = false;
                    }
                })
                .catch((error) => {
                    Object.entries(
                        JSON.parse(error.request.responseText)
                    ).forEach(([key, value]) => {
                        console.log(`${value}`);
                    });
                    _this.isLoading = false;
                    _this.loading = false;
                });
        },
        getFeaturedGames: async function () {
            const _this = this;
            return await HttpApi.get("featured/games")
                .then(async (response) => {
                    _this.featured_games = response.data.featured_games;
                    _this.isLoading = false;
                    _this.loading = false;
                })
                .catch((error) => {
                    Object.entries(
                        JSON.parse(error.request.responseText)
                    ).forEach(([key, value]) => {
                        console.log(`${value}`);
                    });
                    _this.isLoading = false;
                    _this.loading = false;
                });
        },
        initializeMethods: async function () {
            await this.getCasinoCategories();
            await this.getBanners();
            await this.getAllGames();
            await this.getFeaturedGames();
        },
        onCarouselInit(index) {},
        onSlideStart(index) {},
    },
    async created() {
        await this.initializeMethods();
    },
    watch: {},
};
</script>
