<?php session_start();

// Si no está la variable "logueado" en la sesion
// O
// está la variable pero no vale 1
// ENTONCES
// Volvemos al index. El usuario no tiene permiso de ver esta página

if(!isset($_SESSION['logueado'])){
    header('Location: loginregister/index.php');
}


if(isset($_SESSION['logueado']) && $_SESSION['logueado'] != 1){
    header('Location: loginregister/index.php');
}

    // initialize errors variable
	$errors = "";

	// connect to database
	$conexion = mysqli_connect('localhost', 'root', '', 'to_do');

    $categorias = mysqli_query($conexion, "SELECT * FROM categoria");
    $array_categorias = [];
    while ($row = mysqli_fetch_array($categorias, MYSQLI_ASSOC)) {
        $array_categorias[] = $row;
    }

    $tasks = mysqli_query($conexion, "SELECT tareas.id AS id, tareas.name AS tarea, categoria.name AS categoria
    FROM tareas INNER JOIN categoria ON categoria.id = tareas.id_categoria");
    $array_tareas = [];
    while($row = mysqli_fetch_array($tasks, MYSQLI_ASSOC)){
        $array_tareas[] = $row;
    }

    // insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
		if (empty($_POST['tarea'])) {
			$errors = "Debes introducir una tarea";
		}else{
			$task = $_POST['tarea'];
            $category = $_POST['categoria'];
			$sql = "INSERT INTO tareas (name, id_categoria, id_usuario) VALUES ('$task', '$category',1)";
			mysqli_query($conexion, $sql);
			header('location: todo.php');
		}
	}
	// delete task
if (isset($_GET['del_tarea'])) {
	$id = $_GET['del_tarea'];

	mysqli_query($conexion, "DELETE FROM tareas WHERE id =".$id);
	header('location: todo.php');
}	?>


<!-- ACÁ VA EL HTML DEL TO-DO -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3943ac4422.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styleapp/style.css">
    <title>Lista de Tareas</title>

</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <ul>
            <li><svg xmlns="http://www.w3.org/2000/svg" style="width:24px;height:24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>Usuario </li>
            <li><svg xmlns="http://www.w3.org/2000/svg" style="width:24px;height:24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>Fecha</li>
            <li><svg xmlns="http://www.w3.org/2000/svg" style="width:24px;height:24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>Completos</li>
            <li><svg xmlns="http://www.w3.org/2000/svg" style="width:24px;height:24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg><a href="auth/logout.php">Logout</a></li>
        </ul>
        <div class="btn" id="sidebarbtn">
        <span class="burger"> 
            <svg xmlns="http://www.w3.org/2000/svg" style="width:24px;height:24px;" fill="none" viewBox="0 0 24 24" stroke="white">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </span>
        <span class="cerrar">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:24px;height:24px;" fill="none" viewBox="0 0 24 24" stroke="white">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
        </span>
        </div>
    </div>
    <!-- TITULO -->
    <header>
        <h1>Lista de Tareas</h1>
    </header>

    <!-- INPUT FIELD PARA INTRODUCIR TAREAS Y FILTRO DESPLEGABLE -->
    <section class="container">
        <div class="form-container">
            <form class="select1" method="post" action="todo.php">
                    <?php if (isset($errors)) {?>
		            <p><?php echo $errors; ?></p>
	                <?php }?>
                <select name="categoria" id="categoria">
                    <?php
                        //for($i=0; $i < count(mysqli_fetch_array($categorias)); $i++ )
                        foreach($array_categorias as $cat){
                    ?>
                        <option value="<?=$cat["id"]?>"><?=$cat["name"]?></option>
                    <?php }?>
                </select>
                <input type="text" name="tarea" placeholder="Introduce una tarea" class="tarea_input" />
                <button type="submit" name="submit" class="tarea_button">
                    <i class="far fa-plus-square"></i>
                        </button>
                
            </form>
            <div class="select">
                <select name="tareas" class="filtrar_tareas">
                    <option value="all">Todas</option>
                    <option value="completed">Completadas</option>
                    <option value="uncompleted">Sin completar</option>
                    <?php
                        foreach($array_categorias as $cat){
                    ?>
                        <option value="<?=$cat["name"]?>"><?=$cat["name"]?></option>
                    <?php }?>
                </select>
            </div>
        </div>
    
        <!-- CONTAINER PARA MOSTRAR LISTA AÑADIENDO TAREAS DINAMICAMENTE CON JS -->
        <div class="container_lista">
            <ul class="lista_tareas">
            <?php 
                // select all tasks if page is visited or refreshed
                foreach($array_tareas as $row){ ?>
                <div class="tarea <?=$row['categoria']?>">
                    <li class="tarea_item"><?php echo $row['categoria']." - ". $row['tarea'] ;  ?></li>
                    <button class="complete_btn">
                        <i class="far fa-check-square" aria-hidden="true"></i>
                    </button>
                    <a href="todo.php?del_tarea=<?php echo $row['id'] ?>">
                        <i class="far fa-trash-alt" aria-hidden="true"></i>
                    </a>
                    
                </div>
            <?php } ?>	
            </ul>
        </div>

                     
    </section>
    <script src="styleapp/script.js"></script>
</body>

</html>