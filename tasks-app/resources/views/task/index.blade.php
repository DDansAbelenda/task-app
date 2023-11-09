<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Tareas</title>

</head>

<body>
    <div class="container">
        <h1 class="title">Tareas
            <span class="material-symbols-outlined">
                task_alt
            </span>
        </h1>

        @if (session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif


        <form method='POST' action="{{ route('task.store') }}" class="form-container">
            @csrf
            <input type="text" name="name" placeholder="Nombre de la tarea">
            <button type="submit">
                <span class="material-symbols-outlined">
                    add_circle
                </span>
            </button>
        </form>


        <ul class="task-list">
            @foreach ($tasks as $task)
                <li>
                    <form id="form-{{ $task->id }}" method="POST" action="{{ route('task.update', $task->id) }}">
                        @csrf
                        @method('PATCH')
                        <input type="checkbox" class="task-checkbox" data-task-id="{{ $task->id }}"
                            onclick = "submitForm({{ $task->id }})" {{ $task->completed ? 'checked' : '' }}>
                        <label class="task-label {{ $task->completed ? 'completed' : '' }}">{{ $task->name }}</label>
                    </form>
                    <div class="buttons-container">
                        <form method="GET" action="{{ route('task.show', $task->id) }}" class="detail-form">
                            @csrf
                            <button type="submit">
                                <span class="material-symbols-outlined">
                                    quick_reference
                                </span>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('task.destroy', $task->id) }}" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <span class="material-symbols-outlined">
                                    delete
                                </span>
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <script>
        function submitForm(taskId) {
            document.querySelector('#form-' + taskId).submit();
        }
    </script>
</body>

</html>
