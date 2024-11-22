// Selecionar elementos do DOM
const templateSelect = document.getElementById("template-select");
const columnsContainer = document.getElementById("columns-container");
const createTemplateModal = document.getElementById("create-template-modal");
const addTaskModal = document.getElementById("add-task-modal");
const welcomeScreen = document.getElementById("welcome-screen");

// Variável para armazenar templates na memória
let templates = {};

// Abrir e fechar modais
document.getElementById("close-create-modal").onclick = () =>
  (createTemplateModal.style.display = "none");
document.getElementById("close-task-modal").onclick = () =>
  (addTaskModal.style.display = "none");

// Exibir modal de criação de template ao selecionar "Criar Novo Template"
templateSelect.addEventListener("change", (event) => {
  if (event.target.value === "criar-template") {
    createTemplateModal.style.display = "block";
  } else if (event.target.value) {
    welcomeScreen.style.display = "none";
    loadTemplate(event.target.value);
  }
});

// Função para criar um novo template
document
  .getElementById("create-template-form")
  .addEventListener("submit", (event) => {
    event.preventDefault();
    const templateName = document.getElementById("template-name").value;
    const numColumns = parseInt(document.getElementById("num-columns").value);
    const columns = Array.from({ length: numColumns }, (_, i) => {
      const columnName = document.getElementById(`column-name-${i}`).value;
      return { id: `column-${i}`, name: columnName, tasks: [] };
    });

    const template = { name: templateName, columns };
    templates[templateName] = template;  // Armazenar o template na variável

    addTemplateOption(templateName);
    console.log(`Template '${templateName}' criado com sucesso.`);
    createTemplateModal.style.display = "none";
    welcomeScreen.style.display = "none";
    templateSelect.value = templateName;
    loadTemplate(templateName);
  });

// Adicionar campos para nomes das colunas ao definir o número de colunas
document.getElementById("num-columns").addEventListener("input", (event) => {
  const numColumns = parseInt(event.target.value);
  const columnsInputs = document.getElementById("columns-inputs");
  columnsInputs.innerHTML = "";

  for (let i = 0; i < numColumns; i++) {
    const input = document.createElement("input");
    input.type = "text";
    input.id = `column-name-${i}`;
    input.placeholder = `Nome da Coluna ${i + 1}`;
    input.required = true;
    columnsInputs.appendChild(input);
  }
});

// Adicionar uma nova opção ao select de templates
function addTemplateOption(name) {
  const option = document.createElement("option");
  option.value = name;
  option.textContent = name;
  templateSelect.appendChild(option);
}

// Função para carregar o template selecionado
function loadTemplate(templateName) {
  const template = templates[templateName];
  if (template) {
    renderColumns(template.columns);
  } else {
    console.warn(`Template '${templateName}' não encontrado.`);
  }
}

// Função para renderizar colunas e tarefas
function renderColumns(columns) {
  columnsContainer.innerHTML = "";
  columns.forEach((column) => {
    const columnDiv = document.createElement("div");
    columnDiv.classList.add("column");

    const columnHeader = document.createElement("h3");
    columnHeader.classList.add("column-header");
    columnHeader.textContent = column.name;
    columnDiv.appendChild(columnHeader);

    const taskList = document.createElement("div");
    taskList.classList.add("task-list");
    column.tasks.forEach((task) => renderTask(task, taskList));
    columnDiv.appendChild(taskList);

    const addTaskBtn = document.createElement("button");
    addTaskBtn.textContent = "Adicionar Tarefa";
    addTaskBtn.onclick = () => openAddTaskModal(column.name);
    columnDiv.appendChild(addTaskBtn);

    columnsContainer.appendChild(columnDiv);
  });
}

// Função para renderizar uma tarefa
function renderTask(task, container) {
  const taskDiv = document.createElement("div");
  taskDiv.classList.add("task");
  taskDiv.textContent = task.name;
  container.appendChild(taskDiv);
}

// Abrir modal para adicionar tarefa a uma coluna
function openAddTaskModal(columnName) {
  addTaskModal.style.display = "block";
  document.getElementById("add-task-form").onsubmit = (event) => {
    event.preventDefault();
    const task = {
      name: document.getElementById("task-name").value,
      responsible: document.getElementById("task-responsible").value,
      date: document.getElementById("task-date").value,
      location: document.getElementById("task-location").value,
      progress: document.getElementById("task-progress").value,
      estimatedTime: document.getElementById("task-estimated-time").value,
      timeSpent: document.getElementById("task-time-spent").value,
      notes: document.getElementById("task-notes").value,
    };
    addTaskToColumn(columnName, task);
    addTaskModal.style.display = "none";
    document.getElementById("add-task-form").reset();
  };
}

// Adicionar tarefa à coluna na memória e na interface
function addTaskToColumn(columnName, task) {
  const templateName = templateSelect.value;
  const template = templates[templateName];

  if (!template) {
    console.error("Template não encontrado");
    return;
  }

  const column = template.columns.find((col) => col.name === columnName);

  if (column) {
    column.tasks.push(task);
    renderColumns(template.columns); // Atualizar a interface para exibir a nova tarefa
    console.log("Tarefa adicionada com sucesso:", task); // Log para verificar sucesso
  } else {
    console.error("Coluna não encontrada");
  }
}

// Inicialização ao carregar a página
window.onload = () => {
  // Carregar templates criados
  Object.keys(templates).forEach((templateName) => {
    addTemplateOption(templateName);
  });
  console.log("Templates carregados:", Object.keys(templates)); // Log para ver os templates carregados
};
