<template>
    <BaseLayout>
        <div
            class="p-4 max-w-6xl mx-auto text-white flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-8 mt-24"
        >
            <!-- MENU LATERAL -->
            <div class="w-full md:w-1/4">
                <div class="space-y-2">
                    <button
                        v-for="aba in abas"
                        :key="aba"
                        @click="abaSelecionada = aba"
                        class="w-full text-left px-4 py-3 rounded-lg transition-all duration-300 border text-sm"
                        :class="[
                            abaSelecionada === aba
                                ? 'text-primary border-primary bg-primary/10 font-semibold'
                                : 'text-gray-300 border-gray-600 hover:border-primary hover:text-primary',
                        ]"
                    >
                        {{ aba }}
                    </button>
                </div>
            </div>

            <!-- CONTEÚDO -->
            <div class="w-full md:w-3/4 space-y-6">
                <!-- Meus Dados -->
                <div
                    v-if="abaSelecionada === 'Meus Dados'"
                    class="bg-card-dark p-6 rounded-lg shadow-md transition-colors duration-300"
                >
                    <h2
                        class="text-2xl font-semibold mb-6 border-b border-gray-700 pb-2"
                    >
                        Dados do Usuário
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="label">Nome</label
                            ><input
                                v-model="user.name"
                                readonly
                                class="input-field"
                            />
                        </div>
                        <div>
                            <label class="label">E-mail</label
                            ><input
                                v-model="user.email"
                                readonly
                                class="input-field"
                            />
                        </div>
                        <div>
                            <label class="label">Saldo</label
                            ><input
                                :value="formatMoney(user.balance)"
                                disabled
                                class="input-field"
                            />
                        </div>
                        <div>
                            <label class="label">Bônus</label
                            ><input
                                :value="formatMoney(user.balance_bonus)"
                                disabled
                                class="input-field"
                            />
                        </div>
                        <div>
                            <label class="label">Saldo para saque</label
                            ><input
                                :value="formatMoney(user.balance_withdrawal)"
                                disabled
                                class="input-field"
                            />
                        </div>
                        <div>
                            <label class="label">Desde</label
                            ><input
                                :value="formatDateTime(user.created_at)"
                                disabled
                                class="input-field"
                            />
                        </div>
                        <div>
                            <label class="label">Total Apostado</label
                            ><input
                                :value="formatMoney(user.total_bet)"
                                disabled
                                class="input-field"
                            />
                        </div>
                        <div>
                            <label class="label">Total Ganho</label
                            ><input
                                :value="formatMoney(user.total_won)"
                                disabled
                                class="input-field"
                            />
                        </div>
                    </div>
                </div>

                <!-- Histórico de Depósitos -->
                <div
                    v-else-if="abaSelecionada === 'Histórico de Depósitos'"
                    class="bg-card-dark p-6 rounded-lg shadow-md transition-colors duration-300"
                >
                    <h2
                        class="text-2xl font-semibold mb-6 border-b border-gray-700 pb-2"
                    >
                        Histórico de Depósitos
                    </h2>
                    <div
                        v-if="!Array.isArray(deposits) || deposits.length === 0"
                        class="text-gray-400"
                    >
                        Nenhum depósito encontrado.
                    </div>
                    <div
                        v-else
                        v-for="d in deposits"
                        :key="d.id"
                        class="bg-gray-800 p-4 rounded-lg mb-3 hover:bg-gray-700 transition"
                    >
                        💰 Valor: {{ formatMoney(d.amount) }} — Status:
                        <span
                            class="capitalize px-2 py-1 rounded font-semibold text-sm"
                            :class="{
                                'bg-green-600 text-white':
                                    formatStatus(d.status) === 'Aprovado',
                                'bg-red-600 text-white':
                                    formatStatus(d.status) === 'Cancelado',
                                'bg-orange-500 text-white':
                                    formatStatus(d.status) === 'Pendente',
                            }"
                        >
                            {{ formatStatus(d.status) }}
                        </span>
                        — Data: {{ formatDateTime(d.created_at) }}
                    </div>
                    <Pagination
                        :page="depositsPage"
                        :last-page="depositsLastPage"
                        @prev="fetchDeposits(depositsPage - 1)"
                        @next="fetchDeposits(depositsPage + 1)"
                    />
                </div>

                <!-- Histórico de Rodadas -->
                <div
                    v-else-if="abaSelecionada === 'Histórico de Rodadas'"
                    class="bg-card-dark p-6 rounded-lg shadow-md transition-colors duration-300"
                >
                    <h2
                        class="text-2xl font-semibold mb-6 border-b border-gray-700 pb-2"
                    >
                        Histórico de Rodadas
                    </h2>

                    <!-- FILTROS DE DATA -->
                    <div class="flex space-x-4 mb-4">
                        <div>
                            <label class="label" for="startDate"
                                >Data Início</label
                            >
                            <input
                                type="date"
                                id="startDate"
                                v-model="filterStartDate"
                                class="input-field"
                            />
                        </div>
                        <div>
                            <label class="label" for="endDate">Data Fim</label>
                            <input
                                type="date"
                                id="endDate"
                                v-model="filterEndDate"
                                class="input-field"
                            />
                        </div>
                        <div class="flex items-end">
                            <button
                                @click="fetchPartidas(1)"
                                class="btn bg-primary text-white px-4 py-2 rounded"
                            >
                                Filtrar
                            </button>
                        </div>
                    </div>

                    <div
                        v-if="!Array.isArray(partidas) || partidas.length === 0"
                        class="text-gray-400"
                    >
                        Nenhuma rodada encontrada.
                    </div>
                    <div
                        v-else
                        v-for="p in partidas"
                        :key="p.id"
                        class="bg-gray-800 p-4 rounded-lg mb-3 hover:bg-gray-700 transition"
                    >
                        🎮 Jogo: {{ p.game_code || p.game || "Desconhecido" }} —
                        Valor: {{ formatMoney(p.amount) }} — Resultado:
                        <span>
                            Tipo: {{ p.type }} —
                            <span
                                :class="
                                    p.type === 'Vitória'
                                        ? 'text-green-400'
                                        : 'text-red-400'
                                "
                            >
                                {{
                                    p.type === "Vitória" ? "Vitória" : "Derrota"
                                }}
                            </span>
                        </span>

                        — {{ formatDateTime(p.created_at) }}
                    </div>
                    <Pagination
                        :page="partidasPage"
                        :last-page="partidasLastPage"
                        @prev="fetchPartidas(partidasPage - 1)"
                        @next="fetchPartidas(partidasPage + 1)"
                    />
                </div>

                <!-- Histórico de Saques -->
                <div
                    v-else-if="abaSelecionada === 'Histórico de Saques'"
                    class="bg-card-dark p-6 rounded-lg shadow-md transition-colors duration-300"
                >
                    <h2
                        class="text-2xl font-semibold mb-6 border-b border-gray-700 pb-2"
                    >
                        Histórico de Saques
                    </h2>
                    <div
                        v-if="
                            !Array.isArray(withdrawals) ||
                            withdrawals.length === 0
                        "
                        class="text-gray-400"
                    >
                        Nenhum saque encontrado.
                    </div>
                    <div
                        v-else
                        v-for="w in withdrawals"
                        :key="w.id"
                        class="bg-gray-800 p-4 rounded-lg mb-3 hover:bg-gray-700 transition"
                    >
                        🏧 Valor: {{ formatMoney(w.amount) }} — Status:
                        <span
                            class="capitalize px-2 py-1 rounded font-semibold text-sm"
                            :class="{
                                'bg-green-600 text-white':
                                    formatStatus(w.status) === 'Aprovado',
                                'bg-red-600 text-white':
                                    formatStatus(w.status) === 'Cancelado',
                                'bg-orange-500 text-white':
                                    formatStatus(w.status) === 'Pendente',
                            }"
                        >
                            {{ formatStatus(w.status) }}
                        </span>
                        — Data: {{ formatDateTime(w.created_at) }}
                    </div>
                    <Pagination
                        :page="withdrawalsPage"
                        :last-page="withdrawalsLastPage"
                        @prev="fetchWithdrawals(withdrawalsPage - 1)"
                        @next="fetchWithdrawals(withdrawalsPage + 1)"
                    />
                </div>
            </div>
        </div>
    </BaseLayout>
</template>

<script>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import axios from "axios";

// Componente Pagination simples
const Pagination = {
    props: {
        page: Number,
        lastPage: Number,
    },
    template: `
      <div class="flex space-x-2 justify-center mt-4">
        <button
          class="btn bg-gray-700 text-white px-3 py-1 rounded disabled:opacity-50"
          :disabled="page <= 1"
          @click="$emit('prev')"
        >
          Anterior
        </button>
        <span class="px-3 py-1 text-gray-300">Página {{ page }} de {{ lastPage }}</span>
        <button
          class="btn bg-gray-700 text-white px-3 py-1 rounded disabled:opacity-50"
          :disabled="page >= lastPage"
          @click="$emit('next')"
        >
          Próximo
        </button>
      </div>
    `,
};

export default {
    components: { BaseLayout, Pagination },
    data() {
        return {
            abas: [
                "Meus Dados",
                "Histórico de Depósitos",
                "Histórico de Rodadas",
                "Histórico de Saques",
            ],
            abaSelecionada: "Meus Dados",
            user: {
                name: "",
                email: "",
                balance: 0,
                balance_bonus: 0,
                balance_withdrawal: 0,
                created_at: "",
                total_bet: 0,
                total_won: 0,
            },
            deposits: [],
            depositsPage: 1,
            depositsLastPage: 1,
            partidas: [],
            partidasPage: 1,
            partidasLastPage: 1,
            withdrawals: [],
            withdrawalsPage: 1,
            withdrawalsLastPage: 1,

            filterStartDate: "",
            filterEndDate: "",
        };
    },
    mounted() {
        this.loadDados();
    },
    methods: {
        async loadDados() {
            try {
                const token = localStorage.getItem("token");
                const headers = { Authorization: `Bearer ${token}` };
                const perfil = await axios.get("/api/profile", { headers });

                this.user = {
                    ...perfil.data.user,
                    balance: perfil.data.wallet?.balance || 0,
                    balance_bonus: perfil.data.wallet?.balance_bonus || 0,
                    balance_withdrawal:
                        perfil.data.wallet?.balance_withdrawal || 0,
                    total_bet: perfil.data.wallet?.total_bet || 0,
                    total_won: perfil.data.wallet?.total_won || 0,
                    created_at: perfil.data.user.created_at,
                };

                await this.fetchDeposits(1);
                await this.fetchPartidas(1);
                await this.fetchWithdrawals(1);
            } catch (error) {
                console.error("Erro ao carregar dados:", error);
            }
        },

        async fetchDeposits(page = 1) {
            const token = localStorage.getItem("token");
            const headers = { Authorization: `Bearer ${token}` };
            const res = await axios.get(`/api/user/deposits?page=${page}`, {
                headers,
            });
            this.deposits = res.data.data;
            this.depositsPage = res.data.current_page;
            this.depositsLastPage = res.data.last_page;
        },

        async fetchWithdrawals(page = 1) {
            const token = localStorage.getItem("token");
            const headers = { Authorization: `Bearer ${token}` };
            const res = await axios.get(`/api/user/withdrawals?page=${page}`, {
                headers,
            });
            this.withdrawals = res.data.data;
            this.withdrawalsPage = res.data.current_page;
            this.withdrawalsLastPage = res.data.last_page;
        },

        async fetchPartidas(page = 1) {
            try {
                const token = localStorage.getItem("token");
                const headers = { Authorization: `Bearer ${token}` };
                const params = { page };
                if (this.filterStartDate)
                    params.start_date = this.filterStartDate;
                if (this.filterEndDate) params.end_date = this.filterEndDate;

                const res = await axios.get("/api/user/match-history", {
                    headers,
                    params,
                });
                this.partidas = res.data.data;
                this.partidasPage = res.data.current_page;
                this.partidasLastPage = res.data.last_page;
            } catch (error) {
                console.error("Erro ao buscar partidas:", error);
            }
        },

        formatMoney(value) {
            return `R$ ${parseFloat(value).toFixed(2)}`;
        },

        formatStatus(status) {
            if (typeof status === "number") {
                return (
                    ["Pendente", "Aprovado", "Cancelado"][status] ||
                    "Desconhecido"
                );
            }
            if (typeof status === "string") {
                return status.charAt(0).toUpperCase() + status.slice(1);
            }
            return "Desconhecido";
        },

        formatDateTime(dateStr) {
            if (!dateStr) return "";
            const date = new Date(dateStr);
            if (isNaN(date)) return dateStr; // fallback se string inválida
            return date.toLocaleString("pt-BR", {
                day: "2-digit",
                month: "2-digit",
                year: "numeric",
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
                hour12: false,
                timeZone: "America/Sao_Paulo",
            });
        },
    },
};
</script>

<style scoped>
:root {
    --ci-primary-color: #2563eb;
    --ci-primary-color-hover: #1e40af;
    --card-color-dark: #1f2937;
}

.label {
    @apply block text-gray-400 text-sm mb-1;
}
.bg-primary {
    background-color: var(--ci-primary-color);
}
.bg-primary-hover:hover {
    background-color: var(--ci-primary-color-hover);
}
.bg-card-dark {
    background-color: var(--card-color-dark);
}
.bg-primary\/10 {
    background-color: rgba(37, 99, 235, 0.1);
}
.text-primary {
    color: var(--ci-primary-color);
}
.border-primary {
    border-color: var(--ci-primary-color);
}

.input-field {
    width: 100%;
    background-color: #374151;
    padding: 0.75rem;
    border-radius: 0.5rem;
    border: 1px solid #4b5563;
    opacity: 0.8;
}

.input-field:focus {
    outline: none;
    border-color: var(--ci-primary-color);
    box-shadow: 0 0 6px rgba(37, 99, 235, 0.5);
}

button:disabled {
    cursor: not-allowed;
    opacity: 0.5;
}

::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}
::-webkit-scrollbar-thumb {
    background-color: rgba(100, 116, 139, 0.5);
    border-radius: 3px;
}
</style>
