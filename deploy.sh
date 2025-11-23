#!/bin/bash

# Cores para output
GREEN='\033[0;32m'
NC='\033[0m' # No Color

echo -e "${GREEN}Iniciando deploy automático do Cactus...${NC}"

# Verificar se Docker está instalado
if ! command -v docker &> /dev/null; then
    echo "Docker não encontrado. Instalando Docker..."
    curl -fsSL https://get.docker.com -o get-docker.sh
    sh get-docker.sh
fi

# Verificar se Docker Compose está instalado
if ! command -v docker-compose &> /dev/null; then
    echo "Docker Compose não encontrado. Instalando..."
    sudo curl -L "https://github.com/docker/compose/releases/download/v2.23.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    sudo chmod +x /usr/local/bin/docker-compose
fi

# Copiar .env se não existir
if [ ! -f .env ]; then
    echo "Criando arquivo .env..."
    cp .env.example .env
fi

# Parar containers antigos se houver
echo "Parando containers antigos..."
docker-compose down

# Subir containers
echo -e "${GREEN}Subindo containers (isso pode demorar)...${NC}"
docker-compose up -d --build

# Aguardar DB iniciar
echo "Aguardando banco de dados iniciar (30 segundos)..."
sleep 30

# Instalar dependências
echo -e "${GREEN}Instalando dependências...${NC}"
docker-compose exec -T app composer install --no-interaction --optimize-autoloader
docker-compose exec -T app npm install
docker-compose exec -T app npm run build

# Configurar Laravel
echo -e "${GREEN}Configurando aplicação...${NC}"
docker-compose exec -T app php artisan key:generate
docker-compose exec -T app php artisan migrate --force
docker-compose exec -T app php artisan db:seed --force
docker-compose exec -T app php artisan storage:link
docker-compose exec -T app php artisan optimize:clear

# Ajustar permissões
echo "Ajustando permissões..."
docker-compose exec -T app chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
docker-compose exec -T app chmod -R 775 /var/www/storage /var/www/bootstrap/cache

echo -e "${GREEN}------------------------------------------------${NC}"
echo -e "${GREEN}DEPLOY CONCLUÍDO COM SUCESSO!${NC}"
echo -e "${GREEN}Acesse sua plataforma em: http://$(curl -s ifconfig.me)${NC}"
echo -e "${GREEN}------------------------------------------------${NC}"
