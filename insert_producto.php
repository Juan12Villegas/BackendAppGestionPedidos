<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitización y validación de datos
    $idCategoria = isset($_POST['idCategoria']) ? intval($_POST['idCategoria']) : 0;
    $nombreProducto = isset($_POST['nombreProducto']) ? htmlspecialchars(strip_tags(trim($_POST['nombreProducto']))) : '';
    $stock = isset($_POST['stockProducto']) ? intval($_POST['stockProducto']) : 0;
    $precioCompra = isset($_POST['precioCompra']) ? floatval($_POST['precioCompra']) : 0.0;
    $precioVenta = isset($_POST['precioVenta']) ? floatval($_POST['precioVenta']) : 0.0;
    $tamaño = isset($_POST['tamañoMedida']) ? htmlspecialchars(strip_tags(trim($_POST['tamañoMedida']))) : '';
    $idMedida = isset($_POST['idMedida']) ? intval($_POST['idMedida']) : 0;
    $vencimiento = isset($_POST['vencimiento']) ? htmlspecialchars(strip_tags(trim($_POST['vencimiento']))) : '';
    $estado = 0;

    // Validar que los campos no estén vacíos y tengan el formato correcto
    if ($idCategoria > 0 && !empty($nombreProducto) && $stock >= 0 && $precioVenta >= 0) {
        // Verificar si el nombre del producto ya existe en la base de datos
        $stmt = $conexion->prepare("SELECT idProducto FROM Producto WHERE nombreProducto = ? AND tamañoMedida = ? AND idMedida = ? AND fechaVencimiento = ?");
        $stmt->bind_param("ssis", $nombreProducto, $tamaño, $idMedida, $vencimiento);

        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            // El producto ya existe en la base de datos
            echo "El Producto ya existe";
        } else {
        
            if (!empty($vencimiento)) {
                // Validar el formato de la fecha de vencimiento
                $datePattern = "/^\d{4}-\d{2}-\d{2}$/";
            
                if (preg_match($datePattern, $vencimiento)) {
                    // Continuar con la inserción del producto
                    if ($stock == null) {
                        $stock = null;
                    }
            
                    if ($precioCompra == null) {
                        $precioCompra = null;
                    }
            
                    // El producto no existe, insertarlo en la base de datos
                    $stmt = $conexion->prepare("INSERT INTO Producto (idCategoriaProducto, idMedida, tamañoMedida, nombreProducto, stock, precioCompra, precioVenta, fechaVencimiento, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("iissiddsi", $idCategoria, $idMedida, $tamaño, $nombreProducto, $stock, $precioCompra, $precioVenta, $vencimiento, $estado);
            
                    if ($stmt->execute()) {
                        echo "Producto agregado exitosamente";
                    } else {
                        echo "Error al agregar producto";
                    }
                } else {
                    echo "Formato de fecha de vencimiento inválido";
                }
            } else {
                // Si la fecha de vencimiento es null o vacía, asignar null
                $vencimiento = null;
                
                // Continuar con la inserción del producto
                if ($stock == null) {
                    $stock = null;
                }
            
                if ($precioCompra == null) {
                    $precioCompra = null;
                }
            
                // El producto no existe, insertarlo en la base de datos
                $stmt = $conexion->prepare("INSERT INTO Producto (idCategoriaProducto, idMedida, tamañoMedida, nombreProducto, stock, precioCompra, precioVenta, fechaVencimiento, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iissiddsi", $idCategoria, $idMedida, $tamaño, $nombreProducto, $stock, $precioCompra, $precioVenta, $vencimiento, $estado);
            
                if ($stmt->execute()) {
                    echo "Producto agregado exitosamente";
                } else {
                    echo "Error al agregar producto";
                }
            }
            
        }

        $stmt->close();
    } else {
        echo "Datos inválidos. Por favor, verifique e intente nuevamente.";
    }

    $conexion->close();
}
?>