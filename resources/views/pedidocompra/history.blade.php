@isset($auditLogs)
<!-- Botão para abrir a modal -->
<button class="btn" id="openModalBtn">Exibir Histórico</button>

<!-- A modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <h4 class="text-center">Pedido de Compra - Audit Log</h4>
    <span class="close">&times;</span>
    <table>
        <tr>
          <th>Ação</th>
          <th>Dados Modificados</th>
          <th>Horário</th>
          <th>Usuário</th>
        </tr>
        @foreach($auditLogs as $log)
        <tr>
          <td>{{ $log['action'] }}</td>
          <td>
            @if (empty($log['dirty']))
              {!! str_replace(',', ',<br>', strip_tags(json_encode($log['dirty']))) !!}
            @else
              {!! str_replace(',', ',<br>', strip_tags(json_encode($log['before']))) !!}
            @endif
          </td>
          <td>{{ date('d-m-Y H:i:s', substr($log['updated_at'], 0, 10)) }}</td>
          <td>
            @php
              $user = App\User::find($log['user_id']);
              $userName = $user ? $user->name : 'Usuário não encontrado';
              echo $userName;
            @endphp
          </td>
        </tr>
        @endforeach
      </table>
      
      
  </div>
</div>

<style>
    /* CSS para a modal */
    .modal {
      display: none; /* Esconder a modal por padrão */
      position: fixed; /* Ficar em cima de tudo */
      z-index: 1; /* Deixar a modal no topo */
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto; /* Habilitar o scroll se necessário */
      background-color: rgba(0, 0, 0, 0.5); /* Cor de fundo escura */
    }
  
    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }
  
    .modal-content table {
      margin: 0 auto; /* Centralizar a tabela horizontalmente */
      /* width: 100%; */
      border-collapse: collapse;
      background-color: aliceblue;
    }
  
    .modal-content th,
    .modal-content td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
  
    .modal-content th {
      background-color: #f2f2f2;
    }
  
    .modal-content tr:hover {
      background-color: #f5f5f5;
    }
  
    .modal-content tbody {
      text-align: center; /* Alinhar conteúdo do tbody ao centro */
    }
  
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
  
    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
  
  

<script>
  // Obter referências aos elementos
  var modal = document.getElementById("myModal");
  var btn = document.getElementById("openModalBtn");
  var span = document.getElementsByClassName("close")[0];

  // Abrir a modal quando o botão for clicado
  btn.onclick = function() {
    modal.style.display = "block";
  }

  // Fechar a modal quando o usuário clicar no "x"
  span.onclick = function() {
    modal.style.display = "none";
  }

  // Fechar a modal quando o usuário clicar fora dela
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>

@endisset