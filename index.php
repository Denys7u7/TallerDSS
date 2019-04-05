<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//storage.googleapis.com/code.getmdl.io/1.0.1/material.teal-red.min.css" />
    <script src="//storage.googleapis.com/code.getmdl.io/1.0.1/material.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Roboto" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="estilo/style.css">
    <title>Document</title>
</head>
<body>
    

    <?php
        include_once("header.php");
        require_once("Employee.class.php");
        require_once("EmployeeManager.class.php");
        $empleadoObj = new Employee();
        $administracion = new EmployeeManager();
        $administracion->guardarEmpleado($empleadoObj);
        
    ?>

</body>

</html>