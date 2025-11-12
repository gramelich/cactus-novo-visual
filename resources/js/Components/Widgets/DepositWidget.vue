<style>
.item-sombra {
    position: relative;
}

.item-sombra::after {
    content: "";
    position: absolute;
    bottom: 0;
    right: 0;
    width: 50px; /* Largura da sombra */
    height: 50px;
    background: linear-gradient(
        to right,
        rgba(240, 240, 240, 0),
        #323637e7
    ); /* Gradiente de transparência */
}
#placeholder-input::placeholder {
    color: white;
}
.texto-valor {
    font-size: 15px;
}
@media (max-width: 768px) {
    .loading-mobile-qr {
        margin-top: 30vh;
    }
}
@media (max-width: 600px) {
    .texto-valor {
        font-size: 12px;
    }
}
</style>

<template>
    <div
        v-if="
            setting &&
            paymentType === 'pix' &&
            (setting.safiracash_is_enable ||
                setting.bspay_is_enable ||
                setting.digitopay_is_enable)
        "
    >
        <div v-if="showPixQRCode && wallet" class="flex flex-col">
            <div class="w-full">
                <div
                    style="
                        display: flex;
                        justify-content: center;
                        margin: 0 auto;
                        margin-bottom: 20px;
                        width: 100%;
                        border-top-right-radius: 8px;
                        border-top-left-radius: 8px;
                    "
                >
                    <a
                        v-if="setting"
                        class="w-full"
                        style="
                            display: flex;
                            justify-content: center;
                            margin: 0 auto;
                            max-height: 300px;
                        "
                    >
                        <img
                            style="
                                border-top-right-radius: 8px;
                                border-top-left-radius: 8px;
                            "
                            :src="`/storage/` + setting.software_logo_black2"
                            alt=""
                            class="block"
                        />
                    </a>
                </div>
                <div class="flex items-center px-6 gap-4 overflow-y-auto">
                    <div>
                        <a href="" @click.prevent="toggleModalDeposit">
                            <svg
                                height="1em"
                                viewBox="0 0 448 512"
                                width="1em"
                                xmlns="http://www.w3.org/2000/svg"
                                class="text-auth-texts/80 cursor-pointer"
                            >
                                <path
                                    d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"
                                    fill="currentColor"
                                ></path>
                            </svg>
                        </a>
                    </div>
                    <div class="flex flex-col">
                        <h2
                            style="
                                color: white;
                                font-weight: 500;
                                font-size: 18px;
                            "
                        >
                            Voltar
                        </h2>
                    </div>
                </div>
                <div class="flex justify-center" style="margin-top: 10px">
                    <p
                        class="md:block hidden text-lg"
                        style="text-align: center; font-weight: 600"
                    >
                        Escaneie a imagem <br />
                        para realizar o pagamento
                    </p>
                    <p
                        class="md:hidden block text-base"
                        style="text-align: center; font-weight: 600"
                    >
                        Copie o código "copia e cola" <br />
                        abaixo para realizar o pagamento
                    </p>
                </div>
            </div>

            <div class="w-full px-6 overflow-y-auto">
                <div
                    class="qr-code-container p-3 flex justify-center items-center md:block hidden"
                    style="max-width: 250px; margin: 0 auto"
                >
                    <QRCodeVue3 :value="qrcodecopypast" />
                </div>

                <div
                    @click.prevent="copyQRCode"
                    class="mt-4 p-4 rounded-lg relative"
                    style="
                        text-align: center;
                        border: 1px dashed rgba(253, 255, 255, 0.6);
                    "
                >
                    <p
                        class="font-bold"
                        style="
                            font-size: 2em;
                            color: var(--ci-primary-color);
                            margin-bottom: 10px;
                        "
                    >
                        {{
                            state.currencyFormat(
                                parseFloat(deposit.amount),
                                wallet.currency
                            )
                        }}
                    </p>
                    <input
                        style="
                            background-color: #424344;
                            font-size: 12px;
                            border-radius: 10px;
                        "
                        id="pixcopiaecola"
                        type="text"
                        class="input appearance-none border border-gray-300 rounded-md bg-transparent border-none w-full"
                        :value="qrcodecopypast"
                    />

                    <div
                        style="
                            position: absolute;
                            right: 2%;
                            top: 5%;
                            cursor: pointer;
                        "
                    >
                        <svg
                            data-v-283609e4=""
                            height="2rem"
                            viewBox="0 0 512 512"
                            width="2rem"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M397.9,286.8c-7.2,0-13.8,2.1-19.5,5.6c-3.3-17.4-18.5-30.6-36.8-30.6c-13.6,0-25.4,7.3-32,18.1
                            c-3.9-17.4-18.5-30.6-36.8-30.6c-9.7,0-18.4,3.8-25,9.7V143c0-17.3-14-31.3-30.6-31.3c-18,0-32,14-32,31.3v252.3l-43.8-58.4
                            c-6.1-8.2-15.5-12.5-25-12.5c-16.6,0-31.3,13.3-31.3,31.3c0,6.5,2,13.1,6.3,18.7l71.3,95.1c20,26.7,51.8,42.5,85,42.5h75.1
                            c62.1,0,112.6-50.5,112.6-112.6v-75.1C435.4,303.6,418.6,286.8,397.9,286.8z M272.8,424.4c0,6.9-5.6,12.5-12.5,12.5
                            c-6.9,0-12.5-5.6-12.5-12.5v-75.1c0-6.9,5.6-12.5,12.5-12.5c6.9,0,12.5,5.6,12.5,12.5V424.4z M322.8,424.4c0,6.9-5.6,12.5-12.5,12.5
                            s-12.5-5.6-12.5-12.5v-75.1c0-6.9,5.6-12.5,12.5-12.5s12.5,5.6,12.5,12.5V424.4z M372.9,424.4c0,6.9-5.6,12.5-12.5,12.5
                            c-6.9,0-12.5-5.6-12.5-12.5v-75.1c0-6.9,5.6-12.5,12.5-12.5s12.5,5.6,12.5,12.5V424.4z"
                                fill="currentColor"
                                opacity="0.4"
                            ></path>
                            <path
                                d="M260.3,336.9c-6.9,0-12.5,5.6-12.5,12.5v75.1c0,6.9,5.6,12.5,12.5,12.5c6.9,0,12.5-5.6,12.5-12.5v-75.1
                            C272.8,342.5,267.2,336.9,260.3,336.9z M310.3,336.9c-6.9,0-12.5,5.6-12.5,12.5v75.1c0,6.9,5.6,12.5,12.5,12.5s12.5-5.6,12.5-12.5
                            v-75.1C322.8,342.5,317.2,336.9,310.3,336.9z M360.4,336.9c-6.9,0-12.5,5.6-12.5,12.5v75.1c0,6.9,5.6,12.5,12.5,12.5
                            c6.9,0,12.5-5.6,12.5-12.5v-75.1C372.9,342.5,367.2,336.9,360.4,336.9z M341.8,42.1c-7.3-7.3-19.2-7.3-26.5,0l-37.5,37.5
                            c-7.3,7.3-7.3,19.2,0,26.5c4.3,3.7,9.2,5.5,13.9,5.5c4.8,0,9.6-1.8,13.3-5.5l37.5-37.5C349.8,61.3,349.8,49.5,341.8,42.1z
                            M362.8,160.4c0-10.4-8.4-18.8-18.8-18.8H291c-10.4,0-18.8,8.4-18.8,18.8c0.5,5.7,2.6,10.4,6,13.7c3.4,3.4,8.1,5.5,13.3,5.5h53.1
                            C354.9,179.6,363.3,171.3,362.8,160.4z M167.2,160.4c0-10.4-8.4-18.8-18.8-18.8H95.3c-10.4,0-18.8,8.4-18.8,18.8
                            c0.5,5.7,2.6,10.4,6,13.7c3.4,3.4,8.1,5.5,13.3,5.5h53.1C159.2,179.6,167.6,171.3,167.2,160.4z M97,68.7l37.5,37.5
                            c3.7,3.7,8.5,5.5,13.3,5.5c4.8,0,9.6-1.8,13.9-5.5c7.3-7.3,7.3-19.2,0-26.5l-37.5-37.5c-7.3-7.3-19.2-7.3-26.5,0
                            C89.7,49.5,89.7,61.3,97,68.7z M200.7,18.3v53.1c0,5.2,2.1,9.9,5.5,13.3c3.4,3.4,8.1,5.5,13.7,6c10.4,0,18.8-8.4,18.8-18.8V18.8
                            c0-10.4-8.4-18.8-18.8-18.8C209.1-0.4,200.7,8,200.7,18.3z"
                                fill="currentColor"
                            ></path>
                        </svg>
                    </div>

                    <div class="mt-5 w-full flex items-center justify-center">
                        <button
                            @click.prevent="copyQRCode"
                            type="button"
                            class="w-full md:max-w-[270px] px-4 py-2"
                            style="
                                background-color: var(
                                    --ci-primary-opacity-color
                                );
                                color: var(--ci-primary-color);
                                width: 100%;
                                border-radius: 5px;
                            "
                        >
                            <span
                                style="text-wrap: nowrap"
                                class="text-lg md:max-w-[270px]"
                                >{{ $t('Copiar Código "copia e cola"') }}</span
                            >
                        </button>
                    </div>
                </div>

                <div style="">
                    <div
                        v-if="!isCompleted"
                        class="timer"
                        style="padding: 20px 4%"
                    >
                        <p
                            style="
                                color: #29e823;
                                font-weight: 800;
                                font-size: 13px;
                            "
                        >
                            APÓS O PAGAMENTO AGUARDE A CONTAGEM ABAIXO, NOSSO
                            SISTEMA ESTÁ PROCESSANDO chicobets.site PAGAMENTO
                        </p>

                        <div class="time-display">{{ formattedTime }}</div>
                        <div class="progress-bar">
                            <div :style="{ width: progressBarWidth }"></div>
                        </div>
                    </div>
                    <div v-else class="completed-message">
                        Código PIX expirado
                    </div>
                </div>

                <div
                    v-if="showQRCode"
                    class="qr-code-container flex justify-center items-center"
                    style="max-width: 200px; margin: 0 auto"
                >
                    <QRCodeVue3 :value="qrcodecopypast" />
                </div>

                <div class="flex justify-center flex-col items-center">
                    <button
                        style="
                            background-color: #213326;
                            color: #22892e;
                            padding: 5px 15px;
                            border-radius: 5px;
                            margin-bottom: 10px;
                        "
                        @click="refreshPage"
                    >
                        Já paguei o pix
                    </button>
                    <button
                        style="text-align: center"
                        class="md:hidden block flex justify-center"
                        @click="showQRCode = !showQRCode"
                    >
                        {{ showQRCode ? "Ocultar QR Code" : "Exibir QR Code" }}
                    </button>
                </div>
            </div>
        </div>
        <div v-if="!showPixQRCode">
            <div
                v-if="setting != null && wallet != null && isLoading === false"
                class="flex flex-col w-full"
            >
                <form action="" @submit.prevent="submitQRCode">
                    <div
                        style="
                            display: flex;
                            justify-content: center;
                            margin: 0 auto;
                            margin-bottom: 20px;
                            width: 100%;
                            border-top-right-radius: 8px;
                            border-top-left-radius: 8px;
                        "
                    >
                        <a
                            v-if="setting"
                            class="w-full"
                            style="
                                display: flex;
                                justify-content: center;
                                margin: 0 auto;
                                max-height: 300px;
                            "
                        >
                            <!-- <img
                                style="
                                    border-top-right-radius: 8px;
                                    border-top-left-radius: 8px;
                                "
                                :src="
                                    `/storage/` + setting.software_logo_black2
                                "
                                alt=""
                                class="block"
                            /> -->
                        </a>
                    </div>
                    <div class="flex items-center px-6 gap-4">
                        <div class="flex flex-col">
                            <h2
                                style="
                                    color: white;
                                    font-weight: bold;
                                    font-size: 20px;
                                "
                            >
                                Depositar
                            </h2>
                            <p style="font-size: 14px; opacity: 0.7">
                                Adicione saldo à sua conta
                            </p>
                        </div>
                    </div>
                    <div
                        class="mx-6 p-3 mt-4 mb-4 px-6 suit-hover"
                        style="
                            cursor: pointer;
                            border-radius: 8px;
                            border: 1px solid var(--ci-primary-color);
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            background-color: #0f172a;
                            max-width: 120px;
                        "
                    >
                        <img
                            style="max-width: 80px"
                            src="../../../../public/assets/images/pix.png"
                            alt=""
                        />
                    </div>
                    <div
                        style="background-color: #213326; border-radius: 5px"
                        class="px-4 py-2 mt-3 mb-3 mx-6"
                    >
                        <p
                            class="md:text-base text-xs font-semibold"
                            style="color: #22912f"
                        >
                            Depósitos acima de R$50 concorrem a R$ 1000<br />
                            Reais e prêmios todos os sábados
                        </p>
                    </div>

                    <div class="flex items-center px-6 w-full">
                        <div class="mr-4">
                            <label
                                style="
                                    font-size: 12px;
                                    color: #87898a;
                                    opacity: 0.8;
                                    font-weight: bold;
                                "
                                for="methodpagamento"
                                >Método de Pagamento</label
                            >
                            <input
                                disabled
                                style="
                                    padding: 7px 0px;
                                    padding-left: 10px;
                                    background-color: var(--input-primary);
                                    border-radius: 5px;
                                    opacity: 0.7;
                                "
                                id="methodpagamento"
                                type="text"
                                value="SafiraCash"
                            />
                        </div>
                        <div>
                            <label
                                style="
                                    font-size: 12px;
                                    color: #87898a;
                                    opacity: 0.8;
                                    font-weight: bold;
                                "
                                for="methodpagamento2"
                                >Depósito Mínimo</label
                            >

                            <div style="position: relative">
                                <input
                                    disabled
                                    style="
                                        padding: 7px 0px;
                                        padding-left: 10px;
                                        background-color: var(--input-primary);
                                        border-radius: 5px;
                                        opacity: 0.7;
                                    "
                                    id="methodpagamento2"
                                    type="text"
                                    value=""
                                />
                                <p
                                    style="
                                        position: absolute;
                                        left: 6%;
                                        top: 16%;
                                        z-index: 1;
                                        opacity: 0.7;
                                    "
                                >
                                    R$
                                    {{ (setting.min_deposit, wallet.currency) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 px-6">
                        <p
                            class="text-gray-500 md:text-base text-xs"
                            style="font-weight: 550; color: white"
                        >
                            Valor a ser depositado:
                        </p>
                        <div
                            class="w-full flex items-center justify-between rounded py-1"
                        >
                            <div class="flex w-full items-center">
                                <i
                                    style="
                                        position: absolute;
                                        padding-left: 20px;
                                        font-size: 14px;
                                        z-index: 2;
                                    "
                                    class="fa-solid fa-brazilian-real-sign"
                                ></i>

                                <div
                                    style="
                                        position: absolute;
                                        right: 0;
                                        font-size: 10px;
                                        z-index: 2;
                                        padding-right: 50px;
                                        display: flex;
                                        align-items: center;
                                        font-weight: bold;
                                        gap: 3px;
                                    "
                                >
                                    <svg
                                        style="max-width: 10px"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="512"
                                        height="512"
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
                                    <p>BRL</p>
                                </div>

                                <div
                                    v-if="
                                        deposit.amount > 0 &&
                                        wallet &&
                                        wallet.currency &&
                                        setting &&
                                        setting.initial_bonus
                                    "
                                    style="
                                        position: absolute;
                                        right: 0;
                                        padding-right: 100px;
                                        z-index: 2;
                                        font-size: 12px;
                                        color: #a7f432;
                                    "
                                    class="text-right"
                                >
                                    +
                                    {{
                                        state.currencyFormat(
                                            parseFloat(deposit.amount) * 0.25,
                                            wallet.currency ?? "BRL"
                                        )
                                    }}
                                    Bônus
                                </div>

                                <input
                                    id="placeholder-input"
                                    style="
                                        position: relative;
                                        padding-left: 38px;
                                        z-index: 1;
                                        background-color: #424344;
                                        font-weight: 600;
                                    "
                                    type="text"
                                    v-model="deposit.amount"
                                    class="appearance-none border border-gray-300 rounded-md bg-transparent border-none w-full py-2 md:text-xl text-base"
                                    :min="setting.min_deposit"
                                    :max="setting.max_deposit"
                                    :placeholder="$t('0,00')"
                                    required
                                />
                            </div>
                        </div>

                        <div class="mt-3 item-selected">
                            <div
                                style="
                                    background-color: var(
                                        --ci-primary-opacity-color
                                    );
                                "
                                @click.prevent="setAmount(20.0)"
                                class="item"
                                :class="{ active: selectedAmount === 20.0 }"
                            >
                                <button
                                    class="ratio2"
                                    style="
                                        color: var(--ci-primary-color);
                                        font-weight: 800;
                                    "
                                    type="button"
                                >
                                    {{ wallet.symbol }} 20
                                </button>
                                <div class="ratio">HOT</div>
                                <img
                                    v-if="selectedAmount === 20.0"
                                    class="img-check"
                                    :src="`/assets/images/check.png`"
                                    alt=""
                                />
                            </div>
                            <div
                                style="
                                    background-color: var(
                                        --ci-primary-opacity-color
                                    );
                                "
                                @click.prevent="setAmount(50.0)"
                                class="item"
                                :class="{ active: selectedAmount === 50.0 }"
                            >
                                <button
                                    class="ratio2"
                                    style="
                                        color: var(--ci-primary-color);
                                        font-weight: 800;
                                    "
                                    type="button"
                                >
                                    {{ wallet.symbol }} 50
                                </button>
                                <div class="ratio">HOT</div>
                                <img
                                    v-if="selectedAmount === 50.0"
                                    class="img-check"
                                    :src="`/assets/images/check.png`"
                                    alt=""
                                />
                            </div>
                            <div
                                style="
                                    background-color: var(
                                        --ci-primary-opacity-color
                                    );
                                "
                                @click.prevent="setAmount(100.0)"
                                class="item"
                                :class="{ active: selectedAmount === 100.0 }"
                            >
                                <button
                                    class="ratio2"
                                    style="
                                        color: var(--ci-primary-color);
                                        font-weight: 800;
                                    "
                                    type="button"
                                >
                                    {{ wallet.symbol }} 100
                                </button>
                                <div class="ratio" style="">HOT</div>
                                <img
                                    v-if="selectedAmount === 100.0"
                                    class="img-check"
                                    :src="`/assets/images/check.png`"
                                    alt=""
                                />
                            </div>
                        </div>

                        <div class="item-selected">
                            <div
                                style="
                                    background-color: var(
                                        --ci-primary-opacity-color
                                    );
                                "
                                @click.prevent="setAmount(250.0)"
                                class="item"
                                :class="{ active: selectedAmount === 250.0 }"
                            >
                                <button
                                    class="ratio2"
                                    style="
                                        color: var(--ci-primary-color);
                                        font-weight: 800;
                                    "
                                    type="button"
                                >
                                    {{ wallet.symbol }} 250
                                </button>
                                <div class="ratio">HOT</div>
                                <img
                                    v-if="selectedAmount === 250.0"
                                    class="img-check"
                                    :src="`/assets/images/check.png`"
                                    alt=""
                                />
                            </div>
                            <div
                                style="
                                    background-color: var(
                                        --ci-primary-opacity-color
                                    );
                                "
                                @click.prevent="setAmount(500.0)"
                                class="item"
                                :class="{ active: selectedAmount === 500.0 }"
                            >
                                <button
                                    class="ratio2"
                                    style="
                                        color: var(--ci-primary-color);
                                        font-weight: 800;
                                    "
                                    type="button"
                                >
                                    {{ wallet.symbol }} 500
                                </button>
                                <div class="ratio">HOT</div>
                                <img
                                    v-if="selectedAmount === 500.0"
                                    class="img-check"
                                    :src="`/assets/images/check.png`"
                                    alt=""
                                />
                            </div>
                            <div
                                style="
                                    background-color: var(
                                        --ci-primary-opacity-color
                                    );
                                    text-shadow: 2px 1px 11px
                                        var(--ci-primary-color);
                                "
                                @click.prevent="setAmount(1000.0)"
                                class="item"
                                :class="{ active: selectedAmount === 1000.0 }"
                            >
                                <button
                                    class="ratio2"
                                    style="
                                        color: var(--ci-primary-color);
                                        font-weight: 800;
                                    "
                                    type="button"
                                >
                                    {{ wallet.symbol }} 1000
                                </button>
                                <div class="ratio">HOT</div>
                                <img
                                    v-if="selectedAmount === 1000.0"
                                    class="img-check"
                                    :src="`/assets/images/check.png`"
                                    alt=""
                                />
                            </div>
                        </div>

                        <div
                            class="mt-5 w-full flex items-center justify-center"
                        >
                            <button
                                type="submit"
                                class="w-full p-6 mt-1"
                                style="
                                    border-radius: 5px;
                                    color: var(--sub-text-color);
                                    width: auto;
                                    padding: 7px 12px;
                                    -webkit-flex: none;
                                    -ms-flex: none;
                                    flex: none;
                                    font-weight: 400;
                                    background-color: var(--ci-primary-color);
                                    padding-top: 10px;
                                    padding-bottom: 10px;
                                "
                            >
                                <span
                                    class="text-xl"
                                    style="
                                        color: var(--sub-text-color);
                                        font-weight: 550;
                                    "
                                    >DEPOSITAR</span
                                >
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div
        v-if="isLoading"
        role="status"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/70"
    >
        <div
            class="flex flex-col items-center gap-3 p-6 rounded-lg bg-black/90"
        >
            <span class="text-white font-bold text-lg">Gerando QR CODE...</span>
            <i class="fa-solid fa-spinner fa-spin text-white text-4xl"></i>
        </div>
    </div>
</template>

<script>
import { useToast } from "vue-toastification";
import HttpApi from "@/Services/HttpApi.js";
import QRCodeVue3 from "qrcode-vue3";
import { useAuthStore } from "@/Stores/Auth.js";
import { StripeCheckout } from "@vue-stripe/vue-stripe";
import { useSettingStore } from "@/Stores/SettingStore.js";
import CountdownTimer from "@/Pages/Home/CountdownTimer.vue";

export default {
    props: ["showMobile", "title", "isFull"],
    components: { QRCodeVue3, StripeCheckout, CountdownTimer },
    data() {
        return {
            showQRCode: false, // Controla a visibilidade da div com o QR Code
            totalTime: 5 * 60, // 5 minutos em segundos
            timeRemaining: 5 * 60,
            intervalId: null,
            isCompleted: false,
            isModalOpen: true,
            isLoading: false,
            minutes: 15,
            seconds: 0,
            timer: null,
            setting: null,
            wallet: null,
            deposit: {
                amount: "",
                cpf: "10292107994",
                gateway: "",
                accept_bonus: true,
            },
            selectedAmount: 0,
            showPixQRCode: false,
            qrcodecopypast: "",
            idTransaction: "",
            intervalId: null,
            paymentType: null,

            /// stripe
            elementsOptions: {
                appearance: {}, // appearance options
            },
            confirmParams: {
                return_url: null, // success url
            },
            successURL: null,
            cancelURL: null,
            amount: null,
            currency: null,
            publishableKey: null,
            sessionId: null,
            paymentGateway: "",
        };
    },
    setup(props) {
        return {};
    },
    computed: {
        progressBarWidth() {
            const percentage = (this.timeRemaining / this.totalTime) * 100;
            return `${percentage}%`;
        },
        formattedTime() {
            const minutes = Math.floor(this.timeRemaining / 60);
            const seconds = this.timeRemaining % 60;
            return `${String(minutes).padStart(2, "0")}:${String(
                seconds
            ).padStart(2, "0")}`;
        },

        isAuthenticated() {
            const authStore = useAuthStore();
            return authStore.isAuth;
        },
    },
    mounted() {
        this.intervalId = setInterval(this.updateTimer, 1000);
        if (this.setting.safiracash_is_enable) {
            this.setPaymentMethod("pix", "safiracash");
        }
    },

    beforeUnmount() {
        clearInterval(this.intervalId);
        clearInterval(this.timer);
        this.paymentType = null;
    },
    methods: {
        refreshPage() {
            window.location.reload();
        },
        updateTimer() {
            if (this.timeRemaining > 0) {
                this.timeRemaining -= 1;
            } else {
                this.isCompleted = true;
                clearInterval(this.intervalId);
            }
        },
        closeModal() {
            this.isModalOpen = false;
        },

        getSession: function () {
            const _this = this;
            HttpApi.post("stripe/session", {
                amount: _this.amount,
                currency: _this.currency,
            })
                .then((response) => {
                    if (response.data.id) {
                        _this.sessionId = response.data.id;
                    }
                })
                .catch((error) => {});
        },
        checkoutStripe: function () {
            const _toast = useToast();
            if (this.amount <= 0 || this.amount === "") {
                _toast.error("Você precisa digitar um valor");
                return;
            }

            this.$refs.checkoutRef.redirectToCheckout();
        },
        getPublicKeyStripe: function () {
            const _this = this;
            HttpApi.post("stripe/publickey", {})
                .then((response) => {
                    _this.$nextTick(() => {
                        _this.publishableKey = response.data.stripe_public_key;
                        _this.elementsOptions.clientSecret =
                            response.data.stripe_secret_key;
                        _this.confirmParams.return_url =
                            response.data.successURL;
                    });
                })
                .catch((error) => {});
        },
        setPaymentMethod: function (type, gateway) {
            if (type === "stripe") {
                this.getPublicKeyStripe();
            }
            this.paymentType = type;
            this.paymentGateway = gateway;
            console.log("Método de pagamento setado:", type, gateway);
        },
        submitQRCode: function (event) {
            const _this = this;
            const _toast = useToast();
            if (
                _this.deposit.amount === "" ||
                _this.deposit.amount === undefined
            ) {
                _toast.error(_this.$t("You need to enter a value"));
                return;
            }

            if (_this.deposit.cpf === "" || _this.deposit.cpf === undefined) {
                _toast.error(_this.$t("Do you need to enter your CPF or CNPJ"));
                return;
            }

            if (
                parseFloat(_this.deposit.amount) <
                parseFloat(_this.setting.min_deposit)
            ) {
                _toast.error(
                    "O valor mínimo de depósito é de " +
                        _this.setting.min_deposit
                );
                return;
            }

            if (
                parseFloat(_this.deposit.amount) >
                parseFloat(_this.setting.max_deposit)
            ) {
                _toast.error(
                    "O valor máximo de depósito é de " +
                        _this.setting.min_deposit
                );
                return;
            }

            _this.deposit.paymentType = _this.paymentType;
            _this.deposit.gateway = _this.paymentGateway;

            _this.isLoading = true;
            HttpApi.post("wallet/deposit/payment", _this.deposit)
                .then((response) => {
                    _this.showPixQRCode = true;
                    _this.isLoading = false;

                    _this.idTransaction = response.data.idTransaction;
                    _this.qrcodecopypast = response.data.qrcode || "";

                    _this.intervalId = setInterval(function () {
                        _this.checkTransactions(_this.idTransaction);
                    }, 5000);
                })
                .catch((error) => {
                    Object.entries(
                        JSON.parse(error.request.responseText)
                    ).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                    _this.showPixQRCode = false;
                    _this.isLoading = false;
                });
        },
        checkTransactions: function (idTransaction) {
            const _this = this;
            const _toast = useToast();

            if (_this.processingDone) return; // evita múltiplos toasts

            HttpApi.post(_this.paymentGateway + "/consult-status-transaction", {
                idTransaction: idTransaction,
            })
                .then((response) => {
                    if (response.data.status === "APPROVED") {
                        _this.processingDone = true;
                        clearInterval(_this.intervalId);
                        _toast.success("Depósito concluído com sucesso");
                        setTimeout(() => location.reload(), 1500);
                    }
                })
                .catch(() => {
                    // opcional: tratar erros
                });
        },
        copyQRCode: function (event) {
            const _toast = useToast();
            var inputElement = document.getElementById("pixcopiaecola");
            inputElement.select();
            inputElement.setSelectionRange(0, 99999); // Para dispositivos móveis
            console.log("QRCode PIX:", this.qrcodecopypast);
            // Copia o conteúdo para a área de transferência
            document.execCommand("copy");
            _toast.success("Pix Copiado com sucesso");
        },
        setAmount: function (amount) {
            this.deposit.amount = amount;
            this.selectedAmount = amount;
        },
        getWallet: function () {
            const _this = this;
            const _toast = useToast();
            _this.isLoadingWallet = true;

            HttpApi.get("profile/wallet")
                .then((response) => {
                    _this.wallet = response.data.wallet;
                    _this.currency = response.data.wallet.currency;
                    _this.isLoadingWallet = false;
                })
                .catch((error) => {
                    const _this = this;
                    Object.entries(
                        JSON.parse(error.request.responseText)
                    ).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                    _this.isLoadingWallet = false;
                });
        },
        getSetting: function () {
            const _this = this;
            const settingStore = useSettingStore();
            const settingData = settingStore.setting;

            if (settingData) {
                _this.setting = settingData;
                _this.amount = settingData.max_deposit;

                if (
                    _this.paymentType === "stripe" &&
                    settingData.stripe_is_enable
                ) {
                    _this.getSession();
                }

                // 👇 Prioridade de gateways Pix
                if (settingData.safiracash_is_enable) {
                    _this.setPaymentMethod("pix", "safiracash");
                } else if (settingData.digitopay_is_enable) {
                    _this.setPaymentMethod("pix", "digitopay");
                } else if (settingData.bspay_is_enable) {
                    _this.setPaymentMethod("pix", "bspay");
                }
            }
        },
    },
    created() {
        if (this.isAuthenticated) {
            this.getWallet();
            this.getSetting();

            if (this.paymentType === "stripe") {
                this.getSession();
                this.currency = "USD";
            }
        }
    },
    watch: {
        amount(oldValue, newValue) {
            if (this.paymentType === "stripe") {
                this.getSession();
                this.currency = "USD";
            }
        },
        currency(oldValue, newValue) {
            if (this.paymentType === "stripe") {
                this.getSession();
            }
        },
    },
};
</script>

<style scoped>
.timer {
    text-align: start;
}
.progress-bar {
    padding: 0px 6%;
    width: 100%;
    background-color: #323637;
    height: 4px;
    margin-bottom: 10px;
    position: relative;
    border-radius: 20px;
}
.progress-bar > div {
    height: 100%;
    background-color: #82a81b;
    position: absolute;
    top: 0;
    left: 0;
    transition: width 0.5s;
    border-radius: 20px;
}
.time-display {
    font-size: 24px;
    font-weight: bold;
}
.completed-message {
    padding: 40px 0;
    font-size: 22px;
    color: #c13a5c;
    text-align: center;
    font-weight: bold;
}
</style>
