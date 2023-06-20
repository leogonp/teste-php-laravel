<!DOCTYPE html>
<html>
<head>
    <title>Lista de Documentos</title>
</head>
<body>
<div class="container">

    <h1>Documentos</h1>

    <table>
        <thead>
        <tr>
            <th>Categoria</th>
            <th>Título</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($documents as $document)
            <tr>
                <td>{{ $document->categoria }}</td>
                <td>{{ $document->titulo }}</td>
                <td>
                    <button class="open-modal" data-documento="{{ $document->id }}">Abrir</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div id="modal" style="display: none;">
        <h2 id="modal-title"></h2>
        <p id="modal-content"></p>
    </div>

</div>

</body>
</html>


<script>
        const modal = document.getElementById('modal');
        const modalTitle = document.getElementById('modal-title');
        const modalContent = document.getElementById('modal-content');

        const buttons = document.querySelectorAll('.open-modal');
        buttons.forEach((button) => {
            button.addEventListener('click', (event) => {
                const documentoId = event.target.dataset.documento;

                fetch(`/documentos/${documentoId}`)
                    .then(response => response.json())
                    .then(data => {
                        modalTitle.textContent = data.titulo;
                        modalContent.textContent = data.conteudo;
                        modal.style.display = 'block';
                    });
            });
        });
    </script>
