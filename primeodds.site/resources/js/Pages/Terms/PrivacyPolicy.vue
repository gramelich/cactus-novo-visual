<template>
    <div
      v-if="visible"
      class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 p-4"
      @click.self="close"
    >
      <div
        class="bg-[#0f172a] w-[550px] h-[650px] rounded-lg p-4 text-white flex flex-col overflow-hidden"
      >
        <!-- Cabeçalho -->
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-lg font-bold">Políticas</h2>
          <button
            @click="close"
            class="text-white text-xl hover:text-red-500"
            aria-label="Fechar"
          >
            <i class="fa fa-xmark"></i>
          </button>
        </div>
  
        <!-- Conteúdo -->
        <div class="flex-grow flex overflow-hidden">
          <!-- Menu lateral -->
          <div class="w-1/3 border-r border-gray-600 pr-2 overflow-y-auto space-y-2">
            <button
              v-for="item in sections"
              :key="item.key"
              @click="currentSection = item.key"
              class="w-full text-left px-2 py-1 text-sm rounded transition"
              :class="{
                'bg-blue-600 font-bold text-white': currentSection === item.key,
                'hover:text-blue-400': currentSection !== item.key
              }"
            >
              {{ item.label }}
            </button>
          </div>
  
          <!-- Texto -->
          <div class="w-2/3 pl-4 overflow-y-auto text-sm leading-relaxed">
            <div v-if="currentSection === 'terms'">
              <h3 class="text-lg font-semibold mb-2">Termos e Condições</h3>
              <p>
                Ao utilizar nossa plataforma, você concorda com os nossos termos. É proibido o uso do site por menores de 18 anos. Reservamo-nos o direito de encerrar contas que violem nossas políticas.
              </p>
              <p>
                A responsabilidade sobre dados cadastrados é do usuário. É necessário manter chicobets.sites dados atualizados para garantir o bom funcionamento dos serviços.
              </p>
            </div>
  
            <div v-else-if="currentSection === 'privacy'">
              <h3 class="text-lg font-semibold mb-2">Política de Privacidade</h3>
              <p>
                chicobets.sites dados pessoais são armazenados com segurança e não serão compartilhados com terceiros sem sua autorização. Utilizamos tecnologias modernas de criptografia para proteger suas informações.
              </p>
              <p>
                A qualquer momento, você pode solicitar a remoção ou atualização de chicobets.sites dados entrando em contato com nosso suporte.
              </p>
            </div>
  
            <div v-else-if="currentSection === 'bonus'">
              <h3 class="text-lg font-semibold mb-2">Política de Bônus</h3>
              <p>
                Bônus oferecidos devem ser utilizados conforme as regras estabelecidas. É necessário cumprir o rollover (volume mínimo de apostas) antes de realizar saques.
              </p>
              <p>
                O não cumprimento das regras de uso pode resultar no cancelamento do bônus e dos ganhos obtidos com ele.
              </p>
            </div>
  
            <div v-else-if="currentSection === 'cashout'">
              <h3 class="text-lg font-semibold mb-2">Política de Cashout</h3>
              <p>
                Solicitações de saque passam por verificação e são processadas em até 48 horas úteis. É obrigatório que o CPF utilizado na conta seja o mesmo do titular do método de saque.
              </p>
            </div>
  
            <div v-else-if="currentSection === 'missions'">
              <h3 class="text-lg font-semibold mb-2">Política de Missões</h3>
              <p>
                Missões são desafios temporários com objetivos e recompensas específicas. As regras podem variar por missão e devem ser lidas antes da participação.
              </p>
            </div>
  
            <div v-else-if="currentSection === 'vips'">
              <h3 class="text-lg font-semibold mb-2">Política de VIPs</h3>
              <p>
                O programa VIP oferece benefícios exclusivos para jogadores frequentes. A elegibilidade é baseada em volume de apostas e comportamento na plataforma.
              </p>
              <p>
                O acesso e os benefícios VIP podem ser revogados caso sejam identificadas violações às regras do site.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "PrivacyPolicy",
    props: {
      visible: {
        type: Boolean,
        required: true,
      },
      section: {
        type: String,
        default: "terms",
      },
    },
    data() {
      return {
        currentSection: this.section,
        sections: [
          { key: "terms", label: "Termos e Condições" },
          { key: "privacy", label: "Política de Privacidade" },
          { key: "bonus", label: "Política de Bônus" },
          { key: "cashout", label: "Política de Cashout" },
          { key: "missions", label: "Política de Missões" },
          { key: "vips", label: "Política de VIPs" },
        ],
      };
    },
    watch: {
      section(newVal) {
        this.currentSection = newVal;
      },
    },
    methods: {
      close() {
        this.$emit("close");
      },
    },
  };
  </script>
  
  <style scoped>
  /* Scroll suave se necessário */
  ::-webkit-scrollbar {
    width: 6px;
  }
  ::-webkit-scrollbar-thumb {
    background-color: #334155;
    border-radius: 3px;
  }
  </style>
  