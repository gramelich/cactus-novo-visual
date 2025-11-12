<template>
</template>

<script>
export default {
    name: "FixedCardGrid",
    data() {
        return {
            slides: [
                {
                    title: "Ganhe",
                    subtitle: "Indique e",
                    image: "/storage/refer-friend.png",
                    tag: "hot",
                    tagLabel: "🔥 HOT",
                },
                {
                    title: "Aplicativo",
                    subtitle: "Baixe o",
                    image: "/storage/app.png",
                    tag: "novo",
                    tagLabel: "⚡ NOVO",
                },
                {
                    title: "Missões",
                    subtitle: "7Klub",
                    image: "/storage/missions.png",
                    tag: "hot",
                    tagLabel: "🔥 HOT",
                },
                {
                    title: "Aviator",
                    subtitle: "Jogue agora",
                    image: "/storage/aviador.png",
                },
                {
                    title: "Roleta",
                    subtitle: "Jogue ao vivo",
                    image: "/storage/roleta.png",
                },
                {
                    title: "Tiger",
                    subtitle: "Fortune",
                    image: "/storage/tiger.png",
                    tag: "hot",
                    tagLabel: "🔥 HOT",
                },
                {
                    title: "Pirates",
                    subtitle: "Fortune",
                    image: "/storage/pirates.png",
                },
                {
                    title: "Esportes",
                    subtitle: "Esportes",
                    image: "/storage/mines.png",
                },
                {
                    title: "Mines",
                    subtitle: "Jogue agora",
                    image: "/storage/vip-store.png",
                },
            ],
        };
    },
};
</script>

<style scoped>
.card-grid-wrapper {
    background-color: var(--carousel-banners-dark, #111);
    padding: 20px 0;
    display: flex;
    justify-content: center;
    overflow: hidden;
}

/* Desktop: Grid padrão */
.card-grid {
    display: grid;
    grid-template-columns: repeat(9, 1fr);
    gap: 16px;
    max-width: 1300px;
    width: 100%;
    padding: 0 16px;
}

/* Card individual */
.card {
    background-color: transparent;
    border-radius: 12px;
    overflow: hidden;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    cursor: pointer;
}
.card:hover {
    transform: translateY(-6px);
}

/* Imagem */
.icon {
    width: 100%;
    height: 90px;
    object-fit: cover;
    background-color: #030a1c;
    border-radius: 12px 12px 0 0;
    display: block;
}

/* Textos */
.text-group {
    background-color: #030a1c;
    padding: 6px 4px;
    border-radius: 0 0 12px 12px;
}
.subtitle {
    font-size: 11px;
    color: #bbb;
    margin: 0;
}
.title {
    font-size: 13px;
    font-weight: bold;
    color: #fff;
    margin: 0;
}

/* Ribbon */
.ribbon {
    position: absolute;
    top: -5px;
    left: -5px;
    z-index: 0; /* ou remova completamente */
    pointer-events: none; /* evita clique acidental */
}

.ribbon span {
    font-size: 10px;
    font-weight: bold;
    padding: 2px 6px;
    border-radius: 6px;
    color: #fff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
}
.ribbon .hot {
    background-color: #ff3b3b;
}
.ribbon .novo {
    background-color: #ffa500;
}

/* Responsivo */
@media (max-width: 1024px) {
    .card-grid {
        display: flex;
        overflow-x: auto;
        gap: 12px;
        /* padding: 0 16px 12px; */
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }

    .card-grid::-webkit-scrollbar {
        display: none;
    }
    .card-grid {
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* IE 10+ */
    }

    .card {
        flex: 0 0 auto;
        width: 140px;
        scroll-snap-align: start;
    }
}

@media (max-width: 640px) {
    .card {
        width: 120px;
    }
}
</style>
