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

    public function getSupply($id) //ritorna l'ordine richiesto fatto al fornitore ricevendo in input l'id dell'ordine stesso
    {
        $sql = "SELECT s.id, a.username, d.name, f.name, s.date_supply, sf.weight, s.total_price, s.status
        from supply s
        inner join dairy d on s.id_dairy = d.id
        inner join account a on a.id = s.id_account
        inner join supply_formaggyo sf on sf.id_supply = s.id
        inner join formaggyo f on sf.id_formaggyo = f.id
        where s.id = :id ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
