<!doctype html>
<html lang="en">
  <head>
    <title>CRUD Exemplo</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles_crud.css">

    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>

  <body>
  <div class="container-fluid" id="registreP">
  <div id="images"></div>
  <div class="container" id="registre">
    <h2 id="registreTitulo">Registre o Pokémon</h2>

    <form action="" method="post">
  
      <div class="form-group">
        <label for="PokemonNames">Pokémon Nome</label>
        <input type="text" id="pokemonName" name="pokemonName" placeholder="Digite o nome" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="PokemonLevels">Pokémon Level</label>
        <input type="text" id="pokemonLevel" name="pokemonLevel" placeholder="Digite o level" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="pokemonTypes">Pokémon Tipo</label>
        <input type="text" id="pokemonTipo" name="pokemonTipo" placeholder="Digite o tipo (ex: elétrico, normal)" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="ataques">Ataque</label>
        <input type="text" id="ataque" name="ataque" placeholder="Digite o ataque" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="hp">HP</label>
        <input type="text" id="hp" placeholder="Digite o HP" name="hp" class="form-control" required>
      </div>

      <button type="submit" id="btnRegistrar" name="btnRegistrar" class="btn btn-info">Registrar!</button>

    </form>
  </div>
  </div>

  <div id="atualizarBox" class="container">
    <div class="row">
        <div class="col-md-2"><img src="img/all3pokemon.png" alt="" class="image-fluid"></div>
        <dv class="col-md-2"><img src="img/squartle.png" alt="Squartle" class="image-fluid"></dv>
        <div id="linkAtualiza" class="col-md-4">
        <h1><a href="index.php?atualizar">Atualizar</a></h1>
        </div>
        <div class="col-md-2">
          <img src="img/charmander.png" alt="Charmander" class="image-fluid">
        </div>
        <div class="col-md-2"><img src="img/bulbagif.gif" alt="" class="image-fluid"></div>
      </div>
  </div>

  <div id="secondSquare" class="container-fluid">
    <div class="container">

      <h2 class="titleTable">Pokémon Registrados</h2>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Level</th>
              <th>Tipo</th>
              <th>Ataque</th>
              <th>HP</th>
              <th>Atualizar</th>
              <th>Deletar</th>
            </tr>
          </thead>
        
      </div>
    </div>
  </div>

  <?php

  $con = mysqli_connect("localhost","root","root","test");

  if(mysqli_connect_errno()){
    echo "Conexão com a database falhou";
  } 

  if(isset($_POST['btnRegistrar'])){

    $user_pkmName = $_POST['pokemonName'];
    $user_pkmLevel = $_POST['pokemonLevel'];
    $user_pkmTipo = $_POST['pokemonTipo'];
    $user_pkmAtaque = $_POST['ataque'];
    $user_pkmHP = $_POST['hp'];

    $insert_pokemon = "INSERT INTO pokemon(pokemonNome, pokemonLevel, pokemonTipo, ataque, hp) VALUES ('$user_pkmName', '$user_pkmLevel', '$user_pkmTipo', '$user_pkmAtaque', '$user_pkmHP')";

    $run_insert_pokemon = mysqli_query($con, $insert_pokemon);

    if($run_insert_pokemon){
      echo "Novo Pokemon Registrado";
    } else{
      echo "O Pokemon nao pode ser registrado.";
    }

  }

  ?>

  <?php
    $connection = mysqli_connect("localhost","root","root","test");

    if(mysqli_connect_errno()){
      echo "Conexão com a database falhou";
    } 

    if(isset($_GET['atualizar'])){
    $query_pokemon = "SELECT * FROM pokemon";
    $run_query_pokemon = mysqli_query($connection, $query_pokemon);

    while($result = mysqli_fetch_array($run_query_pokemon)){

      $poke_ID = $result['id'];

      echo "
      <tbody>
      <tr>
        <td>$poke_ID</td>
        <td>$result[1]</td>
        <td>$result[2]</td>
        <td>$result[3]</td>
        <td>$result[4]</td>
        <td>$result[5]</td>
        <td><a href='index.php?atualizanovo=$poke_ID'>Atualizar</a></td>
        <td><a href='index.php?deletar=$poke_ID'>Deletar</a></td>
      </tr>
    </tbody>
      
      ";
    }
    echo "</table>";
  
  }
  //DELETE PKM

  if(isset($_GET['deletar'])){

    $pokeDeletar = $_GET['deletar'];

    $deletarPoke = "DELETE FROM pokemon WHERE id='$pokeDeletar'";
    $run_deletePoke = mysqli_query($connection, $deletarPoke);

    if($run_deletePoke){
      echo "Pokemon deletado!";
    }
  }

  //Atualizar dados do Pokémon
  if(isset($_GET['atualizanovo'])){
    $atualizaID = $_GET['atualizanovo'];

    $atualizaPoke = "SELECT * FROM pokemon WHERE id='$atualizaID'";
    $queryAtualizaPoke = mysqli_query($connection, $atualizaPoke);

    //fetch all the columns of that single pokémon to manipulate 'em

    $resultPoke = mysqli_fetch_array($queryAtualizaPoke);

    $newPokemonID = $resultPoke['id'];
    $newPokemonNome = $resultPoke['pokemonNome']; 
    $newPokemonLevel = $resultPoke['pokemonLevel'];
    $newPokemonTipo = $resultPoke['pokemonTipo'];
    $newPokemonAtaque = $resultPoke['ataque'];
    $newPokemonHP = $resultPoke['hp'];

    echo "
    
      <form method='POST' action=''>
      <input type='text' name='nNome' value='$newPokemonNome'/>
      <input type='text'name='nLevel' value='$newPokemonLevel'/>
      <input type='text' name='nTipo' value='$newPokemonTipo'/>
      <input type='text' name='nAtaque' value='$newPokemonAtaque'/>
      <input type='text' name='nHP' value='$newPokemonHP'/>
      <input type='submit' name='nBotao' value='Atualizar'/>
      </form>

    ";
  }

  if(isset($_POST['nBotao'])){
    $newID = $newPokemonID;

    $nNome = $_POST['nNome'];
    $nLevel = $_POST['nLevel'];
    $nTipo = $_POST['nTipo'];
    $nAtaque = $_POST['nAtaque'];
    $nHP = $_POST['nHP'];

    $updatePokemon = "UPDATE pokemon SET pokemonNome ='$nNome', pokemonLevel='$nLevel', pokemonTipo='$nTipo', ataque='$nAtaque', hp='$nHP' WHERE id='$newID'";
    $queryUpdatePokemon = mysqli_query($connection, $updatePokemon);

    if($queryUpdatePokemon){
      header("location: index.php");
      exit;
    } else{
      echo "Erro na Atualização!";
    }
  }

  ?>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>