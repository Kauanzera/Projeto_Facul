document.addEventListener("DOMContentLoaded", function () {
  let templates = JSON.parse(localStorage.getItem("templates")) || [];
  let currentTemplate = null;
  let currentColumnIndex = null;

  updateTemplateSelect();

  // Função para excluir um template inteiro
  function deleteTemplate(templateIndex) {
    // Confirmação antes de deletar
    const confirmation = confirm("Tem certeza que deseja excluir este template?");
    if (confirmation) {
      templates.splice(templateIndex, 1); // Remove o template do array
      localStorage.setItem("templates", JSON.stringify(templates)); // Atualiza o localStorage
      updateTemplateSelect(); // Atualiza a lista de templates no select
      document.getElementById("columns-container").innerHTML = ""; // Limpa a exibição das colunas
      document.getElementById("welcome-text").style.display = "block"; // Exibe o texto de boas-vindas
    }
  }

  // Exemplo de botão para deletar o template selecionado
  document.getElementById("delete-template-btn").addEventListener("click", function () {
    const selectedTemplate = document.getElementById("template-select").value;
    const templateIndex = templates.findIndex((t) => t.name === selectedTemplate);

    if (templateIndex !== -1) {
      deleteTemplate(templateIndex); // Chama a função de deletar com o índice do template
    } else {
      alert("Por favor, selecione um template válido para deletar.");
    }
  });


  // Atualiza as entradas de coluna conforme o número de colunas
  document.getElementById("num-columns").addEventListener("change", function () {
    const numColumns = parseInt(this.value);
    const columnsInputs = document.getElementById("columns-inputs");
    columnsInputs.innerHTML = "";

    for (let i = 1; i <= numColumns; i++) {
      const input = document.createElement("input");
      input.type = "text";
      input.placeholder = `Nome da Coluna ${i}`;
      input.required = true;
      columnsInputs.appendChild(input);
    }
  });

  // Cria um novo template ao enviar o formulário
  document.getElementById("create-template-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const templateName = document.getElementById("template-name").value;
    const numColumns = parseInt(document.getElementById("num-columns").value);
    const columnNames = Array.from(document.getElementById("columns-inputs").children).map((input) => input.value);

    // Validação para evitar templates com nomes duplicados
    if (templates.some((template) => template.name === templateName)) {
      alert("Um template com este nome já existe. Escolha outro nome.");
      return;
    }

    const newTemplate = { name: templateName, columns: columnNames, tasks: columnNames.map(() => []) };

    templates.push(newTemplate);
    localStorage.setItem("templates", JSON.stringify(templates));

    updateTemplateSelect();
    closeModal();
  });

  // Seleção e exibição do template escolhido
  document.getElementById("template-select").addEventListener("change", function () {
    const selectedValue = this.value;

    if (selectedValue === "criar-template") {
      openModal();
      resetModal();
      return;
    }

    currentTemplate = templates.find((template) => template.name === selectedValue);

    if (currentTemplate) {
      renderTemplate(currentTemplate);
      document.getElementById("welcome-text").style.display = "none";
    }
  });

  // Função para adicionar uma nova tarefa
  document.getElementById("add-task-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const taskName = document.getElementById("task-name").value;

    if (!taskName || currentColumnIndex === null) {
      alert("Por favor, insira o nome da tarefa.");
      return;
    }

    // Adiciona a tarefa à coluna correta no template atual
    currentTemplate.tasks[currentColumnIndex].push(taskName);
    localStorage.setItem("templates", JSON.stringify(templates));

    closeTaskModal();
    renderTemplate(currentTemplate);  // Re-renderiza o template atual para mostrar a nova tarefa
  });

  // Função para excluir uma coluna específica
  function deleteColumn(templateIndex, columnIndex) {
    templates[templateIndex].columns.splice(columnIndex, 1);
    templates[templateIndex].tasks.splice(columnIndex, 1); // Remove também as tarefas da coluna excluída
    localStorage.setItem("templates", JSON.stringify(templates));
    renderTemplate(templates[templateIndex]);
  }

  // Função para excluir um template inteiro
  function deleteTemplate(templateIndex) {
    templates.splice(templateIndex, 1);
    localStorage.setItem("templates", JSON.stringify(templates));
    updateTemplateSelect();
    document.getElementById("columns-container").innerHTML = "";
  }

  // Fechar o modal de criação de template
  document.getElementById("close-create-modal").addEventListener("click", function(){
    closeModal(); //Chama a função de fechamento de modal
  });

  //Função para fechar o modal
  function closeModal() {
    document.getElementById("create-template-modal").style.display = "none";
  }

  // Fecha o modal de adição de tarefa
  document.getElementById("close-task-modal").addEventListener("click", closeTaskModal);

  // Abre o modal de criação de template
  function openModal() {
    document.getElementById("create-template-modal").style.display = "block";
  }

  // Fecha o modal de criação de template
  function closeModal() {
    document.getElementById("create-template-modal").style.display = "none";
  }

  // Fecha o modal de adição de tarefa
  function closeTaskModal() {
    document.getElementById("add-task-modal").style.display = "none";
    document.getElementById("task-name").value = "";
  }

  // Reseta o modal para criação de novo template
  function resetModal() {
    document.getElementById("modal-title").textContent = "Criar Novo Template";
    document.getElementById("template-name").value = "";
    document.getElementById("num-columns").value = 1;
    document.getElementById("columns-inputs").innerHTML = '<input type="text" placeholder="Nome da Coluna 1" required />';
  }

  // Atualiza a lista de templates no select
  function updateTemplateSelect() {
    const select = document.getElementById("template-select");
    select.innerHTML = '<option value="">Selecione um Template</option>';
    select.innerHTML += '<option value="criar-template">Criar Novo Template</option>';

    templates.forEach((template) => {
      const option = document.createElement("option");
      option.value = template.name;
      option.textContent = template.name;
      select.appendChild(option);
    });
  }

  // Renderiza o template selecionado
  function renderTemplate(template) {
    const columnsContainer = document.getElementById("columns-container");
    columnsContainer.innerHTML = "";

    const templateIndex = templates.findIndex((t) => t.name === template.name);

    template.columns.forEach((columnName, columnIndex) => {
      const columnDiv = document.createElement("div");
      columnDiv.className = "column";

      const columnHeader = document.createElement("div");
      columnHeader.className = "column-header";
      columnHeader.textContent = columnName;

      const deleteButton = document.createElement("button");
      deleteButton.className = "delete-column-btn";
      deleteButton.textContent = "X";
      deleteButton.addEventListener("click", function () {
        deleteColumn(templateIndex, columnIndex);
      });

      const taskList = document.createElement("div");
      taskList.className = "task-list";

      // Renderiza as tarefas da coluna
      template.tasks[columnIndex].forEach((task, taskIndex) => {
        const taskDiv = document.createElement("div");
        taskDiv.className = "task";
        taskDiv.id = `task-${columnIndex}-${taskIndex}`; // ID único para cada tarefa
        taskDiv.textContent = task;
        taskList.appendChild(taskDiv);
      });

      const addCardBtn = document.createElement("button");
      addCardBtn.className = "add-card-btn";
      addCardBtn.textContent = "Adicionar Tarefa";
      addCardBtn.addEventListener("click", function () {
        document.getElementById("add-task-modal").style.display = "block";
        currentColumnIndex = columnIndex; // Salva o índice da coluna para a nova tarefa
      });

      columnHeader.appendChild(deleteButton);
      columnDiv.appendChild(columnHeader);
      columnDiv.appendChild(taskList);
      columnDiv.appendChild(addCardBtn);

      columnsContainer.appendChild(columnDiv);
    });

    enableDragAndDrop();
  }

  // Habilita o drag-and-drop entre as colunas
  function enableDragAndDrop() {
    const tasks = document.querySelectorAll(".task");
    const columns = document.querySelectorAll(".task-list");

    tasks.forEach((task) => {
      task.setAttribute("draggable", true);
      task.addEventListener("dragstart", function (e) {
        e.dataTransfer.setData("text/plain", e.target.id);
      });
    });

    columns.forEach((column) => {
      column.addEventListener("dragover", function (e) {
        e.preventDefault();
      });

      column.addEventListener("drop", function (e) {
        const id = e.dataTransfer.getData("text");
        const task = document.getElementById(id);
        e.target.appendChild(task);
      });
    });
  }

  // Função para excluir um template inteiro
function deleteTemplate(templateIndex) {
  // Confirmação antes de deletar
  const confirmation = confirm("Tem certeza que deseja excluir este template?");
  if (confirmation) {
    templates.splice(templateIndex, 1); // Remove o template do array
    localStorage.setItem("templates", JSON.stringify(templates)); // Atualiza o localStorage
    updateTemplateSelect(); // Atualiza a lista de templates no select
    document.getElementById("columns-container").innerHTML = ""; // Limpa a exibição das colunas
    document.getElementById("welcome-text").style.display = "block"; // Exibe o texto de boas-vindas
  }
}

// Exemplo de botão para deletar o template selecionado
document.getElementById("delete-template-btn").addEventListener("click", function () {
  const selectedTemplate = document.getElementById("template-select").value;
  const templateIndex = templates.findIndex((t) => t.name === selectedTemplate);

  if (templateIndex !== -1) {
    deleteTemplate(templateIndex); // Chama a função de deletar com o índice do template
  } else {
    alert("Por favor, selecione um template válido para deletar.");
  }
});

});
