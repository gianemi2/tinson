<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Compiled and minified CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="vendor/ajax-snippet.js"></script>
    <title>Tinson</title>
    <style>
        .radio-type{
            margin-bottom: 20px;
        }
        .radio-type label{
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <form class="col s12" id="add-game">
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
            <form class="col s12" id="delete-game">
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
<script>
    // Add new games
    let saveForm = document.getElementById('add-game');
    saveForm.addEventListener('submit', function(event){
        event.preventDefault();
        let gid = saveForm.querySelector('#gid');
        let gname = saveForm.querySelector('#gname');

        ajax.get('switch_games.php', {gid: gid.value, gname: gname.value}, function(response) {
            M.toast({html: response});
            gid.value = '';
            gname.value = '';
            refreshGames();
        })
    })

    let deleteForm = document.getElementById('delete-game');
    deleteForm.addEventListener('submit', function(event){
        event.preventDefault();
        let checkedBoxes = deleteForm.querySelectorAll('input[type="checkbox"]');
        let toDelete = [];
        for(let i in checkedBoxes){
            let box = checkedBoxes[i];
            if(box.checked){
                toDelete.push(box.name);
            }
        }
        toDelete = JSON.stringify(toDelete);
        ajax.get('switch_games.php', {delete: toDelete }, function(response) {
            M.toast({html: response});
            refreshGames();
        })
    })

    // Get all current games
    function refreshGames(){
        const gamesContainer = document.getElementById('games-list');
        ajax.get('switch_games.php', {list: true}, function(response) {
            if(response != -1){
                gamesContainer.innerHTML = '';
                let gamesList = response.split(';');
                for(let i in gamesList){
                    let game = appendGamesInList(gamesList[i]);
                    gamesContainer.innerHTML += game;
                }
            } else {
                gamesContainer.innerHTML = '<p>Nessun gioco nella lista.</p>';
            }
        })
    }
    refreshGames();

    function appendGamesInList(gameName){
        return '<label><input class="filled-in" name="' + gameName + '" type="checkbox"><span>' + gameName + '</span></label>';
    }

</script>
</html>
