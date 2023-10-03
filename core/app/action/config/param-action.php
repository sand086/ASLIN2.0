<?php

class ConfigParam
{
  public static function configNewAutoridad($data)
  {
    // core::preprint($data);
    $sql = 'INSERT INTO config_campos (campo,valor,activo) values ("autoridad","' . $data['autoridad'] . '" , "' . $data['estatus'] . '" ) ';
    $query = Database::exeDoIt($sql);
    // core::preprint($sql);
    if ($query[0]) { //se ejecuta correctamente el inser, procede a cargar el historico
      core::insertHistorico('New', ' Se a;ade autoridad :' . $data['autoridad'], 'Config');
    } else {
      print "ERROR en SQL inser autoridad";
    }
    print "insitucion nueva";

  }

  public static function configEditAutoridad($data)
  {
    // core::preprint($data);
    $sql = 'UPDATE config_campos set valor = "' . $data['autoridad'] . '" , activo = "' . $data['estatus'] . '" WHERE id = ' . $data['id'] . '; ';
    $query = Database::exeDoIt($sql);
    // core::preprint($sql);
    if ($query) { //se ejecuta correctamente el inser, procede a cargar el historico
      core::insertHistorico('Edit', ' Se edito autoridad :' . $data['autoridad'], 'Config');
    } else {
      print "ERROR en SQL inser tipo de archivo por categorias";
    }

  }

  public static function configNewInstitucion($data)
  {
    // core::preprint($data);
    $sql = 'INSERT INTO config_campos (campo,valor,activo) values ("institucion","' . $data['institucion'] . '" , "' . $data['estatus'] . '" ) ';
    $query = Database::exeDoIt($sql);
    // core::preprint($sql);
    if ($query[0]) { //se ejecuta correctamente el inser, procede a cargar el historico
      core::insertHistorico('Edit', ' Se edito institucion :' . $data['institucion'], 'Config');
    } else {
      print "ERROR en SQL inser tipo de archivo por categorias";
    }
    print "insitucion nueva";

  }

  public static function configEditInstitucion($data)
  {
    // core::preprint($data);
    $sql = 'UPDATE config_campos set valor = "' . $data['institucion'] . '" , activo = "' . $data['estatus'] . '" WHERE id = ' . $data['id'] . '; ';
    $query = Database::exeDoIt($sql);
    // core::preprint($sql);
    if ($query) { //se ejecuta correctamente el inser, procede a cargar el historico
      core::insertHistorico('Edit', ' Se edito institucion :' . $data['institucion'], 'Config');
    } else {
      print "ERROR en SQL inser tipo de archivo por categorias";
    }

  }

  /** */
  public static function configNewTypeFile($data)
  {

    $sql = "insert into config_files(nivel,valor,parent)  values('3','" . $data['descripcion'] . "', '" . $data['valorid'] . "');";

    
    /*  $sql.="insert into config_files(nivel,valor,parent)  values('2','".$data['etapa2']."','".$data['etapa1']."');";
     $sql.="insert into config_files(nivel,valor,parent)  values('3','".$data['tipo']."','".$data['etapa2']."');"; */
    $query = Database::exeDoIt($sql);
    if ($query) { //se ejecuta correctamente el inser, procede a cargar el historico
      core::insertHistorico('Insert', 'Nuevo Tipo de archivo :' . $data['tipo'], 'Config');
    } else {
      print "ERROR en SQL inser tipo de archivo por categorias";
    }
  }

  public static function configNewTypeFileEtapaUno($data)
  {

    $sql = "insert into config_files(nivel,valor,parent)  values('1','" . $data['descripcion'] . "', '0');";

    /*  $sql.="insert into config_files(nivel,valor,parent)  values('2','".$data['etapa2']."','".$data['etapa1']."');";
     $sql.="insert into config_files(nivel,valor,parent)  values('3','".$data['tipo']."','".$data['etapa2']."');"; */
    $query = Database::exeDoIt($sql);
    if ($query) { //se ejecuta correctamente el inser, procede a cargar el historico
      core::insertHistorico('Insert', 'Nuevo Tipo de archivo :' . $data['tipo'], 'Config');
    } else {
      print "ERROR en SQL inser tipo de archivo por categorias";
    }
  }

  public static function configNewTypeFileEtapaDos($data) 
  {
    $sql = "insert into config_files(nivel,valor,parent)  values('2','" . $data['descripcion'] . "', '" . $data['valorid'] . "');";

    /*  $sql.="insert into config_files(nivel,valor,parent)  values('2','".$data['etapa2']."','".$data['etapa1']."');";
     $sql.="insert into config_files(nivel,valor,parent)  values('3','".$data['tipo']."','".$data['etapa2']."');"; */
    $query = Database::exeDoIt($sql);
    if ($query) { //se ejecuta correctamente el inser, procede a cargar el historico
      core::insertHistorico('Insert', 'Nuevo Tipo de archivo :' . $data['tipo'], 'Config');
    } else {
      print "ERROR en SQL inser tipo de archivo por categorias";
    }
  }

  /*=============================================
    CREAR UN NUEVO ABOGADO A PARTIR DE SWET ALERT 
    =============================================*/
  public static function configNewAbogado($data)
  {
    $opciones = [ 'cost' => 12 ];
    $encripatar_contraseña = password_hash($data['password'], PASSWORD_BCRYPT, $opciones);

  $CamposNuevos = "'" . $data['nombre_limpio'] . "', '" . $data['apellidoP'] . "', '" . $data['apellidoM'] . "', '" . $data['email'] . "', '" . $encripatar_contraseña . "', " . $data['tipoUsuario'] . ", 1, 1, '" . $data['fechaNacimiento'] . "'";

   
    $sql = "INSERT INTO usuarios (`nombre`, `paterno`, `materno`, `email`, `pass`, `rol`, `seccion`, `estatus`, `FechaNacimiento`) VALUES ($CamposNuevos)";
    $query = Database::exeDoIt($sql);

    $sql1 = "INSERT INTO `gruposusuario` (`id`, `IdGrupo`, `idArea`, `idUsuario`, `fechaCreacion`, `modificacion`, `quienModifica`, `esAbogado`) VALUES (NULL, '".$data['tipoUsuario']."', '".$data['area']."', '".$query[1]."', now(), now(), NULL, 'S');";

    if($query){
      $query = Database::exeDoIt($sql1);
    }
  }

  /*=============================================
  CREAR UN NUEVO PROVENIENTE A PARTIR DE SWET ALERT 
  =============================================*/
  public static function configNewProv($data)
  {
    // core::preprint($data);
    /* (
      [prov] => adm
      [descripcion] => admin seg méxico
      [estatus] => 1
      [border] => #7d6a6a
      [background] => #9a1919
  ) */

    /* $compVac = core::compruebaVacios($data);
    if(!$compVac==1);echo 'error campos vacios.'; exit(); */

    $CamposNuevos = ' "prov_' . strtolower($data['prov']) . '", "' . strtolower($data['prov']) . '", "' . strtolower($data['descripcion']) . '","' . $data['border'] . '", "' . $data['background'] . '","' . $data['estatus'] . '" ';
    $sql = "insert into config_prov (tabla,proveniente, descripcion,borderColor,backgroundColor,estatus) values(" . $CamposNuevos . ")";
    $query = Database::exeDoIt($sql);

    Folios::crearProveniente($data['prov'], '');

    if ($query) { //se ejecuta correctamente el inser, procede a cargar el historico
      core::insertHistorico('Insert', 'Nuevo Proveniente :' . $data['prov'], 'Provenientes');
    } else {
      print "ERROR en SQL inser new prov";
    }

  }

  
  /*=============================================
  ACTUALIZA CONFIGURACION DE PARAMETROS DEL ABOGADO
  =============================================*/
  public static function configEditAbogado($data)
  {
    $sql = "UPDATE usuarios SET nombre ='".$data["abog"]."', paterno='".$data['paterno']."', materno='".$data['materno']."', email='".$data['email']."', estatus=".$data['estatus']." WHERE id=".$data['id'];

    $sql2 = 'UPDATE gruposusuario set idGrupo ='.$data['rol'].', idArea ='.$data['area'].' WHERE idUsuario ='.$data['id'];
    
    $query = Database::exeDoIt($sql);

    if($query){
      $query2 = Database::exeDoIt($sql2);
      if($query2) return json_encode(['mensaje' => 'Exito...']);  
    }else {
      die('Error al actualizar la información.');
    }

  }

  /*=============================================
  ACTUALIZA CONFIGURACION DE PARAMETROS DEL PROVENIENTE
  =============================================*/
  public static function configEditProv($data)
  {

    //?arma el array con nos nonbres de columnas para comparar
    $comparar = array(
      'proveniente' => strtolower($data['prov']),
      'descripcion' => strtolower($data['descripcion']),
      'borderColor' => $data['border'],
      'backgroundColor' => $data['background'],
      'estatus' => $data['estatus'],
    );
    $valoresComparados = core::seleccionaUnoParaComparar('config_prov', $data['id'], $comparar);

    //?armar el string con SQL para editar los campos diferentes.
    $CamposEditar = '';
    $camposHistorico = '';
    foreach ($valoresComparados as $key) { // campo, nuevo, anterior
      if ($key['nuevo'] != '') {
        $CamposEditar .= " " . $key['campo'] . " = '" . $key['nuevo'] . "', ";
        $camposHistorico .= " " . $key['campo'] . " -> anterior: '" . $key['anterior'] . "' ; nuevo: '" . $key['nuevo'] . "' |";
      }
    }

    $CamposEditar = rtrim($CamposEditar, ', ');

    $sql = "update config_prov set " . $CamposEditar . "
		where id=" . $data['id'];
    $query = Database::exeDoIt($sql);
    if ($query) { //se ejecuta correctamente el inser, procede a cargar el historico
      core::insertHistorico('Update', $camposHistorico, 'Provenientes');
    } else {
      print "ERROR en SQL edit prov";
    }
  }

  /*=============================================
  ACTUALIZA CONFIGURACION DE PARAMETROS DEL ÁREA
  =============================================*/
  public static function configEditArea($data)
  {
    /*  [area] => Penal
     [descripcion] => Relacionado con lo penal
     [jefeA] => 1
     [activo] => 0 
     [id] => 1 */
    //?arma el array con nos nonbres de columnas para comparar
    $comparar = array(
      'area' => strtolower($data['area']),
      'descripcion' => strtolower($data['descripcion']),
      'jefeArea' => $data['jefeA'],
      'activo' => $data['activo'],
    );
    $valoresComparados = core::seleccionaUnoParaComparar('areas', $data['id'], $comparar);

    //?armar el string con SQL para editar los campos diferentes.
    $CamposEditar = core::camposEditar($valoresComparados); //devuelve string de los valores a editar para historico y updateSQL

    $sql = "update areas set " . $CamposEditar[0] . "
		where id=" . $data['id'];
    $query = Database::exeDoIt($sql);
    if ($query) { //se ejecuta correctamente el inser, procede a cargar el historico
      core::insertHistorico('Update', $CamposEditar[1], 'Áreas');
    } else {
      print "ERROR en SQL edit area";
    }
  }

}

/*=============================================
ACTIVAR TABLA SEGUN EL POST O GET
=============================================*/
$activar = new ConfigParam();
if (!isset($_REQUEST['modo'])) {
  print "sin acceso";
}

switch ($_REQUEST['modo']) {

  //proveniente
  case 'proveniente':
    if (isset($_REQUEST['edit']) and $_REQUEST['edit'] == 'prov') { //?editar proveniente
      $activar->configEditProv($_REQUEST['data']);
    } else if (isset($_REQUEST['new']) and $_REQUEST['new'] == 'prov') { //? crear nuevo proveniente
      $activar->configNewProv($_REQUEST['data']);
    }
    break;

    //abogado
  case 'abogado':
    if (isset($_REQUEST['edit']) and $_REQUEST['edit'] == 'abog') { //?editar abogado
      $activar->configEditAbogado($_REQUEST['data']);
    } else if (isset($_REQUEST['new']) and $_REQUEST['new'] == 'abog') { //? crear nuevo abogado
      $activar->configNewAbogado($_REQUEST['data']);
      // print_r($_REQUEST['data']); die();
    }
    break;

  //area
  case 'area':
    if (isset($_REQUEST['edit']) and $_REQUEST['edit'] == 'area') { //?editar area
      $activar->configEditArea($_REQUEST['data']);
    }
    break;

  //tipo de archivo TypeFile
  case 'typeFile':
    if (isset($_REQUEST['new']) and $_REQUEST['new'] == 'cat') { //?crear categoria
      $activar->configNewTypeFile($_REQUEST['data']);
    } else if (isset($_REQUEST['new']) and $_REQUEST['new'] == 'etapa1') { //?editar categoria

      $activar->configNewTypeFileEtapaUno($_REQUEST['data']);

    } else if (isset($_REQUEST['new']) and $_REQUEST['new'] == 'etapa2') { //?editar categoria

      $activar->configNewTypeFileEtapaDos($_REQUEST['data']);

    } else if (isset($_REQUEST['edit']) and $_REQUEST['edit'] == 'cat') { //?editar categoria
      //aun no existe categoria //! $activar ->configEditArea($_REQUEST['data']);
    }

    //tipo de archivo TypeFile
    break;

  case 'institucion':
    if (isset($_REQUEST['edit']) and $_REQUEST['edit'] == 'inst') { //?crear categoria
      $activar->configEditInstitucion($_REQUEST['data']);
    } else if (isset($_REQUEST['new']) and $_REQUEST['new'] == 'inst') { //?editar categoria
      $activar->configNewInstitucion($_REQUEST['data']);
    }

    break;
  case 'autoridad':
    if (isset($_REQUEST['edit']) and $_REQUEST['edit'] == 'auto') { //?crear categoria
      $activar->configEditAutoridad($_REQUEST['data']);
    } else if (isset($_REQUEST['new']) and $_REQUEST['new'] == 'auto') { //?editar categoria
      $activar->configNewAutoridad($_REQUEST['data']);
    }
    break;

  default:
    print "sin acceso LLR";
    break;
}