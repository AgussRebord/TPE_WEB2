<?php

require_once 'config.php'; 
class helaModel {

    private $db;

    function __construct(){
        //1.  abro conexión
        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }
    private function deploy(){
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        $password = 'admin';
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        if(count($tables) == 0){
            $sql = <<<END
            CREATE TABLE `categorias` (
                `id_categoria` int(11) NOT NULL,
                `nombre_categoria` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
              
            CREATE TABLE `pedidos` (
                `id_pedido` int(11) NOT NULL,
                `id_producto` int(11) NOT NULL,
                `producto` varchar(255) NOT NULL,
                `categoria` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                  
            CREATE TABLE `producto` (
                `id_productos` int(11) NOT NULL,
                `nombre_producto` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            CREATE TABLE `usuarios` (
                `id` int(11) NOT NULL,
                `userName` varchar(20) NOT NULL,
                `password` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            ALTER TABLE `categorias`
            ADD PRIMARY KEY (`id_categoria`);
            ALTER TABLE `pedidos`
            ADD PRIMARY KEY (`id_pedido`),
            ADD KEY `categoria` (`categoria`),
            ADD KEY `id_producto` (`id_producto`);
            ALTER TABLE `producto`
            ADD PRIMARY KEY (`id_productos`);
            ALTER TABLE `usuarios`
            ADD PRIMARY KEY (`id`);
            ALTER TABLE `categorias`
            MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
            ALTER TABLE `pedidos`
            MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=524;
            ALTER TABLE `producto`
            MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
            ALTER TABLE `usuarios`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
            ALTER TABLE `pedidos`
            ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id_categoria`),
            ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
            ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
            ADD CONSTRAINT `pedidos_ibfk_4` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_productos`) ON DELETE CASCADE ON UPDATE CASCADE;
            COMMIT;
            INSERT INTO `producto` (`id_productos`, `nombre_producto`) VALUES
            (1, 'Bombon Suizo'),
            (2, 'Torta Oreo'),
            (3, 'Torta Milka'),
            (4, 'Cucurucho'),
            (5, 'palito bombon'),
            (23, 'Helado');
            INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
            (2, 'servido'),
            (3, 'tortas'),
            (4, 'otros'),
            (5, 'bombones'),
            (6, 'palitos');
            INSERT INTO `pedidos` (`id_pedido`, `id_producto`, `producto`, `categoria`) VALUES
            (1, 1, 'Bombon Suizo', 5),
            (2, 3, 'Torta Milka', 3),
            (3, 2, 'Torta Oreo', 3),
            (4, 4, 'Cucurucho', 4),
            (523, 23, 'Helado', 2);
            INSERT INTO `usuarios` (`id`, `userName`, `password`) VALUES
            (1, 'webadmin', '$hashedPassword');
            END;   
            $this->db->query($sql);
        }
    }
    function getPedidos(){
        //2.  ejecuto consulta SQL
        $query = $this->db->prepare('SELECT pedidos.*, categorias.nombre_categoria 
                                    FROM pedidos JOIN categorias ON pedidos.categoria = categorias.id_categoria');
        $query->execute();

        //3. Obtener datos de la consulta

        return $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo con todos los pedidos

    }
    function getPedidosxFiltro($categoria){
        //2.  ejecuto consulta SQL
        $query = $this->db->prepare('SELECT * FROM pedidos WHERE categoria = ?');
        $query->execute([$categoria]);

        //3. Obtener datos de la consulta

        return $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo con todos los pedidos

    }

    function BuscarIdProducto($producto){


    }
    function insertPedidos($producto,$categoria){
        $query = $this->db->prepare('SELECT id_productos FROM producto WHERE nombre_producto = ?');
        $query->execute([$producto]);

        $id_producto = $query->fetch(PDO::FETCH_OBJ);
            

        $query = $this->db->prepare('INSERT INTO pedidos(id_producto, producto, categoria) VALUES(?,?,?)');
        
        $query->execute(array($id_producto->id_productos,$producto,$categoria));
    
        return $this->db->lastInsertId();

    }
    
    function deletePedido($id){
        $query = $this->db->prepare('DELETE FROM pedidos WHERE id_producto = ?');
        $query->execute([$id]);
        
        
    }
    function updatePedido($id_pedido,$producto,$id_producto, $categoria){
            
        $query = $this->db->prepare('UPDATE pedidos SET id_producto = ?, producto = ?, categoria = ? WHERE id_pedido = ?');
        $query->execute(array($id_producto, $producto, $categoria, $id_pedido));
    }
    
}

















?>