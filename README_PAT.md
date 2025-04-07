# Personal Acess Token

## Porque há que utilizar

O GitHub Workflow não clona os submodulos, para clonar os submodulos há que habilitar o submodulos no ficheiro .yaml e dar acesso a uma chave SSH ou PAT.

## SSH vs PAT

O SSH permite acesso a varias funcionalidades desnecessarias enquanto o PAT permite configurar apenas o que vamos utilizar. Exemplo: Configurar a chave PAT para apenas poder ler os repositorios e o conteudo.

## Configuração

1. Aceder a [página de criação da chave PAT](https://github.com/settings/personal-access-tokens/new)
2. Criar um novo PAT
3. Definir um nome à escolha
4. Definir uma data de expiração
5. Definir acesso a todos os repositorios
6. No dropdown das permissões do repositorio:
    - Dar permissões de leitura aos conteudos
7. Gerar o token
8. Copiar o token
9. Aceder a pagina de criação de secrets do repositorio
10. Criar um **Action** secret
11. Definir o nome como `TOKEN_PAT`
12. No conteudo colar o token copiado no 8º passo
13. Adicionar secret
