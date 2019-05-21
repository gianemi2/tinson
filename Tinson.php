<?php
/**
 * Created by PhpStorm.
 * User: marcogiannini
 * Date: 06/05/2019
 * Time: 15:52
 */

class Tinson
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
        if(isset($_POST['gid']) && isset($_POST['gname'])){
            $this->addGameToList($_POST['gid'], $_POST['gname']);
        }
        if(isset($_POST['list'])){
            $this->listCurrentGames();
        }
        if(isset($_POST['delete'])){
            $this->deleteSelectedGame($_POST['delete']);
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

    function sendResponse($message)
    {
        echo json_encode($message);
    }

    function saveToJSON()
    {
        $json = json_encode($this->json, JSON_UNESCAPED_SLASHES);
        $result = file_put_contents($this->json_name, $json);

        $message = (
            $result
                ? 'Lista aggiornata con successo.'
                : 'La lista non è stata aggiornata correttamente.'
        );
        $this->sendResponse($message);
    }

    function listCurrentGames()
    {
        $gamesCount = count($this->json->files);
        if($gamesCount > 0){
            $files = [];
            foreach ($this->json->files as $index => $file) {
                $fileurl = substr($file, 0, strpos($file, '#'));
                $filename = substr($file, strpos($file, '#') + 1);
                $filename = $index . ' | ' . $filename;
                $files[] = $fileurl . '___' . $filename;
            }
            $this->sendResponse($files);
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
        } else {
            $delete_target = substr($filename, 0, strpos($filename, '|') - 1);
            unset($this->json->files[$delete_target]);
            array_values($this->json->files);
        }
        $this->saveToJSON();
    }
}
