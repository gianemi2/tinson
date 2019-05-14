<?php
/**
 * Created by PhpStorm.
 * User: marcogiannini
 * Date: 06/05/2019
 * Time: 15:52
 */

class JsonMakerForTinfoil
{
    private $json_name = 'switch.json';
    private $google_base = 'https://docs.google.com/uc?export=download&id=';
    private $file_ext = '.nsp';
    private $json;

    function __construct()
    {
        $this->json = file_get_contents($this->json_name);
        $this->json = json_decode($this->json);

        $this->kickassNewGame();
    }

    /*
     * Listen for every GET and run right method.
     */
    function kickassNewGame()
    {
        if(isset($_GET['gid']) && isset($_GET['gname'])){
            $this->addGameToList($_GET['gid'], $_GET['gname']);
        }
        if(isset($_GET['list'])){
            $this->listCurrentGames();
        }
        if(isset($_GET['delete'])){
            $this->deleteSelectedGame($_GET['delete']);
        }
    }

    /**
     * @param $gameID: string ID of google drive links
     * @param $gameName: string Name of NSP
     */
    function addGameToList($gameID, $gameName)
    {
         $gameName = str_replace(' ', '_', $gameName);
         $link = $this->google_base . $gameID . '#' . $gameName . $this->file_ext;
         $this->json->files[] = $link;
         $this->saveToJSON();
    }

    function saveToJSON()
    {
        $json = json_encode($this->json, JSON_UNESCAPED_SLASHES);
        $result = file_put_contents($this->json_name, $json);
        if($result){
            echo 'Lista aggiornata con successo.';
        } else {
            echo 'La lista non è stata aggiornata correttamente.';
        }
    }

    function listCurrentGames()
    {
        if(count($this->json->files) > 0){
            foreach ($this->json->files as $index => $file) {
                $separator = ';';
                if($index == count($this->json->files) - 1){
                    $separator = '';
                }
                $filename = substr($file, strpos($file, '#') + 1);
                $filename = $index . ' | ' . $filename . $separator;
                echo $filename;
            }
        } else {
            echo -1;
        }
    }

    /**
     * @param $filename : String name of game with Index before separated with -
     */
    function deleteSelectedGame($filename)
    {
        $json = json_decode($filename);
        if (json_last_error() === 0) {
            foreach ($json as $filename) {
                $delete_target = substr($filename, 0, strpos($filename, '|') - 1);
                unset($this->json->files[$delete_target]);
            }
            array_values($this->json->files);
            $this->saveToJSON();
        } else {
            $delete_target = substr($filename, 0, strpos($filename, '|') - 1);
            unset($this->json->files[$delete_target]);
            array_values($this->json->files);
            $this->saveToJSON();
        }
    }
}
