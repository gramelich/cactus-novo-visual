<style>
.teste-margin {
    background-color: var(--footer-color-dark);
    border-radius: 5px;
}
#imagem-cash {
    max-width: 300px;
    margin-top: -60px;
}
@media (min-width: 1025px) and (max-width: 1410px) {
    .padding-wallet {
        padding: 0px 4%;
    }
}
@media (min-width: 640px) and (max-width: 1024px) {
    .teste-margin {
        margin-top: 40px;
    }
}
@media (max-width: 600px) {
    #imagem-cash {
        max-width: 150px;
        margin-top: 0px;
    }
}
@media (max-width: 768px) {
    .padding-wallet {
        padding: 0px 4%;
    }
}
</style>
<template>
    <BaseLayout>
        <!-- Modal -->

        <div
            v-if="setting != null"
            class="flex mx-auto w-full sm:max-w-[690px] lg:max-w-[1110px] w-full padding-wallet"
            style="border-radius: 5px"
        >
            <div class="">
                <div class=""></div>
                <div
                    class="relative sm:max-w-[690px] lg:max-w-[1110px] mx-auto w-full overflow-x-auto item-sombra2 item-sombra"
                    style="margin: 0 auto; border-radius: 5px"
                >
                    <div
                        v-if="!isLoadingWallet"
                        class="grid grid-cols-2 mt-3 overflow-x-auto w-full"
                        style="padding-top: 55px; border-radius: 5px"
                    >
                        <div
                            class="grid grid-cols-1 p-4 teste-margin mr-3 relative"
                            style="max-width: 400px"
                        >
                            <div class="flex" style="max-width: 400px">
                                <div
                                    class="leading-4 ml-3 mr-3 flex flex-col sm:max-w-[50px] md:max-w-[50px] lg:max-w-[50px] max-w-[50px] w-full"
                                >
                                    <div class="flex items-center">
                                        <svg
                                            style="
                                                border-radius: 100%;
                                                margin-right: 8px;
                                                width: 20px;
                                            "
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="20"
                                            height="20"
                                            viewBox="0 0 512 512"
                                        >
                                            <mask id="a">
                                                <circle
                                                    cx="256"
                                                    cy="256"
                                                    r="256"
                                                    fill="#fff"
                                                ></circle>
                                            </mask>
                                            <g mask="url(#a)">
                                                <path
                                                    fill="#6da544"
                                                    d="M0 0h512v512H0z"
                                                ></path>
                                                <path
                                                    fill="#ffda44"
                                                    d="M256 100.2 467.5 256 256 411.8 44.5 256z"
                                                ></path>
                                                <path
                                                    fill="#eee"
                                                    d="M174.2 221a87 87 0 0 0-7.2 36.3l162 49.8a88.5 88.5 0 0 0 14.4-34c-40.6-65.3-119.7-80.3-169.1-52z"
                                                ></path>
                                                <path
                                                    fill="#0052b4"
                                                    d="M255.7 167a89 89 0 0 0-41.9 10.6 89 89 0 0 0-39.6 43.4 181.7 181.7 0 0 1 169.1 52.2 89 89 0 0 0-9-59.4 89 89 0 0 0-78.6-46.8zM212 250.5a149 149 0 0 0-45 6.8 89 89 0 0 0 10.5 40.9 89 89 0 0 0 120.6 36.2 89 89 0 0 0 30.7-27.3A151 151 0 0 0 212 250.5z"
                                                ></path>
                                            </g>
                                        </svg>
                                        <h1>BRL</h1>
                                    </div>
                                    <strong
                                        class="md:text-5xl"
                                        style="font-weight: 500"
                                        >{{
                                            state.currencyFormat(
                                                wallet?.total_balance,
                                                wallet?.currency
                                            )
                                        }}</strong
                                    >
                                    <i
                                        style="
                                            color: #5b5e5f;
                                            font-size: 45px;
                                            opacity: 0.5;
                                            position: absolute;
                                            right: 4%;
                                            top: 4%;
                                        "
                                        class="fa fa-wallet"
                                    ></i>
                                </div>
                            </div>
                            <div
                                class="leading-4 ml-3 flex flex-col gap-5"
                                style="position: absolute; left: 0; bottom: 0"
                            >
                                <div class="mt-2 pb-3 flex gap-2">
                                    <!-- Adicionei gap entre os botões -->
                                    <MakeDeposit
                                        :showMobile="false"
                                        :title="$t('Depositar')"
                                    />

                                    <RouterLink
                                        :to="{ name: 'profileWithdraw' }"
                                        active-class="profile-menu-active"
                                        class="flex items-center justify-center px-2 py-1 text-sm rounded-lg border border-[#02e346] bg-[#02e346] text-white transition-all duration-200 min-w-[100px] md:ml-0"
                                        style="margin-left: 8px"
                                    
                                    >
                                        {{ $t("Sacar") }}
                                    </RouterLink>
                                </div>
                            </div>
                        </div>
                        <div
                            class="p-4 w-full teste-margin"
                            style="min-width: 500px"
                        >
                            <div class="flex w-full">
                                <div class="leading-4 ml-3 flex flex-col gap-5">
                                    <div class="flex items-center">
                                        <svg
                                            height="16"
                                            viewBox="0 0 512 512"
                                            width="16"
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="IbX5i _8B-B0"
                                        >
                                            <g filter="url(#filter0_d_31_604)">
                                                <path
                                                    d="M351.205 149.047H351.165C324.766 105.103 276.962 77.5389 224.979 77.5389C143.795 77.5389 78.2922 138.431 77.7547 224.78C77.4266 277.462 103.921 308.412 103.987 308.497C130.58 346.84 174.88 372.003 224.979 372.003C306.174 372.003 372.23 305.963 372.23 224.78C372.231 204.008 366.886 171.019 351.205 149.047ZM91.5758 227.459C91.5609 226.571 91.5445 225.669 91.5445 224.78C91.5445 151.19 151.41 91.3311 224.98 91.3311C250.908 91.3311 275.695 98.9029 296.734 112.358C278.309 104.252 258.18 99.8873 237.496 99.8873C162.978 99.8873 101.218 155.544 91.5758 227.459ZM224.98 358.212C179.695 358.212 139.618 335.521 115.485 300.929C107.919 283.771 104.061 265.674 104.061 247.113C104.061 173.54 163.923 113.679 237.496 113.679C281.236 113.679 322.236 135.208 347.228 171.257C354.436 187.648 358.441 205.754 358.441 224.781C358.44 298.354 298.569 358.212 224.98 358.212ZM55.4547 328.597V328.054C61.8555 338.524 69.2094 348.351 77.3789 357.436L77.3852 366.227C68.6672 354.665 61.293 342.037 55.4547 328.597ZM120.938 407.818C110.13 400.424 100.169 391.894 91.1703 382.43V371.352C100.343 379.736 110.314 387.255 120.938 393.822V407.818ZM134.75 416.377L134.738 401.567C141.821 405.198 149.121 408.469 156.665 411.24L156.677 426.854C149.11 423.833 141.787 420.337 134.75 416.377ZM200.224 438.292C190.019 436.917 180.063 434.756 170.455 431.78V415.681C180.102 418.441 190.041 420.483 200.224 421.756V438.292ZM235.963 439.644C232.325 439.859 228.667 440.001 224.979 440.001C221.293 440.001 217.641 439.859 214.01 439.644L214.016 423.035C217.647 423.233 221.299 423.351 224.979 423.351C228.667 423.351 232.327 423.233 235.965 423.035L235.963 439.644ZM279.533 431.776C269.924 434.751 259.968 436.918 249.763 438.293V421.751C259.945 420.478 269.885 418.437 279.533 415.676V431.776ZM315.15 416.422C308.109 420.376 300.789 423.866 293.22 426.887L293.3 411.246C300.844 408.473 308.144 405.204 315.229 401.578L315.15 416.422ZM358.816 382.434C349.818 391.893 339.856 400.423 329.046 407.817V393.816C339.67 387.255 349.641 379.736 358.816 371.351V382.434ZM372.634 366.193L372.622 357.424C380.796 348.333 388.156 338.501 394.563 328.019L394.566 328.551C388.727 341.993 381.351 354.625 372.634 366.193ZM409.109 239.987C401.343 334.78 321.756 409.56 224.979 409.56C128.22 409.56 48.6555 334.78 40.8906 239.987C40.4805 234.966 40.2148 229.905 40.2148 224.78C40.2148 199.502 45.3289 175.394 54.5578 153.431C82.5242 86.8678 148.375 39.999 224.98 39.999C301.601 39.999 367.469 86.8701 395.442 153.437C404.671 175.4 409.786 199.501 409.786 224.78C409.786 229.905 409.52 234.966 409.109 239.987Z"
                                                    fill="#95C317"
                                                ></path>
                                            </g>
                                        </svg>
                                        <p
                                            class="font-semibold text-base"
                                            style="
                                                font-size: 13px;
                                                padding-left: 8px;
                                            "
                                        >
                                            BÔNUS
                                        </p>
                                    </div>
                                    <strong
                                        style="font-size: 2em; font-weight: 400"
                                        >B$
                                        {{
                                            state.currencyFormat(
                                                wallet.balance_bonus,
                                                wallet.currency
                                            )
                                        }}</strong
                                    >
                                    <div class="flex items-center">
                                        <svg
                                            data-v-472a4faf=""
                                            height="12"
                                            viewBox="0 0 512 512"
                                            width="12"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                d="M256 192c17.67 0 32-14.33 32-32c0-17.67-14.33-32-32-32S224 142.3 224 160C224 177.7 238.3 192 256 192zM296 336h-16V248C280 234.8 269.3 224 256 224H224C210.8 224 200 234.8 200 248S210.8 272 224 272h8v64h-16C202.8 336 192 346.8 192 360S202.8 384 216 384h80c13.25 0 24-10.75 24-24S309.3 336 296 336z"
                                                fill="currentColor"
                                            ></path>
                                            <path
                                                d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 128c17.67 0 32 14.33 32 32c0 17.67-14.33 32-32 32S224 177.7 224 160C224 142.3 238.3 128 256 128zM296 384h-80C202.8 384 192 373.3 192 360s10.75-24 24-24h16v-64H224c-13.25 0-24-10.75-24-24S210.8 224 224 224h32c13.25 0 24 10.75 24 24v88h16c13.25 0 24 10.75 24 24S309.3 384 296 384z"
                                                fill="currentColor"
                                                opacity="0.4"
                                            ></path>
                                        </svg>

                                        <p
                                            style="
                                                padding-left: 8px;
                                                font-size: 12px;
                                                color: #aaba9f;
                                                font-weight: 500;
                                            "
                                        >
                                            Rollover cassino ou esportes ainda
                                            não definido.
                                        </p>
                                    </div>
                                    <a href="/casino/provider/category">
                                        <button
                                            class="w-full"
                                            style="
                                                background-color: var(
                                                    --ci-primary-color
                                                );
                                                color: var(--sub-text-color);
                                                font-weight: 400;
                                                font-size: 14px;
                                                border-radius: 3px;
                                                padding: 8px 0;
                                            "
                                        >
                                            Acessar jogos
                                        </button>
                                    </a>
                                    <button
                                        @click="showModal = true"
                                        class="w-full"
                                        style="
                                            background-color: #584117;
                                            color: #e0cc06;
                                            font-weight: 400;
                                            font-size: 14px;
                                            border-radius: 3px;
                                            padding: 8px 0;
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;
                                            font-weight: 500;
                                        "
                                    >
                                        <strong style="padding-right: 5px"
                                            >Dúvidas?
                                        </strong>
                                        Leia as regras de Bônus
                                    </button>
                                </div>

                                <div
                                    style="
                                        border-left: 1px solid #474a4b;
                                        margin-left: 20px;
                                        padding-left: 20px;
                                    "
                                >
                                    <p
                                        style="
                                            padding: 2px 5px;
                                            background-color: #84603c;
                                            border-radius: 5px;
                                            font-size: 12px;
                                            color: black;
                                            display: inline-block;
                                            font-weight: bold;
                                            margin-bottom: 15px;
                                        "
                                    >
                                        Rollover
                                    </p>
                                    <p
                                        class=""
                                        style="
                                            margin-bottom: 15px;
                                            font-size: 12px;
                                            color: #adafb0;
                                            padding-right: 50px;
                                            font-weight: 500;
                                        "
                                    >
                                        Valor restante Rollover<span
                                            style="
                                                font-weight: bold;
                                                padding-left: 30px;
                                            "
                                            >{{
                                                state.currencyFormat(
                                                    parseFloat(
                                                        wallet.balance_deposit_rollover
                                                    ),
                                                    wallet.currency
                                                )
                                            }}</span
                                        >
                                    </p>
                                    <div
                                        class="bg-[#A3D712] text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full truncate"
                                        :style="{
                                            width: rolloverPercentage(
                                                parseFloat(
                                                    wallet.balance_deposit_rollover
                                                )
                                            ),
                                        }"
                                    >
                                        R$
                                        {{
                                            rolloverPercentage(
                                                parseFloat(
                                                    wallet.balance_deposit_rollover
                                                )
                                            )
                                        }}
                                    </div>
                                    <div>
                                        <p
                                            class=""
                                            style="
                                                margin-bottom: 15px;
                                                font-size: 12px;
                                                color: #adafb0;
                                                padding-right: 50px;
                                                font-weight: 500;
                                                margin-top: 15px;
                                            "
                                        >
                                            Valor restante Rollover Bônus<span
                                                style="
                                                    font-weight: bold;
                                                    padding-left: 30px;
                                                "
                                                >{{
                                                    state.currencyFormat(
                                                        parseFloat(
                                                            wallet.balance_bonus_rollover
                                                        ),
                                                        wallet.currency
                                                    )
                                                }}</span
                                            >
                                        </p>
                                        <div
                                            class="bg-[#A3D712] text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full truncate flex justify-center"
                                            :style="{
                                                width: rolloverPercentage(
                                                    parseFloat(
                                                        wallet.balance_bonus_rollover
                                                    )
                                                ),
                                            }"
                                        >
                                            R$
                                            {{
                                                rolloverPercentage(
                                                    parseFloat(
                                                        wallet.balance_bonus_rollover
                                                    )
                                                )
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex">
                                <div
                                    class="text-center flex justify-center items-center"
                                ></div>
                            </div>

                            <div class="w-1/2">
                                <div class="">
                                    <div
                                        class=""
                                        :style="{
                                            width: rolloverPercentage(
                                                parseFloat(
                                                    wallet.balance_deposit_rollover
                                                )
                                            ),
                                        }"
                                    ></div>
                                    <div
                                        v-if="
                                            setting.disable_rollover ===
                                                false || setting.rollover > 0
                                        "
                                        class="flex justify-between col-span-2"
                                    >
                                        <div class="flex w-1/2">
                                            <div
                                                class="text-center flex justify-center items-center"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="grid grid-cols-1">
                            <div
                                class="col-span-1 hidden md:block w-full"
                            ></div>
                            <div class="col-span-2 relative w-full">
                                <div
                                    style="
                                        background-color: var(
                                            --footer-color-dark
                                        );
                                        margin-top: 15px;
                                    "
                                    v-if="isLoading === false && wallet"
                                    class="flex flex-col gap-5 w-full bg-gray-200 hover:bg-gray-300/20 dark:bg-gray-700 p-4 mr-3 rounded"
                                >
                                    <div class="header flex w-full">
                                        <div class="flex flex-col">
                                            <h3
                                                style="
                                                    color: var(
                                                        --ci-primary-color
                                                    );
                                                    font-weight: bold;
                                                    font-size: 1.5em;
                                                "
                                            >
                                                Minhas Transações
                                            </h3>
                                            <div
                                                class="flex items-center mb-1 mt-2 overflow-x-auto"
                                                style="
                                                    font-size: 12px;
                                                    font-weight: bold;
                                                "
                                            >
                                                <p
                                                    style="
                                                        margin-right: 10px;
                                                        background-color: var(
                                                            --ci-primary-opacity-color
                                                        );
                                                        border-radius: 5px;
                                                        color: var(
                                                            --ci-primary-color
                                                        );
                                                        padding: 2px 5px;
                                                        cursor: pointer;
                                                    "
                                                >
                                                    Hoje
                                                </p>
                                                <p
                                                    style="
                                                        margin-right: 10px;
                                                        background-color: var(
                                                            --ci-primary-opacity-color
                                                        );
                                                        border-radius: 5px;
                                                        color: var(
                                                            --ci-primary-color
                                                        );
                                                        padding: 2px 5px;
                                                        cursor: pointer;
                                                        display: inline-block;
                                                        text-wrap: nowrap;
                                                    "
                                                >
                                                    3 dias
                                                </p>
                                                <p
                                                    style="
                                                        margin-right: 10px;
                                                        background-color: var(
                                                            --ci-primary-opacity-color
                                                        );
                                                        border-radius: 5px;
                                                        color: var(
                                                            --ci-primary-color
                                                        );
                                                        padding: 2px 5px;
                                                        cursor: pointer;
                                                        text-wrap: nowrap;
                                                    "
                                                >
                                                    7 dias
                                                </p>
                                                <p
                                                    style="
                                                        margin-right: 10px;
                                                        background-color: var(
                                                            --ci-primary-opacity-color
                                                        );
                                                        border-radius: 5px;
                                                        color: var(
                                                            --ci-primary-color
                                                        );
                                                        padding: 2px 5px;
                                                        cursor: pointer;
                                                        text-wrap: nowrap;
                                                    "
                                                >
                                                    15 dias
                                                </p>
                                                <p
                                                    style="
                                                        margin-right: 10px;
                                                        background-color: var(
                                                            --ci-primary-opacity-color
                                                        );
                                                        border-radius: 5px;
                                                        color: var(
                                                            --ci-primary-color
                                                        );
                                                        padding: 2px 5px;
                                                        cursor: pointer;
                                                        text-wrap: nowrap;
                                                    "
                                                >
                                                    30 dias
                                                </p>
                                                <p
                                                    style="
                                                        color: var(
                                                            --sub-text-color
                                                        );
                                                        padding: 2px 5px;
                                                        background-color: var(
                                                            --ci-primary-color
                                                        );
                                                        border-radius: 5px;
                                                        cursor: pointer;
                                                    "
                                                >
                                                    Total
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <p
                                            style="
                                                margin-bottom: -5px;
                                                color: var(--sub-text-color);
                                                background-color: var(
                                                    --ci-primary-color
                                                );
                                                font-weight: 500;
                                                display: block;
                                                border-radius: 5px;
                                                padding: 2px 5px;
                                            "
                                            class="text-gray-400 text-sm"
                                        >
                                            {{ $t("Saques") }}
                                        </p>
                                        <div
                                            style="
                                                height: 2px;
                                                background-color: var(
                                                    --ci-primary-color
                                                );
                                                width: 100%;
                                                margin-top: 15px;
                                            "
                                        ></div>
                                    </div>
                                    <div v-if="withdraws && wallet" class="">
                                        <div class="relative overflow-x-auto">
                                            <table
                                                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                            >
                                                <thead
                                                    class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400"
                                                >
                                                    <tr>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3"
                                                            style="
                                                                color: white;
                                                                font-weight: 400;
                                                            "
                                                        >
                                                            {{ $t("Tipo") }}
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3"
                                                            style="
                                                                color: white;
                                                                font-weight: 400;
                                                            "
                                                        >
                                                            {{ $t("Valor") }}
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3"
                                                            style="
                                                                color: white;
                                                                font-weight: 400;
                                                            "
                                                        >
                                                            {{ $t("Status") }}
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3"
                                                            style="
                                                                color: white;
                                                                font-weight: 400;
                                                            "
                                                        >
                                                            {{ $t("Date") }}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="(
                                                            withdraw, index
                                                        ) in withdraws"
                                                        :key="index"
                                                        class="bg-white dark:bg-gray-800"
                                                    >
                                                        <td class="px-6 py-4">
                                                            <div
                                                                title="Concluido"
                                                                v-if="
                                                                    withdraw.status ===
                                                                    1
                                                                "
                                                                style="
                                                                    border-radius: 5px;
                                                                    color: white;
                                                                    font-weight: bold;
                                                                    background-color: #22bb33;
                                                                    display: inline-block;
                                                                    padding: 5px;
                                                                "
                                                            >
                                                                <i
                                                                    class="fa-sharp fa-solid fa-arrow-down"
                                                                ></i>
                                                            </div>

                                                            <div
                                                                title="Pendente"
                                                                v-if="
                                                                    withdraw.status ===
                                                                    0
                                                                "
                                                                style="
                                                                    border-radius: 5px;
                                                                    color: #000000;
                                                                    font-weight: bold;
                                                                    background-color: #ff9f43;
                                                                    display: inline-block;
                                                                    padding: 2px
                                                                        7px;
                                                                "
                                                            >
                                                                <i
                                                                    class="fa-sharp fa-solid fa-arrow-down"
                                                                ></i>
                                                            </div>
                                                            <div
                                                                title="Cancelado"
                                                                v-if="
                                                                    withdraw.status ===
                                                                    2
                                                                "
                                                                style="
                                                                    border-radius: 5px;
                                                                    color: #000000;
                                                                    font-weight: bold;
                                                                    background-color: #ff9f43;
                                                                    display: inline-block;
                                                                    padding: 2px
                                                                        7px;
                                                                "
                                                            >
                                                                <i
                                                                    class="fa-sharp fa-solid fa-arrow-down"
                                                                ></i>
                                                            </div>
                                                        </td>
                                                        <td
                                                            class="px-6 py-4"
                                                            style="color: white"
                                                        >
                                                            {{
                                                                state.currencyFormat(
                                                                    parseFloat(
                                                                        withdraw.amount
                                                                    ),
                                                                    withdraw.currency
                                                                )
                                                            }}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <span
                                                                style="
                                                                    border-radius: 5px;
                                                                    color: black;
                                                                    font-weight: bold;
                                                                    padding: 2px
                                                                        3px;
                                                                    background-color: green;
                                                                "
                                                                title="Concluido"
                                                                v-if="
                                                                    withdraw.status ===
                                                                    1
                                                                "
                                                                class="text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:text-green-300"
                                                                >Concluido
                                                            </span>
                                                            <span
                                                                title="Pendente"
                                                                v-if="
                                                                    withdraw.status ===
                                                                    0
                                                                "
                                                                class=""
                                                                style="
                                                                    border-radius: 5px;
                                                                    color: black;
                                                                    font-weight: bold;
                                                                    padding: 2px
                                                                        3px;
                                                                    background-color: #ff9f43;
                                                                "
                                                                >Pendente</span
                                                            ><span
                                                                title="Cancelado"
                                                                v-if="
                                                                    withdraw.status ===
                                                                    2
                                                                "
                                                                class=""
                                                                style="
                                                                    border-radius: 5px;
                                                                    color: black;
                                                                    font-weight: bold;
                                                                    padding: 2px
                                                                        3px;
                                                                    background-color: red;
                                                                "
                                                                >Cancelado</span
                                                            >
                                                        </td>
                                                        <td
                                                            class="px-6 py-4"
                                                            style="color: white"
                                                        >
                                                            {{
                                                                withdraw.dateHumanReadable
                                                            }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="header flex flex-col">
                                        <div class="flex flex-col"></div>
                                        <p
                                            style="
                                                margin-bottom: -5px;
                                                color: var(--sub-text-color);
                                                background-color: var(
                                                    --ci-primary-color
                                                );
                                                font-weight: 500;
                                                display: block;
                                                border-radius: 5px;
                                                padding: 2px 5px;
                                            "
                                            class="text-gray-400 text-sm"
                                        >
                                            {{ $t("Depósitos") }}
                                        </p>
                                        <div
                                            style="
                                                height: 2px;
                                                background-color: var(
                                                    --ci-primary-color
                                                );
                                                width: 100%;
                                                margin-top: 15px;
                                            "
                                        ></div>
                                    </div>

                                    <div v-if="deposits && wallet" class="">
                                        <div class="relative overflow-x-auto">
                                            <table
                                                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                                            >
                                                <thead
                                                    class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400"
                                                >
                                                    <tr>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3"
                                                            style="
                                                                color: white;
                                                                font-weight: 400;
                                                            "
                                                        >
                                                            {{ $t("Tipo") }}
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3"
                                                            style="
                                                                color: white;
                                                                font-weight: 400;
                                                            "
                                                        >
                                                            {{ $t("Value") }}
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3"
                                                            style="
                                                                color: white;
                                                                font-weight: 400;
                                                            "
                                                        >
                                                            {{ $t("Status") }}
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3"
                                                            style="
                                                                color: white;
                                                                font-weight: 400;
                                                            "
                                                        >
                                                            {{ $t("Date") }}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="(
                                                            deposit, index
                                                        ) in deposits"
                                                        :key="index"
                                                        class="bg-white dark:bg-gray-800"
                                                    >
                                                        <!-- Ícone de status -->
                                                        <td class="px-6 py-4">
                                                            <!-- Pago -->
                                                            <div
                                                                v-if="
                                                                    deposit.status ===
                                                                    1
                                                                "
                                                                title="Concluido"
                                                                style="
                                                                    border-radius: 5px;
                                                                    color: white;
                                                                    font-weight: bold;
                                                                    background-color: #22bb33;
                                                                    display: inline-block;
                                                                    padding: 5px;
                                                                "
                                                            >
                                                                <i
                                                                    class="fa-sharp fa-solid fa-arrow-down"
                                                                ></i>
                                                            </div>

                                                            <!-- Pendente -->
                                                            <div
                                                                v-else-if="
                                                                    deposit.status ===
                                                                    0
                                                                "
                                                                title="Pendente"
                                                                style="
                                                                    border-radius: 5px;
                                                                    color: black;
                                                                    font-weight: bold;
                                                                    background-color: #ff9f43;
                                                                    display: inline-block;
                                                                    padding: 5px;
                                                                "
                                                            >
                                                                <i
                                                                    class="fa-sharp fa-solid fa-arrow-down"
                                                                ></i>
                                                            </div>

                                                            <!-- Cancelado -->
                                                            <div
                                                                v-else-if="
                                                                    deposit.status ===
                                                                    2
                                                                "
                                                                title="Cancelado"
                                                                style="
                                                                    border-radius: 5px;
                                                                    color: white;
                                                                    font-weight: bold;
                                                                    background-color: #ff4c4c;
                                                                    display: inline-block;
                                                                    padding: 5px;
                                                                "
                                                            >
                                                                <i
                                                                    class="fa-sharp fa-solid fa-arrow-down"
                                                                ></i>
                                                            </div>
                                                        </td>

                                                        <!-- Valor -->
                                                        <td
                                                            class="px-6 py-4"
                                                            style="
                                                                color: white;
                                                                font-weight: 400;
                                                            "
                                                        >
                                                            {{
                                                                state.currencyFormat(
                                                                    parseFloat(
                                                                        deposit.amount
                                                                    ),
                                                                    deposit.currency
                                                                )
                                                            }}
                                                        </td>

                                                        <!-- Texto do status -->
                                                        <td class="px-6 py-4">
                                                            <span
                                                                v-if="
                                                                    deposit.status ===
                                                                    1
                                                                "
                                                                style="
                                                                    border-radius: 5px;
                                                                    color: white;
                                                                    font-weight: bold;
                                                                    padding: 2px
                                                                        3px;
                                                                    background-color: #22bb33;
                                                                "
                                                            >
                                                                Concluido
                                                            </span>
                                                            <span
                                                                v-else-if="
                                                                    deposit.status ===
                                                                    0
                                                                "
                                                                style="
                                                                    border-radius: 5px;
                                                                    color: black;
                                                                    font-weight: bold;
                                                                    padding: 2px
                                                                        3px;
                                                                    background-color: #ff9f43;
                                                                "
                                                            >
                                                                Pendente
                                                            </span>
                                                            <span
                                                                v-else-if="
                                                                    deposit.status ===
                                                                    2
                                                                "
                                                                style="
                                                                    border-radius: 5px;
                                                                    color: white;
                                                                    font-weight: bold;
                                                                    padding: 2px
                                                                        3px;
                                                                    background-color: #ff4c4c;
                                                                "
                                                            >
                                                                Cancelado
                                                            </span>
                                                        </td>

                                                        <!-- Data -->
                                                        <td
                                                            class="px-6 py-4"
                                                            style="color: white"
                                                        >
                                                            {{
                                                                deposit.dateHumanReadable
                                                            }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <!-- Botão para abrir o modal -->

                                    <div
                                        v-if="isLoading"
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
                                        <span class="sr-only"
                                            >{{ $t("Loading") }}...</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                v-if="showModal"
                class="modal-overlay"
                @click.self="showModal = false"
                style="z-index: 999999; background-color: rgba(0, 0, 0, 0.47)"
            >
                <div
                    class="modal-content login-register-100vh"
                    style="
                        background-color: var(--carousel-banners-dark);
                        border-radius: 12px;
                        z-index: 999999;
                    "
                >
                    <span
                        style="max-width: 40px"
                        @click="showModal = false"
                        class="close"
                        @click.prevent="toggleSearch"
                        href=""
                    >
                        <div
                            class="x-mark-scale"
                            style="
                                box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.5);
                                background-color: var(--carousel-banners-dark);
                                padding: 7px;
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
                            ></i></div
                    ></span>
                    <div class="flex items-center">
                        <svg
                            fill="none"
                            height="24"
                            viewBox="0 0 24 24"
                            width="24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M6 3H18C20.2 3 22 4.8 22 7C22 8.7 21 10.1 19.5 10.7V7C19.5 6.6 19.3 6.2 19.1 5.9C18.9 5.6 18.4 5.5 18 5.5H6C5.6 5.5 5.2 5.7 4.9 5.9C4.6 6.1 4.5 6.6 4.5 7V10.7C3 10.1 2 8.7 2 7C2 4.8 3.8 3 6 3Z"
                                fill="#9CCE13"
                                fill-opacity="0.3"
                            ></path>
                            <path
                                clip-rule="evenodd"
                                d="M18 7V19C18 20.1 17.1 21 16 21H8C6.9 21 6 20.1 6 19V7H18ZM10.5 14.5L11.2 15.2V11C11.2 10.6 11.5 10.2 12 10.2C12.5 10.2 12.8 10.5 12.8 11V15.2L13.5 14.5C13.8 14.2 14.3 14.2 14.6 14.5C14.9 14.8 14.9 15.3 14.6 15.6L13.3 16.9C12.6 17.6 11.5 17.6 10.8 16.9L9.5 15.6C9.2 15.3 9.2 14.8 9.5 14.5C9.8 14.2 10.2 14.2 10.5 14.5Z"
                                fill="#9CCE13"
                                fill-rule="evenodd"
                            ></path>
                        </svg>
                        <p
                            style="
                                font-weight: 800;
                                font-size: 20px;
                                padding-left: 15px;
                                color: white;
                            "
                        >
                            Regras do Bônus
                        </p>
                    </div>

                    <div
                        class="p-4"
                        style="
                            background-color: #323536;
                            border-radius: 8px;
                            margin-top: 20px;
                            line-height: 30px;
                        "
                    >
                        <p
                            style="
                                font-size: 12px;
                                font-weight: 800;
                                color: #a7a9a9;
                            "
                        >
                            Bônus de 1° Depósito:
                            <span
                                style="
                                    background-color: var(
                                        --ci-primary-opacity-color
                                    );
                                    color: var(--ci-primary-color);
                                    padding: 2px 5px;
                                "
                                >100% até R$&nbsp;7.000,00</span
                            >
                        </p>
                        <p
                            style="
                                font-size: 12px;
                                font-weight: 800;
                                color: #a7a9a9;
                            "
                        >
                            Apostas Cassino:
                            <span
                                style="
                                    background-color: var(
                                        --ci-primary-opacity-color
                                    );
                                    color: var(--ci-primary-color);
                                    padding: 2px 5px;
                                "
                                >150x</span
                            >
                        </p>
                        <p
                            style="
                                font-size: 12px;
                                font-weight: 800;
                                color: #a7a9a9;
                            "
                        >
                            Apostas Esportes:
                            <span
                                style="
                                    background-color: var(
                                        --ci-primary-opacity-color
                                    );
                                    color: var(--ci-primary-color);
                                    padding: 2px 5px;
                                "
                                >75x</span
                            >
                        </p>
                        <p
                            style="
                                font-size: 12px;
                                font-weight: 800;
                                color: #a7a9a9;
                            "
                        >
                            Tempo de Expiração Cassino:
                            <span
                                style="
                                    background-color: var(
                                        --ci-primary-opacity-color
                                    );
                                    color: var(--ci-primary-color);
                                    padding: 2px 5px;
                                "
                                >24 horas</span
                            >
                        </p>
                        <p
                            style="
                                font-size: 12px;
                                font-weight: 800;
                                color: #a7a9a9;
                            "
                        >
                            Tempo de Expiração Esportes:
                            <span
                                style="
                                    background-color: var(
                                        --ci-primary-opacity-color
                                    );
                                    color: var(--ci-primary-color);
                                    padding: 2px 5px;
                                "
                                >72 horas</span
                            >
                        </p>
                        <p
                            style="
                                font-size: 12px;
                                font-weight: 800;
                                color: #a7a9a9;
                            "
                        >
                            Valor Máximo de Saque de Bônus:
                            <span
                                style="
                                    background-color: var(
                                        --ci-primary-opacity-color
                                    );
                                    color: var(--ci-primary-color);
                                    padding: 2px 5px;
                                "
                                >3x</span
                            >
                        </p>

                        <div class="flex items-center">
                            <svg
                                style="color: #d08640"
                                height="2.2rem"
                                viewBox="0 0 512 512"
                                width="2.2rem"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M256 320C269.3 320 280 309.3 280 296v-128c0-13.25-10.75-24-23.1-24S232 154.8 232 168v128C232 309.3 242.8 320 256 320zM256 353.1c-17.36 0-31.44 14.08-31.44 31.44C224.6 401.9 238.6 416 256 416s31.44-14.08 31.44-31.44C287.4 367.2 273.4 353.1 256 353.1z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    d="M506.3 417l-213.3-364c-16.33-28-57.54-28-73.98 0l-213.2 364C-10.59 444.9 9.849 480 42.74 480h426.6C502.1 480 522.6 445 506.3 417zM232 168c0-13.25 10.75-24 24-24S280 154.8 280 168v128c0 13.25-10.75 24-23.1 24S232 309.3 232 296V168zM256 416c-17.36 0-31.44-14.08-31.44-31.44c0-17.36 14.07-31.44 31.44-31.44s31.44 14.08 31.44 31.44C287.4 401.9 273.4 416 256 416z"
                                    fill="currentColor"
                                    opacity="0.4"
                                ></path>
                            </svg>
                            <p
                                style="
                                    color: #d08640;
                                    font-size: 12px;
                                    line-height: 15px;
                                    padding-left: 15px;
                                "
                            >
                                Para realizar o saque do bônus para carteira
                                real, você precisa cumprir as regras:
                            </p>
                        </div>
                        <p
                            style="
                                color: #d08640;
                                font-size: 14px;
                                line-height: 15px;
                                border-left: 1px solid #d08640;
                                padding-left: 10px;
                                margin-top: 15px;
                            "
                        >
                            <strong style="font-size: 14px">Cassino:</strong>
                            <br />
                            Voce deve acessar algum jogo disponível na categoria
                            Jogar com Bônus
                        </p>
                        <p
                            style="
                                color: #d08640;
                                font-size: 14px;
                                line-height: 15px;
                                border-left: 1px solid #d08640;
                                padding-left: 10px;
                                margin-top: 15px;
                            "
                        >
                            <strong style="font-size: 14px"
                                >Apostas esportivas:</strong
                            >
                            <br />
                            Bilhetes de apostas Multipla ODD acima de 3.00
                        </p>
                        <p
                            style="
                                color: #d08640;
                                font-size: 14px;
                                line-height: 15px;
                                border-left: 1px solid #d08640;
                                padding-left: 10px;
                                margin-top: 15px;
                            "
                        >
                            Para usar o saldo bônus você não pode possuir o
                            valor da aposta na sua carteira de saldo real.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </BaseLayout>
</template>

<script>
import { RouterLink } from "vue-router";
import MakeDeposit from "@/Components/UI/MakeDeposit.vue";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { useToast } from "vue-toastification";
import { useAuthStore } from "@/Stores/Auth.js";
import HttpApi from "@/Services/HttpApi.js";
import { useSettingStore } from "@/Stores/SettingStore.js";
import WalletSideMenu from "@/Pages/Profile/Components/WalletSideMenu.vue";
import CustomPagination from "@/Components/UI/CustomPagination.vue";
import axios from "axios";

export default {
    props: [],
    components: {
        MakeDeposit,
        CustomPagination,
        WalletSideMenu,
        BaseLayout,
        RouterLink,
    },
    data() {
        return {
            isLoading: false,
            showModal: false,
            isLoadingWallet: true,
            wallet: {},
            mywallets: null,
            setting: null,
            withdraws: [],
            deposits: [],
            isLoading: true,
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
    },
    methods: {
        getWallet() {
            const _this = this;
            const _toast = useToast();
            _this.isLoadingWallet = true;

            HttpApi.get("profile/wallet")
                .then((response) => {
                    _this.wallet = response.data.wallet;
                    _this.isLoadingWallet = false;
                })
                .catch((error) => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(
                        ([key, value]) => {
                            _toast.error(`${value}`);
                        }
                    );
                    _this.isLoadingWallet = false;
                });
        },

        getWithdraws() {
            const _this = this;
            _this.isLoading = true;

            const token = localStorage.getItem("token");
            axios
                .get("/api/user/withdrawals", {
                    headers: { Authorization: `Bearer ${token}` },
                })
                .then((response) => {
                    _this.withdraws = response.data.data;
                    _this.isLoading = false;
                })
                .catch((error) => {
                    console.error("Erro ao carregar saques:", error);
                    _this.isLoading = false;
                });
        },

        getDeposits() {
            const _this = this;
            _this.isLoading = true;

            const token = localStorage.getItem("token");
            axios
                .get("/api/user/deposits", {
                    headers: { Authorization: `Bearer ${token}` },
                })
                .then((response) => {
                    _this.deposits = response.data.data;
                    _this.isLoading = false;
                })
                .catch((error) => {
                    console.error("Erro ao carregar depósitos:", error);
                    _this.isLoading = false;
                });
        },

        setWallet(id) {
            const _this = this;
            const _toast = useToast();
            _this.isLoadingWallet = true;

            HttpApi.post("profile/mywallet/" + id, {})
                .then((response) => {
                    _this.getMyWallet();
                    _this.isLoadingWallet = false;
                    window.location.reload();
                })
                .catch((error) => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(
                        ([key, value]) => {
                            _toast.error(`${value}`);
                        }
                    );
                    _this.isLoadingWallet = false;
                });
        },

        getMyWallet() {
            const _this = this;
            const _toast = useToast();

            HttpApi.get("profile/mywallet")
                .then((response) => {
                    _this.mywallets = response.data.wallets;
                })
                .catch((error) => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(
                        ([key, value]) => {
                            _toast.error(`${value}`);
                        }
                    );
                });
        },

        getSetting() {
            const _this = this;
            const settingStore = useSettingStore();
            const settingData = settingStore.setting;

            if (settingData) {
                _this.setting = settingData;
            }

            _this.isLoading = false;
        },

        rolloverPercentage(balance) {
            return Math.max(0, ((balance / 100) * 100).toFixed(2));
        },
    },
    created() {
        this.getWallet();
        this.getMyWallet();
        this.getSetting();
        this.getWithdraws();
        this.getDeposits();
    },
};
</script>


<style scoped>
.modal-overlay {
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

.modal-content {
    background: white;
    padding: 20px;
    border-radius: 5px;
    position: relative;
    max-width: 500px;
    width: 100%;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    font-size: 24px;
    font-weight: bold;
}
</style>
