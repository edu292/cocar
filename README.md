# MVC (Model View Controller)
## Model
app/Models      
responsável por fazer queries, inserir dados no banco de dados e regras de negócio.
``` bash
php artisan make:model [nome]
```

### Migrações
database/migrations       

git do banco de dados. Diz como criar as tabelas e como mudar os dados de uma versão para outra do banco de dados.
  - up: alterações da nova migração
  - down: como revertê-las.

```php
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            // auto increment por padrão
            $table->id();

            // J?FK (O Laravel já sabe que aponta pro id da tabela users)
            // O "constrained()->cascadeOnDelete()" faz com que, se o user for apagado, o post vá junto.
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Textos
            $table->string('title', 100); // Varchar comum (limite de 100 caracteres)
            $table->string('slug')->unique(); // Varchar que não pode repetir
            $table->text('content'); // Texto longo (para o corpo do post)

            // Números e Booleanos
            $table->integer('views')->default(0); // Inteiro, começa em zero
            $table->boolean('is_published')->default(false); // Verdadeiro ou Falso

            // Datas
            $table->timestamp('published_at')->nullable(); // Aceita valor nulo (vazio)

            // Cria as colunas 'created_at' e 'updated_at' sozinhas.
            // O Laravel preenche isso automaticamente
            $table->timestamps();
        });
    }
```
```bash
php artisan make:migration [nome_tabela] (criar tabela)
php artisan make:migration add_[coluna]_to_[tabela] (adicionar coluna na tabela)
php artisan make:model [nome] -m (cria o arquivo de migração junto com o model)
```

### Queries com laravel(sql com setinhas)
```php
// Traz TODOS os posts da tabela
$posts = Post::all(); 

// Busca o post com ID = 1
$post = Post::find(1); 

// Tenta achar o ID 1. Se não achar, não retorna null, ele já cospe um Erro 404 (Not Found) automático na tela. Lindo.
$post = Post::findOrFail(1); 

// Traz apenas o primeiro post que encontrar na tabela
$post = Post::first();

// Traz apenas o primeiro post que encontrar na tabela
$post = Post::last();

// Query mais complexa
$posts = Post::where('is_published', true) // Filtro 1
             ->where('views', '>', 100)    // Filtro 2
             ->orderBy('created_at', 'desc') // Ordenação
             ->take(5) // LIMIT 5
             ->get(); // Executa a query e retorna os resultados
```


### Relacionamentos(models também amam)
Ao invés de lembrar dos joins você pode ensinar os relacionamentos aos models e depois acessar os dados direto       
relacionamentos são funções no model

#### Um para Um (1:1)
Exemplo: Um usuário tem um perfil
No Model User:
```PHP
public function profile()
{
    // "Eu, Usuário, tenho UM perfil"
    return $this->hasOne(Profile::class);
}

```
No Model Profile (A volta):

```PHP
public function user()
{
    // "Eu, Perfil, pertenço a UM usuário"
    return $this->belongsTo(User::class);
}
```
Como usar: 
  - $user->profile->cpf; (O Laravel faz a query sozinho).
  - $profile->user->email;

#### Um para Muitos (1:N)

Exemplo: Um User tem vários Posts.

No Model User:
```PHP
public function posts()
{
    // "Eu, Usuário, tenho MUITOS posts"
    return $this->hasMany(Post::class);
}
```

No Model Post (A volta):
```PHP
public function user()
{
    // "Eu, Post, pertenço a UM usuário"
    return $this->belongsTo(User::class);
}
```

Como usar:
  - Pegar todos os posts do usuário: $user->posts;
  - Criar um post já atrelado ao usuário: $user->posts()->create(['title' => 'Novo Post']);
  - Pegar usuário que criou post: $post->user() (já faz a query pro model do user)

#### Muitos para Muitos (N:M)
Exemplo: Um Post tem várias Tags, e uma Tag pertence a vários Posts.    
Tem que criar a tabela associativa ainda ([nome tabela]_to_[nome da outra tabela])

No Model Post:
```PHP

public function tags()
{
    // "Eu, Post, pertenço a MUITAS tags, e elas a mim"
    return $this->belongsToMany(Tag::class);
}
```

No Model Tag:
```PHP
public function posts()
{
    return $this->belongsToMany(Post::class);
}
```

Como usar:
  - Ligar uma tag a um post existente: $post->tags()->attach($tag_id);
  - Desligar a tag do post: $post->tags()->detach($tag_id);

## Controller(Ordem errada pq sim)
app/Http/Controllers     

responsável por usar e instanciar os models, fazer os filtros, validações e formatações para passar para a view
geralmente um controller é responsável por um model e controla todo o seu ciclo de vida(menos interagir com o banco de dados, obv)

```bash
php artisan make:controller [nome]
```

### Anatomia:
Cada um desses itens é um método (public function nome_do_metodo()) dentro da classe do Controller.
Normalmente retornan ou uma view(tela) ou redirect(processamento os dados) e mandam de volta para outro lugar
  - index: página que mostra todos os itens
  - create: mostra o formulário para a criação do item(só a tela)
  - store: salva os dados do `create`
  - show: mostra apenas um item detalhado
  - edit: mostra o item para edição (só a tela)
  - update: atualiza item com os dados do `edit`
  - destroy: deletar

php artisan make:controller [nome] -r (já criar todos esses métodos)

### Invokable Controller:
Um controller que não é atrelado a um model, basicamente uma função mas que é uma classe por algum motivo
> funções são classes só pesquisar
```bash
php artisan make:controller [nome] --invokable
```

## View
resources/views     
camada de apresentação, html tunado(.blade.php). Utiliza todas as tags html, mas adiciona for if e outros elementos do php direto no html(indicados pelo @)
Pode definir componentes que serão importados por outras views

```blade
<h1>Bem-vindo, {{ $user->name }}</h1>

@if(count($posts) > 0)
    <p>Temos posts!</p>
@else
    <p>Nada por aqui.</p>
@endif

@foreach($posts as $post)
    <li>{{ $post->title }}</li>
@endforeach
```

# MDQI(Mais do que isso)

## Artisan(seu amiguinho)
é o arquivo php que é usado para criar as estruturas base das classes no laravel(pq dev é preguiçoso)
nada demais, mas serve pra tudo

## Composer
pip do php, mas que na real é mais parecido com o npm
composer require [nome do pacote]
composer run dev (inicia o server de dev do laravel)

## Vite
builder de js e server de static para dev
js: a linguagem de script que precisa de build e compilação

## Route(Porteiro)
routes/web.php    

traduz a url para o controller
```php
// Rota::verbo_http('/url', [NomeDoController::class, 'método_do_controller']);
Route::get('/home', [HomeController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);

// Cria todas as rotas para os métodos do controller de uma vez
Route::resource('posts', PostController::class);
```

## Middleware(Meio da onde?)
algo que roda antes da requisição chegar no controller. Pode barrar, redirecionar ou adicionar informações extras
pode ser adicionado a uma route em específico ou ser aplicado em várias ao mesmo tempo

exemplos:
  - `auth`: Só entra se estiver logado. Se não estiver, vai pro login.
  - `guest`: Só entra se NÃO estiver logado (Visitante).

```php
// 1. Aplicando em UMA rota específica
Route::get('/login', [AuthController::class, 'index'])->middleware('guest');

// 2. Aplicando em um GRUPO de rotas
Route::middleware('auth')->group(function () {

    // Nenhuma dessas rotas será acessada sem login
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/perfil', [ProfileController::class, 'edit']);
    Route::put('/perfil', [ProfileController::class, 'update']);

    // Você pode até aninhar grupos com prefixos de URL
    Route::prefix('admin')->group(function () {
        Route::get('/usuarios', [AdminController::class, 'users']);
    });
});
```

## Policy
app/Policies    
Permissões dos controllers, define quem pode ou não acessar certas páginas ou modificar items. Não percisa de if feio no meio do controller

## Request Form
Validação de formulário em uma classe separado, não precisa de if feio no controller 2.0
