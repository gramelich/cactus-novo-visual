<template>
  <div class="flex items-center justify-center hidden sm:flex">
    <div class="" ref="container">
      <div class="text-sm md:text-md">{{ hora }}</div>
      <div class="text-sm md:text-md">{{ data }}</div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      hora: '',
      data: ''
    };
  },
  mounted() {
    this.atualizarHora();
    setInterval(this.atualizarHora, 1000);
  },
  methods: {
    atualizarHora() {
      const agora = new Date();
      const fusoHorario = agora.getTimezoneOffset() / 60; // Diferença do fuso horário atual para UTC em horas
      const fusoHorarioBrasilia = -3; // Fuso horário de Brasília em relação a UTC

      // Ajustando a hora para o fuso horário de Brasília
      agora.setHours(agora.getHours() + fusoHorario + fusoHorarioBrasilia);

      const horas = agora.getHours();
      const minutos = agora.getMinutes();
      const segundos = agora.getSeconds();

      const horaFormatada = `${this.adicionarZero(horas)}:${this.adicionarZero(minutos)}:${this.adicionarZero(segundos)}`;
      this.hora = horaFormatada;

      const dia = agora.getDate();
      const mes = agora.getMonth() + 1;
      const ano = agora.getFullYear();
      const dataFormatada = `${this.adicionarZero(dia)}/${this.adicionarZero(mes)}/${ano}`;
      this.data = dataFormatada;
    },
    adicionarZero(numero) {
      return numero < 10 ? '0' + numero : numero;
    }
  }
};
</script>

<style scoped>
/* Estilos específicos para este componente, se necessário */
.animate-scrolling {
  display: flex;
  white-space: nowrap;
  animation: scroll-left 20s linear infinite;
}

@keyframes scroll-left {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-100%);
  }
}
</style>



