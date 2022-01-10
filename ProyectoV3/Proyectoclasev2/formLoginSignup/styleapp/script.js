// Selectors
const tareaInput = document.querySelector(".tarea_input");
const tareaButton = document.querySelector(".tarea_button");
const listaTareas = document.querySelector(".lista_tareas");
const filtrarOpciones = document.querySelector(".filtrar_tareas");
const sidebar = document.querySelector(".sidebar");
const botonSidebar = document.querySelector("#sidebarbtn");
const botonBurger = document.querySelector(".burger");
const botonCerrar = document.querySelector(".cerrar");
const selectCategoria = document.querySelector("#categoria");

// Event Listeners
//tareaButton.addEventListener("click", añadeTarea);
//listaTareas.addEventListener("click", borraCheck);
filtrarOpciones.addEventListener("change", filtrarTareas);
botonSidebar.addEventListener("click", toggleSidebar);

// Funciones
function añadeTarea(e) {
  //hace que el form no se envie
  e.preventDefault();

  //Tarea div
  const tareaDiv = document.createElement("div");
  tareaDiv.classList.add("tarea");
  tareaDiv.classList.add(selectCategoria.value);

  //Tarea li
  const nuevaTarea = document.createElement("li");
  nuevaTarea.innerText = selectCategoria.value + " | " +tareaInput.value;
  nuevaTarea.classList.add("tarea_item");
  tareaDiv.appendChild(nuevaTarea);
  if (tareaInput.value === "") {
    return null;
  }

  // Boton Check
  const botonCompletado = document.createElement("button");
  botonCompletado.innerHTML = '<i class="far fa-check-square"></i>';
  botonCompletado.classList.add("complete_btn");
  tareaDiv.appendChild(botonCompletado);

  // Boton Borrar
  const botonBorrar = document.createElement("button");
  botonBorrar.innerHTML = '<i class="far fa-trash-alt"></i>';
  botonBorrar.classList.add("delete_btn");
  tareaDiv.appendChild(botonBorrar);
  //Append to Actual LIST
  listaTareas.appendChild(tareaDiv);
  //Clear todo input VALUE
  tareaInput.value = "";
}

// Borrar & Check
function borraCheck(e) {
  const item = e.target;
  // Borrar item
  if (item.classList[0] === "delete_btn") {
    const tarea = item.parentElement;
    tarea.remove();
  }

  // Completar Item
  if (item.classList[0] === "complete_btn") {
    const todo = item.parentElement;
    todo.classList.toggle("completedItem");
  }
}

// Filtrar tareas segun opciones
function filtrarTareas(e) {
  const tareas = listaTareas.querySelectorAll(".tarea");

  for (let i = 0; i < tareas.length; i++) {
    switch (e.target.value) {
      case "all":
        tareas[i].style.display = "flex";
        break;
      case "completed":
        if (tareas[i].classList.contains("completedItem")) {
          tareas[i].style.display = "flex";
        } else {
          tareas[i].style.display = "none";
        }
        break;
      case "uncompleted":
        if (!tareas[i].classList.contains("completedItem")) {
          tareas[i].style.display = "flex";
        } else {
          tareas[i].style.display = "none";
        }
        break;
      case "Comida":
        if (tareas[i].classList.contains("Comida")) {
          tareas[i].style.display = "flex";
        } else {
          tareas[i].style.display = "none";
        }
        break;
        case "Hogar":
          if (tareas[i].classList.contains("Hogar")) {
            tareas[i].style.display = "flex";
          } else {
            tareas[i].style.display = "none";
          }
          break;
          
          case "Varios":
            
          if (tareas[i].classList.contains("Varios")) {
            tareas[i].style.display = "flex";
          } else {
            tareas[i].style.display = "none";
          }
          break;
    }
  }
}
// Mostrar u ocultar sidebar
function toggleSidebar(){
  sidebar.classList.toggle("open");
  if(sidebar.classList.contains("open")){
    botonBurger.style.display = "none";
    botonCerrar.style.display = "block";
  }
  else{
    botonBurger.style.display = "block";
    botonCerrar.style.display = "none";
  }

}
