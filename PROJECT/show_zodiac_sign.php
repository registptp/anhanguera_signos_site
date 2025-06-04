<?php
include('layouts/header.php');

function formatarNomeImagem($nomeSigno) {
  $nome = strtolower(trim($nomeSigno));
  $nome = str_replace(
    ['á', 'ã', 'â', 'é', 'ê', 'í', 'ó', 'ô', 'ú', 'ç','Á', 'Ã', 'Â', 'É', 'Ê', 'Í', 'Ó', 'Ô', 'Ú', 'Ç'],
    ['a', 'a', 'a', 'e', 'e', 'i', 'o', 'o', 'u', 'c', 'A', 'A', 'A', 'E', 'E', 'I', 'O', 'O', 'U', 'C'],
    $nome
  );
  return "assets/imgs/{$nome}.png";
}

$data_nascimento = $_POST['data_nascimento'];
$signos = simplexml_load_file("signos.xml");

list($ano, $mes, $dia) = explode("-", $data_nascimento);
$data_usuario = mktime(0, 0, 0, $mes, $dia);

foreach ($signos->signo as $signo) {
  $inicio = explode('/', (string)$signo->dataInicio);
  $fim = explode('/', (string)$signo->dataFim);

  $data_inicio = mktime(0, 0, 0, $inicio[1], $inicio[0]);
  $data_fim = mktime(0, 0, 0, $fim[1], $fim[0]);

  if ($data_inicio <= $data_fim) {
    if ($data_usuario >= $data_inicio && $data_usuario <= $data_fim) {
      $encontrado = $signo;
      break;
    }
  } else {
    if ($data_usuario >= $data_inicio || $data_usuario <= $data_fim) {
      $encontrado = $signo;
      break;
    }
  }
}

if (isset($encontrado)) {
  $nomeSigno = (string)$encontrado->signoNome;
  $descricao = (string)$encontrado->descricao;
  $caminhoImagem = formatarNomeImagem($nomeSigno);

  echo "<div class='text-center'>";
  echo "<h2>Seu signo é <strong>$nomeSigno</strong></h2>";
  echo "<img src='$caminhoImagem' alt='$nomeSigno' class='img-fluid' style='max-width: 200px; margin: 20px 0;'>";
  echo "<p>$descricao</p>";
  echo "<a href='index.php' class='btn btn-secondary mt-3'>← Voltar</a>";
  echo "</div>";
} else {
  echo "<p>Data inválida ou signo não encontrado.</p>";
}
?>
</div>
</body>
</html>
