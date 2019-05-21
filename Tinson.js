const APIURL = 'switch_games.php';

class Tinson{
    constructor(){
        this.updateGameForm = document.getElementById('add-game');
        this.deleteForm = document.getElementById('delete-game');
        this.gamesList = document.getElementById('games-list');

        this.refreshGames();
    }

    setQueryParams(object){
        const queryParams = Object.keys(object).map(function(key) {
            return key + '=' + encodeURIComponent(object[key]);
        }).join('&');
        return queryParams;
    }

    request(method="POST", body, type="JSON"){
        const request = new Request(APIURL, {
            method: method,
            headers: new Headers({
                'Content-Type': 'application/x-www-form-urlencoded'
            }),
            body: this.setQueryParams(body)
        })
        return fetch(request).then(response => response.json());
    }

    updateGames(e){
        e.preventDefault();
        const gid = this.updateGameForm.querySelector('#gid');
        const gname = this.updateGameForm.querySelector('#gname');
        this.request("POST", {gid: gid.value, gname: gname.value}).then( response => {
            M.toast({html: response});
            gid.value = '';
            gname.value = '';
            this.refreshGames();
        })
    }

    deleteGames(e){
        event.preventDefault();
        const checkedBoxes = this.deleteForm.querySelectorAll('input[type="checkbox"]');
        let toDelete = [];
        for(let i in checkedBoxes){
            let box = checkedBoxes[i];
            if(box.checked){
                toDelete.push(box.name);
            }
        }
        toDelete = JSON.stringify(toDelete);
        this.request("POST", {delete: toDelete }).then( response => {
            M.toast({html: response});
            this.refreshGames();
        })
    }

    refreshGames(){
        this.request("POST", {list: true}).then( response => {
            if(response != -1){
                this.gamesList.innerHTML = '';
                const gamesList = response;
                for(let i in gamesList){
                    let dividerCount = gamesList[i].indexOf('___');
                    let url = gamesList[i].substr(0, dividerCount);
                    let name = gamesList[i].substr(dividerCount + 3);

                    let game = this.appendGamesInList(name, url);
                    this.gamesList.innerHTML += game;
                }
            } else {
                this.gamesList.innerHTML = '<p>Nessun gioco nella lista.</p>';
            }
        })
    }

    appendGamesInList(gameName, gameUrl){
        return '<label><input class="filled-in" name="' + gameName + '" type="checkbox"><span>' + gameName + '</span><a target="_blank" href="'+gameUrl+'"><i class="material-icons">insert_link</i></a></label>';
    }
}
const tinson = new Tinson();
