<?xml version="1.0" encoding="ISO-8859-1"?>

<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:template match="/">
    <html>
    <head>
      <link rel="stylesheet" href="../certificate-list.css"/>
      <link rel="stylesheet" href="pending.css"/>
      <title>Pending Certificate List</title>
    </head>
    <body>
      <h1>Pending Certificate List</h1>
      <p>This is a list of companies and certificates which have applied for
      inclusion into the Mozilla project Root CA store, and whose applications
      are pending.</p>
      <table>
      <tr><th>State/Colour</th><th>Next Action</th></tr>
      <tr>
        <td class="incomplete">Information incomplete</td>
        <td>CA to provide missing information in Authorisation bug</td>
      </tr>
      <tr>
        <td class="needscheck">Information probably complete</td>
        <td>CA to check and comment in Authorisation bug</td>
      </tr>
      <tr>
        <td class="complete">Information confirmed complete</td>
        <td>Mozilla Foundation to evaluate request</td>
      </tr>
      <tr>
        <td class="pending">Public discussion</td>
        <td>Public feedback requested</td>
      </tr>
      <tr>
        <td class="approved">Inclusion</td>
        <td>Mozilla Foundation to arrange for inclusion</td>
      </tr>
      </table>
      
      <ul>
      <xsl:for-each select="//authority">
        <xsl:sort select="./@name" />
        <li>
          <a>
            <xsl:attribute name="href">
              #<xsl:value-of select="@name"/>
            </xsl:attribute>
            <xsl:value-of select="./@name"/>
          </a>
        </li>
      </xsl:for-each>    
      </ul>
      
      <p>Note: revocation details (CRLs, OCSP) are given for information only; because a CA can create any number
      of sub-CAs, and can decide to change its revocation URLs at any time, this information
      cannot be kept up to date and should not be regarded as comprehensive. Type information is
      a subjective assessment.</p>
      
      <p>Note: it has been decided that government CAs at a level below that of national governments
      will be assessed last. So even if they are green, their assessment may not be imminent.</p>
      
      <xsl:apply-templates select="certificates/authority">
        <xsl:sort select="@name"/>
      </xsl:apply-templates>
      
      <p><a href="http://bonsai-www.mozilla.org/cvslog.cgi?file=mozilla-org/html/projects/security/certs/pending/index.xml&amp;rev=&amp;root=/www/">Document History</a>.</p>
            
    </body>
    </html>
  </xsl:template>

  <xsl:include href="../certificate-list-html.xsl"/>
</xsl:stylesheet>
