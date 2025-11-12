<style>
html {
    font-family: Montserrat, -apple-system, Segoe UI, Roboto, Helvetica Neue,
        Arial, sans-serif;
}
body {
    font-family: Montserrat, -apple-system, Segoe UI, Roboto, Helvetica Neue,
        Arial, sans-serif;
}
.gray-scale-menu {
    color: #fdffffb3;
    display: flex;
    font-size: 0.875rem;
    font-weight: 600;
    filter: grayscale(100%);
    filter: gray; /* IE6-9 */
    -webkit-filter: grayscale(100%);
}
.sidebar {
    position: fixed; /* se sidebar for fixed */
    top: 0;
    left: 0;
    z-index: 50;
    /* outras propriedades */
}
/* Fundo do select */
.sidebar-select {
    background-color: #000f21;
    color: white;
    border-color: #4b5563; /* Tailwind border-gray-600 */
}

/* Remover borda branca ao focar */
.sidebar-select:focus {
    border-color: #000f21;
    box-shadow: none;
    outline: none;
}

/* Abrir o select para cima */
.sidebar-select {
    position: relative;
}

.sidebar-select option {
    background-color: #000f21;
    color: white;
    padding: 10px 10px;
}

/* Hover nas opções */
.sidebar-select option:hover {
    background-color: #1e293b; /* Exemplo de hover mais claro, pode ajustar */
}

.filter-gray-hover {
    transition: 0ms;
}
.filter-gray-hover:hover {
    filter: grayscale(100%) brightness(180%);
    transition: 0ms;
    color: white;
    -webkit-filter: grayscale(100%) brightness(180%);
    -moz-filter: grayscale(100%) brightness(180%);
}
.texto-categoria:hover {
    color: white;
}
.opacidade-hover:hover {
    opacity: 0.9;
}
.opacidade-1-texto-menu {
    color: #a8bebe;
}
.opacidade-1-texto-menu:hover {
    color: white;
    opacity: 1;
}
.texto-categoria {
    display: flex;
    align-items: center;
    gap: 8px; /* espaço entre imagem e texto */
}

.texto-categoria img {
    width: 20px;
    height: 20px;
}
.icon-categoria {
    width: 28px; /* ou ajuste baseado no ícone do cassino */
    height: 28px;
    display: inline-block;
}
svg {
    width: 25px;
    height: 25px;
}
</style>
<template>
    <aside
        :class="[
            sidebar === true
                ? 'translate-x-0 lg:w-[65px] w-[100%]'
                : '-translate-x-full lg:translate-x-0 lg:w-[280px] w-[100%]',
        ]"
        class="fixed left-0 z-30 top-0 overflow-auto h-screen transition-transform"
        aria-label="Sidebar"
        :style="{
            paddingTop: sidebarPaddingTop,
        }"
    >
        <div
            v-if="!sidebar"
            class="h-full pb-4 overflow-y-auto tirar-cedo"
            :style="{
                backgroundImage:
                    'linear-gradient(to bottom, var(--ci-gray-dark), var(--card-color-dark), var(--ci-gray-dark))',
                borderRight: '1px solid #27292a',
            }"
        >
            <div class="px-4">
                <!-- BOTÕES -->
                <button
                    @click.prevent="$router.push('/profile/affiliate')"
                    class="opacidade-hover rounded-[3px] flex w-full items-center h-auto mb-3"
                    style="
                        justify-content: space-between;
                        padding: 6px 20px;
                        padding-right: 25px;
                        margin-top: 120px;
                        background-color: #5701ca;
                    "
                >
                    <h1
                        style="
                            font-size: 0.9rem;
                            font-weight: bold;
                            line-height: 1.25rem;
                            color: white;
                        "
                    >
                        Ganhe até R$ 50,00 Reais
                    </h1>
                    <span
                        style="max-width: 20px; margin-left: -10px"
                        class="text-[25px]"
                        >💰</span
                    >
                </button>

                <!-- RESTO DOS BOTÕES -->
                <button
                    class="opacidade-hover rounded-[3px] flex w-full items-center h-auto mb-3"
                    style="
                        justify-content: space-between;
                        padding: 6px 20px;
                        padding-right: 25px;
                        background-color: #5922bf;
                    "
                >
                    <div
                        class="flex flex-col items-start"
                        style="line-height: 13px"
                    >
                        <p style="font-size: 12px">Veja Nossas</p>
                        <h1
                            style="
                                font-size: 0.9rem;
                                font-weight: bold;
                                color: white;
                            "
                        >
                            Promoções e Giros Free
                        </h1>
                    </div>
                    <span
                        style="max-width: 20px; margin-left: -10px"
                        class="text-[25px]"
                        >🎁</span
                    >
                </button>

                <!-- OUTRO BOTÃO -->
                <button
                    @click="toggleMissionModal"
                    class="opacidade-hover rounded-[3px] flex w-full items-center h-auto"
                    style="
                        justify-content: space-between;
                        padding: 6px 20px;
                        padding-right: 25px;
                        background-color: #5922bf;
                    "
                >
                    <div
                        class="flex flex-col items-start"
                        style="line-height: 13px"
                    >
                        <p style="font-size: 12px">Participe das</p>
                        <h1
                            style="
                                font-size: 0.9rem;
                                font-weight: bold;
                                color: white;
                            "
                        >
                            Missões Club Vip
                        </h1>
                    </div>
                    <span
                        style="max-width: 20px; margin-left: -10px"
                        class="text-[25px]"
                        >🎯</span
                    >
                </button>
            </div>
            <div
                style="
                    width: 100%;
                    height: 0.1rem;
                    background-color: #27292a;
                    margin-top: 20px;
                "
            ></div>

            <div v-if="loading">
                <!-- Aplicar o efeito shimmer enquanto os dados estão carregando -->
                <div
                    v-if="loading"
                    class="shimmer"
                    v-for="n in 13"
                    :key="n"
                    style="height: 20px; margin-bottom: 10px"
                ></div>
            </div>
            <div v-else>
                <!-- Cassino - categoria -->
                <div
                    @click="toggleCassino"
                    class="flex items-center px-4 py-2 texto-categoria font-semibold cursor-pointer w-full"
                >
                    <span class="text-white uppercase ml-3">CASSINO</span>
                    <!-- Ícone da seta -->
                    <svg
                        :class="{ 'rotate-90': isCassinoOpen }"
                        class="ml-auto transition-transform duration-300"
                        xmlns="http://www.w3.org/2000/svg"
                        height="1em"
                        viewBox="0 0 320 512"
                        fill="currentColor"
                    >
                        <path
                            d="M96 96c-8.188 0-16.38 3.125-22.62 9.375c-12.5 12.5-12.5 32.75 0 45.25L178.8 256l-105.4 105.4c-12.5 12.5-12.5 32.75 0 45.25C79.63 418.9 87.81 422 96 422s16.38-3.125 22.62-9.375l128-128c12.5-12.5 12.5-32.75 0-45.25l-128-128C112.4 99.13 104.2 96 96 96z"
                        />
                    </svg>
                </div>

                <ul
                    v-show="isCassinoOpen"
                    class="space-y-2 font-medium py-2 px-4 ml-3"
                >
                    <li v-for="(category, index) in categories" :key="index">
                        <RouterLink
                            v-if="!category.url"
                            :to="{
                                name: 'casinosAll',
                                params: {
                                    provider: 'all',
                                    category: category.slug,
                                },
                            }"
                            active-class="category-active"
                            class="flex flex-row items-center py-2 texto-categoria opacidade-1-texto-menu gray-scale-menu filter-gray-hover"
                        >
                            <img
                                :src="`/storage/` + category.image"
                                alt=""
                                class="w-[24px] h-[24px] mr-1 shrink-0 object-contain"
                            />
                            <span>{{ $t(category.name) }}</span>
                        </RouterLink>
                        <a
                            v-else
                            :href="category.url"
                            active-class="category-active"
                            class="flex flex-row items-center py-2 texto-categoria opacidade-1-texto-menu gray-scale-menu filter-gray-hover"
                        >
                            <img
                                :src="`/storage/` + category.image"
                                alt=""
                                class="w-[24px] h-[24px] mr-1 shrink-0 object-contain"
                            />
                            <span>{{ $t(category.name) }}</span>
                        </a>
                    </li>
                </ul>

                <!-- Linha separadora -->
                <hr class="my-3 border-gray-400 opacity-40" />

             
            </div>
        </div>
        <div v-else>
            <div
                class="h-[100vh] overflow-auto flex-col justify-between px-2 py-2 hidden lg:flex tirar-cedo"
                style="
                    padding-top: 120px;
                    color: var(--title-color);
                    background-image: linear-gradient(
                        to bottom,
                        var(--ci-gray-dark),
                        var(--card-color-dark),
                        var(--ci-gray-dark)
                    );
                    border-right: 1px solid #27292a;
                "
            >
                <ul>
                    <li class="mb-3" title="Ganhe Até R$ 50,00 Reais">
                        <div
                            @click.prevent="$router.push('/profile/affiliate')"
                            class="flex items-center justify-center hover:opacity-80 py-2 rounded-[3px] text-center cursor-pointer"
                            style="background-color: "
                        >
                            <span class="text-[20px] text-white">💰</span>
                        </div>
                    </li>

                    <li class="mb-3" title="Promoções e Giros Free">
                        <div
                            class="flex items-center justify-center hover:opacity-80 py-2 rounded-[3px] text-center cursor-pointer"
                            style="background-color: #5922bf"
                        >
                            <span class="text-[20px] text-white">🎁</span>
                        </div>
                    </li>

                    <li class="mb-3" title="Missões Club Vip">
                        <div
                            @click="toggleMissionModal"
                            class="flex items-center justify-center hover:opacity-80 py-2 rounded-[3px] text-center cursor-pointer"
                            style="background-color: #5922bf"
                        >
                            <span class="text-[20px] text-white">🎯</span>
                        </div>
                    </li>
                    <li
                        v-for="(category, index) in categories"
                        :key="index"
                        :title="$t(category.name)"
                        class="mb-3"
                    >
                        <RouterLink
                            v-if="!category.url"
                            :to="{
                                name: 'casinosAll',
                                params: {
                                    provider: 'all',
                                    category: category.slug,
                                },
                            }"
                            active-class="category-active"
                            class="flex items-center justify-center hover:bg-gray-600 rounded-[3px] py-3 text-center"
                            style="background-color: var(--sidebar-color)"
                        >
                            <img
                                class="gray-scale-menu"
                                :src="`/storage/` + category.image"
                                alt=""
                                width="26"
                            />
                        </RouterLink>
                        <a
                            v-else
                            :href="category.url"
                            active-class="category-active"
                            class="flex items-center justify-center hover:bg-gray-600 rounded-[3px] py-3 text-center"
                            style="background-color: var(--sidebar-color)"
                        >
                            <img
                                class="gray-scale-menu"
                                :src="`/storage/` + category.image"
                                alt=""
                                width="26"
                            />
                        </a>
                    </li>
                    <li :title="$t('Minhas Apostas')" class="mb-3">
                        <RouterLink
                            to="games/play/1458/sport"
                            active-class="category-active"
                            class="flex items-center justify-center hover:bg-gray-600 rounded-[3px] py-3 text-center"
                            style="background-color: var(--sidebar-color)"
                        >
                            <svg
                                class="w-[24px] h-[24px] text-white"
                                height="1em"
                                viewBox="0 0 576 512"
                                width="1em"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M448 128C465.7 128 480 142.3 480 160V352C480 369.7 465.7 384 448 384H128C110.3 384 96 369.7 96 352V160C96 142.3 110.3 128 128 128H448zM448 160H128V352H448V160z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    d="M128 160H448V352H128V160zM512 64C547.3 64 576 92.65 576 128V208C549.5 208 528 229.5 528 256C528 282.5 549.5 304 576 304V384C576 419.3 547.3 448 512 448H64C28.65 448 0 419.3 0 384V304C26.51 304 48 282.5 48 256C48 229.5 26.51 208 0 208V128C0 92.65 28.65 64 64 64H512zM96 352C96 369.7 110.3 384 128 384H448C465.7 384 480 369.7 480 352V160C480 142.3 465.7 128 448 128H128C110.3 128 96 142.3 96 160V352z"
                                    fill="currentColor"
                                    opacity="0.4"
                                ></path>
                            </svg>
                        </RouterLink>
                    </li>
                    <!-- Jogos ao Vivo -->
                    <li :title="$t('JOGOS AO VIVO')" class="mb-3">
                        <RouterLink
                            to="games/play/1458/sport"
                            active-class="category-active"
                            class="flex items-center justify-center hover:bg-gray-600 rounded-[3px] py-3 text-center"
                            style="background-color: var(--sidebar-color)"
                        >
                            <svg
                                class="w-[24px] h-[24px] text-white"
                                height="1em"
                                viewBox="0 0 512 512"
                                width="1em"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    class="primary"
                                    d="M201.9 32l-128 128h92.13l128-128H201.9zM64 32C28.65 32 0 60.65 0 96v64h6.062l128-128H64zM326.1 160l127.4-127.4C451.7 32.39 449.9 32 448 32h-86.06l-128 128H326.1zM497.7 56.19L393.9 160H512V96C512 80.87 506.5 67.15 497.7 56.19zM224.3 241.7C221.1 239.5 216.9 239.5 213.5 241.4C210.1 243.3 208 247 208 251v137.9c0 4.008 2.104 7.705 5.5 9.656C215.1 399.5 216.9 400 218.7 400c1.959 0 3.938-.5605 5.646-1.682l106.7-68.97C334.1 327.3 336 323.8 336 319.1s-1.896-7.34-5.021-9.354L224.3 241.7z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    class="secondary"
                                    d="M0 160v256c0 35.35 28.65 64 64 64h384c35.35 0 64-28.65 64-64V160H0zM330.1 329.3l-106.7 68.97C222.6 399.4 220.6 400 218.7 400c-1.77 0-3.562-.4648-5.166-1.379C210.1 396.7 208 392.1 208 388.1V251c0-4.01 2.104-7.705 5.5-9.656c3.375-1.918 7.562-1.832 10.81 .3027l106.7 68.97C334.1 312.7 336 316.2 336 319.1S334.1 327.3 330.1 329.3z"
                                    fill="currentColor"
                                    opacity="0.4"
                                ></path>
                            </svg>
                        </RouterLink>
                    </li>

                    <!-- Começa em Breve -->
                    <li :title="$t('COMEÇA EM BREVE')" class="mb-3">
                        <RouterLink
                            to="games/play/1458/sport"
                            active-class="category-active"
                            class="flex items-center justify-center hover:bg-gray-600 rounded-[3px] py-3 text-center"
                            style="background-color: var(--sidebar-color)"
                        >
                            <svg
                                class="w-[24px] h-[24px] text-white"
                                height="1em"
                                viewBox="0 0 512 512"
                                width="1em"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M159 159C168.4 149.7 183.6 149.7 192.1 159L272.1 239C282.3 248.4 282.3 263.6 272.1 272.1C263.6 282.3 248.4 282.3 239 272.1L159 192.1C149.7 183.6 149.7 168.4 159 159V159z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    d="M224 32C224 14.33 238.3 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 184.4 29.46 119.6 76.84 73.14C89.46 60.78 109.7 60.98 122.1 73.6C134.5 86.23 134.3 106.5 121.6 118.9C86.03 153.7 64 202.3 64 256C64 362 149.1 448 256 448C362 448 448 362 448 256C448 160.9 378.8 81.89 288 66.65V96C288 113.7 273.7 128 256 128C238.3 128 224 113.7 224 96V32z"
                                    fill="currentColor"
                                    opacity="0.4"
                                ></path>
                            </svg>
                        </RouterLink>
                    </li>

                    <li
                        v-for="(sport, index) in sportsCategories"
                        :key="index"
                        :title="$t(sport.name)"
                        class="mb-3"
                    >
                        <RouterLink
                            v-if="!sport.external"
                            :to="sport.route"
                            active-class="category-active"
                            class="flex items-center justify-center hover:bg-gray-600 rounded-[3px] py-3 text-center"
                            style="background-color: var(--sidebar-color)"
                        >
                            <img
                                v-if="sport.image"
                                class="gray-scale-menu"
                                :src="
                                    `https://chicobets.sitedominio.com/storage/` +
                                    sport.image
                                "
                                alt=""
                                width="26"
                            />
                            <component
                                v-else
                                :is="sport.icon"
                                class="text-white"
                                width="20"
                                height="20"
                            />
                        </RouterLink>
                    </li>
                </ul>
                <li v-if="custom.telegram" class="mb-3">
                    <a :href="custom.telegram" :title="$t('Canal do Telegram')">
                        <div
                            class="flex items-center justify-center p-3 rounded-[3px] text-center"
                            style="background-color: var(--sidebar-color)"
                        >
                            <svg
                                data-v-b7b4c0c9=""
                                height="1.5em"
                                viewBox="0 0 496 512"
                                width="1.5em"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M248,8C111.033,8,0,119.033,0,256S111.033,504,248,504,496,392.967,496,256,384.967,8,248,8ZM362.952,176.66c-3.732,39.215-19.881,134.378-28.1,178.3-3.476,18.584-10.322,24.816-16.948,25.425-14.4,1.326-25.338-9.517-39.287-18.661-21.827-14.308-34.158-23.215-55.346-37.177-24.485-16.135-8.612-25,5.342-39.5,3.652-3.793,67.107-61.51,68.335-66.746.153-.655.3-3.1-1.154-4.384s-3.59-.849-5.135-.5q-3.283.746-104.608,69.142-14.845,10.194-26.894,9.934c-8.855-.191-25.888-5.006-38.551-9.123-15.531-5.048-27.875-7.717-26.8-16.291q.84-6.7,18.45-13.7,108.446-47.248,144.628-62.3c68.872-28.647,83.183-33.623,92.511-33.789,2.052-.034,6.639.474,9.61,2.885a10.452,10.452,0,0,1,3.53,6.716A43.765,43.765,0,0,1,362.952,176.66Z"
                                    fill="currentColor"
                                ></path>
                            </svg>
                        </div>
                    </a>
                </li>
                <li class="mb-3">
                    <a
                        @click="$router.push('/profile/affiliate')"
                        href="#"
                        :title="$t('Seja um Afiliado')"
                    >
                        <div
                            class="flex items-center justify-center p-3 rounded-[3px] text-center"
                            style="background-color: var(--sidebar-color)"
                        >
                            <svg
                                data-v-b7b4c0c9=""
                                fill="currentColor"
                                height="1.5em"
                                viewBox="0 0 448 448.5"
                                width="1.5em"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M209,.5c49.67-3.92,87.5,15.08,113.5,57,16.47,33.39,17.8,67.39,4,102-24.64,47.41-63.81,68.91-117.5,64.5-54.17-10.17-86.33-42.33-96.5-96.5-4.41-49.68,14.42-87.51,56.5-113.5,12.72-6.67,26.06-11.17,40-13.5ZM223,40.5c3.06.3,5.56,1.63,7.5,4,1.11,3.59,1.61,7.25,1.5,11,18.12,5.29,25.96,17.29,23.5,36-3.19,3.5-6.69,3.84-10.5,1-2.17-5.61-4.33-11.27-6.5-17-9.67-9.33-19.33-9.33-29,0-6.61,12.48-3.78,21.98,8.5,28.5,18.14-.2,30.64,7.97,37.5,24.5,3.59,14.9-.58,27.07-12.5,36.5-3.23,2.57-6.89,4.07-11,4.5.32,4.25-.51,8.25-2.5,12-3.67,2.67-7.33,2.67-11,0-1.99-3.75-2.82-7.75-2.5-12-18.12-5.29-25.96-17.29-23.5-36,3.19-3.51,6.69-3.84,10.5-1,2.17,5.6,4.34,11.27,6.5,17,8.15,8.16,16.99,9,26.5,2.5,8-9.33,8-18.67,0-28-6.26-3.16-12.92-4.82-20-5-18.1-6.03-26.26-18.53-24.5-37.5,2.57-14.07,10.74-22.73,24.5-26-.11-3.75.39-7.41,1.5-11,1.5-1.97,3.33-3.3,5.5-4Z"
                                    style="
                                        fill-rule: evenodd;
                                        isolation: isolate;
                                        opacity: 0.98;
                                        stroke-width: 0px;
                                    "
                                ></path>
                                <path
                                    d="M246,239.5c2.43.02,4.76.52,7,1.5l26.5,26.5c.67,3,.67,6,0,9-9.53,9.86-19.36,19.36-29.5,28.5-9.91.37-13.07-4.13-9.5-13.5l10.5-10.5c-26.33-.33-52.67-.67-79-1-1.83-.5-3-1.67-3.5-3.5-.67-2.67-.67-5.33,0-8,.5-1.83,1.67-3,3.5-3.5,26.67-.33,53.33-.67,80-1l-11.5-11.5c-1.9-6.16-.07-10.49,5.5-13Z"
                                    style="
                                        fill-rule: evenodd;
                                        isolation: isolate;
                                        opacity: 0.96;
                                        stroke-width: 0px;
                                    "
                                ></path>
                                <path
                                    d="M198,303.5c9.36.52,12.53,5.19,9.5,14l-10.5,10.5c26.33.33,52.67.67,79,1,1.83.5,3,1.67,3.5,3.5.67,2.67.67,5.33,0,8-.5,1.83-1.67,3-3.5,3.5-26.67.33-53.33.67-80,1,3.83,3.83,7.67,7.67,11.5,11.5,1.81,10.53-2.36,14.36-12.5,11.5-8.83-8.83-17.67-17.67-26.5-26.5-.67-3-.67-6,0-9,9.73-9.9,19.56-19.56,29.5-29Z"
                                    style="
                                        fill-rule: evenodd;
                                        isolation: isolate;
                                        opacity: 0.96;
                                        stroke-width: 0px;
                                    "
                                ></path>
                                <path
                                    d="M73,208.5c34.54-2.91,56.71,12.09,66.5,45,3.4,34.57-11.43,56.73-44.5,66.5-34.59,3.37-56.76-11.47-66.5-44.5-3.19-34.59,11.64-56.92,44.5-67Z"
                                    style="
                                        fill-rule: evenodd;
                                        isolation: isolate;
                                        opacity: 0.98;
                                        stroke-width: 0px;
                                    "
                                ></path>
                                <path
                                    d="M45,336.5c26-.17,52,0,78,.5,24.14,5.47,38.97,20.31,44.5,44.5.67,14.33.67,28.67,0,43-3.17,12.5-11,20.33-23.5,23.5-40,.67-80,.67-120,0-12.5-3.17-20.33-11-23.5-23.5-.67-14.33-.67-28.67,0-43,5.68-24.18,20.51-39.18,44.5-45Z"
                                    style="
                                        fill-rule: evenodd;
                                        isolation: isolate;
                                        opacity: 0.99;
                                        stroke-width: 0px;
                                    "
                                ></path>
                                <path
                                    d="M353,208.5c34.54-2.91,56.71,12.09,66.5,45,3.4,34.57-11.43,56.73-44.5,66.5-34.59,3.37-56.76-11.47-66.5-44.5-3.19-34.59,11.64-56.92,44.5-67Z"
                                    style="
                                        fill-rule: evenodd;
                                        isolation: isolate;
                                        opacity: 0.98;
                                        stroke-width: 0px;
                                    "
                                ></path>
                                <path
                                    d="M325,336.5c26-.17,52,0,78,.5,24.14,5.47,38.97,20.31,44.5,44.5.67,14.33.67,28.67,0,43-3.17,12.5-11,20.33-23.5,23.5-40,.67-80,.67-120,0-12.5-3.17-20.33-11-23.5-23.5-.67-14.33-.67-28.67,0-43,5.68-24.18,20.51-39.18,44.5-45Z"
                                    style="
                                        fill-rule: evenodd;
                                        isolation: isolate;
                                        opacity: 0.99;
                                        stroke-width: 0px;
                                    "
                                ></path>
                            </svg>
                        </div>
                    </a>
                </li>
                <li class="mb-3">
                    <a :href="custom.Suporte" :title="$t('Support')">
                        <div
                            v-if="custom.Suporte"
                            class="flex items-center justify-center p-3 rounded-[3px] text-center"
                            style="background-color: var(--sidebar-color)"
                        >
                            <svg
                                width="1.5em"
                                height="1.5em"
                                viewBox="0 0 16 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M15.2 13.6V14.024C15.1937 14.3381 15.0645 14.6372 14.8402 14.857C14.6158 15.0769 14.3141 15.2001 14 15.2H10V16H14C14.5304 16 15.0391 15.7893 15.4142 15.4142C15.7893 15.0391 16 14.5304 16 14V12.8C15.7748 13.1052 15.5052 13.3748 15.2 13.6Z"
                                    fill="#414952"
                                ></path>
                                <path
                                    d="M0 10.5839C0.049109 9.80103 0.327312 9.04988 0.8 8.42389V8.30389C0.289133 8.88313 0.00499042 9.62758 0 10.3999C0 10.4639 0 10.5199 0 10.5839Z"
                                    fill="#414952"
                                ></path>
                                <path
                                    d="M8 0C5.87827 0 3.84344 0.842855 2.34315 2.34315C0.842855 3.84344 0 5.87827 0 8H0C0.244633 7.6957 0.529976 7.42651 0.848 7.2C1.05156 5.44594 1.89262 3.82784 3.21126 2.65338C4.5299 1.47892 6.23417 0.829998 8 0.829998C9.76583 0.829998 11.4701 1.47892 12.7887 2.65338C14.1074 3.82784 14.9484 5.44594 15.152 7.2C15.47 7.42651 15.7554 7.6957 16 8C16 5.87827 15.1571 3.84344 13.6569 2.34315C12.1566 0.842855 10.1217 0 8 0V0Z"
                                    fill="#414952"
                                ></path>
                                <path
                                    d="M3.2 7.20001C2.35131 7.20001 1.53737 7.53715 0.937258 8.13727C0.337142 8.73739 0 9.55132 0 10.4C0 11.2487 0.337142 12.0626 0.937258 12.6628C1.53737 13.2629 2.35131 13.6 3.2 13.6V7.20001Z"
                                    fill="#8C9099"
                                ></path>
                                <path
                                    d="M12.8 13.6C13.6487 13.6 14.4626 13.2629 15.0627 12.6628C15.6628 12.0626 16 11.2487 16 10.4C16 9.55132 15.6628 8.73739 15.0627 8.13727C14.4626 7.53715 13.6487 7.20001 12.8 7.20001V13.6Z"
                                    fill="#8C9099"
                                ></path>
                                <path
                                    d="M3.20001 7.20001H4.00001C4.21219 7.20001 4.41567 7.2843 4.5657 7.43433C4.71573 7.58436 4.80001 7.78784 4.80001 8.00001V12.8C4.80001 13.0122 4.71573 13.2157 4.5657 13.3657C4.41567 13.5157 4.21219 13.6 4.00001 13.6H3.20001V7.20001Z"
                                    fill="#414952"
                                ></path>
                                <path
                                    d="M12 7.20001H12.8V13.6H12C11.7878 13.6 11.5844 13.5157 11.4343 13.3657C11.2843 13.2157 11.2 13.0122 11.2 12.8V8.00001C11.2 7.78784 11.2843 7.58436 11.4343 7.43433C11.5844 7.2843 11.7878 7.20001 12 7.20001Z"
                                    fill="#414952"
                                ></path>
                                <path
                                    d="M6.8 14H9.2C9.41217 14 9.61566 14.0843 9.76569 14.2343C9.91571 14.3843 10 14.5878 10 14.8V16H6.8C6.58783 16 6.38434 15.9157 6.23431 15.7657C6.08429 15.6157 6 15.4122 6 15.2V14.8C6 14.5878 6.08429 14.3843 6.23431 14.2343C6.38434 14.0843 6.58783 14 6.8 14Z"
                                    fill="#8C9099"
                                ></path>
                            </svg>
                        </div>
                    </a>
                </li>

                <li v-if="custom.ajuda" class="mb-3">
                    <a :href="custom.ajuda" :title="$t('Central de Ajuda')">
                        <div
                            class="flex items-center justify-center p-3 rounded-[3px] text-center"
                            style="background-color: var(--sidebar-color)"
                        >
                            <svg
                                data-v-b7b4c0c9=""
                                height="1.5em"
                                viewBox="0 0 512 512"
                                width="1.5em"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M342.5 214.7C342.6 214.6 342.4 214.8 342.5 214.7l128.1-128.1c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0L297.3 169.5c-.0742 .0742 .0742-.0762 0 0C317.1 178.1 333 194.9 342.5 214.7zM169.5 297.3C169.4 297.4 169.6 297.2 169.5 297.3l-128.1 128.1c-12.5 12.5-12.5 32.75 0 45.25C47.63 476.9 55.81 480 64 480s16.38-3.125 22.62-9.375l128.1-128.1c.0742-.0742-.0742 .0762 0 0C194.9 333 178.1 317.1 169.5 297.3zM342.5 297.3C342.4 297.2 342.6 297.4 342.5 297.3c-9.463 19.78-25.43 35.74-45.21 45.21c.0742 .0762-.0742-.0742 0 0l128.1 128.1C431.6 476.9 439.8 480 448 480s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25L342.5 297.3zM86.63 41.38c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25L169.5 214.7c.0742 .0742-.0762-.0742 0 0c9.463-19.78 25.43-35.74 45.21-45.21c-.0742-.0762 .0742 .0742 0 0L86.63 41.38z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    d="M214.7 169.5C227.2 163.5 241.2 160 256 160s28.76 3.51 41.29 9.502c.0742-.0762-.0742 .0742 0 0l115.5-115.6C369.5 20.26 315.2 0 256 0S142.5 20.26 99.2 53.95L214.7 169.5C214.8 169.6 214.6 169.4 214.7 169.5zM169.5 297.3C163.5 284.8 160 270.8 160 256s3.51-28.76 9.502-41.29c-.0762-.0742 .0742 .0742 0 0L53.95 99.2C20.26 142.5 0 196.8 0 256s20.26 113.5 53.95 156.8L169.5 297.3C169.6 297.2 169.4 297.4 169.5 297.3zM458.1 99.2l-115.6 115.5c-.0742 .0742 .0762-.0742 0 0C348.5 227.2 352 241.2 352 256s-3.51 28.76-9.502 41.29c.0762 .0742-.0742-.0742 0 0l115.6 115.5C491.7 369.5 512 315.2 512 256S491.7 142.5 458.1 99.2zM297.3 342.5C284.8 348.5 270.8 352 256 352s-28.76-3.51-41.29-9.502c-.0742 .0762 .0742-.0742 0 0l-115.5 115.6C142.5 491.7 196.8 512 256 512s113.5-20.26 156.8-53.95L297.3 342.5C297.2 342.4 297.4 342.6 297.3 342.5z"
                                    fill="currentColor"
                                    opacity="0.4"
                                ></path>
                            </svg>
                        </div>
                    </a>
                </li>

                <li class="mb-3">
                    <a
                        @click="$router.push('/profile/affiliate')"
                        href="#"
                        :title="$t('Indique um Amigo')"
                    >
                        <div
                            class="flex items-center justify-center p-3 rounded-[3px] text-center"
                            style="background-color: var(--sidebar-color)"
                        >
                            <svg
                                data-v-b7b4c0c9=""
                                height="1.5em"
                                viewBox="0 0 512 512"
                                width="1.5em"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M320 96C328.8 96 336 103.2 336 112C336 120.8 328.8 128 320 128H192C183.2 128 176 120.8 176 112C176 103.2 183.2 96 192 96H320zM276.1 230.3C282.7 231.5 292.7 233.5 297.1 234.7C307.8 237.5 314.2 248.5 311.3 259.1C308.5 269.8 297.5 276.2 286.9 273.3C283 272.3 269.5 269.7 265.1 268.1C252.9 267.1 242.1 268.7 236.5 271.6C230.2 274.4 228.7 277.7 228.3 279.7C227.7 283.1 228.3 284.3 228.5 284.7C228.7 285.2 229.5 286.4 232.1 288.2C238.2 292.4 247.8 295.4 261.1 299.7L262.8 299.9C274.9 303.6 291.1 308.4 303.2 317.3C309.9 322.1 316.2 328.7 320.1 337.7C324.1 346.8 324.9 356.8 323.1 367.2C319.8 386.2 307.2 399.2 291.4 405.9C286.6 407.1 281.4 409.5 276.1 410.5V416C276.1 427.1 267.1 436.1 255.1 436.1C244.9 436.1 235.9 427.1 235.9 416V409.6C226.4 407.4 213.1 403.2 206.1 400.5C204.4 399.9 202.9 399.4 201.7 398.1C191.2 395.5 185.5 384.2 189 373.7C192.5 363.2 203.8 357.5 214.3 361C216.3 361.7 218.5 362.4 220.7 363.2C230.2 366.4 240.9 370 246.9 371C259.7 373 269.6 371.7 275.7 369.1C281.2 366.8 283.1 363.8 283.7 360.3C284.4 356.3 283.8 354.5 283.4 353.7C283.1 352.8 282.2 351.4 279.7 349.6C273.8 345.3 264.4 342.2 250.4 337.9L248.2 337.3C236.5 333.8 221.2 329.2 209.6 321.3C203 316.8 196.5 310.6 192.3 301.8C188.1 292.9 187.1 283 188.9 272.8C192.1 254.5 205.1 241.9 220 235.1C224.1 232.9 230.3 231.2 235.9 230V223.1C235.9 212.9 244.9 203.9 256 203.9C267.1 203.9 276.1 212.9 276.1 223.1L276.1 230.3z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    d="M144.6 24.88C137.5 14.24 145.1 0 157.9 0H354.1C366.9 0 374.5 14.24 367.4 24.88L320 96H192L144.6 24.88zM332.1 136.4C389.7 172.7 512 250.9 512 416C512 469 469 512 416 512H96C42.98 512 0 469 0 416C0 250.9 122.3 172.7 179 136.4C183.9 133.3 188.2 130.5 192 128H320C323.8 130.5 328.1 133.3 332.1 136.4V136.4zM235.9 224V230C230.3 231.2 224.1 232.9 220 235.1C205.1 241.9 192.1 254.5 188.9 272.8C187.1 283 188.1 292.9 192.3 301.8C196.5 310.6 203 316.8 209.6 321.3C221.2 329.2 236.5 333.8 248.2 337.3L250.4 337.9C264.4 342.2 273.8 345.3 279.7 349.6C282.2 351.4 283.1 352.8 283.4 353.7C283.8 354.5 284.4 356.3 283.7 360.3C283.1 363.8 281.2 366.8 275.7 369.1C269.6 371.7 259.7 373 246.9 371C240.9 370 230.2 366.4 220.7 363.2C218.5 362.4 216.3 361.7 214.3 361C203.8 357.5 192.5 363.2 189 373.7C185.5 384.2 191.2 395.5 201.7 398.1C202.9 399.4 204.4 399.9 206.1 400.5C213.1 403.2 226.4 407.4 235.9 409.6V416C235.9 427.1 244.9 436.1 255.1 436.1C267.1 436.1 276.1 427.1 276.1 416V410.5C281.4 409.5 286.6 407.1 291.4 405.9C307.2 399.2 319.8 386.2 323.1 367.2C324.9 356.8 324.1 346.8 320.1 337.7C316.2 328.7 309.9 322.1 303.2 317.3C291.1 308.4 274.9 303.6 262.8 299.9L261.1 299.7C247.8 295.4 238.2 292.4 232.1 288.2C229.5 286.4 228.7 285.2 228.5 284.7C228.3 284.3 227.7 283.1 228.3 279.7C228.7 277.7 230.2 274.4 236.5 271.6C242.1 268.7 252.9 267.1 265.1 268.1C269.5 269.7 283 272.3 286.9 273.3C297.5 276.2 308.5 269.8 311.3 259.1C314.2 248.5 307.8 237.5 297.1 234.7C292.7 233.5 282.7 231.5 276.1 230.3V224C276.1 212.9 267.1 203.9 255.1 203.9C244.9 203.9 235.9 212.9 235.9 224L235.9 224z"
                                    fill="currentColor"
                                    opacity="0.4"
                                ></path>
                            </svg>
                        </div>
                    </a>
                </li>
            </div>

            <div
                class="h-full pb-4 overflow-y-auto pb-4 lg:hidden block"
                style="
                    background-image: linear-gradient(
                        to bottom,
                        var(--ci-gray-dark),
                        var(--card-color-dark),
                        var(--ci-gray-dark)
                    );
                    z-index: 60;
                    padding-top: 30px;
                "
            >
                <div
                    style="
                        display: flex;
                        padding: 0px 4%;
                        align-items: center;
                        justify-content: space-between;
                        padding-bottom: 20px;
                    "
                >
                    <div>
                        <a
                            v-if="setting"
                            href="/"
                            class="flex lg:ml-2 ml:1 lg:mr-24"
                        >
                            <img
                                style="max-width: 90px"
                                :src="`/storage/` + setting.software_logo_black"
                                alt=""
                                class="h-8 block dark:hidden"
                            />
                            <img
                                style="max-width: 90px"
                                :src="`/storage/` + setting.software_logo_white"
                                alt=""
                                class="lg:max-h-[35px] max-h-[30px] hidden dark:block"
                            />
                        </a>
                    </div>
                    <div>
                        <button
                            @click.prevent="toggleMenu"
                            class="btn"
                            style="
                                border-radius: 50%;
                                padding: 5px;
                                background-color: #3f4142;
                            "
                        >
                            <svg
                                data-v-b7b4c0c9=""
                                height="1em"
                                viewBox="0 0 320 512"
                                width="1em"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"
                                    fill="currentColor"
                                ></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="px-4">
                    <RouterLink
                        :to="{ name: 'profileAffiliate' }"
                        class="opacidade-hover rounded-[3px] flex w-full items-center h-auto"
                        style="
                            justify-content: space-between;
                            padding: 6px 20px;
                            padding-right: 25px;
                            margin-top: 10px;
                            background-color: #36a978;
                        "
                    >
                        <h1
                            class=""
                            style="
                                font-size: 0.9rem;
                                font-weight: bold;
                                line-height: 1.25rem;
                                color: white;
                            "
                        >
                            Ganhe R$ 5O,00 Reais grátis
                        </h1>
                        <span
                            style="max-width: 20px; margin-left: -10px"
                            class="text-[25px]"
                            >💰</span
                        >
                    </RouterLink>

                    <button
                        class="opacidade-hover rounded-[3px] flex w-full items-center h-auto"
                        style="
                            justify-content: space-between;
                            padding: 6px 20px;
                            padding-right: 25px;
                            margin-top: 10px;
                            background-color: #ec7000;
                        "
                    >
                        <div
                            class="flex flex-col items-start"
                            style="line-height: 13px"
                        >
                            <p style="font-size: 12px">Participe dos</p>
                            <h1
                                class=""
                                style="
                                    font-size: 0.9rem;
                                    font-weight: bold;
                                    color: white;
                                "
                            >
                                Promoções e Giros Free
                            </h1>
                        </div>
                        <span
                            style="max-width: 20px; margin-left: -10px"
                            class="text-[25px]"
                            >🎁</span
                        >
                    </button>

                    <button
                        class="opacidade-hover rounded-[3px] flex w-full items-center h-auto"
                        style="
                            justify-content: space-between;
                            padding: 6px 20px;
                            padding-right: 25px;
                            margin-top: 10px;
                            background-color: #5922bf;
                        "
                    >
                        <div
                            class="flex flex-col items-start"
                            style="line-height: 13px"
                        >
                            <p style="font-size: 12px">Participe das</p>
                            <h1
                                class=""
                                style="
                                    font-size: 0.9rem;
                                    font-weight: bold;
                                    color: white;
                                "
                            >
                                Missões Club Vip
                            </h1>
                        </div>
                        <span
                            style="max-width: 20px; margin-left: -10px"
                            class="text-[25px]"
                            >🎯</span
                        >
                    </button>
                </div>

                <div
                    style="
                        width: 100%;
                        height: 1px;
                        background-color: #27292a;
                        margin-top: 20px;
                        margin-bottom: 20px;
                    "
                ></div>

                <!-- Seção Cassino -->
                <div
                    @click="toggleCassino"
                    class="flex items-center px-4 py-2 texto-categoria font-semibold cursor-pointer w-full"
                >
                    <span class="text-white uppercase ml-3">CASSINO</span>
                    <svg
                        :class="{ 'rotate-90': isCassinoOpen }"
                        class="ml-auto transition-transform duration-300"
                        xmlns="http://www.w3.org/2000/svg"
                        height="1em"
                        viewBox="0 0 320 512"
                        fill="currentColor"
                    >
                        <path
                            d="M96 96c-8.188 0-16.38 3.125-22.62 9.375c-12.5 12.5-12.5 32.75 0 45.25L178.8 256l-105.4 105.4c-12.5 12.5-12.5 32.75 0 45.25C79.63 418.9 87.81 422 96 422s16.38-3.125 22.62-9.375l128-128c12.5-12.5 12.5-32.75 0-45.25l-128-128C112.4 99.13 104.2 96 96 96z"
                        />
                    </svg>
                </div>

                <ul
                    v-show="isCassinoOpen"
                    class="space-y-2 font-medium py-2 px-4 ml-3"
                >
                    <li v-for="(category, index) in categories" :key="index">
                        <RouterLink
                            v-if="!category.url"
                            :to="{
                                name: 'casinosAll',
                                params: {
                                    provider: 'all',
                                    category: category.slug,
                                },
                            }"
                            active-class="category-active"
                            class="flex flex-row items-center py-2 texto-categoria opacidade-1-texto-menu gray-scale-menu filter-gray-hover"
                        >
                            <img
                                :src="`/storage/` + category.image"
                                alt=""
                                class="w-[24px] h-[24px] mr-1 shrink-0 object-contain"
                            />
                            <span>{{ $t(category.name) }}</span>
                        </RouterLink>
                        <a
                            v-else
                            :href="category.url"
                            active-class="category-active"
                            class="flex flex-row items-center py-2 texto-categoria opacidade-1-texto-menu gray-scale-menu filter-gray-hover"
                        >
                            <img
                                :src="`/storage/` + category.image"
                                alt=""
                                class="w-[24px] h-[24px] mr-1 shrink-0 object-contain"
                            />
                            <span>{{ $t(category.name) }}</span>
                        </a>
                    </li>
                </ul>

                <!-- Linha separadora -->
                <hr class="my-3 border-gray-400 opacity-40" />

                <!-- Seção: Esportes -->
                <div
                    @click="toggleEsportes"
                    class="flex items-center px-4 py-2 texto-categoria font-semibold cursor-pointer w-full"
                >
                    <span class="text-white uppercase ml-3">ESPORTES</span>
                    <svg
                        :class="{ 'rotate-90': isEsportesOpen }"
                        class="ml-auto transition-transform duration-300"
                        xmlns="http://www.w3.org/2000/svg"
                        height="1em"
                        viewBox="0 0 320 512"
                        fill="currentColor"
                    >
                        <path
                            d="M96 96c-8.188 0-16.38 3.125-22.62 9.375c-12.5 12.5-12.5 32.75 0 45.25L178.8 256l-105.4 105.4c-12.5 12.5-12.5 32.75 0 45.25C79.63 418.9 87.81 422 96 422s16.38-3.125 22.62-9.375l128-128c12.5-12.5 12.5-32.75 0-45.25l-128-128C112.4 99.13 104.2 96 96 96z"
                        />
                    </svg>
                </div>

                <div v-show="isEsportesOpen">
                    <!-- Links fixos -->
                    <ul class="space-y-2 font-medium py-2 px-4 ml-3">
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="flex items-center gap-2 py-2 texto-categoria opacidade-1-texto-menu gray-scale-menu filter-gray-hover"
                                ><svg
                                    class="w-[24px] h-[24px] text-white"
                                    height="1em"
                                    viewBox="0 0 576 512"
                                    width="1em"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M448 128C465.7 128 480 142.3 480 160V352C480 369.7 465.7 384 448 384H128C110.3 384 96 369.7 96 352V160C96 142.3 110.3 128 128 128H448zM448 160H128V352H448V160z"
                                        fill="currentColor"
                                    ></path>
                                    <path
                                        d="M128 160H448V352H128V160zM512 64C547.3 64 576 92.65 576 128V208C549.5 208 528 229.5 528 256C528 282.5 549.5 304 576 304V384C576 419.3 547.3 448 512 448H64C28.65 448 0 419.3 0 384V304C26.51 304 48 282.5 48 256C48 229.5 26.51 208 0 208V128C0 92.65 28.65 64 64 64H512zM96 352C96 369.7 110.3 384 128 384H448C465.7 384 480 369.7 480 352V160C480 142.3 465.7 128 448 128H128C110.3 128 96 142.3 96 160V352z"
                                        fill="currentColor"
                                        opacity="0.4"
                                    ></path>
                                </svg>
                                <span>{{ $t("Minhas Apostas") }}</span>
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="flex items-center gap-2 py-2 texto-categoria opacidade-1-texto-menu gray-scale-menu filter-gray-hover"
                                ><svg
                                    class="w-[24px] h-[24px] text-white"
                                    height="1em"
                                    viewBox="0 0 512 512"
                                    width="1em"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        class="primary"
                                        d="M201.9 32l-128 128h92.13l128-128H201.9zM64 32C28.65 32 0 60.65 0 96v64h6.062l128-128H64zM326.1 160l127.4-127.4C451.7 32.39 449.9 32 448 32h-86.06l-128 128H326.1zM497.7 56.19L393.9 160H512V96C512 80.87 506.5 67.15 497.7 56.19zM224.3 241.7C221.1 239.5 216.9 239.5 213.5 241.4C210.1 243.3 208 247 208 251v137.9c0 4.008 2.104 7.705 5.5 9.656C215.1 399.5 216.9 400 218.7 400c1.959 0 3.938-.5605 5.646-1.682l106.7-68.97C334.1 327.3 336 323.8 336 319.1s-1.896-7.34-5.021-9.354L224.3 241.7z"
                                        fill="currentColor"
                                    ></path>
                                    <path
                                        class="secondary"
                                        d="M0 160v256c0 35.35 28.65 64 64 64h384c35.35 0 64-28.65 64-64V160H0zM330.1 329.3l-106.7 68.97C222.6 399.4 220.6 400 218.7 400c-1.77 0-3.562-.4648-5.166-1.379C210.1 396.7 208 392.1 208 388.1V251c0-4.01 2.104-7.705 5.5-9.656c3.375-1.918 7.562-1.832 10.81 .3027l106.7 68.97C334.1 312.7 336 316.2 336 319.1S334.1 327.3 330.1 329.3z"
                                        fill="currentColor"
                                        opacity="0.4"
                                    ></path>
                                </svg>
                                <span>{{ $t("Jogos Ao Vivo") }}</span>
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="flex items-center gap-2 py-2 texto-categoria opacidade-1-texto-menu gray-scale-menu filter-gray-hover"
                                ><svg
                                    class="w-[24px] h-[24px] text-white"
                                    height="1em"
                                    viewBox="0 0 512 512"
                                    width="1em"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M159 159C168.4 149.7 183.6 149.7 192.1 159L272.1 239C282.3 248.4 282.3 263.6 272.1 272.1C263.6 282.3 248.4 282.3 239 272.1L159 192.1C149.7 183.6 149.7 168.4 159 159V159z"
                                        fill="currentColor"
                                    ></path>
                                    <path
                                        d="M224 32C224 14.33 238.3 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 184.4 29.46 119.6 76.84 73.14C89.46 60.78 109.7 60.98 122.1 73.6C134.5 86.23 134.3 106.5 121.6 118.9C86.03 153.7 64 202.3 64 256C64 362 149.1 448 256 448C362 448 448 362 448 256C448 160.9 378.8 81.89 288 66.65V96C288 113.7 273.7 128 256 128C238.3 128 224 113.7 224 96V32z"
                                        fill="currentColor"
                                        opacity="0.4"
                                    ></path>
                                </svg>
                                <span>{{ $t("Começa em Breve") }}</span>
                            </RouterLink>
                        </li>
                    </ul>
                    <!-- Sessão: Popular -->
                    <ul class="space-y-2 font-medium py-2 px-4 ml-3">
                        <li class="pt-3 font-semibold text-white-600">
                            {{ $t("POPULAR") }}
                        </li>

                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                            >
                                <img
                                    src="https://chicobets.sitedominio.com/storage/brasil.png"
                                    alt="Brasileirão Série A"
                                    class="w-[24px] h-[24px] mr-1"
                                />
                                {{ $t("Brasileirao Serie A") }}
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                            >
                                <img
                                    src="https://chicobets.sitedominio.com/storage/sulamerica.png"
                                    alt="Copa Sul-Americana"
                                    class="w-[24px] h-[24px] mr-1"
                                />
                                {{ $t("Mundial De Clubes") }}
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                            >
                                <img
                                    src="https://chicobets.sitedominio.com/storage/inglaterra.png"
                                    alt="Premier League (Inglaterra)"
                                    class="w-[24px] h-[24px] mr-1"
                                />
                                {{ $t("Premier League (Inglês)") }}
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                            >
                                <img
                                    src="https://chicobets.sitedominio.com/storage/espanha.png"
                                    alt="La Liga (Espanha)"
                                    class="w-[24px] h-[24px] mr-1"
                                />
                                {{ $t("La Liga (Espanhol)") }}
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                            >
                                <img
                                    src="https://chicobets.sitedominio.com/storage/italiaa.png"
                                    alt="Serie A (Itália)"
                                    class="w-[24px] h-[24px] mr-1"
                                />
                                {{ $t("Serie A (Itáliano)") }}
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                            >
                                <img
                                    src="https://chicobets.sitedominio.com/storage/franca.png"
                                    alt="Ligue 1 (França)"
                                    class="w-[24px] h-[24px] mr-1"
                                />
                                {{ $t("Ligue 1 (Françês)") }}
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                            >
                                <img
                                    src="https://chicobets.sitedominio.com/storage/alemanha.png"
                                    alt="Bundesliga (Alemanha)"
                                    class="w-[24px] h-[24px] mr-1"
                                />
                                {{ $t("Bundesliga (Alemão)") }}
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                            >
                                <img
                                    src="https://chicobets.sitedominio.com/storage/championsfut.png"
                                    alt="UEFA Champions League)"
                                    class="w-[24px] h-[24px] mr-1"
                                />
                                {{ $t("UEFA Champions League") }}
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                            >
                                <img
                                    src="https://chicobets.sitedominio.com/storage/nbalogo.png"
                                    alt="NBA (EUA)"
                                    class="w-[24px] h-[24px] mr-1"
                                />
                                {{ $t("NBA (EUA)") }}
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                            >
                                <img
                                    src="https://chicobets.sitedominio.com/storage/nfl.png"
                                    alt="NFL (EUA)"
                                    class="w-[24px] h-[24px] mr-1"
                                />
                                {{ $t("NFL (EUA)") }}
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                            >
                                <img
                                    src="https://chicobets.sitedominio.com/storage/formula1.png"
                                    alt="Fórmula 1"
                                    class="w-[24px] h-[24px] mr-1"
                                />
                                {{ $t("Fórmula 1") }}
                            </RouterLink>
                        </li>

                        <!-- Sessão: Top 5 Esportes -->
                        <li class="pt-3 font-semibold text-white-600">
                            {{ $t("TOP 5 ESPORTES") }}
                        </li>

                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                                ><svg
                                    class="w-[21px] h-[21px], mr-1"
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
                                Futebol
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                                ><svg
                                    class="w-[21px] h-[21px], mr-1"
                                    height="1em"
                                    viewBox="0 0 512 512"
                                    width="1em"
                                    xmlns="http://www.w3.org/2000/svg"
                                    lined="false"
                                >
                                    <path
                                        d="M240.17 246.422C240.086 228.824 237.367 185.535 215.258 135.27C180.836 148.16 72.197 199.859 33.633 346.066C47.418 380.059 68.816 410.043 95.639 434.199C130.367 318.742 212.752 262.348 240.17 246.422ZM200.609 106.652C188.039 84.801 171.389 62.48 149.695 41.066C70.549 80.297 16 161.676 16 256C16 267.496 17.086 278.719 18.648 289.785C67.943 169.801 162.389 121.672 200.609 106.652ZM380.932 281.113C386.98 244.91 396.535 125.09 289.393 18.59C278.451 17.062 267.363 16 256 16C230.049 16 205.117 20.238 181.709 27.859C264.502 115.723 272.119 215.402 272.221 247.105C287.5 255.848 326.342 275.137 380.932 281.113ZM154.383 378.602C141.721 400.441 130.957 426.34 123.252 455.887C161.279 481.191 206.896 496 256 496C311.938 496 363.275 476.699 404.084 444.617C387.816 446.809 372.055 448.035 357.094 448.035C253.158 448.035 182.176 400.836 154.383 378.602ZM345.246 33.332C424.699 136.121 419.15 242.102 413.051 282.73C438.236 282.762 465.857 279.496 495.221 271.43C495.547 266.301 496 261.207 496 256C496 155.02 433.559 68.766 345.246 33.332ZM255.691 274.465C240.545 283.301 204.348 307.301 171.812 351.66C200.193 375.02 299.279 443.137 444.959 403.629C467.055 375.387 483.068 342.184 490.748 305.832C463.404 312.301 437.51 315.004 413.594 315.004C333.971 315.004 276.334 286.391 255.691 274.465Z"
                                        fill="currentColor"
                                        opacity="0.4"
                                    ></path>
                                    <path
                                        d="M172.164 351.66C200.545 375.02 299.631 443.137 445.311 403.629C433.371 418.887 419.666 432.645 404.436 444.617C388.168 446.809 372.406 448.035 357.445 448.035C253.51 448.035 182.527 400.836 154.734 378.602C142.072 400.441 131.309 426.34 123.604 455.887C113.822 449.379 104.689 442.031 95.99 434.199C130.719 318.742 213.104 262.348 240.521 246.422C240.437 228.824 237.719 185.535 215.609 135.27C181.187 148.16 72.549 199.859 33.984 346.066C26.771 328.277 21.771 309.402 19 289.785C68.295 169.801 162.74 121.672 200.961 106.652C188.391 84.801 171.74 62.48 150.047 41.066C160.348 35.965 170.988 31.465 182.061 27.859C264.854 115.723 272.471 215.402 272.572 247.105C287.852 255.848 326.693 275.137 381.283 281.113C387.332 244.91 396.887 125.09 289.744 18.59C309.203 21.309 327.926 26.238 345.598 33.332C425.051 136.121 419.502 242.102 413.402 282.73C438.588 282.762 466.209 279.496 495.572 271.43C494.826 283.129 493.463 294.652 491.1 305.832C463.756 312.301 437.861 315.004 413.945 315.004C334.322 315.004 276.686 286.391 256.043 274.465C240.896 283.301 204.699 307.301 172.164 351.66Z"
                                        fill="currentColor"
                                    ></path>
                                </svg>
                                Vôlei
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                                ><svg
                                    class="w-[21px] h-[21px], mr-1"
                                    height="1em"
                                    viewBox="0 0 512 512"
                                    width="1em"
                                    xmlns="http://www.w3.org/2000/svg"
                                    lined="false"
                                >
                                    <path
                                        d="M269.549 16.684C265.037 16.432 260.574 16 256 16C249.672 16 243.459 16.465 237.254 16.945C238.912 27.078 240 37.404 240 48C240 153.875 153.875 240 48 240C37.404 240 27.078 238.912 16.945 237.254C16.465 243.459 16 249.672 16 256C16 260.574 16.432 265.037 16.684 269.549C26.945 270.994 37.346 272 48 272C171.516 272 272 171.516 272 48C272 37.346 270.994 26.945 269.549 16.684ZM495.316 242.451C485.055 241.006 474.654 240 464 240C340.484 240 240 340.484 240 464C240 474.654 241.006 485.055 242.451 495.316C246.963 495.568 251.426 496 256 496C262.328 496 268.541 495.535 274.746 495.055C273.088 484.922 272 474.596 272 464C272 358.125 358.125 272 464 272C474.596 272 484.922 273.088 495.055 274.746C495.535 268.541 496 262.328 496 256C496 251.426 495.568 246.963 495.316 242.451Z"
                                        fill="currentColor"
                                    ></path>
                                    <path
                                        d="M464.316 240C474.971 240 485.371 241.006 495.633 242.451C488.818 120.756 391.561 23.498 269.865 16.684C271.311 26.945 272.316 37.346 272.316 48C272.316 171.516 171.832 272 48.316 272C37.662 272 27.262 270.994 17 269.549C23.814 391.244 121.072 488.502 242.768 495.316C241.322 485.055 240.316 474.654 240.316 464C240.316 340.484 340.801 240 464.316 240ZM240.316 48C240.316 37.404 239.229 27.078 237.57 16.945C120.016 26.059 26.375 119.699 17.262 237.254C27.395 238.912 37.721 240 48.316 240C154.191 240 240.316 153.875 240.316 48ZM272.316 464C272.316 474.596 273.404 484.922 275.062 495.055C392.617 485.941 486.258 392.301 495.371 274.746C485.238 273.088 474.912 272 464.316 272C358.441 272 272.316 358.125 272.316 464Z"
                                        fill="currentColor"
                                        opacity="0.4"
                                    ></path>
                                </svg>
                                Tênis
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                                ><svg
                                    class="w-[21px] h-[21px], mr-1"
                                    height="1em"
                                    viewBox="0 0 512 512"
                                    width="1em"
                                    xmlns="http://www.w3.org/2000/svg"
                                    lined="false"
                                >
                                    <path
                                        d="M141.734 164.361L75.521 98.148C50.535 126.691 32.291 161.154 23.039 199.224C29.023 199.906 34.875 201.045 41.039 201.045C79.387 201.045 114.148 186.931 141.734 164.361ZM186.971 164.343L256 233.373L413.852 75.519C371.637 38.566 316.512 15.997 256 15.999C247.432 15.999 238.984 16.487 230.648 17.362C231.627 25.208 233.041 32.931 233.041 41.038C233.041 88.202 215.291 130.884 186.971 164.343ZM201.045 41.038C201.045 34.872 199.904 29.021 199.223 23.036C161.154 32.286 126.691 50.532 98.148 75.519L164.361 141.734C186.934 114.146 201.045 79.386 201.045 41.038ZM164.344 186.97C130.885 215.289 88.203 233.041 41.039 233.041C32.934 233.041 25.211 231.627 17.363 230.646C16.488 238.982 16 247.432 16 256C16 316.512 38.568 371.637 75.521 413.852L233.373 256L164.344 186.97ZM370.266 347.637L436.479 413.852C461.465 385.307 479.713 350.844 488.963 312.778C482.977 312.094 477.125 310.955 470.961 310.955C432.613 310.955 397.852 325.067 370.266 347.637ZM436.479 98.148L278.627 256L347.656 325.028C381.115 296.709 423.797 278.959 470.961 278.959C479.066 278.959 486.791 280.373 494.637 281.352C495.512 273.016 496 264.568 496 256C496 195.488 473.432 140.363 436.479 98.148ZM325.029 347.657L256 278.627L98.148 436.479C140.363 473.433 195.488 496.001 256 495.999C264.568 495.999 273.016 495.513 281.352 494.636C280.371 486.79 278.959 479.067 278.959 470.962C278.959 423.798 296.709 381.116 325.029 347.657ZM310.955 470.962C310.955 477.126 312.094 482.976 312.775 488.962C350.846 479.71 385.309 461.466 413.852 436.479L347.639 370.266C325.066 397.852 310.955 432.614 310.955 470.962Z"
                                        fill="currentColor"
                                        opacity="0.4"
                                    ></path>
                                    <path
                                        d="M494.992 281.332C493.824 292.053 491.855 302.514 489.314 312.762C483.381 312.076 477.572 310.955 471.457 310.955C433.109 310.955 398.348 325.067 370.762 347.637L436.736 413.614C429.699 421.657 422.152 429.204 414.109 436.241L348.135 370.266C325.562 397.852 311.451 432.614 311.451 470.962C311.451 477.077 312.574 482.878 313.258 488.817C303.01 491.356 292.549 493.329 281.83 494.497C280.852 486.702 279.455 479.02 279.455 470.962C279.455 423.798 297.205 381.116 325.525 347.657L256.496 278.627L99.139 435.985C91.086 428.94 83.557 421.411 76.512 413.358L233.869 256L164.84 186.97C131.381 215.289 88.699 233.041 41.535 233.041C33.479 233.041 25.801 231.644 18 230.666C19.168 219.947 21.141 209.486 23.68 199.238C29.617 199.922 35.42 201.045 41.535 201.045C79.883 201.045 114.645 186.931 142.23 164.361L76.129 98.259C83.158 90.222 90.602 82.56 98.645 75.519L164.857 141.734C187.43 114.146 201.541 79.386 201.541 41.038C201.541 34.923 200.418 29.114 199.734 23.183C209.982 20.644 220.443 18.671 231.164 17.503C232.141 25.302 233.537 32.98 233.537 41.038C233.537 88.202 215.787 130.884 187.467 164.343L256.496 233.373L414.348 75.519C422.393 82.562 429.754 90.298 436.779 98.343L279.123 256L348.152 325.028C381.611 296.709 424.293 278.959 471.457 278.959C479.514 278.959 487.193 280.356 494.992 281.332Z"
                                        fill="currentColor"
                                    ></path>
                                </svg>
                                Basquete
                            </RouterLink>
                        </li>
                        <li>
                            <RouterLink
                                to="games/play/1458/sport"
                                class="texto-categoria flex items-center gap-2 py-2 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100"
                                ><svg
                                    class="w-[21px] h-[21px] mr-1"
                                    height="1em"
                                    viewBox="0 0 640 512"
                                    width="1em"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M247.1 200l-31.96-.011L215.1 168c0-13.2-10.78-24-23.98-24C178.8 144 167.1 154.8 167.1 168l.0367 31.99L135.1 200c-13.2 0-23.98 10.8-23.98 24c0 13.2 10.77 24 23.98 24l32.04-.0098L167.1 280c0 13.2 10.82 24 24.02 24c13.2 0 23.98-10.8 23.98-24l.0368-32.01L247.1 248c13.2 0 24.02-10.8 24.02-24C271.1 210.8 261.2 200 247.1 200z"
                                        fill="currentColor"
                                    ></path>
                                    <path
                                        d="M640 384.2c0-5.257-.4576-10.6-1.406-15.98l-33.38-211.6C591.4 77.96 522 32 319.1 32C119 32 48.71 77.46 34.78 156.6l-33.38 211.6c-.9487 5.383-1.406 10.72-1.406 15.98c0 51.89 44.58 95.81 101.5 95.81c49.69 0 93.78-30.06 109.5-74.64l7.5-21.36h203l7.5 21.36c15.72 44.58 59.81 74.64 109.5 74.64C595.4 479.1 640 436.1 640 384.2zM247.1 248l-31.96-.0098L215.1 280c0 13.2-10.78 24-23.98 24c-13.2 0-24.02-10.8-24.02-24l.0367-32.01L135.1 248c-13.2 0-23.98-10.8-23.98-24c0-13.2 10.77-24 23.98-24l32.04-.011L167.1 168c0-13.2 10.82-24 24.02-24c13.2 0 23.98 10.8 23.98 24l.0368 31.99L247.1 200c13.2 0 24.02 10.8 24.02 24C271.1 237.2 261.2 248 247.1 248zM432 311.1c-22.09 0-40-17.92-40-40c0-22.08 17.91-40 40-40s40 17.92 40 40C472 294.1 454.1 311.1 432 311.1zM496 215.1c-22.09 0-40-17.92-40-40c0-22.08 17.91-40 40-40s40 17.92 40 40C536 198.1 518.1 215.1 496 215.1z"
                                        fill="currentColor"
                                        opacity="0.4"
                                    ></path>
                                </svg>
                                Esportes Virtuais
                            </RouterLink>
                        </li>
                    </ul>
                </div>
                <hr class="my-3 border-gray-400 opacity-40" />
                <ul
                    v-if="custom.telegram"
                    class="font-medium mt-2 mb-[200px] ml-2"
                >
                    <li class="px-3">
                        <a
                            :href="custom.telegram"
                            class="l-5 flex items-center w-full p-2 text-gray-700 font-normal rounded-lg group dark:text-gray-400 dark:hover:text-white gray-scale-menu"
                        >
                            <svg
                                data-v-b7b4c0c9=""
                                height="20px"
                                viewBox="0 0 496 512"
                                width="20px"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M248,8C111.033,8,0,119.033,0,256S111.033,504,248,504,496,392.967,496,256,384.967,8,248,8ZM362.952,176.66c-3.732,39.215-19.881,134.378-28.1,178.3-3.476,18.584-10.322,24.816-16.948,25.425-14.4,1.326-25.338-9.517-39.287-18.661-21.827-14.308-34.158-23.215-55.346-37.177-24.485-16.135-8.612-25,5.342-39.5,3.652-3.793,67.107-61.51,68.335-66.746.153-.655.3-3.1-1.154-4.384s-3.59-.849-5.135-.5q-3.283.746-104.608,69.142-14.845,10.194-26.894,9.934c-8.855-.191-25.888-5.006-38.551-9.123-15.531-5.048-27.875-7.717-26.8-16.291q.84-6.7,18.45-13.7,108.446-47.248,144.628-62.3c68.872-28.647,83.183-33.623,92.511-33.789,2.052-.034,6.639.474,9.61,2.885a10.452,10.452,0,0,1,3.53,6.716A43.765,43.765,0,0,1,362.952,176.66Z"
                                    fill="currentColor"
                                ></path>
                            </svg>
                            <span
                                class="ml-3"
                                style="font-weight: bold; font-size: 12px"
                                >{{ $t("Canal do Telegram") }}</span
                            >
                        </a>
                    </li>

                    <li class="px-3">
                        <a
                            @click.prevent="$router.push('/profile/affiliate')"
                            href="#"
                            class="l-5 flex items-center w-full p-2 text-gray-700 font-normal rounded-lg group dark:text-gray-400 dark:hover:text-white gray-scale-menu"
                        >
                            <svg
                                data-v-b7b4c0c9=""
                                fill="currentColor"
                                height="20px"
                                viewBox="0 0 448 448.5"
                                width="20px"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M209,.5c49.67-3.92,87.5,15.08,113.5,57,16.47,33.39,17.8,67.39,4,102-24.64,47.41-63.81,68.91-117.5,64.5-54.17-10.17-86.33-42.33-96.5-96.5-4.41-49.68,14.42-87.51,56.5-113.5,12.72-6.67,26.06-11.17,40-13.5ZM223,40.5c3.06.3,5.56,1.63,7.5,4,1.11,3.59,1.61,7.25,1.5,11,18.12,5.29,25.96,17.29,23.5,36-3.19,3.5-6.69,3.84-10.5,1-2.17-5.61-4.33-11.27-6.5-17-9.67-9.33-19.33-9.33-29,0-6.61,12.48-3.78,21.98,8.5,28.5,18.14-.2,30.64,7.97,37.5,24.5,3.59,14.9-.58,27.07-12.5,36.5-3.23,2.57-6.89,4.07-11,4.5.32,4.25-.51,8.25-2.5,12-3.67,2.67-7.33,2.67-11,0-1.99-3.75-2.82-7.75-2.5-12-18.12-5.29-25.96-17.29-23.5-36,3.19-3.51,6.69-3.84,10.5-1,2.17,5.6,4.34,11.27,6.5,17,8.15,8.16,16.99,9,26.5,2.5,8-9.33,8-18.67,0-28-6.26-3.16-12.92-4.82-20-5-18.1-6.03-26.26-18.53-24.5-37.5,2.57-14.07,10.74-22.73,24.5-26-.11-3.75.39-7.41,1.5-11,1.5-1.97,3.33-3.3,5.5-4Z"
                                    style="
                                        fill-rule: evenodd;
                                        isolation: isolate;
                                        opacity: 0.98;
                                        stroke-width: 0px;
                                    "
                                ></path>
                                <path
                                    d="M246,239.5c2.43.02,4.76.52,7,1.5l26.5,26.5c.67,3,.67,6,0,9-9.53,9.86-19.36,19.36-29.5,28.5-9.91.37-13.07-4.13-9.5-13.5l10.5-10.5c-26.33-.33-52.67-.67-79-1-1.83-.5-3-1.67-3.5-3.5-.67-2.67-.67-5.33,0-8,.5-1.83,1.67-3,3.5-3.5,26.67-.33,53.33-.67,80-1l-11.5-11.5c-1.9-6.16-.07-10.49,5.5-13Z"
                                    style="
                                        fill-rule: evenodd;
                                        isolation: isolate;
                                        opacity: 0.96;
                                        stroke-width: 0px;
                                    "
                                ></path>
                                <path
                                    d="M198,303.5c9.36.52,12.53,5.19,9.5,14l-10.5,10.5c26.33.33,52.67.67,79,1,1.83.5,3,1.67,3.5,3.5.67,2.67.67,5.33,0,8-.5,1.83-1.67,3-3.5,3.5-26.67.33-53.33.67-80,1,3.83,3.83,7.67,7.67,11.5,11.5,1.81,10.53-2.36,14.36-12.5,11.5-8.83-8.83-17.67-17.67-26.5-26.5-.67-3-.67-6,0-9,9.73-9.9,19.56-19.56,29.5-29Z"
                                    style="
                                        fill-rule: evenodd;
                                        isolation: isolate;
                                        opacity: 0.96;
                                        stroke-width: 0px;
                                    "
                                ></path>
                                <path
                                    d="M73,208.5c34.54-2.91,56.71,12.09,66.5,45,3.4,34.57-11.43,56.73-44.5,66.5-34.59,3.37-56.76-11.47-66.5-44.5-3.19-34.59,11.64-56.92,44.5-67Z"
                                    style="
                                        fill-rule: evenodd;
                                        isolation: isolate;
                                        opacity: 0.98;
                                        stroke-width: 0px;
                                    "
                                ></path>
                                <path
                                    d="M45,336.5c26-.17,52,0,78,.5,24.14,5.47,38.97,20.31,44.5,44.5.67,14.33.67,28.67,0,43-3.17,12.5-11,20.33-23.5,23.5-40,.67-80,.67-120,0-12.5-3.17-20.33-11-23.5-23.5-.67-14.33-.67-28.67,0-43,5.68-24.18,20.51-39.18,44.5-45Z"
                                    style="
                                        fill-rule: evenodd;
                                        isolation: isolate;
                                        opacity: 0.99;
                                        stroke-width: 0px;
                                    "
                                ></path>
                                <path
                                    d="M353,208.5c34.54-2.91,56.71,12.09,66.5,45,3.4,34.57-11.43,56.73-44.5,66.5-34.59,3.37-56.76-11.47-66.5-44.5-3.19-34.59,11.64-56.92,44.5-67Z"
                                    style="
                                        fill-rule: evenodd;
                                        isolation: isolate;
                                        opacity: 0.98;
                                        stroke-width: 0px;
                                    "
                                ></path>
                                <path
                                    d="M325,336.5c26-.17,52,0,78,.5,24.14,5.47,38.97,20.31,44.5,44.5.67,14.33.67,28.67,0,43-3.17,12.5-11,20.33-23.5,23.5-40,.67-80,.67-120,0-12.5-3.17-20.33-11-23.5-23.5-.67-14.33-.67-28.67,0-43,5.68-24.18,20.51-39.18,44.5-45Z"
                                    style="
                                        fill-rule: evenodd;
                                        isolation: isolate;
                                        opacity: 0.99;
                                        stroke-width: 0px;
                                    "
                                ></path>
                            </svg>
                            <span
                                style="font-weight: bold; font-size: 12px"
                                class="ml-3 gray-scale-menu"
                                >{{ $t("Seja um Afiliado") }}</span
                            >
                        </a>
                    </li>

                    <li v-if="custom.Suporte" class="px-3">
                        <a
                            :href="custom.Suporte"
                            class="l-5 flex items-center w-full p-2 text-gray-700 font-normal rounded-lg group dark:text-gray-400 dark:hover:text-white gray-scale-menu"
                        >
                            <svg
                                data-v-b7b4c0c9=""
                                height="20px"
                                viewBox="0 0 640 512"
                                width="20px"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M640 191.1v191.1c0 35.25-28.75 63.1-64 63.1h-32v54.24c0 7.998-9.125 12.62-15.5 7.873l-82.75-62.12L319.1 447.1C284.7 447.1 256 419.2 256 383.1v-31.98l96-.002c52.88 0 96-43.12 96-95.99V128h128C611.3 128 640 156.7 640 191.1z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    d="M352 0H64C28.75 0 0 28.75 0 63.1V256C0 291.2 28.75 320 64 320l32 .0098v54.25c0 7.998 9.125 12.62 15.5 7.875l82.75-62.12L352 319.9c35.25 .125 64-28.68 64-63.92V63.1C416 28.75 387.3 0 352 0z"
                                    fill="currentColor"
                                    opacity="0.4"
                                ></path>
                            </svg>
                            <span
                                style="font-weight: bold; font-size: 12px"
                                class="ml-3 gray-scale-menu"
                                >{{ $t("Suporte Ao Vivo") }}</span
                            >
                        </a>
                    </li>

                    <li v-if="custom.ajuda" class="px-3">
                        <a
                            :href="custom.ajuda"
                            class="l-5 flex items-center w-full p-2 text-gray-700 font-normal rounded-lg group dark:text-gray-400 dark:hover:text-white gray-scale-menu"
                        >
                            <svg
                                data-v-b7b4c0c9=""
                                height="20px"
                                viewBox="0 0 512 512"
                                width="20px"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M342.5 214.7C342.6 214.6 342.4 214.8 342.5 214.7l128.1-128.1c12.5-12.5 12.5-32.75 0-45.25s-32.75-12.5-45.25 0L297.3 169.5c-.0742 .0742 .0742-.0762 0 0C317.1 178.1 333 194.9 342.5 214.7zM169.5 297.3C169.4 297.4 169.6 297.2 169.5 297.3l-128.1 128.1c-12.5 12.5-12.5 32.75 0 45.25C47.63 476.9 55.81 480 64 480s16.38-3.125 22.62-9.375l128.1-128.1c.0742-.0742-.0742 .0762 0 0C194.9 333 178.1 317.1 169.5 297.3zM342.5 297.3C342.4 297.2 342.6 297.4 342.5 297.3c-9.463 19.78-25.43 35.74-45.21 45.21c.0742 .0762-.0742-.0742 0 0l128.1 128.1C431.6 476.9 439.8 480 448 480s16.38-3.125 22.62-9.375c12.5-12.5 12.5-32.75 0-45.25L342.5 297.3zM86.63 41.38c-12.5-12.5-32.75-12.5-45.25 0s-12.5 32.75 0 45.25L169.5 214.7c.0742 .0742-.0762-.0742 0 0c9.463-19.78 25.43-35.74 45.21-45.21c-.0742-.0762 .0742 .0742 0 0L86.63 41.38z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    d="M214.7 169.5C227.2 163.5 241.2 160 256 160s28.76 3.51 41.29 9.502c.0742-.0762-.0742 .0742 0 0l115.5-115.6C369.5 20.26 315.2 0 256 0S142.5 20.26 99.2 53.95L214.7 169.5C214.8 169.6 214.6 169.4 214.7 169.5zM169.5 297.3C163.5 284.8 160 270.8 160 256s3.51-28.76 9.502-41.29c-.0762-.0742 .0742 .0742 0 0L53.95 99.2C20.26 142.5 0 196.8 0 256s20.26 113.5 53.95 156.8L169.5 297.3C169.6 297.2 169.4 297.4 169.5 297.3zM458.1 99.2l-115.6 115.5c-.0742 .0742 .0762-.0742 0 0C348.5 227.2 352 241.2 352 256s-3.51 28.76-9.502 41.29c.0762 .0742-.0742-.0742 0 0l115.6 115.5C491.7 369.5 512 315.2 512 256S491.7 142.5 458.1 99.2zM297.3 342.5C284.8 348.5 270.8 352 256 352s-28.76-3.51-41.29-9.502c-.0742 .0762 .0742-.0742 0 0l-115.5 115.6C142.5 491.7 196.8 512 256 512s113.5-20.26 156.8-53.95L297.3 342.5C297.2 342.4 297.4 342.6 297.3 342.5z"
                                    fill="currentColor"
                                    opacity="0.4"
                                ></path>
                            </svg>
                            <span
                                style="font-weight: bold; font-size: 12px"
                                class="ml-3 gray-scale-menu"
                                >{{ $t("Central de Ajuda") }}</span
                            >
                        </a>
                    </li>

                    <li class="px-3">
                        <a
                            @click.prevent="$router.push('/profile/affiliate')"
                            href="#"
                            class="l-5 flex items-center w-full p-2 text-gray-700 font-normal rounded-lg group dark:text-gray-400 dark:hover:text-white gray-scale-menu"
                        >
                            <svg
                                data-v-b7b4c0c9=""
                                height="20px"
                                viewBox="0 0 512 512"
                                width="20px"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M320 96C328.8 96 336 103.2 336 112C336 120.8 328.8 128 320 128H192C183.2 128 176 120.8 176 112C176 103.2 183.2 96 192 96H320zM276.1 230.3C282.7 231.5 292.7 233.5 297.1 234.7C307.8 237.5 314.2 248.5 311.3 259.1C308.5 269.8 297.5 276.2 286.9 273.3C283 272.3 269.5 269.7 265.1 268.1C252.9 267.1 242.1 268.7 236.5 271.6C230.2 274.4 228.7 277.7 228.3 279.7C227.7 283.1 228.3 284.3 228.5 284.7C228.7 285.2 229.5 286.4 232.1 288.2C238.2 292.4 247.8 295.4 261.1 299.7L262.8 299.9C274.9 303.6 291.1 308.4 303.2 317.3C309.9 322.1 316.2 328.7 320.1 337.7C324.1 346.8 324.9 356.8 323.1 367.2C319.8 386.2 307.2 399.2 291.4 405.9C286.6 407.1 281.4 409.5 276.1 410.5V416C276.1 427.1 267.1 436.1 255.1 436.1C244.9 436.1 235.9 427.1 235.9 416V409.6C226.4 407.4 213.1 403.2 206.1 400.5C204.4 399.9 202.9 399.4 201.7 398.1C191.2 395.5 185.5 384.2 189 373.7C192.5 363.2 203.8 357.5 214.3 361C216.3 361.7 218.5 362.4 220.7 363.2C230.2 366.4 240.9 370 246.9 371C259.7 373 269.6 371.7 275.7 369.1C281.2 366.8 283.1 363.8 283.7 360.3C284.4 356.3 283.8 354.5 283.4 353.7C283.1 352.8 282.2 351.4 279.7 349.6C273.8 345.3 264.4 342.2 250.4 337.9L248.2 337.3C236.5 333.8 221.2 329.2 209.6 321.3C203 316.8 196.5 310.6 192.3 301.8C188.1 292.9 187.1 283 188.9 272.8C192.1 254.5 205.1 241.9 220 235.1C224.1 232.9 230.3 231.2 235.9 230V223.1C235.9 212.9 244.9 203.9 256 203.9C267.1 203.9 276.1 212.9 276.1 223.1L276.1 230.3z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    d="M144.6 24.88C137.5 14.24 145.1 0 157.9 0H354.1C366.9 0 374.5 14.24 367.4 24.88L320 96H192L144.6 24.88zM332.1 136.4C389.7 172.7 512 250.9 512 416C512 469 469 512 416 512H96C42.98 512 0 469 0 416C0 250.9 122.3 172.7 179 136.4C183.9 133.3 188.2 130.5 192 128H320C323.8 130.5 328.1 133.3 332.1 136.4V136.4zM235.9 224V230C230.3 231.2 224.1 232.9 220 235.1C205.1 241.9 192.1 254.5 188.9 272.8C187.1 283 188.1 292.9 192.3 301.8C196.5 310.6 203 316.8 209.6 321.3C221.2 329.2 236.5 333.8 248.2 337.3L250.4 337.9C264.4 342.2 273.8 345.3 279.7 349.6C282.2 351.4 283.1 352.8 283.4 353.7C283.8 354.5 284.4 356.3 283.7 360.3C283.1 363.8 281.2 366.8 275.7 369.1C269.6 371.7 259.7 373 246.9 371C240.9 370 230.2 366.4 220.7 363.2C218.5 362.4 216.3 361.7 214.3 361C203.8 357.5 192.5 363.2 189 373.7C185.5 384.2 191.2 395.5 201.7 398.1C202.9 399.4 204.4 399.9 206.1 400.5C213.1 403.2 226.4 407.4 235.9 409.6V416C235.9 427.1 244.9 436.1 255.1 436.1C267.1 436.1 276.1 427.1 276.1 416V410.5C281.4 409.5 286.6 407.1 291.4 405.9C307.2 399.2 319.8 386.2 323.1 367.2C324.9 356.8 324.1 346.8 320.1 337.7C316.2 328.7 309.9 322.1 303.2 317.3C291.1 308.4 274.9 303.6 262.8 299.9L261.1 299.7C247.8 295.4 238.2 292.4 232.1 288.2C229.5 286.4 228.7 285.2 228.5 284.7C228.3 284.3 227.7 283.1 228.3 279.7C228.7 277.7 230.2 274.4 236.5 271.6C242.1 268.7 252.9 267.1 265.1 268.1C269.5 269.7 283 272.3 286.9 273.3C297.5 276.2 308.5 269.8 311.3 259.1C314.2 248.5 307.8 237.5 297.1 234.7C292.7 233.5 282.7 231.5 276.1 230.3V224C276.1 212.9 267.1 203.9 255.1 203.9C244.9 203.9 235.9 212.9 235.9 224L235.9 224z"
                                    fill="currentColor"
                                    opacity="0.4"
                                ></path>
                            </svg>
                            <span
                                style="font-weight: bold; font-size: 12px"
                                class="ml-3 gray-scale-menu"
                                >{{ $t("Indique um Amigo") }}</span
                            >
                        </a>
                    </li>
                    <hr class="my-3 border-gray-400 opacity-40" />
                    <li class="px-3 pt-2">
                        <div class="relative inline-block w-full">
                            <div
                                @click="toggleDropdown"
                                class="w-full bg-[#ba002d] text-white text-sm border border-red-600 rounded px-2 py-1 cursor-pointer select-none flex items-center justify-between"
                            >
                                <span>{{
                                    selectedOption
                                        ? selectedOption.label
                                        : "Selecionar"
                                }}</span>
                                <svg
                                    :class="[
                                        'transition-transform duration-300',
                                        isOpen ? 'rotate-90' : 'rotate-0',
                                    ]"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    class="w-4 h-4 ml-1"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </div>

                            <!-- Dropdown -->
                            <ul
                                v-if="isOpen"
                                class="absolute left-0 bottom-full mb-1 w-full bg-[#0F172A] border border-red-600 rounded text-white text-sm shadow-md max-h-48 overflow-auto z-50"
                            >
                                <li
                                    v-for="option in options"
                                    :key="option.value"
                                    @click="selectOption(option)"
                                    class="px-2 py-1 hover:bg-[#ba002d] cursor-pointer"
                                >
                                    {{ option.label }}
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
</template>

<script>
import { sidebarStore } from "@/Stores/SideBarStore.js";
import { RouterLink } from "vue-router";
import HttpApi from "@/Services/HttpApi.js";
import { useToast } from "vue-toastification";
import { useAuthStore } from "@/Stores/Auth.js";
import { useSettingStore } from "@/Stores/SettingStore.js";
import { missionStore } from "@/Stores/MissionStore.js";
import { loadLanguageAsync } from "laravel-vue-i18n";

export default {
    components: {
        RouterLink,
    },
    data() {
        return {
            sidebar: /iPhone|iPad|iPod|Android/i.test(navigator.userAgent)
                ? false
                : localStorage.getItem("sidebarStatus")
                ? JSON.parse(localStorage.getItem("sidebarStatus"))
                : false,
            isLoading: true,
            loading: true,
            categories: [],
            isOpen: false,
            options: [
                { label: "🇧🇷 Português", value: "pt_BR" },
                { label: "🇺🇸 English", value: "en" },
                { label: "🇪🇸 Español", value: "es" },
            ],
            selectedOption: { label: "🇧🇷 Português", value: "pt_BR" },
            sports: [
                { name: "FUTEBOL", route: "/futebol", icon: "FutebolIcon" },
                { name: "VOLEI", route: "/volei", icon: "VoleiIcon" },
                { name: "TENIS", route: "/tenis", icon: "TenisIcon" },
                { name: "BASQUETE", route: "/basquete", icon: "BasqueteIcon" },
                {
                    name: "ESPORTES_VIRTUAIS",
                    route: "/esportes-virtuais",
                    icon: "EsportesVirtuaisIcon",
                },
            ],
            sportsCategories: [
                {
                    name: "Brasileirao Serie A",
                    route: "/brasileirao-serie-a",
                    image: "brasil.png",
                },
                {
                    name: "Copa Sul Americana",
                    route: "/copa-sul-americana",
                    image: "sulamerica.png",
                },
                {
                    name: "Premier League (Inglês)",
                    route: "/premier-league",
                    image: "inglaterra.png",
                },
                {
                    name: "La Liga (Espanhol)",
                    route: "/la-liga",
                    image: "espanha.png",
                },
                {
                    name: "Serie A (Itáliano)",
                    route: "/serie-a-italia",
                    image: "italiaa.png",
                },
                {
                    name: "Ligue 1 (Françês)",
                    route: "/ligue-1",
                    image: "franca.png",
                },
                {
                    name: "Bundesliga (Alemão)",
                    route: "/bundesliga",
                    image: "alemanha.png",
                },
            ],
            modalMission: true,
            setting: null,
            expanded: false,
            custom: null,
            isEsportesOpen: true,
            isCassinoOpen: true,
            isLangDropdownOpen: false,
            languages: [
                { label: "🇧🇷 Português", value: "pt_BR" },
                { label: "🇺🇸 English", value: "en" },
                { label: "🇪🇸 Español", value: "es" },
            ],
        };
    },
    computed: {
        sidebarMenuStore() {
            return sidebarStore();
        },
        sidebarMenu() {
            return sidebarStore().getSidebarStatus;
        },
        isAuthenticated() {
            return useAuthStore().isAuth;
        },
        setting() {
            return useSettingStore().setting;
        },
    },
    async mounted() {
        window.scrollTo(0, 0);
        document.addEventListener("click", this.handleClickOutsideLang);

        const savedLang = localStorage.getItem("locale");
        if (savedLang) {
            const lang = this.languages.find((l) => l.value === savedLang);
            if (lang) {
                this.selectedOption = lang;
                await loadLanguageAsync(savedLang);
            }
        }
    },
    beforeUnmount() {
        document.removeEventListener("click", this.handleClickOutsideLang);
    },
    created() {
        this.custom = custom;
        this.getCasinoCategories();
        this.getSetting();
    },
    methods: {
        toggleDropdown() {
            this.isOpen = !this.isOpen;
        },
        closeDropdown() {
            setTimeout(() => {
                this.isOpen = false;
            }, 150);
        },
        async selectOption(option) {
            this.selectedOption = option;
            this.isOpen = false;

            // Corrige valor: remove barra se tiver
            const languageCode = option.value.replace("/", "");

            // Carrega idioma dinamicamente
            await loadLanguageAsync(languageCode);

            // Salva no localStorage para uso no app.js
            localStorage.setItem("language", languageCode);

            try {
                await HttpApi.put("/profile/updateLanguage", {
                    language: languageCode,
                });
            } catch (error) {
                console.error("Erro ao atualizar idioma:", error);
            }

            // Recarrega página para aplicar mudanças
            window.location.reload();
        },
        getSetting() {
            const settingStore = useSettingStore();
            const settingData = settingStore.setting;
            const currentPath = window.location.pathname;
            const found = this.languages.find((lang) =>
                currentPath.startsWith(lang.value)
            );
            this.selectedLanguage = found || this.languages[0];
            if (settingData) {
                this.setting = settingData;
            }
        },
        toggleCassino() {
            this.isCassinoOpen = !this.isCassinoOpen;
        },
        toggleEsportes() {
            this.isEsportesOpen = !this.isEsportesOpen;
        },
        toggleMenu() {
            this.sidebarMenuStore.setSidebarToogle();
        },
        toggleMissionModal() {
            missionStore().setMissionToogle();
        },
        getCasinoCategories() {
            const _toast = useToast();
            this.isLoading = true;
            this.loading = true;
            HttpApi.get("categories")
                .then((response) => {
                    this.categories = response.data.categories;
                    this.isLoading = false;
                    this.loading = false;
                })
                .catch((error) => {
                    Object.entries(
                        JSON.parse(error.request.responseText)
                    ).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                    this.isLoading = false;
                    this.loading = false;
                });
        },
        toggleLangDropdown() {
            this.isLangDropdownOpen = !this.isLangDropdownOpen;
        },
        selectLanguage(option) {
            this.selectedLanguage = option;
            this.isLangDropdownOpen = false;
            window.location.href = option.value;
        },
        handleClickOutsideLang(event) {
            if (!this.$el.contains(event.target)) {
                this.isLangDropdownOpen = false;
            }
        },
    },
    watch: {
        sidebarMenu(newVal) {
            this.sidebar = newVal;
        },
    },
};
</script>

<style scoped>
.shimmer {
    margin: 0 auto;
    margin-bottom: 10px;
    margin-top: 10px;
    position: relative;
    overflow: hidden;
    padding: 20px;
    max-width: 80%;
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

@keyframes shimmer {
    0% {
        left: -100%;
    }
    100% {
        left: 100%;
    }
}
</style>
