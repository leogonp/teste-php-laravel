<!DOCTYPE html>
<html>
<head>
    <title>Lista de Documentos</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #000000;
            text-align: left;
            padding: 8px;
            max-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .button {
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button1 {background-color: #008CBA;}
    </style>
</head>
<body>
<div class="container">

    <h1>Documentos</h1>
    <form action="{{ route('documents.send-queue') }}" method="GET">
        @csrf
        <button class="button button1">Importar documentos</button>
    </form>

    <table>
        <thead>
        <tr>
            <th>Categoria</th>
            <th>Título</th>
            <th>Conteúdo</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($documents as $document)
            <tr>
                <td>{{ $document->category->name }}</td>
                <td>{{ $document->title }}</td>
                <td>{{ $document->contents }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>

