<<<<<<< HEAD
<?php   // Que os jogos comecem ;-;      • 20/10/24 •

    // Incluindo o código html no arquivo index
    include('site.html');

    // Conexão com o banco de dados
    $pdo = new PDO("mysql:host=localhost;dbname=gerenciador_tarefas", "root", "");

    // Data e hora padrão do site: São Paulo 'GMT -03:00'
    date_default_timezone_set('America/Sao_Paulo');


    // Atribuição das informações de criação de Template a tabela `projetos`
    if(isset($_POST['salvar-template'])){
        $nomeTemplate = $_POST['template-name'];
        $categoriaTemplate = $_POST['template-category'];
        $descricaoTemplate = $_POST['template-description'];

        $sql = $pdo->prepare("INSERT INTO `projetos` VALUES (null, ?, ?, ?)");

        $sql->execute(array($nomeTemplate, $categoriaTemplate, $descricaoTemplate));
        
    }



    //ODEIO PHP 
=======
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SCRUM Board</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <!-- Notificação -->
    <div id="notification" class="notification"></div>

    <header>
      <h1>SCRUM</h1>
      <div>
        <select id="template-select">
          <option value="">Selecione um Template</option>
          <option value="criar-template">Criar Novo Template</option>
        </select>
        <button id="delete-template-btn">Deletar Template</button>
      </div>
      <button id="logout">Sair</button>
    </header>
    <main>
      <div id="welcome-screen">
        <h2>Bem-vindo ao Quadro Scrum</h2>
        <p>Selecione ou crie um template para começar!</p>
      </div>
      <div id="columns-container"></div>
    </main>

    <!-- Modal para Criar/Editar Template -->
    <div id="create-template-modal" class="modal">
      <div class="modal-content">
        <span id="close-create-modal" class="close">&times;</span>
        <h3 id="template-modal-title">Criar Template</h3>
        <form id="create-template-form">
          <input
            type="text"
            id="template-name"
            placeholder="Nome do Template"
            required
          />
          <input
            type="number"
            id="num-columns"
            placeholder="Número de Colunas"
            min="1"
            required
          />
          <div id="columns-inputs"></div>
          <button type="submit">Salvar</button>
          <p id="template-error" class="error-message"></p>
        </form>
      </div>
    </div>

    <!-- Modal para Adicionar/Editar Tarefa -->
    <div id="add-task-modal" class="modal">
      <div class="modal-content">
        <span id="close-task-modal" class="close">&times;</span>
        <h3 id="task-modal-title">Adicionar Tarefa</h3>
        <form id="add-task-form">
          <input
            type="text"
            id="task-name"
            placeholder="Nome da Tarefa"
            required
          />
          <input
            type="text"
            id="task-responsible"
            placeholder="Responsável"
            required
          />
          <input type="date" id="task-date" required />
          <input
            type="text"
            id="task-location"
            placeholder="Localização"
            required
          />
          <input
            type="text"
            id="task-progress"
            placeholder="Status de Progresso"
            required
          />
          <input type="time" id="task-start-time" required />
          <input
            type="number"
            id="task-time-spent"
            placeholder="Tempo Gasto (h)"
            required
          />
          <textarea
            id="task-notes"
            placeholder="Mais Informações"
            rows="3"
          ></textarea>
          <button type="submit">Salvar</button>
          <p id="task-error" class="error-message"></p>
        </form>
      </div>
    </div>

    <!-- Modal para Detalhes da Tarefa -->
    <div id="task-details-modal" class="modal">
      <div class="modal-content">
        <span id="close-task-details-modal" class="close">&times;</span>
        <h3>Detalhes da Tarefa</h3>
        <p><strong>Nome:</strong> <span id="detail-task-name"></span></p>
        <p>
          <strong>Responsável:</strong>
          <span id="detail-task-responsible"></span>
        </p>
        <p><strong>Data:</strong> <span id="detail-task-date"></span></p>
        <p>
          <strong>Localização:</strong> <span id="detail-task-location"></span>
        </p>
        <p><strong>Status:</strong> <span id="detail-task-progress"></span></p>
        <p>
          <strong>Hora de Início:</strong>
          <span id="detail-task-start-time"></span>
        </p>
        <p>
          <strong>Tempo Gasto:</strong>
          <span id="detail-task-time-spent"></span>
        </p>
        <p>
          <strong>Informações:</strong> <span id="detail-task-notes"></span>
        </p>
      </div>
    </div>
>>>>>>> 27beee245f061a58a9723239620dc79446a4b1c1

?>