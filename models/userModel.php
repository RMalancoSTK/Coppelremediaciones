<?php
class userModel
{

    private $con;

    public function __construct()
    {
        $this->con = new Connection();
        $this->con = $this->con->connect();
    }

    public function getusers()
    {
        $query = "SELECT *, if(estatus=1,'ACTIVO','INACTIVO') AS estatusUser, if(estatus=1, 'bg-success', 'bg-warning') AS estilosUser FROM co_usuarios";
        $res = mysqli_query($this->con, $query);
        $i = 0;
        while ($row = mysqli_fetch_assoc($res)) {
            $data["id_usuario"][$i] = $row['id_usuario'];
            $data["nombre"][$i] = $row['nombre'];
            $data["apt_pat"][$i] = $row['apt_pat'];
            $data["apt_mat"][$i] = $row['apt_mat'];
            $data["tipo_usuario"][$i] = $row['tipo_usuario'];
            $data["correo"][$i] = $row['correo'];
            $data["fecha_reg"][$i] = $row['fecha_reg'];
            $data["fecha_up"][$i] = $row['fecha_up'];
            $data["fecha_de"][$i] = $row['fecha_de'];
            $data["estatus"][$i] = $row['estatus'];
            $data["estatusUser"][$i] = $row['estatusUser'];
            $data["bg"][$i] = $row['estilosUser'];
            $i++;
        }
        return $data;
    }

    public function update($datos)
    {
        $fecha = getdate();
        $fecha_up = $fecha["year"] . "-" . $fecha["mon"] . "-" . $fecha["mday"];
        $query = "UPDATE co_usuarios SET nombre='" . $datos['nombre'] . "', apt_pat='" . $datos['html_pat'] . "', apt_mat ='" . $datos['html_mat'] . "', tipo_usuario='" . $datos['html_us'] . "', correo='" . $datos['html_correo'] . "', fecha_up='" . $fecha_up . "', estatus='" . $datos['html_estatus'] . "' WHERE id_usuario='" . $datos['id'] . "'  ";
        $res = mysqli_query($this->con, $query);
        return true;
    }

    public function saveUser($datos)
    {
        $fecha = getdate();
        $fecha_in = $fecha["year"] . "-" . $fecha["mon"] . "-" . $fecha["mday"];
        $query = "INSERT INTO co_usuarios(nombre,apt_pat,apt_mat,tipo_usuario,correo,password,fecha_reg,estatus) 
        VALUES ('" . $datos['nombre'] . "','" . $datos['paterno'] . "','" . $datos['materno'] . "','" . $datos['tipo_usuario'] . "','" . $datos['correo'] . "','" . $datos['password'] . "','" . $fecha_in . "',1);";
        $res = mysqli_query($this->con, $query);
        $id = mysqli_insert_id($this->con);
        return $id;
    }

    public function deleteUser($id)
    {
        $fecha = getdate();
        $fecha_up = $fecha["year"] . "-" . $fecha["mon"] . "-" . $fecha["mday"];
        $query = "UPDATE co_usuarios SET fecha_de='" . $fecha_up . "',estatus = 0 WHERE id_usuario = $id";
        $res = mysqli_query($this->con, $query);
        return true;
    }

    public function saveUserRol($idUser, $idRol)
    {
        $query = "INSERT INTO co_r_usu(id_usuario,id_rol) VALUES($idUser,$idRol)";
        $res = mysqli_query($this->con, $query);
        return true;
    }
}
