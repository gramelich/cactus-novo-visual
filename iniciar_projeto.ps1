Write-Host "Iniciando configuração do projeto Cactus..." -ForegroundColor Green

# Verificar se .env existe
if (-not (Test-Path ".env")) {
    Write-Host "Criando arquivo .env a partir do exemplo..."
    Copy-Item ".env.example" ".env"
}

# Subir Docker
Write-Host "Subindo containers Docker (isso pode demorar na primeira vez)..."
docker-compose up -d --build

if ($LASTEXITCODE -ne 0) {
    Write-Host "Erro ao subir o Docker. Verifique se o Docker Desktop está rodando." -ForegroundColor Red
    exit
}

# Aguardar DB
Write-Host "Aguardando banco de dados iniciar (30 segundos)..."
Start-Sleep -Seconds 30

# Instalar dependências e buildar
Write-Host "Instalando dependências do Composer..."
docker-compose exec -T app composer install --no-interaction --optimize-autoloader

Write-Host "Instalando dependências do NPM e compilando assets..."
docker-compose exec -T app npm install
docker-compose exec -T app npm run build

# Configurar Laravel
Write-Host "Gerando chave da aplicação..."
docker-compose exec -T app php artisan key:generate

Write-Host "Rodando migrações e seeders..."
docker-compose exec -T app php artisan migrate --force
docker-compose exec -T app php artisan db:seed --force

Write-Host "Criando link simbólico do storage..."
docker-compose exec -T app php artisan storage:link

Write-Host "Limpando caches..."
docker-compose exec -T app php artisan optimize:clear

Write-Host "------------------------------------------------" -ForegroundColor Green
Write-Host "PROJETO INICIADO COM SUCESSO!" -ForegroundColor Green
Write-Host "Acesse a plataforma em: http://localhost:8000" -ForegroundColor Cyan
Write-Host "------------------------------------------------" -ForegroundColor Green
Pause
