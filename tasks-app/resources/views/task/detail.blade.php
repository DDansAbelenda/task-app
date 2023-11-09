<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <title>Document</title>
    
</head>
<body>
    <h1>Tareas</h1>
    <p>Title: {{$task->name}}</p>
    <p class="">Completed: {{$task->completed?'Sí': 'No'}}</p>
    <form action="{{route('task.index')}}" method="get">
    <button type="submit">Regresar</button>
    </form>
</body>
</html>