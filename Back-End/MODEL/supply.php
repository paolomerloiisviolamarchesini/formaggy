<?php

spl_autoload_register(function ($class) {
    require __DIR__ . "/../COMMON/$class.php";
});

set_exception_handler("errorHandler::handleException");
set_error_handler("errorHandler::handleError");

class Supply
{
    private PDO $conn;
    private Connect $db;

    public function __construct()
    {
        $this->db = new Connect;
        $this->conn = $this->db->getConnection();
    }

    public function getSupply($id) //Ritorna l'ordine richiesto fatto al fornitore ricevendo in input l'id
    {
        $sql = "SELECT s.id, a.username, d.name as dairy_name, s.date_supply, s.total_price, s.status
        FROM supply s
        INNER JOIN dairy d on s.id_dairy = d.id
        INNER JOIN account a on a.id = s.id_account
        WHERE s.id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getSupplyFormaggy($id) //Ritorna i prodotti di un ordine
    {
        $sql = "SELECT f.id, f.name, f.description, sf.weight
        FROM supply s
        INNER JOIN supply_formaggyo sf ON s.id = sf.id_supply
        INNER JOIN formaggyo f on f.id = sf.id_formaggyo
        INNER JOIN category c on f.id_category = c.id
        INNER JOIN certification c2 on f.id_certification = c2.id
        WHERE s.id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
