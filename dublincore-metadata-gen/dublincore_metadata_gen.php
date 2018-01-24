<?php


// XXX Eliminar todo contenido malicioso...  strip_tags
// XXX No hay Unicode en PHP 5   Ojo a la función ord() 


$caracteresTransformables = array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ","Ä","Ç","Ë","Ï","Ö","Ü","ä","ç","ë","ï","ö","ü","‘","’","“","”","„","‰","%","$","¥","£","€","#","™","&","<",">","…","÷","÷","×","¿","»","¶","±","«","©","§","¡","®","•","*");
$longitudArray = count($caracteresTransformables);
$output = "";


/*variables generales*/
$endTag = ">";
$vContenidoMetadatos = "";
$vContenidoMicroformatos = "";
$vContenidoRDF = "";
$vExisteContenido = false;

/*variables de formulario*/
$vTitulo = "";
$vUrl = "";
$vDescripcion = "";

$vKeyw1 = "";
$vKeyw2 = "";
$vKeyw3 = "";
$vKeyw4 = "";
$vKeyw5 = "";

$vIdioma = "";
$vAutor1Nombre = "";
$vAutor1url = "";
$vColaborador1Nombre = "";
$vColaborador1url = "";
$vEditor1Nombre = "";
$vEditor1url = "";
$vDerechos1Nombre = "";
$vDerechos1url = "";
$vFechaCreacion = "";

$vCollection = false;//0
$vDataset = false;//1
$vEvent = false;//2
$vImage = false;//3
$vInteractiveResource = false;//4
$vMovingImage = false;//5
$vPhysicalObject = false;//6
$vService = false;//7
$vSoftware = false;//8
$vSound = false;//9
$vStillImage = false;//10
$vText = false;//11

$vRecurso1Nombre = "";
$vRecurso1url = "";
$vRecurso2Nombre = "";
$vRecurso2url = "";


/*Transforma los caracteres no ascii a números de entidades válidos para xml*/
function funcion($contenidoFormulario)
{
	global $output;
	global $caracteresTransformables;
	global $longitudArray;

	$input = $contenidoFormulario;
	$longitudInput = strlen($input);
	$output = "";

	for ( $i = 0; $i < $longitudInput; $i++ )
	{
		$reemplazado = false;

		for ( $j = 0; $j < $longitudArray ; $j++ )
		{
			if ($input[$i] == $caracteresTransformables[$j])
			{
				$output = $output . "&#" . ord($input[$i]) . ";";
				$reemplazado = true;
			}
		}
		if ($reemplazado == false)
		{
			$output = $output . $input[$i];
		}
	}
}

function iniciaVariables()
{
	global $endTag;
	global $vTitulo;
	global $vUrl;
	global $vDescripcion;
	global $vKeyw1;
	global $vKeyw2;
	global $vKeyw3;
	global $vKeyw4;
	global $vKeyw5;
	global $vIdioma;
	global $vAutor1Nombre;
	global $vAutor1url;
	global $vColaborador1Nombre;
	global $vColaborador1url;
	global $vEditor1Nombre;
	global $vEditor1url;
	global $vDerechos1Nombre;
	global $vDerechos1url;
	global $vFechaCreacion;
	global $vCollection;
	global $vDataset;
	global $vEvent;
	global $vImage;
	global $vInteractiveResource;
	global $vMovingImage;
	global $vPhysicalObject;
	global $vService;
	global $vSoftware;
	global $vSound;
	global $vStillImage;
	global $vText;
	global $vRecurso1Nombre;
	global $vRecurso1url;
	global $vRecurso2Nombre;
	global $vRecurso2url;
	global $vContenidoMetadatos;
	global $vContenidoMicroformatos;
	global $vContenidoRDF;

	/*inicializa las variables usadas en el script con los datos rellenados con el usuario*/
	if ( isset($_POST['xhtmlhtml']) && ($_POST['xhtmlhtml'] === "xhtml") )
	{
		$endTag = " />";
	}

	$vTitulo = $_POST['tituloTexto'];
	$vUrl = $_POST['url'];
	$vDescripcion = $_POST['descripcion'];
	$vKeyw1 = $_POST['keyw1'];
	$vKeyw2 = $_POST['keyw2'];
	$vKeyw3 = $_POST['keyw3'];
	$vKeyw4 = $_POST['keyw4'];
	$vKeyw5 = $_POST['keyw5'];

	if ($_POST['idioma'] !== "")
	{
		$vIdioma = $_POST['idioma'];
	}

	$vAutor1Nombre = $_POST['autor1Nombre'];
	$vAutor1url = $_POST['autor1url'];
	$vColaborador1Nombre = $_POST['colaborador1Nombre'];
	$vColaborador1url = $_POST['colaborador1url'];
	$vEditor1Nombre = $_POST['editor1Nombre'];
	$vEditor1url = $_POST['editor1url'];
	$vDerechos1Nombre = $_POST['derechos1Nombre'];
	$vDerechos1url = $_POST['derechos1url'];


	if ($_POST['anioCreacion'] !== "" && $_POST['mesCreacion'] !== "" && $_POST['diaCreacion'] !== "")
	{
		$vFechaCreacion = $_POST['anioCreacion'] . '-' . $_POST['mesCreacion'] . '-' . $_POST['diaCreacion'];
	}

	if ( isset($_POST['tipoRecurso']) )
	{
		$contador = count($_POST['tipoRecurso']);
		for ($i = 0; $i < $contador; $i++)
		{
			$dato = $_POST['tipoRecurso'][$i];
			if ( $dato === "Collection" )
			{
				$vCollection = true;
			} elseif ( $dato === "Dataset" ) {
				$vDataset = true;
			} elseif ( $dato === "Event" ) {
				$vEvent = true;
			} elseif ( $dato === "Image" ) {
				$vImage = true;
			} elseif ( $dato === "InteractiveResource" ) {
				$vInteractiveResource = true;
			} elseif ( $dato === "MovingImage" ) {
				$vMovingImage = true;
			} elseif ( $dato === "PhysicalObject" ) {
				$vPhysicalObject = true;
			} elseif ( $dato === "Service" ) {
				$vService = true;
			} elseif ( $dato === "Software" ) {
				$vSoftware = true;
			} elseif ( $dato === "Sound" ) {
				$vSound = true;
			} elseif ( $dato === "StillImage" ) {
				$vStillImage = true;
			} elseif ( $dato === "Text" ) {
				$vText = true;
			}
		}
	}

	$vRecurso1Nombre = $_POST['recurso1Nombre'];
	$vRecurso1url = $_POST['recurso1url'];
	$vRecurso2Nombre = $_POST['recurso2Nombre'];
	$vRecurso2url = $_POST['recurso2url'];

	/*cajas de resultado*/
	$vContenidoMetadatos = "";
	$vContenidoMicroformatos = "";
	$vContenidoRDF = "";
}


function generaMetadatos()
{
	global $endTag;
	global $vTitulo;
	global $vUrl;
	global $vDescripcion;
	global $vKeyw1;
	global $vKeyw2;
	global $vKeyw3;
	global $vKeyw4;
	global $vKeyw5;
	global $vIdioma;
	global $vAutor1Nombre;
	global $vAutor1url;
	global $vColaborador1Nombre;
	global $vColaborador1url;
	global $vEditor1Nombre;
	global $vEditor1url;
	global $vDerechos1Nombre;
	global $vDerechos1url;
	global $vFechaCreacion;
	global $vCollection;
	global $vDataset;
	global $vEvent;
	global $vImage;
	global $vInteractiveResource;
	global $vMovingImage;
	global $vPhysicalObject;
	global $vService;
	global $vSoftware;
	global $vSound;
	global $vStillImage;
	global $vText;
	global $vRecurso1Nombre;
	global $vRecurso1url;
	global $vRecurso2Nombre;
	global $vRecurso2url;
	global $vContenidoMetadatos;

	/*con los valores obtenidos en iniciaVariables() genera escribe en una variable el contenido de los metadatos generados*/
	$vContenidoMetadatos = $vContenidoMetadatos . '<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/"' . $endTag . "\n" . "\t";

	/*titulo*/
	if ( $vTitulo !== "" )
	{
		$vContenidoMetadatos= $vContenidoMetadatos . '<meta name="DC.title" content="' . $vTitulo . '"' . $endTag . "\n" . "\t";
	}

	/*url*/
	/*comentario: para este dato de momento, interpreto que la url actua como identificador*/
	if ( $vUrl !== "" )
	{
		$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.identifier" content="' . $vUrl . '"' . $endTag . "\n" . "\t";
	}

	/*descripcion*/
	if ( $vDescripcion !== "" )
	{
		$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.description" content="' . $vDescripcion . '"' . $endTag . "\n" . "\t";
	}

	/*keywords*/
	if ( ($vKeyw1 !== "") || ($vKeyw2 !== "") || ($vKeyw3 !== "") || ($vKeyw4 !== "") || ($vKeyw5 !== "") )
	{
		$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.subject" content="';
		if ($vKeyw1 !== "") $vContenidoMetadatos = $vContenidoMetadatos . $vKeyw1;
		if ($vKeyw2 !== "") $vContenidoMetadatos = $vContenidoMetadatos . ', ' . $vKeyw2;
		if ($vKeyw3 !== "") $vContenidoMetadatos = $vContenidoMetadatos . ', ' . $vKeyw3;
		if ($vKeyw4 !== "") $vContenidoMetadatos = $vContenidoMetadatos . ', ' . $vKeyw4;
		if ($vKeyw5 !== "") $vContenidoMetadatos = $vContenidoMetadatos . ', ' . $vKeyw5;
		$vContenidoMetadatos = $vContenidoMetadatos . '"' . $endTag . "\n" . "\t";
	}

	/*idioma*/
	if ($vIdioma !== "")
	{
		$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.language" scheme="ISO639-1" content="' . $vIdioma . '"' . $endTag . "\n" . "\t";
	}

	/*Autor*/
	if ( ($vAutor1Nombre !== "") && ($vAutor1url === "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.creator" content="' . $vAutor1Nombre . '"' . $endTag . "\n" . "\t";}
	if ( ($vAutor1Nombre === "") && ($vAutor1url !== "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.creator" content="' . $vAutor1url . '"' . $endTag . "\n" . "\t";}
	if ( ($vAutor1Nombre !== "") && ($vAutor1url !== "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.creator" content="' . $vAutor1url . '"' . $endTag . "\n" . "\t";}

	/*colaborador*/
	if ( ($vColaborador1Nombre !== "") && ($vColaborador1url === "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.contributor" content="' . $vColaborador1Nombre . '"' . $endTag . "\n" . "\t";}
	if ( ($vColaborador1Nombre === "") && ($vColaborador1url !== "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.contributor" content="' . $vColaborador1url . '"' . $endTag . "\n" . "\t";}
	if ( ($vColaborador1Nombre !== "") && ($vColaborador1url !== "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.contributor" content="' . $vColaborador1url . '"' . $endTag . "\n" . "\t";}

	/*editor*/
	if ( ($vEditor1Nombre !== "") && ($vEditor1url === "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.publisher" content="' . $vEditor1Nombre . '"' . $endTag . "\n" . "\t";}
	if ( ($vEditor1Nombre === "") && ($vEditor1url !== "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.publisher" content="' . $vEditor1url . '"' . $endTag . "\n" . "\t";}
	if ( ($vEditor1Nombre !== "") && ($vEditor1url !== "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.publisher" content="' . $vEditor1url . '"' . $endTag . "\n" . "\t";}

	/*licencia*/
	if ( ($vDerechos1Nombre !== "") && ($vDerechos1url === "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.license" content="' . $vDerechos1Nombre . '"' . $endTag . "\n" . "\t";}
	if ( ($vDerechos1Nombre === "") && ($vDerechos1url !== "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.license" content="' . $vDerechos1url . '"' . $endTag . "\n" . "\t";}
	if ( ($vDerechos1Nombre !== "") && ($vDerechos1url !== "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.license" content="' . $vDerechos1url . '"' . $endTag . "\n" . "\t";}

	/*type y DCMI Type Vocabulary [DCMITYPE] */
	if ($vCollection) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.type" scheme="DCMITYPE" content="' . 'http://purl.org/dc/dcmitype/Collection' . '"' . $endTag . "\n" . "\t";}
	if ($vDataset) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.type" scheme="DCMITYPE" content="' . 'http://purl.org/dc/dcmitype/Dataset' . '"' . $endTag . "\n" . "\t";}
	if ($vEvent) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.type" scheme="DCMITYPE" content="' . 'http://purl.org/dc/dcmitype/Event' . '"' . $endTag . "\n" . "\t";}
	if ($vImage) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.type" scheme="DCMITYPE" content="' . 'http://purl.org/dc/dcmitype/Image' . '"' . $endTag . "\n" . "\t";}
	if ($vInteractiveResource) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.type" scheme="DCMITYPE" content="' . 'http://purl.org/dc/dcmitype/InteractiveResource' . '"' . $endTag . "\n" . "\t";}
	if ($vMovingImage) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.type" scheme="DCMITYPE" content="' . 'http://purl.org/dc/dcmitype/MovingImage' . '"' . $endTag . "\n" . "\t";}
	if ($vPhysicalObject) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.type" scheme="DCMITYPE" content="' . 'http://purl.org/dc/dcmitype/PhysicalObject' . '"' . $endTag . "\n" . "\t";}
	if ($vService) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.type" scheme="DCMITYPE" content="' . 'http://purl.org/dc/dcmitype/Service' . '"' . $endTag . "\n" . "\t";}
	if ($vSoftware) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.type" scheme="DCMITYPE" content="' . 'http://purl.org/dc/dcmitype/Software' . '"' . $endTag . "\n" . "\t";}
	if ($vSound) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.type" scheme="DCMITYPE" content="' . 'http://purl.org/dc/dcmitype/Sound' . '"' . $endTag . "\n" . "\t";}
	if ($vStillImage) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.type" scheme="DCMITYPE" content="' . 'http://purl.org/dc/dcmitype/StillImage' . '"' . $endTag . "\n" . "\t";}
	if ($vText) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.type" scheme="DCMITYPE" content="' . 'http://purl.org/dc/dcmitype/Text' . '"' . $endTag . "\n" . "\t";}

	/*relacionado1*/
	if ( ($vRecurso1Nombre !== "") && ($vRecurso1url === "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.relation" content="' . $vRecurso1Nombre . '"' . $endTag . "\n" . "\t";}
	if ( ($vRecurso1Nombre === "") && ($vRecurso1url !== "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.relation" content="' . $vRecurso1url . '"' . $endTag . "\n" . "\t";}
	if ( ($vRecurso1Nombre !== "") && ($vRecurso1url !== "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.relation" content="' . $vRecurso1url . '"' . $endTag . "\n" . "\t";}

	/*relacionado2*/
	if ( ($vRecurso2Nombre !== "") && ($vRecurso2url === "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.relation" content="' . $vRecurso2Nombre . '"' . $endTag . "\n" . "\t";}
	if ( ($vRecurso2Nombre === "") && ($vRecurso2url !== "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.relation" content="' . $vRecurso2url . '"' . $endTag . "\n" . "\t";}
	if ( ($vRecurso2Nombre !== "") && ($vRecurso2url !== "") ) {$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DC.relation" content="' . $vRecurso2url . '"' . $endTag . "\n" . "\t";}

	/*fecha creacion*/
	if ($vFechaCreacion !== "")
	{	$vContenidoMetadatos = $vContenidoMetadatos . '<link rel="schema.DCTERMS" href="http://purl.org/dc/terms/" />' . "\n" . "\t";
		$vContenidoMetadatos = $vContenidoMetadatos . '<meta name="DCTERMS.created" scheme="ISO8601" content="' . $vFechaCreacion . '"' . $endTag . "\n" . "\t";
	}
}


function generaMicroformatos()
{
	global $endTag;
	global $vTitulo;
	global $vUrl;
	global $vDescripcion;
	global $vKeyw1;
	global $vKeyw2;
	global $vKeyw3;
	global $vKeyw4;
	global $vKeyw5;
	global $vIdioma;
	global $vAutor1Nombre;
	global $vAutor1url;
	global $vColaborador1Nombre;
	global $vColaborador1url;
	global $vEditor1Nombre;
	global $vEditor1url;
	global $vDerechos1Nombre;
	global $vDerechos1url;
	global $vFechaCreacion;
	global $vCollection;
	global $vDataset;
	global $vEvent;
	global $vImage;
	global $vInteractiveResource;
	global $vMovingImage;
	global $vPhysicalObject;
	global $vService;
	global $vSoftware;
	global $vSound;
	global $vStillImage;
	global $vText;
	global $vRecurso1Nombre;
	global $vRecurso1url;
	global $vRecurso2Nombre;
	global $vRecurso2url;
	global $vContenidoMicroformatos;

	/*con los valores obtenidos en iniciaVariables() genera escribe en una variable el contenido de los microformatos generados*/
	$vContenidoMicroformatos = "";
	//$vContenidoMicroformatos = $vContenidoMicroformatos . '<div class="dublincore">' . "\n"
	$vContenidoMicroformatos = $vContenidoMicroformatos . '<dl class="dublincore">' . "\n";

	/*titulo*/
	if ($vTitulo !== "")
	{
		$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Título:</dt><dd class="title">' . $vTitulo . '</dd>' . "\n";
	}

	/*url -> identificador*/
	if ($vUrl !== "")
	{
		$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Dirección:</dt><dd><a href="' . $vUrl . '" class="identifier">' . $vUrl . '</a></dd>' . "\n";
	}

	/*descripcion*/
	if ($vDescripcion !== "")
	{
		$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Descripción:</dt><dd class="description">' . $vDescripcion . '</dd>' . "\n";
	}

	/*keywords*/
	if ( ($vKeyw1 !== "") || ($vKeyw2 !== "") || ($vKeyw3 !== "") || ($vKeyw4 !== "") || ($vKeyw5 !== "") )
	{
		$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Palabras clave:</dt><dd class="subject">';
		if ($vKeyw1 !== "") $vContenidoMicroformatos = $vContenidoMicroformatos . $vKeyw1;
		if ($vKeyw2 !== "") $vContenidoMicroformatos = $vContenidoMicroformatos . ', ' . $vKeyw2;
		if ($vKeyw3 !== "") $vContenidoMicroformatos = $vContenidoMicroformatos . ', ' . $vKeyw3;
		if ($vKeyw4 !== "") $vContenidoMicroformatos = $vContenidoMicroformatos . ', ' . $vKeyw4;
		if ($vKeyw5 !== "") $vContenidoMicroformatos = $vContenidoMicroformatos . ', ' . $vKeyw5;
		$vContenidoMicroformatos = $vContenidoMicroformatos . '</dd>' . "\n";
	}

	/*idioma*/
	if ($vIdioma !== "")
	{
		$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Código de idioma:</dt><dd class="language">' . $vIdioma . '</dd>' . "\n";
	}

	/*Autor*/
	if ( ($vAutor1Nombre !== "") && ($vAutor1url === "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Autor/a:</dt><dd class="creator">' . $vAutor1Nombre . '</dd>' . "\n";}
	if ( ($vAutor1Nombre === "") && ($vAutor1url !== "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Autor/a:</dt><dd><a href="' . $vAutor1url . '" class="creator">' . $vAutor1url . '</a></dd>' . "\n";}
	if ( ($vAutor1Nombre !== "") && ($vAutor1url !== "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Autor/a:</dt><dd><a href="' . $vAutor1url . '" class="creator">' . $vAutor1Nombre . '</a></dd>' . "\n";}

	/*colaborador*/
	if ( ($vColaborador1Nombre !== "") && ($vColaborador1url === "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Colaborador/a:</dt><dd class="contributor">' . $vColaborador1Nombre . '</dd>' . "\n";}
	if ( ($vColaborador1Nombre === "") && ($vColaborador1url !== "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Colaborador/a:</dt><dd><a href="' . $vColaborador1url . '" class="contributor">' . $vColaborador1url . '</a></dd>' . "\n";}
	if ( ($vColaborador1Nombre !== "") && ($vColaborador1url !== "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Colaborador/a:</dt><dd><a href="' . $vColaborador1url . '" class="contributor">' . $vColaborador1Nombre . '</a></dd>' . "\n";}

	/*editor*/
	if ( ($vEditor1Nombre !== "") && ($vEditor1url === "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Editor/a:</dt><dd class="publisher">' . $vEditor1Nombre . '</dd>' . "\n";}
	if ( ($vEditor1Nombre === "") && ($vEditor1url !== "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Editor/a:</dt><dd><a href="' . $vEditor1url . '" class="publisher">' . $vEditor1url . '</a></dd>' . "\n";}
	if ( ($vEditor1Nombre !== "") && ($vEditor1url !== "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Editor/a:</dt><dd><a href="' . $vEditor1url . '" class="publisher">' . $vEditor1Nombre . '</a></dd>' . "\n";}

	/*licencia*/
	if ( ($vDerechos1Nombre !== "") && ($vDerechos1url === "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Derechos:</dt><dd class="license">' . $vDerechos1Nombre . '</dd>' . "\n";}
	if ( ($vDerechos1Nombre === "") && ($vDerechos1url !== "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Derechos:</dt><dd><a href="' . $vDerechos1url . '" class="license">' . $vDerechos1url . '</a></dd>' . "\n";}
	if ( ($vDerechos1Nombre !== "") && ($vDerechos1url !== "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Derechos:</dt><dd><a href="' . $vDerechos1url . '" class="license">' . $vDerechos1Nombre . '</a></dd>' . "\n";}

	/*fecha creacion*/
	if ($vFechaCreacion !== "") {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Fecha de creación:</dt><dd class="created">' . $vFechaCreacion . '</dd>' . "\n";}

	/*relacionado1*/
	if ( ($vRecurso1Nombre !== "") && ($vRecurso1url === "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Recurso relacionado:</dt><dd class="relation">' . $vRecurso1Nombre . '</dd>' . "\n";}
	if ( ($vRecurso1Nombre === "") && ($vRecurso1url !== "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Recurso relacionado:</dt><dd><a href="' . $vRecurso1url . '" class="relation">' . $vRecurso1url . '</a></dd>' . "\n";}
	if ( ($vRecurso1Nombre !== "") && ($vRecurso1url !== "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Recurso relacionado:</dt><dd><a href="' . $vRecurso1url . '" class="relation">' . $vRecurso1Nombre . '</a></dd>' . "\n";}

	/*relacionado2*/
	if ( ($vRecurso2Nombre !== "") && ($vRecurso2url === "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Recurso relacionado:</dt><dd class="relation">' . $vRecurso2Nombre . '</dd>' . "\n";}
	if ( ($vRecurso2Nombre === "") && ($vRecurso2url !== "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Recurso relacionado:</dt><dd><a href="' . $vRecurso2url . '" class="relation">' . $vRecurso2url . '</a></dd>' . "\n";}
	if ( ($vRecurso2Nombre !== "") && ($vRecurso2url !== "") ) {$vContenidoMicroformatos = $vContenidoMicroformatos . "\t" . '<dt>Recurso relacionado:</dt><dd><a href="' . $vRecurso2url . '" class="relation">' . $vRecurso2Nombre . '</a></dd>' . "\n";}

	$vContenidoMicroformatos = $vContenidoMicroformatos . '</dl>';
	//$vContenidoMicroformatos = $vContenidoMicroformatos . "\n" . '</div>'
}


function generaRDF()
{
	global $endTag;
	global $vTitulo;
	global $vUrl;
	global $vDescripcion;
	global $vKeyw1;
	global $vKeyw2;
	global $vKeyw3;
	global $vKeyw4;
	global $vKeyw5;
	global $vIdioma;
	global $vAutor1Nombre;
	global $vAutor1url;
	global $vColaborador1Nombre;
	global $vColaborador1url;
	global $vEditor1Nombre;
	global $vEditor1url;
	global $vDerechos1Nombre;
	global $vDerechos1url;
	global $vFechaCreacion;
	global $vCollection;
	global $vDataset;
	global $vEvent;
	global $vImage;
	global $vInteractiveResource;
	global $vMovingImage;
	global $vPhysicalObject;
	global $vService;
	global $vSoftware;
	global $vSound;
	global $vStillImage;
	global $vText;
	global $vRecurso1Nombre;
	global $vRecurso1url;
	global $vRecurso2Nombre;
	global $vRecurso2url;
	global $vContenidoRDF;
	global $output;

	/*con los valores obtenidos en iniciaVariables() genera escribe en una variable el contenido del fichero RDF generado*/
	$vContenidoRDF = "";
	$vContenidoRDF='<?xml version="1.0" encoding="utf-8"?>'
	 . "\n" . 
	'<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"'
	 . "\n" . "\t" . 
	'xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"'
	 . "\n" . "\t" . 
	'xmlns:dc="http://purl.org/dc/elements/1.1/"';

	if ($vFechaCreacion !== "")
	{
		$vContenidoRDF = $vContenidoRDF . "\n" . "\t" . 'xmlns:dcterms="http://purl.org/dc/terms/"';
	}

	if ($vCollection || $vDataset || $vEvent || $vImage || $vInteractiveResource || 
		 $vMovingImage || $vPhysicalObject || $vService || $vSoftware || $vSound ||
		 $vStillImage || $vText)
	{
		$vContenidoRDF = $vContenidoRDF . "\n" . "\t" . 'xmlns:dcmitype="http://purl.org/dc/dcmitype/"';
	}

	$vContenidoRDF = $vContenidoRDF . "\n" . "\t" . 'xmlns:admin="http://webns.net/mvcb/"';
	$vContenidoRDF = $vContenidoRDF . '>' . "\n" . "\n";

	/*url*/
	if ($vUrl === "")
	{
		$vContenidoRDF = $vContenidoRDF . '<rdf:Description>';
	} else {
		$vContenidoRDF = $vContenidoRDF . '<rdf:Description rdf:about="' . $vUrl . '">';
	}

	/*titulo*/
	funcion($vTitulo);
	if ($output !== "") { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:title>' . $output . '</dc:title>'; }

	/*descripcion*/
	funcion($vDescripcion);
	if ($output !== "") { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:description>' . $output . '</dc:description>'; }

	/*Palabras clave*/
	if ($vKeyw1 !== "" || $vKeyw2 !== "" || $vKeyw3 !== "" || $vKeyw4 !== "" || $vKeyw5 !== "")
	{
		$vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:subject>';
		$vContenidoRDF = $vContenidoRDF . "\n" . "\t" . "\t" . '<rdf:Bag>';

		funcion($vKeyw1);
		if ($output !== "")
		{
			$vContenidoRDF = $vContenidoRDF . "\n" . "\t" . "\t" . "\t" . '<rdf:li>' . $output . '</rdf:li>';
		}
		funcion($vKeyw2);
		if ($output !== "")
		{
			$vContenidoRDF = $vContenidoRDF . "\n" . "\t" . "\t" . "\t" . '<rdf:li>' . $output . '</rdf:li>';
		}
		funcion($vKeyw3);
		if ($output !== "")
		{
			$vContenidoRDF = $vContenidoRDF . "\n" . "\t" . "\t" . "\t" . '<rdf:li>' . $output . '</rdf:li>';
		}
		funcion($vKeyw4);
		if ($output !== "")
		{
			$vContenidoRDF = $vContenidoRDF . "\n" . "\t" . "\t" . "\t" . '<rdf:li>' . $output . '</rdf:li>';
		}
		funcion($vKeyw5);
		if ($output !== "")
		{
			$vContenidoRDF = $vContenidoRDF . "\n" . "\t" . "\t" . "\t" . '<rdf:li>' . $output . '</rdf:li>';
		}
		$vContenidoRDF = $vContenidoRDF . "\n" . "\t" . "\t" . '</rdf:Bag>';
		$vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '</dc:subject>';
	}

	/*idioma*/
	funcion($vIdioma);
	if ($output !== "") { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:language>' . $output . '</dc:language>'; }

	/*autor*/
	funcion($vAutor1Nombre);
	if ( ($output !== "") && ($vAutor1url === "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:creator rdfs:Literal="' . $output . '" />'; }
	if ( ($output === "") && ($vAutor1url !== "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:creator dc:source="' . $vAutor1url . '" />'; }
	if ( ($output !== "") && ($vAutor1url !== "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:creator dc:source="' . $vAutor1url . '" rdfs:Literal="' . $output . '" />'; }

	/*colaborador*/
	funcion($vColaborador1Nombre);
	if ( ($output !== "") && ($vColaborador1url === "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:contributor rdfs:Literal="' . $output . '" />'; }
	if ( ($output === "") && ($vColaborador1url !== "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:contributor dc:source="' . $vColaborador1url . '" />'; }
	if ( ($output !== "") && ($vColaborador1url !== "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:contributor dc:source="' . $vColaborador1url . '" rdfs:Literal="' . $output . '" />'; }

	/*Editor*/
	funcion($vEditor1Nombre);
	if ( ($output !== "") && ($vEditor1url === "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:publisher rdfs:Literal="' . $output . '" />'; }
	if ( ($output === "") && ($vEditor1url !== "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:publisher dc:source="' . $vEditor1url . '" />'; }
	if ( ($output !== "") && ($vEditor1url !== "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:publisher dc:source="' . $vEditor1url . '" rdfs:Literal="' . $output . '" />'; }

	/*licencia*/
	funcion($vDerechos1Nombre);
	if ( ($output !== "") && ($vEditor1url === "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:license rdfs:Literal="' . $output . '" />'; }
	if ( ($output === "") && ($vEditor1url !== "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:license dc:source="' . $vDerechos1url . '" />'; }
	if ( ($output !== "") && ($vEditor1url !== "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:license dc:source="' . $vDerechos1url . '" rdfs:Literal="' . $output . '" />'; }

	/*fecha*/
	if($vFechaCreacion !== "") { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dcterms:Created><dcterms:W3CDTF><rdf:value>' . $vFechaCreacion . '</rdf:value></dcterms:W3CDTF></dcterms:Created>'; }

	/*type*/
	if ($vCollection) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:type rdfs:value="http://purl.org/dc/dcmitype/Collection" />'; }
	if ($vDataset) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:type rdfs:value="http://purl.org/dc/dcmitype/Dataset" />'; }
	if ($vEvent) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:type rdfs:value="http://purl.org/dc/dcmitype/Event" />'; }
	if ($vImage) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:type rdfs:value="http://purl.org/dc/dcmitype/Image" />'; }
	if ($vInteractiveResource) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:type rdfs:value="http://purl.org/dc/dcmitype/InteractiveResource" />'; }
	if ($vMovingImage) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:type rdfs:value="http://purl.org/dc/dcmitype/MovingImage" />'; }
	if ($vPhysicalObject) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:type rdfs:value="http://purl.org/dc/dcmitype/PhysicalObject" />'; }
	if ($vService) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:type rdfs:value="http://purl.org/dc/dcmitype/Service" />'; }
	if ($vSoftware) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:type rdfs:value="http://purl.org/dc/dcmitype/Software" />'; }
	if ($vSound) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:type rdfs:value="http://purl.org/dc/dcmitype/Sound" />'; }
	if ($vStillImage) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:type rdfs:value="http://purl.org/dc/dcmitype/StillImage"/>'; }
	if ($vText) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:type rdfs:value="http://purl.org/dc/dcmitype/Text" />'; }

	/*RelacionadoCon1*/
	funcion($vRecurso1Nombre);
	if ( ($output !== "") && ($vRecurso1url === "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:relation rdfs:Literal="' . $output . '" />'; }
	if ( ($output === "") && ($vRecurso1url !== "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:relation dc:source="' . $vRecurso1url . '" />'; }
	if ( ($output !== "") && ($vRecurso1url !== "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:relation dc:source="' . $vRecurso1url . '" rdfs:Literal="' . $output . '" />'; }

	/*RelacionadoCon2*/
	funcion($vRecurso2Nombre);
	if ( ($output !== "") && ($vRecurso1url === "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:relation rdfs:Literal="' . $output . '" />'; }
	if ( ($output === "") && ($vRecurso1url !== "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:relation dc:source="' . $vRecurso2url . '" />'; }
	if ( ($output !== "") && ($vRecurso1url !== "") ) { $vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<dc:relation dc:source="' . $vRecurso2url . '" rdfs:Literal="' . $output . '" />'; }

	$vContenidoRDF = $vContenidoRDF . "\n" . "\t" . '<admin:generatorAgent rdf:resource="http://www.webposible.com/utilidades/dublincore-metadata-gen/" />';
	$vContenidoRDF = $vContenidoRDF . "\n" . '</rdf:Description>';
	$vContenidoRDF = $vContenidoRDF . "\n" . '</rdf:RDF>';
}

/* Comprobar si llegan datos y en caso contrario terminar. */
if ( isset($_POST['generate']) )
{
	iniciaVariables();
	generaMetadatos();
	generaMicroformatos();
	generaRDF();
}

?>
