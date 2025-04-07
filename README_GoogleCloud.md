# Home

Contem toda a informação sobre este repositório.

## Ordem a seguir

1. Seguir o guia da configuração inicial da [Configuração inicial da Implantação Contínua do Cloud Run](#configuração-inicial-da-implantação-contínua-do-cloud-run).
2. Seguir os guias no [SSH](#ssh).
3. Seguir os restantes guias no [Google Cloud](#configuração-do-google-cloud)

# Configuração do Google Cloud

## Configuração inicial da Implantação Contínua do Cloud Run

Podemos utilizar a [Documentação Oficial da Google](https://cloud.google.com/run/docs/continuous-deployment-with-cloud-build?hl=pt-br) ou o seguinte guia(**O guia só contem os passos necessários para fazer a configuração, o resto cabe ao utilizador decidir se vai alterar**):

1. Entrar na [Documentação Oficial da Google](https://cloud.google.com/run/docs/continuous-deployment-with-cloud-build?hl=pt-br) e ativar as APIs.
2. Aceder ao [Cloud Run](https://console.cloud.google.com/run) e selecionar o projeto.
3. Criar um serviço.
4. Selecionar a opção "Implantar continuamente novas revisões de um repositório de origem".
    1. Clicar em "CONFIGURAR COM O CLOUD BUILD".
    2. Repositório de origem:
        1. Provedor de repositório: GitHub
        2. Repositório: O repositório que será utilizado para a Implantação Contínua
        3. Ler e aceitar o contrato
        4. Clicar em "PRÓXIMA"
    3. Configuração da build
        1. Ramificação: a branch que será utilizada para a implantação
        2. Tipo de build: Dockerfile
        3. Local de origem: `/Dockerfile`
5. Região: região escolhida pelo utilizador
6. Autenticação: Permitir invocações não autenticadas
7. Clicar em "CRIAR".

## Configuração da chave SSH privada e Secret Manager

1. Abrir o [Secret Manager](https://console.cloud.google.com/security/secret-manager).
2. Criar um secret.
    1. Atribuir um nome.
    2. Dar upload do ficheiro da chave privada.
    3. Criar o secret.
3. Abrir o [IAM](https://console.cloud.google.com/iam-admin/iam).
4. Ativar a opção "Incluir concessões do papel fornecidas pelo Google".
5. Atribuir permissões de "Assessor de secret do Secret Manager" a conta que acaba com `@cloudbuild.gserviceaccount.com` e `@developer.gserviceaccount.com`.
6. No ficheiro `cloudbuild.yaml` procurar uma linha que contenha `secretManager`.
    1. Editar a `versionName` que contenha algo parecido com `projects/<id do projeto>/secrets/<nome do segredo>/versions/latest`
        * Trocar o conteúdo do `<id do projeto>` pelo id do projeto atual do projeto, ambos o id ou o número do projeto podem ser utilizados.
        * Trocar o conteúdo do `<nome do segredo>` pelo nome do segredo guardado no 2º passo.
    2. Caso esteja correto deve ficar algo parecido com o seguinte exemplo: `projects/o-meu-projeto-1522/secrets/ALGO_MUITO_IMPORTANTE/versions/latest`
    3. Se estiver tudo correto já pode guardar o ficheiro.

## Configurando as variáveis do Cloud Build

1. Aceder aos [gatilhos da Cloud Build](https://console.cloud.google.com/cloud-build/trigger).
2. Procurar e abrir o gatilho de implantação contínua.
3. Adicionar as variáveis:
    * `_REPOSITORY_SSH` sendo o valor o URL SSH do repositório principal.
    * `_SSH_PUBLIC_KEY` sendo o valor o conteúdo da chave RSA gerado em [Criação do ficheiro SSH RSA do GitHub
      ](#criação-do-ficheiro-ssh-rsa-do-github)

## Variáveis

| Nome | Descrição do valor |
|---|---|
| _REPOSITORY_SSH | URL para SSH ao repositório principal. |
| _SSH_PUBLIC_KEY | Chave RSA publica para o GitHub |

# SSH

## Configuração da chave publica e privada SSH

Será utilizado o Git Bash neste guia.

Podemos utilizar a [Documentação Oficial do GitHub](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent#generating-a-new-ssh-key) ou os seguintes passos:

1. Abrir o Git Bash.
2. Executar o seguinte comando `ssh-keygen -t ed25519 -C "seu_email@exemplo.com"`.
3. Ver ou definir onde as chaves serão guardas e pressionar Enter.
4. Deixar as palavras-passes em branco.
5. Adicionar a chave publica a conta do GitHub.
    1. Abrir as configurações do perfil.
    2. Aceder a secção de chaves SSH.
    3. Criar uma nova chave SSH.
    4. Definir um nome.
    5. Colocar o conteúdo do ficheiro `id_25519.pub` (**ATENÇÃO AO NOME**) dentro da chave.
    6. Criar a chave.
6. Para a criação da chave privada seguir [estes passos](#configuração-da-chave-ssh-privada-e-secret-manager) com o ficheiro `id_25519` (**ATENÇÃO AO NOME**).

## Criação do ficheiro SSH RSA do GitHub

1. Abrir o terminal.
2. Executar `ssh-keyscan -t rsa github.com > known_hosts.github`.
