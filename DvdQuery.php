<?php

namespace Database\Query;

require './Database.php';

use PDO;

class DvdQuery extends \Database
{

    protected $title;
    protected $sort;


    public function __construct()
    {
        parent::__construct();
    }

    public function titleContains($title)
    {
        $this->title = $title;
    }

    public function orderByTitle()
    {
        $this->sort =

            "ORDER BY title";

    }

    public function find()
    {
        if($this->sort) {
            $sql = "
            SELECT *
            FROM dvds
            INNER JOIN ratings
            ON dvds.rating_id = ratings.id
            WHERE dvds.title LIKE ?
            $this->sort
            
        ";
        }
        else{

         $sql = "
            SELECT *
            FROM dvds
            INNER JOIN ratings
            ON dvds.rating_id = ratings.id
            WHERE dvds.title LIKE ?
            ";
            }


        $statement = self::$pdo->prepare($sql);
        $like = '%' . $this->title . '%';
        $statement->bindParam(1, $like);
        $statement->execute();
        $dvds = $statement->fetchAll(PDO::FETCH_OBJ);
    //    var_dump($dvds);
        ?>
        <table>
            <tr>
                <th>Dvd Title</th>
                <th>ID</th>
                <th>Rating</th>
            </tr>

            <?php foreach ($dvds as $dvd) : ?>
                <tr>
                    <td> <?php echo $dvd->title ?> </td>
                    <td> <?php echo $dvd->id ?> </td>
                    <td> <?php echo $dvd->rating_name ?></td>

                </tr>
            <?php endforeach; ?>
        </table>
    <?php }
}