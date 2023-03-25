<?php

spl_autoload_register(function ($class) {
    require __DIR__ . "/../COMMON/$class.php";
});

set_exception_handler("errorHandler::handleException");
set_error_handler("errorHandler::handleError");

class Formaggy
{
    private PDO $conn;
    private Connect $db;

    public function __construct()
    {
        $this->db = new Connect;
        $this->conn = $this->db->getConnection();
    }
    
    public function getArchiveFormaggy() //Ritorna tutti i formaggi.
    {
        $query = "SELECT f.id, f.name, f.description, f.price_kg, c.name as category, c2.acronym as certification, f.color, f.smell, f.taste, f.expiry_date, f.kcal, f.fats, f.satured_fats, f.carbohydrates, f.sugars, f.proteins, f.fibers, f.salts
        from formaggyo f
        inner join category c on c.id = f.id_category
        inner join certification c2 on c2.id = f.id_certification
        order by f.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFormaggy($id) //ritorna il formaggio richiesto ricevendo in input l'id dell'formaggio stesso
    {
        $sql = "SELECT f.id, f.name, f.description, f.price_kg, c.name as category, c2.acronym as certification, f.color, f.smell, f.taste, f.expiry_date, f.kcal, f.fats, f.satured_fats, f.carbohydrates, f.sugars, f.proteins, f.fibers, f.salts
        from formaggyo f
        inner join category c on c.id = f.id_category
        inner join certification c2 on c2.id = f.id_certification
        inner join formaggyo_size fs ON fs.id_formaggyo = f.id
        inner join `size` s on s.id = fs.id_size
        where f.id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getFormaggyIngredients($id) //Ritorna gli ingredienti del formaggio
    {
        $sql = "SELECT i.id, i.name, i.description 
        FROM formaggyo f
        INNER JOIN formaggyo_ingredient fi ON f.id = fi.id_formaggyo
        INNER JOIN ingredient i ON fi.id_ingredient = i.id
        WHERE f.id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getFormaggySizes($id) //ritorna le taglie del formaggio richiesto
    {
        $sql = "SELECT s.id, s.weight 
                from formaggyo f 
                inner join formaggyo_size fs on fs.id_formaggyo =f.id 
                inner join `size` s on s.id =fs.id_size 
                where f.id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }
}
?>
