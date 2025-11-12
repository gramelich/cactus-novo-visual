<style>
.icons-footer {
    color: white;
    font-size: 14px;
    background-color: #212425;
    border-radius: 50%;
    padding: 10px;
}
.align-reverse {
    align-items: start;
}
@media (max-width: 768px) {
    .align-reverse {
        align-items: center;
    }
}
</style>
<template>
    <div
        class="footer pb-32 md:pb-5 mt-5 footer-color p-4 md:p-8"
        style="
            background-image: linear-gradient(
                to bottom,
                var(--ci-gray-medium) 5%,
                var(--ci-gray-over)
            );
        "
    >
        <div class="m-auto flex flex-col">
            <div
                class="w-full flex flex-col-reverse md:flex-row gap-4 justify-between items-center"
            >
                <div class="flex flex-col align-reverse" style="">
                    <a
                        v-if="setting"
                        href="/"
                        class="flex justify-center items-center"
                    >
                        <img
                            :src="`/storage/` + setting.software_logo_black"
                            alt="Logo"
                            class="block dark:hidden"
                            style="
                                max-width: 160px;
                                max-height: 70px;
                                object-fit: contain;
                            "
                        />
                        <img
                            :src="`/storage/` + setting.software_logo_white"
                            alt="Logo"
                            class="hidden dark:block"
                            style="
                                max-width: 160px;
                                max-height: 70px;
                                object-fit: contain;
                            "
                        />
                    </a>
                    <div v-if="custom" class="flex mt-2">
                        <div v-if="custom.instagram" class="flex">
                            <a
                                :href="custom.instagram"
                                target="_blank"
                                class="text-2xl p-1"
                            >
                                <i
                                    class="fa-brands fa-instagram icons-footer"
                                ></i>
                            </a>
                        </div>
                        <div v-if="custom.telegram" class="flex">
                            <a
                                :href="custom.telegram"
                                target="_blank"
                                class="text-2xl p-1"
                            >
                                <i
                                    class="fa-brands fa-telegram icons-footer"
                                ></i>
                            </a>
                        </div>
                        <div v-if="custom.whastapp" class="flex">
                            <a
                                :href="custom.whastapp"
                                target="_blank"
                                class="text-2xl p-1"
                            >
                                <i
                                    class="fa-brands fa-whatsapp icons-footer"
                                ></i>
                            </a>
                        </div>
                        <div v-if="custom.facebook" class="flex">
                            <a
                                :href="custom.facebook"
                                target="_blank"
                                class="text-2xl p-1"
                            >
                                <i
                                    class="fa-brands fa-facebook icons-footer"
                                ></i>
                            </a>
                        </div>
                        <div v-if="custom.youtube" class="flex">
                            <a
                                :href="custom.youtube"
                                target="_blank"
                                class="text-2xl p-1"
                            >
                                <i
                                    class="fa-brands fa-youtube icons-footer"
                                ></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row gap-10 justify-between">
                    <div class="flex flex-col justify-center items-start">
                        <p
                            class="text-white font-bold text-lg pb-2"
                            style="font-size: 14px"
                        >
                            Aposte
                        </p>
                        <div class="flex flex-col gap-1 items-start">
                            <a
                                href="/terms/service"
                                class="flex flex-row gap-1 items-start"
                            >
                                <p
                                    class="text-[#adadad] text-base"
                                    style="font-size: 14px"
                                >
                                    Apostas esportivas
                                </p>
                            </a>

                            <a
                                href="/terms/service"
                                class="flex flex-row gap-1 items-center"
                            >
                                <p
                                    class="text-[#adadad] text-base"
                                    style="font-size: 14px"
                                >
                                    Esportes ao vivo
                                </p>
                            </a>
                            <a
                                href="/terms/service"
                                class="flex flex-row gap-1 items-center"
                            >
                                <p
                                    class="text-[#adadad] text-base"
                                    style="font-size: 14px"
                                >
                                    Jogos slots
                                </p>
                            </a>
                            <a
                                href="/terms/service"
                                class="flex flex-row gap-1 items-center"
                            >
                                <p
                                    class="text-[#adadad] text-base"
                                    style="font-size: 14px"
                                >
                                    Cassino ao vivo
                                </p>
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-col justify-center items-start">
                        <p
                            class="text-white font-bold text-lg pb-2"
                            style="font-size: 14px"
                        >
                            Comunidade
                        </p>
                        <div class="flex flex-col gap-1 items-start">
                            <a
                                href="/terms/service"
                                class="flex flex-row gap-1 items-start"
                            >
                                <p
                                    class="text-[#adadad] text-base"
                                    style="font-size: 14px"
                                >
                                    Promoções
                                </p>
                            </a>

                            <a
                                href="/terms/service"
                                class="flex flex-row gap-1 items-center"
                            >
                                <p
                                    class="text-[#adadad] text-base"
                                    style="font-size: 14px"
                                >
                                    Blog
                                </p>
                            </a>
                            <a
                                href="/terms/service"
                                class="flex flex-row gap-1 items-center"
                            >
                                <p
                                    class="text-[#adadad] text-base"
                                    style="font-size: 14px"
                                >
                                    Central de Ajuda
                                </p>
                            </a>
                            <a
                                href="/terms/service"
                                class="flex flex-row gap-1 items-center"
                            >
                                <p
                                    class="text-[#adadad] text-base"
                                    style="font-size: 14px"
                                >
                                    Aplicativo Movel
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row gap-10 justify-between">
                    <div class="flex flex-col justify-center items-start">
                        <p
                            class="text-white font-bold text-lg pb-2"
                            style="font-size: 14px"
                        >
                            Regras
                        </p>
                        <div class="flex flex-col gap-1 items-start">
                            <a
                                href="/terms/service"
                                class="flex flex-row gap-1 items-start"
                            >
                                <p
                                    class="text-[#adadad] text-base"
                                    style="font-size: 14px"
                                >
                                    Termos & Condições
                                </p>
                            </a>

                            <a
                                href="/betting-terms"
                                class="flex flex-row gap-1 items-center"
                            >
                                <p
                                    class="text-[#adadad] text-base"
                                    style="font-size: 14px"
                                >
                                    Termo De Aposta
                                </p>
                            </a>
                            <a
                                href="/aml-policy"
                                class="flex flex-row gap-1 items-center"
                            >
                                <p
                                    class="text-[#adadad] text-base"
                                    style="font-size: 14px"
                                >
                                    Política AML
                                </p>
                            </a>
                            <a
                                href="/terms/service"
                                class="flex flex-row gap-1 items-center"
                            >
                                <p
                                    class="text-[#adadad] text-base"
                                    style="font-size: 14px"
                                >
                                    Politica de Privacidade
                                </p>
                            </a>
                            <a
                                href="/terms/service"
                                class="flex flex-row gap-1 items-center"
                            >
                                <p
                                    class="text-[#adadad] text-base"
                                    style="font-size: 14px"
                                >
                                    Politica KYC
                                </p>
                            </a>
                            <a
                                href="/responsible-gaming"
                                class="flex flex-row gap-1 items-center"
                            >
                                <p
                                    class="text-[#adadad] text-base"
                                    style="font-size: 14px"
                                >
                                    Central de jogo responsavel
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-row gap-10 justify-between">
                        <div class="flex flex-col justify-center items-start">
                            <p
                                class="text-white font-bold text-lg pb-2"
                                style="font-size: 14px"
                            >
                                Links Úteis
                            </p>
                            <div class="flex flex-col gap-1 items-start">
                                <a
                                    href="https://docs.google.com/forms/d/e/1FAIpQLScLblWYZiuWdJZ8T3P-LnGnLLuDUR4d12odMBZODmUp3Fom_A/viewform?usp=dialog"
                                    @click="callElfsight"
                                    class="flex flex-row gap-1 items-start cursor-pointer"
                                >
                                    <p
                                        class="text-[#adadad] text-base"
                                        style="font-size: 14px"
                                    >
                                        Suporte Ao Vivo
                                    </p>
                                </a>
                                <a
                                    href="https://docs.google.com/forms/d/e/1FAIpQLScLblWYZiuWdJZ8T3P-LnGnLLuDUR4d12odMBZODmUp3Fom_A/viewform?usp=dialog"
                                    class="flex flex-row gap-1 items-center"
                                >
                                    <p
                                        class="text-[#adadad] text-base"
                                        style="font-size: 14px"
                                    >
                                        Contate-nos
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col justify-center items-start md:pr-[300px]"
                    >
                        <p
                            class="text-white font-bold text-lg pb-2"
                            style="font-size: 14px"
                        >
                            Pagamento
                        </p>
                        <div class="w-full flex justify-center">
                            <svg
                                id="Layer_1"
                                data-name="Layer 1"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 952.8 338.7"
                                class="h-8 w-auto text-white"
                                fill="currentColor"
                            >
                                <defs></defs>
                                <path
                                    class="cls-1"
                                    d="M638.9,34.8l-11.3-11.3c-2.8-2.8-2.8-7.3,0-10.1,0,0,0,0,0,0l11.3-11.3c2.8-2.8,7.3-2.8,10.2,0l11.3,11.3c2.8,2.8,2.8,7.3,0,10.1,0,0,0,0,0,0l-11.3,11.3c-2.8,2.8-7.3,2.8-10.1,0,0,0,0,0,0,0M246.1,264.5c-12.3,0-24.1-4.8-32.8-13.5l-47.4-47.4c-3.5-3.3-9-3.3-12.4,0l-47.5,47.5c-8.7,8.7-20.5,13.6-32.8,13.6h-9.3l60,60c18.7,18.7,49.1,18.7,67.8,0l60.1-60.1h-5.8ZM73.3,97.1c12.3,0,24.1,4.9,32.8,13.6l47.5,47.5c3.4,3.4,9,3.4,12.4,0l47.3-47.3c8.7-8.7,20.5-13.6,32.8-13.6h5.7l-60.1-60.1c-18.7-18.7-49.1-18.7-67.8,0,0,0,0,0,0,0l-59.9,59.9h9.3ZM301.6,147l-36.3-36.3c-.8.3-1.7.5-2.6.5h-16.5c-8.6,0-16.8,3.4-22.9,9.5l-47.3,47.3c-8.9,8.9-23.3,8.9-32.1,0l-47.5-47.5c-6.1-6.1-14.3-9.5-22.9-9.5h-20.3c-.8,0-1.7-.2-2.4-.5l-36.6,36.5c-18.7,18.7-18.7,49.1,0,67.8l36.5,36.5c.8-.3,1.6-.5,2.4-.5h20.4c8.6,0,16.8-3.4,22.9-9.5l47.5-47.5c8.6-8.6,23.6-8.6,32.1,0l47.3,47.3c6.1,6.1,14.3,9.5,22.9,9.5h16.5c.9,0,1.8.2,2.6.5l36.3-36.3c18.7-18.7,18.7-49.1,0-67.8,0,0,0,0,0,0"
                                ></path>
                                <path
                                    class="cls-2"
                                    d="M582.8,122v41.3c0,39-31.7,70.7-70.7,70.7h-81.1c-3.3,0-6-2.7-6-6s2.7-6,6-6h81.1c32.4,0,58.7-26.4,58.7-58.8v-41.3c0-32.3-26.3-58.6-58.5-58.7h-57.3c-32.4,0-58.7,26.3-58.7,58.7v194.3c0,3.3-2.7,6-6,6s-6-2.7-6-6V122c0-39,31.7-70.7,70.7-70.7h57.4c38.9.2,70.5,31.8,70.4,70.7ZM617.7,51.3h-24.9c-3.3,0-6,2.7-6,6s2.7,6,6,6h24.9c11.4,0,20.6,9.2,20.6,20.6v145.1c0,3.3,2.7,6,6,6s6-2.7,6-6V83.8c0-17.9-14.6-32.5-32.5-32.5ZM692,63.1h24.7c11.2,0,21.7,4.4,29.6,12.3l57.7,57.7c4.7,4.7,11,7.4,17.8,7.3,6.7,0,13-2.6,17.7-7.3l57.6-57.6c7.9-7.9,18.4-12.3,29.6-12.3h20.1c3.3,0,6-2.7,6-6s-2.7-6-6-6h-20.1c-14.4,0-27.9,5.6-38,15.7l-57.5,57.5c-5.1,5.1-13.5,5.1-18.6,0l-57.7-57.7c-10.2-10.2-23.7-15.7-38.1-15.7h-24.7c-3.3,0-6,2.7-6,6s2.7,6,6,6ZM946.7,221.5h-20.1c-11.2,0-21.7-4.4-29.6-12.3l-57.5-57.5c-9.8-9.8-25.7-9.8-35.5,0l-57.7,57.7c-7.9,7.9-18.4,12.3-29.6,12.3h-24.7c-3.3,0-6,2.7-6,6s2.7,6,6,6h24.7c14.4,0,27.9-5.6,38-15.7l57.7-57.7c5.1-5.1,13.5-5.1,18.6,0l57.5,57.5c10.2,10.2,23.7,15.7,38,15.7h20.1c3.3,0,6-2.7,6-6s-2.7-6-6-6ZM442.5,299.8c4.5,0,6.8,2.2,6.8,7.1s-2.8,7.2-8.8,7.2c-2.4,0-4.7-.4-6.9-1.2v-11.8c2.9-.8,5.9-1.2,8.9-1.4M433.7,321.7v-6.9c2.3.7,4.7,1.1,7.1,1.1,2.4,0,4.8-.5,6.9-1.5,2.8-1.6,3.8-4.6,3.8-7.5s-.7-5.6-2.7-7.3c-1.8-1.3-3.9-1.9-6.1-1.8-3.1.2-6.2.7-9.3,1.5l-.2-1h-1.6v23.4h2ZM466.4,299.7c5.9,0,8.5,2.3,8.5,7.4s-2.6,7.1-8.5,7.1-8.6-2.3-8.6-7.3,2.6-7.1,8.6-7.1M474,314.1c2.2-1.5,3-4.1,3-7.2s-.8-5.6-3-7.2c-2-1.4-4.6-1.8-7.6-1.8s-5.7.4-7.7,1.8c-2.2,1.6-3.1,4-3.1,7.2s.9,5.7,3.1,7.2c1.9,1.4,4.6,1.8,7.7,1.8s5.6-.4,7.6-1.8M503.9,315.5l7.1-17.1h-2.2l-5.7,14.4h-.1l-6.5-14.4h-1.8l-6.4,14.4h-.1l-5.9-14.4h-2.2l7,17.1h1.8l6.5-14.2h.1l6.6,14.2h1.8ZM523.8,299.6c5.5,0,7.5,2.1,7.7,6h-15.4c.3-3.5,2.2-6,7.7-6M523.7,315.9c3,0,6-.4,9-1v-1.8c-2.9.6-5.9.9-8.8,1-6.7,0-7.8-3.1-7.9-6.6h17.5c0-3.3-.5-6.2-3-7.9-2.1-1.2-4.5-1.8-6.8-1.7-2.4-.1-4.7.5-6.7,1.7-2.3,1.7-3.2,4.4-3.2,7.3s.7,5.4,2.7,7.1c1.7,1.4,3.8,1.9,7.1,1.9M541.3,315.4v-14.4c3.8-1,5.4-1.4,8.1-1.4h.5v-1.9h-.2c-3.2,0-4.9.6-8.5,1.5l-.2-1h-1.6v17.1h2ZM561.5,299.6c5.5,0,7.5,2.1,7.7,6h-15.4c.3-3.5,2.2-6,7.7-6M561.4,315.9c3,0,6-.4,9-1v-1.8c-2.9.6-5.9.9-8.9,1-6.7,0-7.8-3.1-7.9-6.6h17.6c0-3.3-.5-6.2-3-7.9-2.1-1.2-4.5-1.8-6.8-1.7-2.4-.1-4.7.5-6.7,1.7-2.3,1.7-3.2,4.4-3.2,7.3s.7,5.4,2.7,7.1c1.7,1.4,3.8,1.9,7.1,1.9M593.2,312.7c-2.9.7-5.9,1.2-8.9,1.3-4.5,0-6.8-2.2-6.8-7.1s2.8-7.2,8.8-7.2c2.4,0,4.7.4,6.9,1.1v11.9ZM595.2,315.5v-24.4h-2v7.8c-2.3-.7-4.7-1-7.1-1.1-2.4,0-4.8.5-6.9,1.6-2.8,1.6-3.8,4.4-3.8,7.5s.7,5.6,2.7,7.2c1.7,1.3,3.9,1.9,6.1,1.8,3.1-.2,6.2-.7,9.3-1.5l.2,1h1.6ZM624.5,299.8c4.5,0,6.8,2.2,6.8,7.1s-2.8,7.2-8.8,7.2c-2.4,0-4.7-.4-6.9-1.2v-11.8c2.9-.8,5.9-1.2,8.9-1.4M629.7,314.4c2.8-1.6,3.8-4.6,3.8-7.5s-.7-5.6-2.7-7.3c-1.8-1.3-3.9-1.9-6.1-1.8-3.1.2-6.1.7-9.1,1.4v-8.2h-2v24.3h1.4v-.8c2.6.8,5.2,1.3,7.8,1.3,2.4,0,4.7-.5,6.9-1.5M636.1,322c.8.1,1.6.2,2.5.2,3.5,0,5.4-1.2,7.2-4.6l9.6-19.2h-2.3l-7.3,14.8h-.1l-7.7-14.8h-2.3l9,17.1-.7,1.4c-1.4,2.8-2.9,3.5-5.4,3.5s-1.5,0-2.5-.2v1.9M683,305.7c4,0,6.3.3,6.3,3s-1.7,3-6.3,3h-6.6v-6h6.6M681.8,296c4.1,0,6.3.3,6.3,3s-1.8,3.1-6.3,3.1h-5.5v-6.1h5.4M692.1,313.8c1.7-1,2.6-2.8,2.5-4.7,0-3.3-1.9-4.8-4.9-5.5h0c2.7-1.2,3.7-2.9,3.7-5.3.1-1.9-.8-3.7-2.4-4.6-2.4-1.4-5.2-1.5-9.9-1.5h-9.9v23.3h10.2c5.4,0,8.3,0,10.8-1.6M714.8,311.6c-2.4.6-4.8.9-7.2,1-2.7,0-3.7-.7-3.7-2.3s1.2-2.3,4.7-2.3,4.2,0,6.2.3v3.3ZM719.7,315.5v-10.1c0-2.5-.4-4.5-2.3-5.9s-5-1.6-8-1.6-5,.1-7.4.3v3.5c2.2-.2,4.5-.3,6.3-.3,4.8,0,6.6.9,6.6,3.6v.3c-2-.1-4.4-.2-6.2-.2s-4.6,0-6.4.9c-.6.3-1.2.8-1.7,1.3-1.9,2.2-1.6,5.6.7,7.5,1.6.9,3.4,1.4,5.2,1.3,3.1-.1,6.3-.6,9.3-1.5v1c.1,0,4,0,4,0ZM746.7,315.5v-10.5c0-2.4-.5-4.1-1.9-5.4-1.7-1.3-3.8-1.9-5.9-1.8-3.1.2-6.2.7-9.2,1.6l-.2-1.1h-3.9v17.1h4.8v-12.6c2.3-.6,4.6-1,7-1.1,2.8,0,4.4,1.1,4.4,4.2v9.5h4.7ZM760.2,315.9c2.8,0,5.6-.5,8.3-1.1v-3.5c-2.4.5-4.8.8-7.2.9-3.7,0-5.3-1.6-5.3-5.3s2.1-5.4,6.7-5.4,3.7.1,5.5.3v-3.7c-2.1-.2-4-.3-6-.3s-5.4.3-7.5,1.7c-2.6,1.7-3.5,4.6-3.5,7.3s.6,5.6,2.7,7.3c1.8,1.5,4.2,1.8,6.4,1.8M782.7,301.4c4.5,0,6.5,1.7,6.5,5.6s-1.9,5.3-6.5,5.3-6.5-1.7-6.5-5.6,2-5.3,6.5-5.3M790.9,314.1c2.3-1.6,3.2-4.2,3.2-7.3s-.8-5.7-3.2-7.2c-2.1-1.4-4.8-1.8-8.2-1.8s-6.2.4-8.2,1.8c-2.4,1.6-3.2,4.2-3.2,7.3s.8,5.7,3.2,7.2c2.1,1.4,4.9,1.8,8.2,1.8s6.1-.4,8.2-1.8M821.7,315.9c3.8-.1,7.5-.6,11.2-1.5v-4.1c-3.4.8-6.9,1.3-10.3,1.4-4.9,0-7.5-2.5-7.5-7.9s2.8-7.9,9.4-7.9,5.4.2,7.9.4v-4.2c-2.9-.2-5.5-.4-8.1-.4s-7,.4-9.8,2.2c-3.6,2.4-4.7,6.4-4.7,9.9s.8,7.4,3.6,9.7c2.3,1.9,5.5,2.4,8.3,2.4M847,300.9c4,0,5.6,1.2,5.7,4h-11.5c.3-2.6,1.8-4,5.8-4M846.3,315.9c3.5,0,6.9-.5,10.3-1.1v-3.4c-3,.5-6.1.8-9.1.9-4.8,0-6.2-1.7-6.3-4.3h16.3c0-3.5-.2-6.5-3-8.4-2.1-1.5-5-1.7-7.4-1.7s-5.4.3-7.5,1.8c-2.4,1.7-3.2,4.6-3.2,7.2s.8,5.6,2.8,7.2,4.5,1.9,7.3,1.9M883.5,315.5v-10.5c0-2.4-.5-4.1-1.9-5.4-1.7-1.3-3.8-1.9-5.9-1.8-3.1.2-6.2.7-9.2,1.6l-.2-1.1h-3.9v17.1h4.8v-12.6c2.3-.6,4.6-1,7-1.1,2.8,0,4.4,1.1,4.4,4.2v9.5h4.7ZM897.1,315.9c1.7,0,3.3-.3,5-.6v-3.4c-1.1.2-2.3.3-3.4.3-1.5,0-2.6-.4-3.1-1.6-.4-1-.5-2.2-.5-3.3v-5.5h6.8v-3.6h-6.8v-5.2h-4.2l-.5,5.2h-3.5v3.6h3.5v6.4c-.1,1.8.3,3.6,1.3,5.2,1.2,1.8,3.2,2.5,5.6,2.5M911.2,315.5v-12.6c2.2-.6,4.5-.9,6.7-.9h1.7v-4.1c-.2,0-.4,0-.6,0-2.9.1-5.7.6-8.5,1.6l-.2-1.1h-3.9v17.1h4.8ZM937,311.6c-2.4.6-4.8.9-7.2,1-2.7,0-3.7-.7-3.7-2.3s1.2-2.3,4.7-2.3,4.2,0,6.2.3v3.3ZM941.8,315.5v-10.1c0-2.5-.4-4.5-2.3-5.9s-5-1.6-8-1.6-5,.1-7.4.3v3.5c2.2-.2,4.4-.3,6.3-.3,4.8,0,6.6.9,6.6,3.6v.3c-2-.1-4.4-.2-6.2-.2s-4.6,0-6.4.9c-1.8.8-3,2.6-2.9,4.6,0,1.6.6,3.2,1.9,4.1,1.6.9,3.4,1.4,5.2,1.3,3.1-.1,6.3-.6,9.3-1.5v1c.1,0,3.9,0,3.9,0ZM947.9,315.5h4.8v-24.4h-4.8v24.4Z"
                                ></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="flex flex-col border-y-[1px] border-[#5B5E5F] my-[40px] text-center text-base"
            >
                <p class="pt-[20px]" style="font-size: 12px">
                    BACOSI – Apostas, Cassino e Diversão com as
                    Melhores Odds Seja bem-vindo ao bacosi.com.br, a casa das
                    melhores odds e da emoção sem limites! Aqui você encontra
                    cotações competitivas em diversos esportes e jogos de
                    cassino, com atualizações em tempo real para garantir sempre
                    o melhor retorno.
                </p>
                <template v-if="expanded">
                    <p style="font-size: 12px">
                        Esportes e Apostas ao Vivo Aposte nos bacosi.com.br esportes
                        favoritos – futebol, corridas e muito mais. Sinta a
                        adrenalina das apostas ao vivo, com odds dinâmicas
                        enquanto o jogo acontece. Cassino Online: Slots, Mesa e
                        Cassino ao Vivo Explore um cassino online premium com
                        slots, jogos de mesa e cassino ao vivo, tudo com
                        gráficos incríveis e experiência imersiva. eSports: A
                        Nova Fronteira das Apostas Mergulhe no universo dos
                        eSports! Aposte em campeonatos de jogos eletrônicos como
                        LoL, CS:GO, Valorant e muito mais.
                    </p>
                </template>
                <div
                    class="flex justify-center items-center mt-2 mb-4 w-full"
                    style="
                        background: linear-gradient(
                            to bottom,
                            rgb(33 36 37 / 0%),
                            var(--footer-color-dark)
                        );
                    "
                >
                    <button
                        @click.prevent="toggleExpanded"
                        class="px-4 flex justify-center items-center text-center"
                        style="opacity: 0.8"
                    >
                        <p class="text-white text-xs">
                            {{ expanded ? "Ver menos" : "Ver mais" }}
                        </p>
                    </button>
                </div>
            </div>
            <div
                class="flex justify-center items-center text-center flex-row gap-2 border-[#ffffff]"
            >
                <span class="text-3xl">🇧🇷</span>
                <h2>Feito com 💚 para Brasileiros!</h2>
            </div>

            <div
                class="flex flex-col-reverse md:flex-row items-center justify-center gap-2 border-y-[1px] border-[#5B5E5F] my-[40px] text-center text-base py-[20px]"
            >
                <div class="w-full md:w-[80%]">
                    <p
                        style="font-size: 12px; line-height: 15px"
                        class="pt-[20px] text-white text-left md:text-center"
                    >
                        <strong>{{ setting.software_name }}</strong> é um site
                        de entretenimento online que oferece aos bacosi.com.br usuários
                        uma experiência única em apostas esportivas e jogos
                        online. Este site é operado pela
                        <b>NovaWave Technology N.V.</b>, a company uma empresa
                        registrada no Brasil, sob o número CNPJ
                        55.933.850/0001-34, com sede em AL OSCAR NIEMEYER, 132 -
                        ANDAR 12 SALA 1202 - CEP 34.006-049 - Vale do Sereno -
                        Nova Lima/MG, entidade devidamente autorizada a operar a
                        modalidade lotérica de apostas de quota fixa no Brasil,
                        em temática desportiva e jogos online, conjuntamente,
                        pela Secretaria de Prêmios e Apostas do Ministério da
                        Fazenda, conforme Portaria SPA/MF n.º 322/2025,
                        publicada em 17 de fevereiro de 2025 no Diário Oficial
                        da República Federativa do Brasil. <br /><br />
                        Ao acessar, continuar a usar ou navegar neste site, você
                        concorda que podemos usar determinados cookies do
                        navegador para melhorar sua experiência ao usar nosso
                        site. Utilizamos cookies apenas para melhorar a sua
                        experiência e isso não interfere na sua privacidade.
                    </p>
                </div>
                <div
                    class="w-[180px] h-auto md:h-[140px] flex items-center justify-center"
                >
                    <img
                        src="https://bacosi.com.br/storage/autorizado.png"
                        alt="GAMING LICENSEE CLICK FOR MORE INFORMATION"
                        class="max-w-full max-h-full object-contain"
                    />
                </div>
            </div>
            <div class="flex flex-col justify-center items-center">
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a
                        href="#"
                        class="w-[120px] h-[40px] md:h-[50px] flex justify-center items-center"
                    >
                        <img
                            src="https://bacosi.com.br/storage/ibia.png"
                            alt="Ibia"
                            class="h-full object-contain"
                        />
                    </a>
                    <a
                        href="#"
                        class="w-[120px] h-[40px] md:h-[50px] flex justify-center items-center"
                    >
                        <img
                            src="https://bacosi.com.br/storage/reclameaqui.png"
                            alt="Reclame-Aqui"
                            class="h-full object-contain"
                        />
                    </a>
                    <a
                        href="#"
                        class="flex items-center gap-2 px-4 py-2 rounded-md border border-[var(--ci-primary-color)] text-white hover:bg-transparent hover:text-[var(--ci-primary-color)] bg-[var(--ci-primary-color)] text-white hover:bg-transparent hover:text-[var(--ci-primary-color)] text-white hover:bg-transparent hover:text-[--ci--primary-color] transition-colors duration-200"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 16L8 12h3V4h2v8h3l-4 4zm8 4H4v-2h16v2z"
                            />
                        </svg>
                        <span class="text-sm font-semibold"
                            >Baixe nosso app</span
                        >
                    </a>

                    <a
                        href="#"
                        class="w-[120px] h-[40px] md:h-[50px] flex justify-center items-center"
                    >
                        <img
                            src="https://bacosi.com.br/storage/ebac.png"
                            alt="EBAC"
                            class="h-full object-contain"
                        />
                    </a>
                    <a
                        href="#"
                        class="w-[120px] h-[40px] md:h-[50px] flex justify-center items-center"
                    >
                        <img
                            src="https://bacosi.com.br/storage/compulse.png"
                            alt="Compulsive Player Support"
                            class="h-full object-contain"
                        />
                    </a>
                    <a
                        href="#"
                        class="w-[120px] h-[40px] md:h-[50px] flex justify-center items-center"
                    >
                        <img
                            src="https://bacosi.com.br/storage/begambleaware.png"
                            alt="BeGambleAware"
                            class="h-full object-contain"
                        />
                    </a>
                    <a
                        href="#"
                        class="w-[120px] h-[40px] md:h-[50px] flex justify-center items-center"
                    >
                        <img
                            src="https://bacosi.com.br/storage/gt.png"
                            alt="GT Support"
                            class="h-full object-contain"
                        />
                    </a>
                </div>

                <div
                    class="flex flex-row items-center justify-center gap-2 mt-4"
                >
                    <a
                        href="/responsible-gaming"
                        class="flex items-center gap-2 text-white"
                    >
                        <svg
                            fill="none"
                            viewBox="0 0 200 200"
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-8 h-8 md:w-10 md:h-10"
                            title="Para maiores de 18 anos"
                        >
                            <circle
                                cx="100"
                                cy="100"
                                fill="currentColor"
                                r="100"
                            ></circle>
                            <circle
                                cx="99.9231"
                                cy="99.9231"
                                fill="black"
                                r="76.9231"
                            ></circle>
                            <path
                                d="M45 91.304V76.2294C53.0312 74.8205 58.788 70.3122 62.2706 62.7044H72.7182V136.951H58.6459V84.4007C55.803 87.3123 51.2544 89.6134 45 91.304Z"
                                fill="white"
                            ></path>
                            <path
                                d="M82.9527 97.0803C78.9726 93.4173 76.9826 88.2985 76.9826 81.7239C76.9826 76.5581 78.5462 72.0028 81.6733 68.058C84.8716 64.0193 89.7756 62 96.3853 62C102.711 62 107.508 63.9724 110.777 67.9172C114.118 71.768 115.788 76.3702 115.788 81.7239C115.788 88.2985 113.798 93.4173 109.818 97.0803C115.575 101.213 118.453 107.365 118.453 115.536C118.453 122.205 116.428 127.793 112.377 132.301C108.325 136.716 102.995 138.923 96.3853 138.923C89.7045 138.923 84.3386 136.669 80.2874 132.161C76.3074 127.652 74.3174 122.111 74.3174 115.536C74.3174 111.122 75.1702 107.365 76.876 104.265C78.5817 101.072 80.6073 98.677 82.9527 97.0803ZM96.3853 91.5858C98.02 91.5858 99.477 90.9753 100.756 89.7543C102.036 88.4394 102.675 86.5139 102.675 83.978C102.675 81.3482 102.036 79.3758 100.756 78.0609C99.477 76.7459 98.02 76.0885 96.3853 76.0885C94.7507 76.0885 93.2581 76.7459 91.9078 78.0609C90.6285 79.3758 89.9888 81.3482 89.9888 83.978C89.9888 86.42 90.6285 88.2985 91.9078 89.6134C93.2581 90.9283 94.7507 91.5858 96.3853 91.5858ZM96.3853 124.271C98.8018 124.271 100.721 123.379 102.142 121.594C103.635 119.81 104.381 117.509 104.381 114.691C104.381 111.685 103.599 109.243 102.036 107.365C100.543 105.393 98.6596 104.406 96.3853 104.406C94.0399 104.406 92.121 105.393 90.6285 107.365C89.1359 109.243 88.3897 111.685 88.3897 114.691C88.3897 117.603 89.1004 119.951 90.5219 121.735C92.0144 123.426 93.9689 124.271 96.3853 124.271Z"
                                fill="white"
                            ></path>
                            <path
                                d="M143.66 85.0769V84.0769H142.66H138.264H137.264V85.0769V97.3553H125.077H124.077V98.3553V102.659V103.659H125.077H137.264V115.846V116.846H138.264H142.66H143.66V115.846V103.659H155.846H156.846V102.659V98.3553V97.3553H155.846H143.66V85.0769Z"
                                fill="white"
                                stroke="white"
                                stroke-width="2"
                            ></path>
                        </svg>
                        <span class="text-[12px] md:text-[14px] text-white"
                            >Para maiores de 18 anos, jogue com
                            responsabilidade</span
                        >
                    </a>
                </div>

                <div
                    class="flex flex-wrap justify-center items-center text-white text-[12px] md:text-[14px] gap-x-4 mt-3"
                >
                    <a
                        href="https://docs.google.com/forms/d/e/1FAIpQLScLblWYZiuWdJZ8T3P-LnGnLLuDUR4d12odMBZODmUp3Fom_A/viewform?usp=dialog"
                        style="
                            color: var(--ci-primary-color);
                            text-decoration: underline;
                            cursor: pointer;
                        "
                        >Suporte ao jogador</a
                    >
                    <span>|</span>
                    <a
                        href="https://docs.google.com/forms/d/e/1FAIpQLScLblWYZiuWdJZ8T3P-LnGnLLuDUR4d12odMBZODmUp3Fom_A/viewform?usp=dialog"
                        style="
                            color: var(--ci-primary-color);
                            text-decoration: underline;
                            cursor: pointer;
                        "
                        >Jurídico</a
                    >
                    <span>|</span>
                    <a
                        href="https://bacosi.com.br/storage/autorizado.png"
                        style="
                            color: var(--ci-primary-color);
                            text-decoration: underline;
                            cursor: pointer;
                        "
                        >Parceiros</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import { useSettingStore } from "@/Stores/SettingStore.js";
import { footerStore } from "@/Stores/FooterStore.js";

export default defineComponent({
    data() {
        return {
            isLoading: false,
            year: new Date().getFullYear(),
            setting: null,
            expanded: false,
            custom: null,
        };
    },
    computed: {
        footerTextMenu() {
            return footerStore.getFooterStatus();
        },
    },
    methods: {
        toggleExpanded() {
            this.expanded = !this.expanded;
        },
        getSetting() {
            const settingStore = useSettingStore();
            const settingData = settingStore.setting;

            if (settingData) {
                this.setting = settingData;
            }
        },
    },
    created() {
        this.getSetting();
        const savedLang = localStorage.getItem("lang");
        if (savedLang) {
            this.selectedLang = savedLang;
        }
    },
});
</script>

<style scoped></style>
