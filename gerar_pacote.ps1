Write-Host "Criando pacote de instalação (ignorando arquivos pesados)..." -ForegroundColor Green

# Remove arquivo antigo se existir
if (Test-Path "deploy.tar.gz") { Remove-Item "deploy.tar.gz" }

# Cria o arquivo tar.gz ignorando pastas pesadas
# O Windows 10/11 nativamente tem o comando tar
tar -czvf deploy.tar.gz --exclude=node_modules --exclude=vendor --exclude=.git --exclude=deploy.tar.gz .

Write-Host "------------------------------------------------" -ForegroundColor Green
Write-Host "PACOTE CRIADO: deploy.tar.gz" -ForegroundColor Green
Write-Host "------------------------------------------------" -ForegroundColor Green
Write-Host "Agora rode o comando abaixo no seu terminal local para enviar para a VPS:" -ForegroundColor Yellow
Write-Host "scp deploy.tar.gz root@72.60.11.180:/root/" -ForegroundColor Cyan
Write-Host "------------------------------------------------" -ForegroundColor Green
