<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Compiled and minified CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="main.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="vendor/ajax-snippet.js"></script>
    <title>Tinson</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <form class="col s12" id="add-game" onSubmit="tinson.updateGames(event)">
                <div class="row">
                    <div class="col s12">
                        <h5>Aggiungi un gioco</h5>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="gid" type="text" class="validate" name="gid">
                        <label for="gid">Google Drive ID</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="gname" type="text" class="validate">
                        <label for="gname">Nome del gioco</label>
                    </div>
                    <div class="col s12">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Salva
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <form class="col s12" id="delete-game" onSubmit="tinson.deleteGames(event)">
                <div class="row">
                    <div class="col s12">
                        <h5>Elimina un gioco</h5>
                    </div>
                    <div class="col s12 radio-type" id="games-list">

                    </div>
                    <div class="col s12">
                        <button class="btn waves-effect waves-light deep-orange darken-3" type="submit" name="action">Elimina
                            <i class="material-icons right">delete</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="Tinson.js"></script>
</html>
