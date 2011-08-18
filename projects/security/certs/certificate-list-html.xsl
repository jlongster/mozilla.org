<?xml version="1.0" encoding="ISO-8859-1"?>

<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="authority">
  <div>
  <xsl:attribute name="class">
    <xsl:value-of select="@status"/>
    authority
  </xsl:attribute>
  <a>
    <xsl:attribute name="name">
      <xsl:value-of select="@name"/>
    </xsl:attribute>
  </a>
  <h2>
    <a>
      <xsl:attribute name="href">
        <xsl:value-of select="@url"/>
      </xsl:attribute>
      <xsl:value-of select="@name"/>
    </a>
  </h2>
  
  <p><xsl:value-of select="summary"/></p>
  
  <xsl:for-each select="audit">
    <p>
    Audit:
    <xsl:choose>
      <xsl:when test="auditor != ''">
        <xsl:value-of select="@type"/>, performed by 
        <a>
          <xsl:attribute name="href">
            <xsl:value-of select="auditor/@url"/>
          </xsl:attribute>
          <xsl:value-of select="auditor"/>
        </a>:
        <xsl:for-each select="document">
          <a>
          <xsl:attribute name="href">
            <xsl:value-of select="@url"/>
          </xsl:attribute>
          <xsl:value-of select="."/>
          </a>
          <xsl:if test="position() != last()">, </xsl:if>
        </xsl:for-each>
      </xsl:when>
      <xsl:otherwise>
        <i>none</i>
      </xsl:otherwise>
    </xsl:choose>
    </p>
  </xsl:for-each>
  
  <xsl:apply-templates select="certificate"/>
  
  <p>
    <xsl:if test="comments != ''">
     <xsl:value-of select="comments"/>           
    </xsl:if>
  </p>
  </div>
</xsl:template>





<xsl:template match="certificate">
  <div class="certificate">
  <xsl:attribute name="class">
    <xsl:value-of select="@status"/>
    certificate
  </xsl:attribute>
  <h3>
    <xsl:value-of select="@name"/>
  </h3>
  <p><xsl:value-of select="summary"/></p>
  <table>
    <tr>
      <td>Link</td>
      <td>        
        <a>
          <xsl:attribute name="href">
           <xsl:value-of select="data/@url"/>
          </xsl:attribute>
          Download/Install
        </a>
      </td>
    </tr>
    <tr>
      <td>SHA1</td>
      <td><xsl:value-of select="data/@sha1"/></td>
    </tr>
    <tr>
      <td>Version</td>
      <td><xsl:value-of select="data/@version"/></td>
    </tr>
    <tr>
      <td>Modulus (key length)</td>
      <td><xsl:value-of select="data/@modulus"/></td>
    </tr>
    <tr>
      <td>Valid From</td>
      <td><xsl:value-of select="data/@from"/></td>
    </tr>
    <tr>
      <td>Valid To</td>
      <td><xsl:value-of select="data/@to"/></td>
    </tr>
    <tr>
      <td>Revocation</td>
      <td>
        <xsl:for-each select="crl">
          <a>
            <xsl:attribute name="href">
             <xsl:value-of select="@url"/>
            </xsl:attribute>
            <xsl:value-of select="."/>
          </a>
          <xsl:if test="position() != last()">, </xsl:if>
        </xsl:for-each>
      
        <xsl:if test="ocsp != ''">,
          <a>
            <xsl:attribute name="href">
             <xsl:value-of select="ocsp"/>
            </xsl:attribute>
            OCSP
          </a>
        </xsl:if>
       </td>
    </tr>
    <tr>
      <td>Type</td>
      <td><xsl:value-of select="type"/></td>
    </tr>
    <xsl:for-each select="document">
      <tr>
        <td>Document</td>
        <td>
          <a>
            <xsl:attribute name="href">
             <xsl:value-of select="@url"/>
            </xsl:attribute>
            <xsl:value-of select="."/>
          </a>     
        </td>
      </tr>
    </xsl:for-each>
    <tr class="trustbits">
      <td valign="top">Requested Trust Bits</td>
      <td>
        <ul>
        <xsl:if test="not(trust/flag/@type)"><li>Unknown</li></xsl:if>
        <xsl:if test="trust/flag/@type = 'web'"><li>Websites</li></xsl:if>
        <xsl:if test="trust/flag/@type = 'email'"><li>Email</li></xsl:if>
        <xsl:if test="trust/flag/@type = 'code'"><li>Code</li></xsl:if>
        </ul>
      </td>
    </tr>
    <tr>
      <td>Bugs</td>
      <td>
        <xsl:if test="inclusion/authorisation != ''">
          Authorisation (<a>
          <xsl:attribute name="href">
            <xsl:value-of select="inclusion/authorisation"/>
          </xsl:attribute>
          <xsl:value-of select="substring-after(inclusion/authorisation,'=')"/></a>)</xsl:if>
        <xsl:if test="inclusion/technical != ''">, 
          Inclusion (<a>
            <xsl:attribute name="href">
              <xsl:value-of select="inclusion/technical"/>
            </xsl:attribute>
            <xsl:value-of select="substring-after(inclusion/technical,'=')"/></a>)</xsl:if>
        <xsl:if test="inclusion/ev != ''">, 
          EV (<a>
            <xsl:attribute name="href">
              <xsl:value-of select="inclusion/ev"/>
            </xsl:attribute>
            <xsl:value-of select="substring-after(inclusion/ev,'=')"/></a>)
        </xsl:if>
      </td>
    </tr>
    <xsl:if test="inclusion/@date != ''">
      <tr>
        <td>Included In</td>
        <td>
          <xsl:value-of select="inclusion/@date"/>
        </td>
      </tr>
    </xsl:if>
    <tr>
      <td>Comments</td>
      <td>
        <xsl:choose>
          <xsl:when test="comments != ''">
           <xsl:value-of select="comments"/>           
          </xsl:when>
          <xsl:otherwise>
            <i>none</i>
          </xsl:otherwise>
        </xsl:choose>
      </td>
    </tr>
  </table>
  </div>
</xsl:template>

</xsl:stylesheet>
