<?php

spl_autoload_register(function ($class) {
    require __DIR__ . "/../COMMON/$class.php";
});

set_exception_handler("errorHandler::handleException");
set_error_handler("errorHandler::handleError");

class Order
{
    private PDO $conn;
    private Connect $db;

    public function __construct()
    {
        $this->db = new Connect;
        $this->conn = $this->db->getConnection();
    }

    public function getOrder($id) //ritorna l'ordine richiesto ricevendo in input l'id dell'ordine stesso
    {
        $sql = "SELECT o.id, o.id_account, o.address, o.date_order, f.name, of.weight, o.total_price, o.status
        from `order` o
        inner join order_formaggyo of on o.id = of.id_order
        inner join formaggyo f on f.id = of.id_formaggyo
        where o.id = :id ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getArchiveOrder() //Ritorna tutti gli ordini.
    {
        $query = "SELECT o.id, o.id_account, o.address, o.date_order, f.name, of.weight, o.total_price, o.status
        from `order` o
        inner join order_formaggyo of on o.id = of.id_order
        inner join formaggyo f on f.id = of.id_formaggyo";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
