<?php

require('dublincore_metadata_gen.php');

function getBrowserLanguages() 
{
	$langlist = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
	$langs = array();

	foreach($langlist as $lang) {
		$lang = explode(';', $lang);
		$lang = substr($lang[0], 0, 2);
		if ($langs[$lang] == FALSE) { $langs[$lang] = $lang; }
	}
	return $langs;
}

function decidirLenguaje($lenguajes, $navegador, $lang = "es")
{
	foreach($navegador as $lengua)
		if ($lenguajes[$lengua])
			return $lengua;

	return $lang;
}

$lenguajeForzado = $_GET["lang"];

isset($lenguajeForzado)
?	$lenguaje = decidirLenguaje( array("es" => "es", "en" => "en", "ca" => "ca"),
										  array($lenguajeForzado) )
										  
:	$lenguaje = decidirLenguaje( array("es" => "es", "en" => "en", "ca" => "ca"),
										  getBrowserLanguages() );

require ("textos_" . $lenguaje . ".inc");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lenguaje ?>" dir="ltr" lang="<?php echo $lenguaje ?>">

<head>
	<title xml:lang="en" lang="en">Dublin Core Metadata Gen</title>

	<link rel="stylesheet" type="text/css" href="ficheros/css.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	
	<link rel="meta" type="application/rdf+xml" href="http://www.webposible.com/utilidades/dublincore-metadata-gen/dublincore-metadata-gen.rdf" />

	<link rel="meta" title="DOAP" type="application/rdf+xml" href="http://www.webposible.com/utilidades/dublincore-metadata-gen/doap.rdf" />

<?php
	if ($lenguaje === "es" || $lenguaje === "en")
	{
?>
	<link rel="alternate" hreflang="ca" href="index.php?lang=ca" />
<?php
	}
?>

<?php
	if ($lenguaje === "es" || $lenguaje === "ca")
	{
?>
	<link rel="alternate" hreflang="en" href="index.php?lang=en" />
<?php
	}
?>

<?php
	if ($lenguaje === "ca" || $lenguaje === "en")
	{
?>
	<link rel="alternate" hreflang="es" href="index.php?lang=es" />
<?php
	}
?>

	<link rel="author" href="http://www.webposible.com/autor.html" />
	<link rel="section" href="http://www.webposible.com/utilidades/" />
	<link rel="index" href="http://www.webposible.com/" />

<!--dublincore:DC-->	
	<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />
	<meta name="DC.title" content="Dublin Core Metadata Gen: <?php echo $lang_dc_title ?>" />

	<meta name="DC.identifier" content="http://www.webposible.com/utilidades/dublincore-metadata-gen/" />
	<meta name="DC.description" content="<?php echo $lang_dc_description ?>" />
	<meta name="DC.subject" content="<?php echo $lang_dc_subject ?>" />
	<meta name="DC.creator" content="http://www.webposible.com/autor.html" />
	<meta name="DC.contributor" content="http://css.artnau.com/" />
	<meta name="DC.contributor" content="Fernando Taboada" />
	<meta name="DC.publisher" content="http://www.webposible.com/autor.html" />
	<meta name="DC.license" content="http://www.gnu.org/copyleft/gpl.html" />
	<meta name="DC.type" scheme="DCMITYPE" content="http://purl.org/dc/dcmitype/Dataset" />
	<meta name="DC.type" scheme="DCMITYPE" content="http://purl.org/dc/dcmitype/Software" />
	<meta name="DC.type" scheme="DCMITYPE" content="http://purl.org/dc/dcmitype/Text" />
	<meta name="DC.relation" content="http://www.webposible.com/utilidades/generador_rdf_foto.html" />
	<meta name="DC.relation" content="http://microformats.org/code/hcard/creator" />
	<meta name="DC.identifier" content="http://www.webposible.com/utilidades/dublincore-metadata-gen/" />
	<meta name="DC.language" scheme="ISO639-1" content="<?php echo $lenguaje ?>" />

	<!--dublincore:DCTERMS-->	
	<link rel="schema.DCTERMS" href="http://purl.org/dc/terms/" />
	<meta name="DCTERMS.created" scheme="ISO8601" content="2005-11-22" />
	<meta name="DCTERMS.modified" scheme="ISO8601" content="2008-01-22" />

	<meta name="DCTERMS.conformsTo" content="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
	<meta name="DCTERMS.isPartOf" content="http://www.webposible.com/" />
	<meta name="DCTERMS.isPartOf" content="http://www.webposible.com/utilidades/" />
	<meta name="DCTERMS.license" content="http://www.gnu.org/copyleft/gpl.html" />
	<meta name="DCTERMS.rightsHolder" content="http://www.webposible.com/autor.html" />
	<script src="http://www.google-analytics.com/ga.js" type="text/javascript"></script>
	<script type="text/javascript">
	try{
	var pageTracker = _gat._getTracker("UA-1083995-1");
	pageTracker._trackPageview();
	} catch(err) {}
	</script>
</head>
<body xml:lang="<?php echo $lenguaje ?>" lang="<?php echo $lenguaje ?>">
<div id="logo">

<a href="http://www.webposible.com/index.html"><img src="../../imagenes/webposible.png" alt="webposible" title="<?php echo $lang_titulo ?>" longdesc="http://www.webposible.org/logotipo-webposible.html#descripcion-logo" height="74" width="120" /></a>

<img src="../../imagenes/cab-subopcion.png" alt="<?php echo $lang_subopcion ?>" height="74" width="31" />

<!-- <a href="http://www.webposible.com/microformatos-dublincore/index.html"><img src="../../imagenes/cab-microformatos-dublin-core.png" alt="<?php echo $lang_alt_dublincore ?>"  width="68" height="74" /></a>

<img src="../../imagenes/cab-subopcion.png" alt="<?php echo $lang_subopcion ?>" height="74" width="31" />

<img src="../../imagenes/cab-dublin-core-metadata-gen.png" alt="Dublin Core Metadata Gen" height="74" width="200" /> -->
<img src="../../imagenes/logo-dcmg.png" alt="Dublin Core Metadata Gen" width="600" height="54" border="0" />

</div>

<h1 id="dmg"><span xml:lang="en" lang="en">Dublin Core Metadata</span> <abbr title="<?php echo $lang_abbr_gen ?>" xml:lang="<?php echo $lenguaje ?>" lang="<?php echo $lenguaje ?>">Gen</abbr>: <?php echo $lang_generador_meta ?> <span xml:lang="en" lang="en">Dublin Core</span></h1>

<h2 id="quees"><?php echo $lang_quees ?> <span xml:lang="en" lang="en">Dublin Core Metadata</span> <abbr title="<?php echo $lang_abbr_gen ?>" xml:lang="<?php echo $lenguaje ?>" lang="<?php echo $lenguaje ?>">Gen</abbr>?</h2>

<p><?php echo $lang_app1 ?> <acronym title="eXtensible HyperText Markup Language" xml:lang="en" lang="en">XHTML</acronym>, <?php echo $lang_app2 ?> <span xml:lang="en" lang="en">Dublin Core</span>:</p>

<ul>
	<li><?php echo $lang_lang1 ?> <acronym title="HyperText Markup Language" xml:lang="en" lang="en">HTML</acronym> <?php echo $lang_lang2 ?> <acronym title="eXtensible HyperText Markup Language" xml:lang="en" lang="en">XHTML</acronym> <?php echo ($lenguaje === "en")?$lang_lang1_1:"" ?>.</li>
	<li><a href="http://www.webposible.com/microformatos-dublincore/index.html"><?php echo $lang_lang3 ?> <span xml:lang="en" lang="en">Dublin Core</span></a><?php echo $lang_lang5 ?><a href="../../microformatos-dublincore/microformats_dublin-core.html"><?php echo $lang_lang6 ?></a><?php echo $lang_lang7 ?><a href="../../microformatos-dublincore/index.html" hreflang="es" title="link to documentation in spanish"><?php echo $lang_lang8 ?></a>.</li>
	<li><?php echo $lang_lang4 ?> <acronym title="Resource Description Framework" xml:lang="en" lang="en">RDF</acronym><?php echo $lang_lang4_1 ?>.</li>


</ul>
<p xml:lang="en"><strong>Get the source code</strong> at <a href="http://code.google.com/p/dublincoremetadatagen/">dublincoremetadatagen</a>, in Google Code.</p>
<p><?php echo $lang_intro1 ?> <a href="#formulario" accesskey="0"><?php echo $lang_intro2 ?></a>. <?php echo $lang_intro3 ?>
<?php if ($lenguaje === "es")
{
?>
 <a href="index.php?lang=ca" hreflang="ca" title="Dublin Core Metadata Gen <?php echo $lang_en_catalan ?>"><?php echo $lang_intro4 ?></a> (<?php echo $lang_intro5 ?> <a href="http://css.artnau.com/" class="contributor" xml:lang="ca" lang="ca">Arnau Siches</a>) <?php echo $lang_intro6 ?> <a href="index.php?lang=en" title="Dublin Core Metadata Gen <?php echo $lang_en_ingles ?>" hreflang="en"><?php echo $lang_intro7 ?></a>.
<?php
} elseif ($lenguaje === "ca")
{
?>
 <a href="index.php?lang=es" hreflang="es" title="Dublin Core Metadata Gen <?php echo $lang_en_catalan ?>"><?php echo $lang_en_catalan ?></a> i <a href="index.php?lang=en" title="Dublin Core Metadata Gen <?php echo $lang_en_ingles ?>" hreflang="en"><?php echo $lang_en_ingles ?></a>.
<?php
} elseif ($lenguaje === "en")
{
?>
 <a href="index.php?lang=ca" hreflang="ca" title="Dublin Core Metadata Gen <?php echo $lang_en_catalan ?>"><?php echo $lang_intro4 ?></a> (<?php echo $lang_intro5 ?> <a href="http://css.artnau.com/" class="contributor" xml:lang="ca" lang="ca">Arnau Siches</a>) <?php echo $lang_intro6 ?> <a href="index.php?lang=es" title="Dublin Core Metadata Gen <?php echo $lang_en_ingles ?>" hreflang="es"><?php echo $lang_intro7 ?></a>.
<?php
}
?>
</p>
<h3 id="observaciones"><?php echo $lang_observ ?></h3> 

<ul>
	<li><?php echo $lang_ob1 ?> <a href="http://dublincore.org/documents/dcmi-terms/" xml:lang="en" hreflang="en" lang="en"><acronym title="Dublin Core Metadata Initiative" xml:lang="en" lang="en">DCMI</acronym> Metadata Terms</a> (<?php echo $lang_ob2 ?>, <a href="http://dublincore.org/documents/dcmi-terms/#H2" xml:lang="en" hreflang="en" lang="en">The Dublin Core Metadata Element Set</a> <?php echo $lang_ob3 ?>, <a href="http://dublincore.org/documents/dcmi-terms/#H3" xml:lang="en" hreflang="en" lang="en">Other Elements and Element Refinements</a> <?php echo $lang_ob4 ?>, <a href="http://dublincore.org/documents/dcmi-terms/#H4" xml:lang="en" hreflang="en" lang="en">Encoding Schemes</a> <?php echo $lang_ob5 ?> <a href="http://dublincore.org/documents/dcmi-terms/#H5" xml:lang="en" hreflang="en" lang="en">The DCMI Type Vocabulary</a> <?php echo $lang_ob6 ?> <a href="http://dublincore.org/documents/dcmi-terms/#H2" xml:lang="en" hreflang="en" lang="en">The Dublin Core Metadata Element Set</a>. <?php echo $lang_ob7 ?>: <span xml:lang="en" lang="en">coverage, format</span> <?php echo $lang_micro3 ?> <span xml:lang="en" lang="en">source</span>.</li>

	<li><?php echo $lang_ob8 ?> <a href="http://dublincore.org/documents/dcmi-terms/#date" xml:lang="en" hreflang="en" lang="en">date</a> <?php echo $lang_ob9 ?> (<a href="http://dublincore.org/documents/dcmi-terms/#available" xml:lang="en" hreflang="en" lang="en">available</a>, <a href="http://dublincore.org/documents/dcmi-terms/#created" xml:lang="en" hreflang="en" lang="en">created</a>, <a href="http://dublincore.org/documents/dcmi-terms/#dateAccepted" xml:lang="en" hreflang="en" lang="en">dateAccepted</a>, <a href="http://dublincore.org/documents/dcmi-terms/#dateCopyrighted" xml:lang="en" hreflang="en" lang="en">dateCopyrighted</a>, <a href="http://dublincore.org/documents/dcmi-terms/#dateSubmitted" xml:lang="en" hreflang="en" lang="en">dateSubmitted</a>, <a href="http://dublincore.org/documents/dcmi-terms/#issued" xml:lang="en" hreflang="en" lang="en">issued</a>, <a href="http://dublincore.org/documents/dcmi-terms/#modified" xml:lang="en" hreflang="en" lang="en">modified</a> <?php echo $lang_micro3 ?> <a href="http://dublincore.org/documents/dcmi-terms/#valid" xml:lang="en" hreflang="en" lang="en">valid</a>) <?php echo $lang_ob10 ?> <strong xml:lang="en" lang="en">created</strong> <?php echo $lang_ob11 ?>.</li>

</ul>

<form id="rbb" name="rbb" action="index.php<?php echo isset($lenguajeForzado)?"?lang=$lenguajeForzado":"" ?>#resultados-metadatos" method="post">
<input name="generate" id="generate" value="true" type="hidden" />

<h2 id="formulario"><?php echo $lang_form ?></h2>
<p><?php echo $lang_fp1 ?> <acronym title="eXtensible HyperText Markup Language" xml:lang="en" lang="en">XHTML</acronym> <?php echo $lang_lang2 ?> <acronym title="HyperText Markup Language" xml:lang="en" lang="en">HTML</acronym>? <?php echo $lang_fp2 ?> <acronym title="Resource Description Framework" xml:lang="en" lang="en">RDF</acronym>. <?php echo $lang_fp3 ?> <span xml:lang="en" lang="en">Dublin Core</span> <?php echo $lang_fp4 ?>.</p>

<ul id="xhtml-or-html">
	<li><label for="usoHTML"> <input name="xhtmlhtml" id="usoHTML" value="html" checked="checked" type="radio" /><acronym title="HyperText Markup Language" xml:lang="en" lang="en">HTML</acronym></label></li>
	<li><label for="usoXHTML"> <input name="xhtmlhtml" id="usoXHTML" value="xhtml" type="radio" /><acronym title="eXtensible HyperText Markup Language" xml:lang="en" lang="en">XHTML</acronym></label></li>
</ul>

<fieldset id="datosDescriptivosRecurso">

	 <legend><?php echo $lang_desc1 ?></legend>

<dl>

<dt><label for="tituloTexto"><strong><?php echo $lang_desc2 ?></strong>:</label></dt>
<dd><input id="tituloTexto" name="tituloTexto" size="60" title="<?php echo $lang_desc2 ?>" type="text" /></dd>

<dt><label for="url"><strong><acronym title="Uniform Resource Locator" xml:lang="en" lang="en">URL</acronym></strong>:</label></dt>
<dd><input id="url" name="url" size="60" title="URL" type="text" /></dd>

<dt><label for="descripcion"><strong><?php echo $lang_desc3 ?></strong>:</label></dt>

<dd><textarea cols="60" rows="6" id="descripcion" name="descripcion" title="<?php echo $lang_desc3 ?>"></textarea><p><?php echo $lang_desc4 ?> <acronym title="Resource Description Framework" xml:lang="en" lang="en">RDF</acronym> <?php echo $lang_desc5 ?>).</p></dd>

<dt><strong><?php echo $lang_key1 ?></strong>:</dt>
<dd>
	<ul id="palabrasclave">

		<li><label for="keyw1"><input id="keyw1" name="keyw1" size="20" title="<?php echo $lang_key2 ?>" type="text" /> <strong><?php echo $lang_key2 ?></strong></label></li>
		<li><label for="keyw2"><input id="keyw2" name="keyw2" size="20" title="<?php echo $lang_key3 ?>" type="text" /> <strong><?php echo $lang_key3 ?></strong>.</label></li>
		<li><label for="keyw3"><input id="keyw3" name="keyw3" size="20" title="<?php echo $lang_key4 ?>" type="text" /> <strong><?php echo $lang_key4 ?></strong></label></li>
		<li><label for="keyw4"><input id="keyw4" name="keyw4" size="20" title="<?php echo $lang_key5 ?>" type="text" /> <strong><?php echo $lang_key5 ?></strong></label></li>

		<li><label for="keyw5"><input id="keyw5" name="keyw5" size="20" title="<?php echo $lang_key6 ?>" type="text" /> <strong><?php echo $lang_key6 ?></strong></label></li>
	</ul>
</dd>

<dt><strong><?php echo $lang_idioma1 ?></strong>:</dt>
<dd>

<select id="idioma" name="idioma">
	<option value=""><?php echo $lang_idioma2 ?></option>
	<option value="es">español</option>

	<option value="en" xml:lang="en" lang="en">English</option>
	<option value="ca" xml:lang="ca">Català</option>
	<option value="eu" xml:lang="eu">Euskera</option>
	<option value="gl" xml:lang="gl">Galego</option>
</select>
</dd>

</dl>

</fieldset>


<fieldset id="datosInformativosRecurso">

	 <legend><?php echo $lang_infor ?></legend>

<dl>

<dt><strong><?php echo $lang_aut1 ?></strong></dt>
<dd>
	<dl>
		<dt><label for="autor1Nombre"><?php echo $lang_aut2 ?></label></dt>

			<dd><input name="autor1Nombre" id="autor1Nombre" size="40" title="<?php echo $lang_aut2 ?>" type="text" /></dd>
		<dt><label for="autor1url"><acronym title="Uniform Resource Locator" xml:lang="en" lang="en">URL</acronym> <?php echo $lang_aut3 ?></label></dt>
			<dd><input name="autor1url" id="autor1url" size="60" title="URL <?php echo $lang_aut3 ?>" type="text" /></dd>
	</dl>
</dd>

<dt><strong><?php echo $lang_col1 ?></strong></dt>
<dd>
	<dl>

		<dt><label for="colaborador1Nombre"><?php echo $lang_col2 ?></label></dt>
			<dd><input name="colaborador1Nombre" id="colaborador1Nombre" size="40" title="<?php echo $lang_col2 ?>" type="text" /></dd>
		<dt><label for="colaborador1url"><acronym title="Uniform Resource Locator" xml:lang="en" lang="en">URL</acronym> <?php echo $lang_col3 ?></label></dt>
			<dd><input name="colaborador1url" id="colaborador1url" size="60" title="URL <?php echo $lang_col3 ?>" type="text" /></dd>
	</dl>
</dd>

<dt><strong><?php echo $lang_edi1 ?></strong></dt>

<dd>
	<dl>
		<dt><label for="editor1Nombre"><?php echo $lang_edi2 ?></label></dt>
			<dd><input name="editor1Nombre" id="editor1Nombre" size="40" title="<?php echo $lang_edi2 ?>" type="text" /></dd>
		<dt><label for="editor1url"><acronym title="Uniform Resource Locator" xml:lang="en" lang="en">URL</acronym> <?php echo $lang_edi3 ?></label></dt>
			<dd><input name="editor1url" id="editor1url" size="60" title="URL <?php echo $lang_edi3 ?>" type="text" /></dd>
	</dl>

</dd>

<dt><strong><?php echo $lang_pi1 ?></strong></dt>
<dd>
	<dl>
		<dt><label for="derechos1Nombre"><?php echo $lang_pi2 ?></label></dt>
			<dd><input id="derechos1Nombre" name="derechos1Nombre" size="40" title="<?php echo $lang_pi3 ?>" type="text" /></dd>
		<dt><label for="derechos1url"><acronym title="Uniform Resource Locator" xml:lang="en" lang="en">URL</acronym> <?php echo $lang_pi4 ?></label></dt>

			<dd><input id="derechos1url" name="derechos1url" size="60" title="URL <?php echo $lang_pi5 ?>" type="text" /></dd>
	</dl>
</dd>

</dl>

</fieldset>


<fieldset id="datosAdicionalesRecurso">

	 <legend><?php echo $lang_adic ?></legend>

<dl>

<dt><strong><?php echo $lang_fecha1 ?></strong> <span class="info">(<?php echo $lang_fecha2 ?> aaaa-mm-dd)</span>:</dt>
<dd>
	<label for="anioCreacion"><input id="anioCreacion" name="anioCreacion" size="4" title="<?php echo $lang_fecha3 ?>" type="text" /> <?php echo $lang_fecha4 ?></label>
	-
	<label for="mesCreacion"><input id="mesCreacion" name="mesCreacion" size="2" title="<?php echo $lang_fecha5 ?>" type="text" /> <?php echo $lang_fecha6 ?></label>

	-
	<label for="diaCreacion"><input id="diaCreacion" name="diaCreacion" size="2" title="<?php echo $lang_fecha7 ?>" type="text" /> <?php echo $lang_fecha8 ?></label>
</dd>

<dt><strong><?php echo $lang_res1 ?></strong> (<a href="http://dublincore.org/documents/dcmi-type-vocabulary/"><?php echo $lang_res2 ?> <span xml:lang="en" lang="en">Dublin Core</span> <?php echo $lang_res3 ?> <span xml:lang="en" lang="en">type</span></a>):</dt>

<dd>
	<ul id="typeVocabulary">
		<li><label for="Collection"><input name="tipoRecurso[]" id="Collection" value="Collection" type="checkbox" /><?php echo $lang_res4 ?></label></li>
		<li><label for="Dataset"><input name="tipoRecurso[]" id="Dataset" value="Dataset" type="checkbox" /><?php echo $lang_res5 ?></label></li>
		<li><label for="Event"><input name="tipoRecurso[]" id="Event" value="Event" type="checkbox" /><?php echo $lang_res6 ?></label></li>
		<li><label for="Image"><input name="tipoRecurso[]" id="Image" value="Image" type="checkbox" /><?php echo $lang_res7 ?></label></li>

		<li><label for="InteractiveResource"><input name="tipoRecurso[]" id="InteractiveResource" value="InteractiveResource" type="checkbox" /><?php echo $lang_res8 ?>, <span xml:lang="en" lang="en">applets</span>, <?php echo $lang_res9 ?>, <span xml:lang="en" lang="en">chat</span>, <?php echo $lang_res10 ?>,...)</label></li>
		<li><label for="MovingImage"><input name="tipoRecurso[]" id="MovingImage" value="MovingImage" type="checkbox" /><?php echo $lang_res11 ?></label></li>
		<li><label for="PhysicalObject"><input name="tipoRecurso[]" id="PhysicalObject" value="PhysicalObject" type="checkbox" /><?php echo $lang_res12 ?></label></li>
		<li><label for="Service"><input name="tipoRecurso[]" id="Service" value="Service" type="checkbox" /><?php echo $lang_res13 ?></label></li>

		<li><label for="Software"><input name="tipoRecurso[]" id="Software" value="Software" type="checkbox" />Software</label></li>
		<li><label for="Sound"><input name="tipoRecurso[]" id="Sound" value="Sound" type="checkbox" /><?php echo $lang_res14 ?></label></li>
		<li><label for="StillImage"><input name="tipoRecurso[]" id="StillImage" value="StillImage" type="checkbox" /><?php echo $lang_res15 ?></label></li>
		<li><label for="Text"><input name="tipoRecurso[]" id="Text" value="Text" type="checkbox" /><?php echo $lang_res16 ?></label></li>
	</ul>
<p><?php echo $lang_res17 ?> <span xml:lang="en" lang="en">Dublin Core</span> <?php echo $lang_res18 ?>.</p>

</dd>

<dt><strong><?php echo $lang_rrel1 ?></strong>:</dt>
<dd>
	<ul>

		<li><?php echo $lang_rrel2 ?> "1"
			<dl>
				<dt><label for="recurso1Nombre"><?php echo $lang_desc2 ?></label></dt>
				<dd><input id="recurso1Nombre" name="recurso1Nombre" size="40" title="<?php echo $lang_rrel3 ?>  &quot;1&quot;" type="text" /></dd>

				
				<dt><label for="recurso1url"><acronym title="Uniform Resource Locator" xml:lang="en" lang="en">URL</acronym> <?php echo $lang_rrel4 ?> "1"</label></dt>
				<dd><input id="recurso1url" name="recurso1url" size="60" title="URL <?php echo $lang_rrel4 ?> &quot;1&quot;" type="text" /></dd>
			</dl>		
		</li>

		<li><?php echo $lang_rrel2 ?> "2"
			<dl>
				<dt><label for="recurso2Nombre"><?php echo $lang_rrel3 ?> "2"</label></dt>

				<dd><input id="recurso2Nombre" name="recurso2Nombre" size="40" title="<?php echo $lang_rrel3 ?> &quot;2&quot;" type="text" /></dd>
				
				<dt><label for="recurso2url"><acronym title="Uniform Resource Locator" xml:lang="en" lang="en">URL</acronym> <?php echo $lang_rrel4 ?> "2"</label></dt>
				<dd><input id="recurso2url" name="recurso2url" size="60" title="URL <?php echo $lang_rrel5 ?> &quot;2&quot;" type="text" /></dd>
			</dl>		
		</li>


	</ul>
</dd>

</dl>

</fieldset>


<p><?php echo $lang_boton ?>:</p>
<div id="botonGenera">

<input id="botonGenerarMetadatos" name="botonGenerarMetadatos" value="<?php echo $lang_generar ?>" title="Generar Metadatos" accesskey="1" type="submit" />
</div>

<ul>

	<li><a href="#resultados-metadatos"><?php echo $lang_a_res_meta ?></a></li>
	<li><a href="#resultados-microformatos"><?php echo $lang_a_res_micro ?></a></li>
	<li><a href="#resultados-rdf"><?php echo $lang_a_res_rdf ?> <acronym title="Resource Description Framework" xml:lang="en" lang="en">RDF</acronym><?php echo $lang_a_res_rdf_1 ?></a></li>	
</ul>

<h2 id="resultados-metadatos"><?php echo $lang_meta1 ?></h2>
<p><label for="contenidoGeneradoMetadatos"><?php echo $lang_meta2 ?> <code>&lt;head&gt;</code> <?php echo $lang_micro3 ?> <code>&lt;/head&gt;</code> <?php echo $lang_meta3 ?> <acronym title="HyperText Markup Language" xml:lang="en" lang="en">HTML</acronym> <?php echo $lang_lang2 ?> <acronym title="eXtensible HyperText Markup Language" xml:lang="en" lang="en">XHTML</acronym>.</label></p>

<div><textarea cols="70" rows="15" id="contenidoGeneradoMetadatos" name="contenidoGeneradoMetadatos" accesskey="2"><?php echo $vContenidoMetadatos ?></textarea></div>

<h2 id="resultados-microformatos"><?php echo $lang_micro1 ?> <span xml:lang="en" lang="en">Dublin Core</span></h2>
<p><label for="contenidoGeneradoMicroformatos"><?php echo $lang_micro2 ?> <code>&lt;body&gt;</code> <?php echo $lang_micro3 ?> <code>&lt;/body&gt;</code> <?php echo $lang_micro4 ?> <acronym title="HyperText Markup Language" xml:lang="en" lang="en">HTML</acronym> <?php echo $lang_lang2 ?> <acronym title="eXtensible HyperText Markup Language" xml:lang="en" lang="en">XHTML</acronym>.</label></p>

<div><textarea cols="70" rows="15" id="contenidoGeneradoMicroformatos" name="contenidoGeneradoMicroformatos" accesskey="3"><?php echo $vContenidoMicroformatos ?></textarea></div>

<h2 id="resultados-rdf"><?php echo $lang_rdf1 ?> <acronym title="Resource Description Framework" xml:lang="en" lang="en">RDF</acronym></h2>
<p><label for="contenidoGeneradoRDF"><?php echo $lang_rdf2 ?> <strong>.rdf</strong> (<?php echo $lang_rdf3 ?>) <?php echo $lang_lang2 ?> <strong>.xml</strong>. <?php echo $lang_rdf4 ?> <code>&lt;head&gt;</code> <?php echo $lang_micro3 ?> <code>&lt;/head&gt;</code> <?php echo $lang_micro4 ?> <acronym title="HyperText Markup Language" xml:lang="en" lang="en">HTML</acronym> <?php echo $lang_lang2 ?> <acronym title="eXtensible HyperText Markup Language" xml:lang="en" lang="en">XHTML</acronym>, <?php echo $lang_rdf5 ?>:</label></p>

<pre><code>&lt;link rel="meta"
	type="application/rdf+xml"
	href="http://www.example.org/fichero.rdf" /&gt;</code></pre>
<div><textarea cols="70" rows="15" id="contenidoGeneradoRDF" name="contenidoGeneradoRDF" accesskey="4"><?php echo $vContenidoRDF ?></textarea></div>

</form>

<div id="referencias">
<h2 id="references"><?php echo $lang_refer1 ?></h2>
<ul>
	<li><a href="http://www.w3.org/2001/sw/" xml:lang="en" hreflang="en" lang="en">Semantic Web</a></li>
	<li><a href="http://www.w3.org/RDF/" xml:lang="en" hreflang="en" lang="en">Resource Description Framework (<acronym title="Resource Description Framework" xml:lang="en" lang="en">RDF</acronym>)</a></li>

	<li><a href="http://www.dublincore.org/documents/dcmi-terms/" xml:lang="en" hreflang="en" lang="en"><acronym title="Dublin Core Metadata Initiative">DCMI</acronym> Metadata Terms</a></li>
	<li><a href="http://microformats.org/" xml:lang="en" hreflang="en" lang="en">microformats.org</a></li>
</ul>
</div>

<h2><?php echo $lang_refer2 ?>  <span xml:lang="en" lang="en">Dublin Core Metadata <abbr title="<?php echo $lang_abbr_gen ?>" xml:lang="<?php echo $lenguaje ?>" lang="<?php echo $lenguaje ?>">Gen</abbr></span></h2>
<p><?php echo $lang_refer3 ?>:</p>

<ul>
	<li><?php echo $lang_refer4 ?> <span xml:lang="en" lang="en">Dublin Core</span></li>
	<li><?php echo $lang_refer5 ?> <acronym title="Resource Description Framework" xml:lang="en" lang="en">RDF</acronym> <?php echo $lang_refer6 ?> <a rel="meta" type="application/rdf+xml" href="http://www.example.org/dublincore-metadata-gen.rdf">dublincore-metadata-gen.rdf</a>. <?php echo $lang_refer7 ?></li>
	<li><?php echo $lang_refer8 ?> <span xml:lang="en" lang="en">Dublin Core</span> <?php echo $lang_refer9 ?>:</li>

</ul>
<div id="primer-microformato-dublincore">
<div class="dublincore">
<dl>
	<dt><?php echo $lang_desc2 ?>:</dt><dd class="title"><span xml:lang="en" lang="en">Dublin Core Metadata</span> <abbr title="<?php echo $lang_abbr_gen ?>" xml:lang="<?php echo $lenguaje ?>" lang="<?php echo $lenguaje ?>">Gen</abbr>: <?php echo $lang_dc_title ?></dd>
	<dt><?php echo $lang_direcc ?>:</dt><dd><a href="http://www.webposible.com/utilidades/dublincore-metadata-gen/" class="identifier">http://www.webposible.com/utilidades/dublincore-metadata-gen/</a></dd>

	<dt><?php echo $lang_desc3 ?>:</dt><dd class="description">Dublin Core Metadata Gen <?php echo $lang_gen1 ?> <acronym title="eXtensible HyperText Markup Language" xml:lang="en" lang="en">XHTML</acronym>, <?php echo $lang_gen2 ?> <acronym title="HyperText Markup Language" xml:lang="en" lang="en">HTML</acronym> <?php echo $lang_lang2 ?> <acronym title="eXtensible HyperText Markup Language" xml:lang="en" lang="en">XHTML</acronym>, <?php echo $lang_gen3 ?> <span xml:lang="en" lang="en">Dublin Core</span> <?php echo $lang_gen4 ?> <acronym title="Resource Description Framework" xml:lang="en" lang="en">RDF</acronym>.</dd>

	<dt><?php echo $lang_gen5 ?>:</dt><dd class="subject">Dublin Core, <?php echo $lang_gen6 ?>, <acronym title="Resource Description Framework" xml:lang="en" lang="en">RDF</acronym></dd>
	<dt><?php echo $lang_gen7 ?>:</dt><dd class="language"><?php echo $lenguaje ?></dd>
	<dt><?php echo $lang_aut1 ?>:</dt><dd><a href="http://www.webposible.com/autor.html" class="creator">Alejandro Gonzalo Bravo García</a></dd>
	<dt><?php echo $lang_col1 ?>:</dt><dd><a href="http://css.artnau.com/" class="contributor" xml:lang="ca" lang="ca">Arnau Siches</a></dd>

	<dt><?php echo $lang_edi1 ?>:</dt><dd><a href="http://www.webposible.com/" class="publisher">webposible.com</a></dd>
	<dt><?php echo $lang_gen8 ?>:</dt><dd><a href="http://www.gnu.org/copyleft/gpl.html" class="license"><acronym title="GNU Not's Unix" xml:lang="en" lang="en">GNU</acronym> General Public License</a></dd>
	<dt><?php echo $lang_fecha1 ?>:</dt><dd class="created">2005-11-22</dd>
	<dt><?php echo $lang_rrel2 ?>:</dt><dd><a href="http://www.webposible.com/utilidades/generador_rdf_foto.html" class="relation"><?php echo $lang_gen9 ?>.</a></dd>

	<dt><?php echo $lang_rrel2 ?>:</dt><dd><a href="http://microformats.org/code/hcard/creator" class="relation">hCard Creator</a></dd>
</dl>
</div>
</div>
<h2><?php echo $lang_suger1 ?></h2>
<p><?php echo $lang_suger2 ?>, <a href="http://www.webposible.com/blog/?p=129#commentlist"><?php echo $lang_suger3 ?></a>. <?php echo $lang_suger4 ?> <a href="http://www.webposible.com/autor.html"><?php echo $lang_suger5 ?></a>.</p>

<h2 id="iconos"><?php echo $lang_icons ?></h2>
<ul id="uliconos">
	<li><a href="http://validator.w3.org/check?uri=referer" hreflang="en"><img src="http://www.w3.org/Icons/valid-xhtml10.png" alt="XHTML 1.0 <?php echo $lang_valid ?>" height="31" width="88" /></a></li>
	<li><a href="http://dublincore.org/" title="Dublin Core Metadata Initiative: Making it easier to find information." hreflang="en" xml:lang="en" lang="en"><img style="display: none;" alt="Dublin Core Used Here" src="http://dublincore.org/images/banners/dcusedhere/dcuh_88x31.gif" height="31" width="88" /></a></li>
	<li><a href="http://www.w3.org/RDF/" title="RDF Resource Description Framework" hreflang="en" xml:lang="en" lang="en"><img src="http://www.w3.org/RDF/icons/rdf_developer_button.32" alt="RDF Resource Description Framework Developer Icon" height="32" width="76" /></a></li>
</ul>

</body></html>