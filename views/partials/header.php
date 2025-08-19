<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Usuarios</title>
    <!-- <link rel="stylesheet" href="../public/css/estilos.css" -->
    <link rel="stylesheet" href="/IFTS_4_DS_Desarrollo_de_Sistemas_Web_2025/public/css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-users"></i> Sistema de Gestión de Usuarios</h1>
            
            <div class="actions">
                <a href="index.php" class="btn"><i class="fas fa-home"></i> Inicio</a>
                <a href="index.php?accion=crear" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Usuario</a>
            </div>
        </header>
        
        <?php include 'mensajes.php'; ?>