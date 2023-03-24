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
    
        public function getArchiveOrder() //Ritorna tutti gli ordini.
    {
        $query = "SELECT o.id, a.username, o.address, o.date_order, o.total_price, o.status
        from `order` o
        inner join account a on o.id_account = a.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrder($id) //ritorna l'ordine richiesto ricevendo in input l'id dell'ordine stesso
    {
        $sql = "SELECT o.id, a.username , o.address, o.date_order, o.total_price, o.status
        from `order` o
        inner join account a on a.id = o.id_account 
        where o.id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getOrderFormaggy($id) //Ritorna i prodotti di un ordine
    {
        $sql = "SELECT f.id, f.name, f.description, of2.weight
        from `order` o
        inner join order_formaggyo of2 on of2.id_order = o.id
        inner join formaggyo f on f.id = of2.id_formaggyo 
        where o.id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
