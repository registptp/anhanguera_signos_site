<?php include('layouts/header.php'); ?>
<h1>Descubra seu Signo do Zodíaco</h1>
<form method="POST" action="show_zodiac_sign.php">
  <div class="mb-3">
    <label for="data_nascimento" class="form-label">Escolha sua data de nascimento:</label>
    <input type="date" class="form-control form-control-lg" id="data_nascimento" name="data_nascimento" required>
  </div>
  <div class="d-grid">
    <button type="submit" class="btn btn-primary btn-lg">Ver meu signo ✨</button>
  </div>
</form>
</div>
</body>
</html>

