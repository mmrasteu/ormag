<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:preserve-space elements="*" />
<xsl:output method="xml" encoding="UTF-8" indent="yes" />
	<xsl:template match="/">
	    <xsl:for-each select="Registros/Registro">
	      <tr>
	        <td><xsl:value-of select="Usuario"/></td>
	        <td><xsl:value-of select="Accion"/></td>
	        <td><xsl:value-of select="Hora"/></td>
	        <td><xsl:value-of select="Dia"/></td>
	        <td><xsl:value-of select="Mes"/></td>
	        <td><xsl:value-of select="Anyo"/></td>
	      </tr>
	    </xsl:for-each>     
	</xsl:template>
</xsl:stylesheet>