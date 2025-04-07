# Home

Bem-vindo a documentação sobre como implementar a implantação do GitHub Actions.

# Configuração

1. Entrar na pagina `https://github.com/<autor>/<nome do repositorio>/actions/new`.
2. No ficheiro .yml definir o nome da Azure Web App em `AZURE_WEBAPP_NAME`.
3. Selecionar a opção "Deploy a PHP app to an Azure Web App".
4. Ir a pagina da App Azure e baixar o perfil publico.
5. Criar um segredo no repositorio com o nome `AZURE_WEBAPP_PUBLISH_PROFILE` e o conteudo do ficheiro baixado.
6. Dar commit ao ficheiro .yml.
