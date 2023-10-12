<p><strong>Nombre:</strong> {{ $nombre }}</p>
<p><strong>Apellido:</strong> {{ $apellido }}</p>
<p><strong>Correo electrónico:</strong> {{ $email }}</p>
<p><strong>Cod País:</strong> {{ $cod_pais }}</p>
<p><strong>Numero Celular:</strong> {{ $movil }}</p>
<p><strong>País:</strong> {{ $pais }}</p>
<p><strong>Comentario:</strong></p>
<p>{{ $comentario }}</p>
@if ($id)
    <p><strong>Ya Soy Cliente, mi numero de ID es: </strong> {{ $id }}</p>
@endif