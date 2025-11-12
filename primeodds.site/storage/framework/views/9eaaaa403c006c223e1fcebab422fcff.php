<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="dark">
    <head>
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="application-name" content="Nome do chicobets.site Site">
        <link rel="icon" type="image/png" sizes="192x192" href="/img/icon.png"> <!-- ícone para Android -->
        <link rel="apple-touch-icon" href="/img/icon.png"> <!-- ícone para iOS -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <?php $setting = \Helper::getSetting() ?>
        <?php if(!empty($setting['software_favicon'])): ?>
            <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('/storage/' . $setting['software_favicon'])); ?>">
        <?php endif; ?>

        <link rel="stylesheet" href="<?php echo e(asset('assets/css/fontawesome.min.css')); ?>">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&family=Roboto+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100&display=swap" rel="stylesheet">        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


        <title><?php echo e(env('APP_NAME')); ?></title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

      
      
      
      
      
      
      
      
   <script>
(function () {
  if (window.location.pathname !== "/") return;

  // 👉 Não mostrar se já instalado
  if (
    window.matchMedia("(display-mode: standalone)").matches ||
    navigator.standalone ||
    localStorage.getItem("pwaInstalado") === "true"
  ) {
    console.log("PWA já instalado — barra não exibida");
    return;
  }

  let deferredPrompt = null;
  window.addEventListener("beforeinstallprompt", (e) => {
    e.preventDefault();
    deferredPrompt = e;
  });

  // 🔥 Detectar instalação real e salvar no localStorage
  window.addEventListener("appinstalled", () => {
    console.log("PWA instalado com sucesso");
    localStorage.setItem("pwaInstalado", "true");
    const barra = document.getElementById("barra-notificacao");
    if (barra) barra.remove();
  });

  const style = document.createElement("style");
  style.textContent = `
    #barra-notificacao {
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      z-index: 9999;
      font-family: sans-serif;
      transform: translateY(-100%);
      transition: transform 0.4s ease, opacity 0.4s ease;
      opacity: 0;
      box-sizing: border-box;
    }
    #barra-notificacao.mostrar { transform: translateY(0); opacity: 1; }
    #barra-notificacao .notificacao-inner {
      background-color: #ff8400;
      color: #fff;
      padding: 12px 18px;
      font-size: 15px;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
      position: relative;
    }
    #barra-notificacao .fechar {
      cursor: pointer;
      font-weight: bold;
      font-size: 18px;
      position: absolute;
      right: 14px; top: 50%;
      transform: translateY(-50%);
      background: transparent;
      border: none;
      color: #fff;
    }
    .btn-baixar, .btn-android {
      background-color: #fff;
      color: #8800ff;
      border: none;
      padding: 6px 14px;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s ease;
      font-size: 14px;
    }
    .btn-baixar:hover, .btn-android:hover { background-color: #f2e5ff; }
    .btn-android img { width: 18px; height: 18px; }

    #modal-pwa {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.8);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 10000;
      padding: 20px;
    }
    #modal-pwa .modal-content {
      background: #fff;
      border-radius: 20px;
      max-width: 420px;
      width: 100%;
      text-align: center;
      padding: 24px 20px 28px;
      position: relative;
      box-shadow: 0 8px 20px rgba(0,0,0,0.4);
      animation: scaleIn 0.3s ease;
    }
    #modal-pwa .modal-content h3 { font-size: 1.2rem; color: #222; margin-bottom: 8px; }
    #modal-pwa .modal-content p { font-size: 0.95rem; color: #555; margin-bottom: 16px; line-height: 1.4; }
    #modal-pwa .modal-content img { width: 100%; border-radius: 22px; box-shadow: 0 2px 10px rgb(0 0 0 / 38%); }
    #modal-pwa .fechar-modal { position: absolute; top: 10px; right: 14px; font-size: 24px; color: #888; cursor: pointer; transition: 0.2s; }
    #modal-pwa .fechar-modal:hover { color: #000; transform: scale(1.2); }
    @keyframes scaleIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
  `;
  document.head.appendChild(style);

  let menuEl = null;
  let menuOriginal = {};
  let barraFechada = false; // flag temporária (não persiste após reload)

  function saveMenuOriginal(menu) {
    menuEl = menu;
    menuOriginal = {
      top: menu.style.top || "",
      marginTop: menu.style.marginTop || "",
      transition: menu.style.transition || "",
      position: menu.style.position || ""
    };
  }

  function restoreMenuOriginal() {
    if (!menuEl) return;
    Object.entries(menuOriginal).forEach(([k, v]) => (menuEl.style[k] = v));
    document.body.style.paddingTop = "0";
  }

  function criarBarra() {
    const barra = document.createElement("div");
    barra.id = "barra-notificacao";

    const isAndroid = /Android/i.test(navigator.userAgent);
    barra.innerHTML = `
      <div class="notificacao-inner">
        <span>📱 Baixe nosso aplicativo</span>
        ${
          isAndroid
            ? `<button class="btn-android"><img src="https://cdn-icons-png.flaticon.com/512/226/226770.png"/>Android</button>`
            : `<button class="btn-baixar">Abrir</button>`
        }
        <button class="fechar">&times;</button>
      </div>
    `;

    barra.querySelector(".fechar").addEventListener("click", () => fecharBarra(barra));
    barra.querySelector(".btn-android")?.addEventListener("click", handleAndroidInstall);
    barra.querySelector(".btn-baixar")?.addEventListener("click", abrirModal);

    return barra;
  }

  async function handleAndroidInstall() {
    if (deferredPrompt) {
      deferredPrompt.prompt();
      const { outcome } = await deferredPrompt.userChoice;
      if (outcome === "accepted") {
        localStorage.setItem("pwaInstalado", "true");
        console.log("Usuário instalou via prompt");
      }
      deferredPrompt = null;
    } else {
      abrirModal();
    }
  }

  function ajustarMenuParaBarra() {
    const barra = document.getElementById("barra-notificacao");
    const menu = document.querySelector("nav[data-v-c044f4d8]");
    if (!barra || !menu) return;

    if (!menuEl) saveMenuOriginal(menu);

    const altura = barra.offsetHeight;
    const estilo = window.getComputedStyle(menu);
    const pos = estilo.position;

    barra.style.position = "fixed";
    barra.style.top = "0";
    barra.style.left = "0";
    barra.style.right = "0";
    barra.style.zIndex = "9999";

    if (pos === "fixed" || pos === "sticky") {
      menu.style.top = altura + "px";
      document.body.style.paddingTop = "0";
    } else {
      menu.style.top = "";
      document.body.style.paddingTop = altura + "px";
    }
  }

  function fecharBarra(barra) {
    barraFechada = true;
    barra.classList.remove("mostrar");
    setTimeout(() => {
      restoreMenuOriginal();
      barra.remove();
    }, 350);
  }

  function abrirModal() {
    let modal = document.getElementById("modal-pwa");
    if (!modal) {
      modal = document.createElement("div");
      modal.id = "modal-pwa";
      modal.innerHTML = `
        <div class="modal-content">
          <span class="fechar-modal">&times;</span>
          <h3>Como instalar o app</h3>
          <p>Abra o menu do navegador e selecione "Adicionar à tela inicial".</p>
          <img src="https://i.imgur.com/hHdJhrh.png" alt="Instruções"/>
        </div>
      `;
      document.body.appendChild(modal);
      modal.querySelector(".fechar-modal").addEventListener("click", () => (modal.style.display = "none"));
      modal.addEventListener("click", (e) => {
        if (e.target === modal) modal.style.display = "none";
      });
    }
    modal.style.display = "flex";
  }

  // 👇 Intervalo que exibe a barra apenas quando não há modais nem forms
  const intervalo = setInterval(() => {
    const menu = document.querySelector("nav[data-v-c044f4d8]");
    const formAberto = document.querySelector("form[data-v-5edcbc7d]");
    const modalAuthAberto = document.getElementById("modalElAuth");

    if (barraFechada) return; // não recriar se usuário fechou
    if (!menu || formAberto || modalAuthAberto) return; // não mostrar se modal ativo

    if (!document.getElementById("barra-notificacao")) {
      const barra = criarBarra();
      menu.parentNode.insertBefore(barra, menu);
      requestAnimationFrame(() => {
        setTimeout(() => {
          barra.classList.add("mostrar");
          ajustarMenuParaBarra();
        }, 80);
      });
      window.addEventListener("resize", ajustarMenuParaBarra);
      window.addEventListener("orientationchange", ajustarMenuParaBarra);
    }
  }, 300);
})();
</script>





<script>
document.addEventListener("DOMContentLoaded", function() {
  // procura pela DIV com a classe específica
  const target = document.querySelector("div.mt-2");
  if (!target) return;

  // cria o container do carrossel
  const carouselSection = document.createElement("div");
  carouselSection.className = "carousel-wrapper w-full overflow-hidden py-4";

  carouselSection.innerHTML = `
    <div class="carousel-track flex animate-scroll">
      <img src="https://bacosi.com.br/storage/Games/Spribe/mines.webp" alt="Mines" class="mx-2 w-60 rounded-xl shadow-lg" />
      <img src="https://bacosi.com.br/storage/Games/Pragmatic/vs5luckytig.webp" alt="Tiger" class="mx-2 w-60 rounded-xl shadow-lg" />
      <img src="https://bacosi.com.br/storage/Games/Spribe/Aviator.webp" alt="Aviator" class="mx-2 w-60 rounded-xl shadow-lg" />
      <img src="https://bacosi.com.br/storage/Games/Evolution_Original/9610.webp" alt="Roleta" class="mx-2 w-60 rounded-xl shadow-lg" />

      <!-- duplicado para loop -->
      <img src="https://bacosi.com.br/storage/Games/Spribe/mines.webp" alt="Mines" class="mx-2 w-60 rounded-xl shadow-lg" />
      <img src="https://bacosi.com.br/storage/Games/Pragmatic/vs5luckytig.webp" alt="Tiger" class="mx-2 w-60 rounded-xl shadow-lg" />
      <img src="https://bacosi.com.br/storage/Games/Spribe/Aviator.webp" alt="Aviator" class="mx-2 w-60 rounded-xl shadow-lg" />
      <img src="https://bacosi.com.br/storage/Games/Evolution_Original/9610.webp" alt="Roleta" class="mx-2 w-60 rounded-xl shadow-lg" />
    </div>
  `;

  // insere acima da div.mt-2
  target.parentNode.insertBefore(carouselSection, target);

  // adiciona o CSS
  const style = document.createElement("style");
  style.textContent = `
    @keyframes scrollLoop {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }

    .carousel-track {
      display: flex;
      width: max-content;
      animation: scrollLoop 25s linear infinite;
    }

    .carousel-wrapper img {
      transition: transform 0.3s ease;
    }

    .carousel-wrapper img:hover {
      transform: scale(1.05);
    }

    .carousel-track:hover {
      animation-play-state: paused;
    }
  `;
  document.head.appendChild(style);
});
</script>

      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
<script>
(function () {
  const IDS = { wrapper: 'ganhos-inject-wrapper-final' };

  const ganhos = [
    { img: "https://bacosi.com.br/storage/Games/Spribe/mines.webp", nome: "Juliano Silva", valor: "R$ 1.158", jogo: "MINES" },
    { img: "https://bacosi.com.br/storage/Games/Pragmatic/vs5luckytig.webp", nome: "Hugo Ribeiro", valor: "R$ 622", jogo: "TIGRE" },
    { img: "https://bacosi.com.br/storage/Games/Spribe/Aviator.webp", nome: "Rodrigo M.", valor: "R$ 810", jogo: "AVIATOR" },
    { img: "https://bacosi.com.br/storage/Games/Evolution_Original/9610.webp", nome: "Tatiane Santos", valor: "R$ 345", jogo: "ROLETA" },
    { img: "https://bacosi.com.br/storage/Games/Pragmatic/vs20doghouse.webp", nome: "Felipe Rocha", valor: "R$ 529", jogo: "DOGHOUSE" },
    { img: "https://bacosi.com.br/storage/Games/Pragmatic/vs20starlight.webp", nome: "Camila Ribeiro", valor: "R$ 486", jogo: "STARLIGHT" }
  ];

  function buildCarousel() {
    if (document.getElementById(IDS.wrapper)) return document.getElementById(IDS.wrapper);

    const wrapper = document.createElement('div');
    wrapper.id = IDS.wrapper;
    wrapper.className = 'ganhos-wrapper-final';
    wrapper.innerHTML = `
      <div class="ganhos-inner">
        <div class="ganhos-label">
          <div class="g-title">GANHOS</div>
          <div class="g-sub">DE HOJE</div>
        </div>
        <div class="ganhos-viewport">
          <div class="ganhos-track"></div>
        </div>
      </div>
    `;

    const track = wrapper.querySelector('.ganhos-track');
    const all = [...ganhos, ...ganhos, ...ganhos]; // triplica para loop contínuo
    all.forEach((g) => {
      const card = document.createElement('div');
      card.className = 'ganho-card';
      card.innerHTML = `
        <div class="card-thumb"><img loading="lazy" src="${g.img}" alt="${g.jogo}"></div>
        <div class="card-info">
          <div class="card-game">${g.jogo}</div>
          <div class="card-name">${g.nome}</div>
          <div class="card-amount">${g.valor}</div>
        </div>
      `;
      track.appendChild(card);
    });

    injectStyles();
    return wrapper;
  }

  function injectStyles() {
    if (document.getElementById('ganhos-style-final')) return;
    const s = document.createElement('style');
    s.id = 'ganhos-style-final';
    s.textContent = `
      .ganhos-wrapper-final {
        background: #16171cb8;
        border-radius: 18px;
        padding: 10px 12px;
        margin-bottom: 14px;
        font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial;
      }
      .ganhos-inner { display: flex; gap: 10px; align-items: center; }
      .ganhos-label { min-width: 120px; text-align: right; padding-right: 6px; }
      .g-title { color: #ff7a00; font-weight: 800; letter-spacing: 0.8px; font-size: 13px; }
      .g-sub { color: #b9bfc5; font-weight: 600; margin-top: -2px; font-size: 12px; }

      .ganhos-viewport {
        flex: 1;
        overflow: hidden;
        -webkit-mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
        mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
      }
      .ganhos-track {
        display: flex;
        gap: 10px;
        width: max-content;
        align-items: center;
        animation: ganhos-scroll 35s linear infinite;
      }
      .ganhos-wrapper-final:hover .ganhos-track { animation-play-state: paused; }
      @keyframes ganhos-scroll { 0% { transform: translateX(0); } 100% { transform: translateX(-33.33%); } }

      .ganho-card {
        width: 110px;
        min-width: 110px;
        height: 120px;
        background: #1c1d20;
        border-radius: 8px;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        padding: 8px 6px;
        text-align: center;
      }

      .card-thumb {
        width: 46px;
        height: 46px;
        margin-top: 4px;
      }
      .card-thumb img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 4px;
      }

      .card-info {
        margin-top: 6px;
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      .card-game {
        color: #ff7a00;
        font-size: 10px;
        font-weight: 700;
      }
      .card-name {
        color: #fff;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      .card-amount {
        color: #ffd800;
        font-size: 13px;
        font-weight: 800;
        margin-top: 4px;
      }

      @media (max-width:900px) {
        .ganhos-label { display: none; }
        .ganho-card { width: 90px; height: 110px; }
        .card-thumb { width: 40px; height: 40px; }
      }
    `;
    document.head.appendChild(s);
  }

  // ———————— Lógica de injeção dinâmica —————————
  function insertAboveTarget(target) {
    if (document.getElementById(IDS.wrapper)) return;
    const wrapper = buildCarousel();
    target.parentNode.insertBefore(wrapper, target);
  }

  function tryInsertNow() {
    const target = document.querySelector('section.carousel[aria-label="Gallery"], section.carousel[dir][aria-label="Gallery"]');
    if (target) {
      insertAboveTarget(target);
      return true;
    }
    return false;
  }

  if (tryInsertNow()) return;

  const observer = new MutationObserver((mutations, obs) => {
    if (tryInsertNow()) obs.disconnect();
  });
  observer.observe(document.documentElement || document.body, { childList: true, subtree: true });
  setTimeout(() => { tryInsertNow(); observer.disconnect(); }, 20000);
})();
</script>



      
      <script>
(function(){
  const manifestContent = {
    "name": "Gn77.fun",
    "short_name": "Gn77.fun",
    "description": "Seu aplicativo instalado diretamente da web.",
    "start_url": "/",
    "display": "standalone",
    "background_color": "#8800ff",
    "theme_color": "#8800ff",
    "orientation": "portrait",
    "icons": [
      {
        "src": "https://th.bing.com/th?q=Jogo+Do+Tigrinho+Gr%c3%a1tis&w=120&h=120&c=1&rs=1&qlt=70&o=7&cb=1&pid=InlineBlock&rm=3&mkt=pt-BR&cc=BR&setlang=pt-br&adlt=moderate&t=1&mw=247",
        "sizes": "192x192",
        "type": "image/png"
      },
      {
        "src": "https://th.bing.com/th?q=Jogo+Do+Tigrinho+Gr%c3%a1tis&w=120&h=120&c=1&rs=1&qlt=70&o=7&cb=1&pid=InlineBlock&rm=3&mkt=pt-BR&cc=BR&setlang=pt-br&adlt=moderate&t=1&mw=247",
        "sizes": "512x512",
        "type": "image/png",
        "purpose": "any maskable"
      }
    ]
  };

  const blob = new Blob([JSON.stringify(manifestContent, null, 2)], {type: 'application/json'});
  const manifestURL = URL.createObjectURL(blob);
  let link = document.querySelector('link[rel="manifest"]');
  if (!link) {
    link = document.createElement('link');
    link.rel = 'manifest';
    document.head.appendChild(link);
  }
  link.href = manifestURL;
})();
</script>
      
      
        <?php $custom = \Helper::getCustom() ?>
        <style>
            body{
                /* font-family: "'Roboto', sans-serif"; */
                 font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif; 
            }
            :root {
                --ci-primary-color: <?php echo e($custom['primary_color']); ?>;
                --ci-primary-opacity-color: <?php echo e($custom['primary_opacity_color']); ?>;
                --ci-secundary-color: <?php echo e($custom['secundary_color']); ?>;
                --ci-gray-dark: <?php echo e($custom['gray_dark_color']); ?>;
                --ci-gray-light: <?php echo e($custom['gray_light_color']); ?>;
                --ci-gray-medium: <?php echo e($custom['gray_medium_color']); ?>;
                --ci-gray-over: <?php echo e($custom['gray_over_color']); ?>;
                --title-color: <?php echo e($custom['title_color']); ?>;
                --text-color: <?php echo e($custom['text_color']); ?>;
                --sub-text-color: <?php echo e($custom['sub_text_color']); ?>;
                --placeholder-color: <?php echo e($custom['placeholder_color']); ?>;
                --background-color: <?php echo e($custom['background_color']); ?>;
                --standard-color: #1C1E22;
                --shadow-color: #111415;
                --page-shadow: linear-gradient(to right, #111415, rgba(17, 20, 21, 0));
                --autofill-color: #f5f6f7;
                --yellow-color: #FFBF39;
                --yellow-dark-color: #d7a026;
                --border-radius: <?php echo e($custom['border_radius']); ?>;
                --tw-border-spacing-x: 0;
                --tw-border-spacing-y: 0;
                --tw-translate-x: 0;
                --tw-translate-y: 0;
                --tw-rotate: 0;
                --tw-skew-x: 0;
                --tw-skew-y: 0;
                --tw-scale-x: 1;
                --tw-scale-y: 1;
                --tw-scroll-snap-strictness: proximity;
                --tw-ring-offset-width: 0px;
                --tw-ring-offset-color: #fff;
                --tw-ring-color: rgba(59,130,246,.5);
                --tw-ring-offset-shadow: 0 0 #0000;
                --tw-ring-shadow: 0 0 #0000;
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;

                --input-primary: <?php echo e($custom['input_primary']); ?>;
                --input-primary-dark: <?php echo e($custom['input_primary_dark']); ?>;

                --carousel-banners: <?php echo e($custom['carousel_banners']); ?>;
                --carousel-banners-dark: <?php echo e($custom['carousel_banners_dark']); ?>;


                --sidebar-color: <?php echo e($custom['sidebar_color']); ?> !important;
                --sidebar-color-dark: <?php echo e($custom['sidebar_color_dark']); ?> !important;


                --navtop-color <?php echo e($custom['navtop_color']); ?>;
                --navtop-color-dark: <?php echo e($custom['navtop_color_dark']); ?>;


                --side-menu <?php echo e($custom['side_menu']); ?>;
                --side-menu-dark: <?php echo e($custom['side_menu_dark']); ?>;

                --footer-color <?php echo e($custom['footer_color']); ?>;
                --footer-color-dark: <?php echo e($custom['footer_color_dark']); ?>;

                --card-color <?php echo e($custom['card_color']); ?>;
                --card-color-dark: <?php echo e($custom['card_color_dark']); ?>;
            }
            .navtop-color{
                background-color: <?php echo e($custom['sidebar_color']); ?> !important;
            }
            :is(.dark .navtop-color) {
                background-color: <?php echo e($custom['sidebar_color_dark']); ?> !important;
            }

            .bg-base {
                background-color: <?php echo e($custom['background_base']); ?>;
            }
            :is(.dark .bg-base) {
                background-color: <?php echo e($custom['background_base_dark']); ?>;
            }
        </style>

        <?php if(!empty($custom['custom_css'])): ?>
            <style>
                <?php echo $custom['custom_css']; ?>

            </style>
        <?php endif; ?>

        <?php if(!empty($custom['custom_header'])): ?>
            <?php echo $custom['custom_header']; ?>

        <?php endif; ?>

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body color-theme="dark" class="bg-base text-gray-800 dark:text-gray-300 ">
        <div id="viperpro"></div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/datepicker.min.js"></script>
        <script>
            window.Livewire?.on('copiado', (texto) => {
                navigator.clipboard.writeText(texto).then(() => {
                    Livewire.emit('copiado');
                });
            });

            window._token = '<?php echo e(csrf_token()); ?>';
            //if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.remove('dark')
                document.documentElement.classList.add('light');
            } else {
                document.documentElement.classList.remove('light')
                document.documentElement.classList.add('dark')
            }
        </script>
      
      
      <script>
(function(){
  const ID = 'injected-feedbacks-v2';
  const STYLE_ID = ID + '-styles';

  if (document.getElementById(ID)) return;

  function createFeedbackSection() {
    const section = document.createElement('section');
    section.id = ID;
    section.style.margin = '28px 0';
    section.style.width = '100%';
    section.style.boxSizing = 'border-box';

    const title = document.createElement('h2');
    title.textContent = 'FEEDBACKS';
    title.style.color = '#ffffff';
    title.style.fontSize = '20px';
    title.style.fontWeight = '700';
    title.style.margin = '0 0 12px 0';
    title.style.paddingLeft = '30px';
    section.appendChild(title);

    const viewport = document.createElement('div');
    viewport.style.overflow = 'hidden';
    viewport.style.position = 'relative';
    section.appendChild(viewport);

    const track = document.createElement('div');
    track.className = 'fb-track';
    track.style.display = 'flex';
    track.style.gap = '14px';
    track.style.alignItems = 'stretch';
    track.style.width = 'max-content';
    track.style.animation = 'fb-slide 28s linear infinite';
    viewport.appendChild(track);

    const cidades = [
      'São Paulo', 'Belo Horizonte', 'Rio de Janeiro',
      'Salvador', 'Recife', 'Curitiba',
      'Porto Alegre', 'Fortaleza', 'Manaus'
    ];

    const items = [
      {stars:4, text:'Bônus caiu na hora, vale muito a pena.', name:'Paula**'},
      {stars:5, text:'Recebi meu saque super rápido, amei d+.', name:'Lívia**'},
      {stars:3, text:'Bônus chegou rápido, experiência boa.', name:'Lorraine**'},
      {stars:4, text:'Jogos tops demais, saque caiu certinho.', name:'Beatriz**'},
      {stars:4, text:'Bônus incrível, atendimento ótimo.', name:'Luciana**'},
      {stars:5, text:'Site confiável, recomendo!', name:'Carla**'},
      {stars:3, text:'Tudo certo com o saque, rápido e fácil.', name:'Fernanda**'},
      {stars:4, text:'Promoções muito boas, curti demais.', name:'Juliana**'}
    ].map(i => ({...i, city: cidades[Math.floor(Math.random() * cidades.length)]}));

    function makeCard(f){
      const card = document.createElement('div');
      card.className = 'fb-card';
      card.style.flex = '0 0 260px';
      card.style.minWidth = '260px';
      card.style.background = '#1e1f21';
      card.style.borderRadius = '10px';
      card.style.padding = '14px';
      card.style.color = '#fff';
      card.style.display = 'flex';
      card.style.flexDirection = 'column';
      card.style.justifyContent = 'space-between';
      card.style.boxSizing = 'border-box';
      card.style.minHeight = '120px';

      const stars = document.createElement('div');
      stars.className = 'fb-stars';
      stars.style.color = '#ffcc33';
      stars.style.fontWeight = '800';
      stars.style.marginBottom = '8px';
      stars.textContent = '★'.repeat(f.stars) + '☆'.repeat(5 - f.stars);
      card.appendChild(stars);

      const p = document.createElement('p');
      p.className = 'fb-text';
      p.style.color = '#d9d9d9';
      p.style.fontSize = '15px';
      p.style.lineHeight = '1.2';
      p.style.margin = '6px 0 12px';
      p.textContent = `"${f.text}"`;
      card.appendChild(p);

      const user = document.createElement('div');
      user.className = 'fb-user';
      user.style.display = 'flex';
      user.style.gap = '10px';
      user.style.alignItems = 'center';
      user.style.marginTop = '6px';

      const avatar = document.createElement('img');
      avatar.className = 'fb-avatar';
      avatar.src = 'https://i.imgur.com/Z4KOv0E.png';
      avatar.alt = 'Usuário';
      avatar.style.width = '34px';
      avatar.style.height = '34px';
      avatar.style.borderRadius = '50%';
      avatar.style.objectFit = 'cover';
      user.appendChild(avatar);

      const meta = document.createElement('div');
      meta.className = 'fb-meta';
      meta.style.fontSize = '0.85rem';
      meta.style.color = '#cfcfcf';
      const strong = document.createElement('strong');
      strong.textContent = f.name;
      strong.style.display = 'block';
      strong.style.color = '#fff';
      strong.style.fontWeight = '700';
      const span = document.createElement('span');
      span.textContent = f.city;
      span.style.opacity = '0.8';
      span.style.fontSize = '0.8rem';
      meta.appendChild(strong);
      meta.appendChild(span);

      user.appendChild(meta);
      card.appendChild(user);

      return card;
    }

    items.forEach(i => track.appendChild(makeCard(i)));
    items.forEach(i => track.appendChild(makeCard(i).cloneNode(true)));

    return section;
  }

  function injectStyles(){
    if (document.getElementById(STYLE_ID)) return;
    const s = document.createElement('style');
    s.id = STYLE_ID;
    s.textContent = `
      @keyframes fb-slide {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
      }
      #${ID}:hover .fb-track { animation-play-state: paused !important; }
      @media (max-width:900px) {
        #${ID} .fb-card { flex: 0 0 220px !important; min-width: 220px !important; }
      }
    `;
    document.head.appendChild(s);
  }

  function findFooterDiv(){
    const divs = document.querySelectorAll('div');
    for (const d of divs) {
      const cn = d.className || '';
      if (typeof cn === 'string' && /\bfooter\b/.test(cn)) {
        return d;
      }
    }
    return null;
  }

  function tryInsertNow(){
    if (document.getElementById(ID)) return true;
    const footer = findFooterDiv();
    if (!footer) return false;
    injectStyles();
    const section = createFeedbackSection();
    footer.parentNode.insertBefore(section, footer);
    console.log('✅ Feedbacks atualizado inserido acima do footer.');
    return true;
  }

  if (tryInsertNow()) return;

  const obs = new MutationObserver((mutations, o) => {
    if (tryInsertNow()) o.disconnect();
  });
  obs.observe(document.body, { childList: true, subtree: true });
  setTimeout(() => { tryInsertNow(); try { obs.disconnect(); } catch(e){} }, 25000);
})();
</script>

      
      <script>
(function(){
  const STYLE_ID = 'inject-md-mt6-style';
  if (document.getElementById(STYLE_ID)) return; // não duplica

  const css = `
    @media (min-width: 768px) {
      /* seletor específico para o elemento que tem essas 4 classes */
      div.w-full.flex.justify-between[class*="md:mt-6"] {
        background: linear-gradient(90deg, #252837 0%, #ff7a0000 57%, rgba(0, 0, 0, 0) 100%);
        padding-top: 2px;
        padding-bottom: 2px;
        border-radius: 8px;
      }
    }
  `;

  function inject() {
    if (document.getElementById(STYLE_ID)) return true;
    const style = document.createElement('style');
    style.id = STYLE_ID;
    style.textContent = css;
    document.head.appendChild(style);
    return true;
  }

  // se já existe o elemento alvo -> injeta agora
  function hasTarget() {
    return !!document.querySelector('div.w-full.flex.justify-between[class*="md:mt-6"]');
  }

  if (hasTarget()) {
    inject();
    return;
  }

  // senão observa o DOM até aparecer (SPA/dinâmico)
  const obs = new MutationObserver((mutations, o) => {
    if (hasTarget()) {
      inject();
      o.disconnect();
    }
  });
  obs.observe(document.documentElement || document.body, { childList: true, subtree: true });

  // safety timeout: injeta depois de 20s mesmo que não encontre (opcional)
  setTimeout(() => { inject(); try { obs.disconnect(); } catch(e){} }, 20000);
})();
</script>

      
      
      
      
      
        <!-- Elfsight Telegram Chat | Untitled Telegram Chat 2 -->
        <!-- <script src="https://static.elfsight.com/platform/platform.js" async></script>
        <div class="elfsight-app-7f920811-48cf-4907-8dd3-561423cfa413" data-elfsight-app-lazy></div> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/datepicker.min.js"></script>
        <?php if(!empty($custom['custom_js'])): ?>
            <script>
                <?php echo $custom['custom_js']; ?>

            </script>
        <?php endif; ?>

        <?php if(!empty($custom['custom_body'])): ?>
            <?php echo $custom['custom_body']; ?>

        <?php endif; ?>

        <?php if(!empty($custom)): ?>
            <script>
                const custom = <?php echo json_encode($custom); ?>;
            </script>
        <?php endif; ?>
    </body>
</html>
<?php /**PATH /home/dindinbet123456/htdocs/dindinbet.pro/resources/views/layouts/app.blade.php ENDPATH**/ ?>