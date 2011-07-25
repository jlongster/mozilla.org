/* SETMOZENV.CMD - A utility for setting up the build environment for Warpzilla */
/* V 1.1 - mkaply@us.ibm.com - proper support for GLIB and LIBIDL */
/* V 1.2 - mkaply@us.ibm.com - use EMX2, not emx_string */
/* V 1.3 - mkaply@us.ibm.com - Support for a better PERL */
/* V 1.4 - mkaply@us.ibm.com - Support for an even better PERL */
/* V 1.5 - mkaply@us.ibm.com - Support for changing FLOCK and perl shell */
/* V 1.6 - mkaply@us.ibm.com - Make VACPP the default */
/* V 1.7 - pedemont@us.ibm.com - Update to GNU make 3.79 */

/* When invoked with the parameter vacpp, a VisualAge build is setup, otherwise */
/* a GCC build is setup */

/* If SETMOZENV has alread been run, don't run it again */
if value('MOZENV',,'OS2ENVIRONMENT') = '1' THEN
DO
   exit
END
'set MOZENV=1'

/* Figure out what drive the utility was run on and set it as ROOT */
PARSE SOURCE command
PARSE VAR command word1 word2 path
PARSE UPPER VALUE path WITH root':\'therest
'SET ROOT='root':'
/* Get the buildtype (vacpp or other) */
PARSE ARG buildtype

/* If the environment variable PERLLOC is set, use it, otherwise assume PERLLIB is a directory off of ROOT */
if value('PERLLOC',,'OS2ENVIRONMENT') = '' THEN
DO
'SET PERLLOC=%ROOT%\PERLLIB'
END
/* Create an environment variable PERLLOC2 with forward slashes instead of backslashes */
'SET PERLLOC2='backtoforward(value('PERLLOC',,'OS2ENVIRONMENT'));

/* If the environment variable GLIB is set, use it, otherwise assume GLIB is a directory off of ROOT */
if value('GLIB',,'OS2ENVIRONMENT') = '' THEN
DO
'SET GLIB=%ROOT%\GLIBIDL\GLIB'
END
/* Create an environment variable GLIB2 with forward slashes instead of backslashes */
'SET GLIB2='backtoforward(value('GLIB',,'OS2ENVIRONMENT'));

/* If the environment variable LIBIDL is set, use it, otherwise assume LIBIDL is a directory off of ROOT */
if value('LIBIDL',,'OS2ENVIRONMENT') = '' THEN
DO
'SET LIBIDL=%ROOT%\GLIBIDL\LIBIDL'
END
/* Create an environment variable LIBIDL2 with forward slashes instead of backslashes */
'SET LIBIDL2='backtoforward(value('LIBIDL',,'OS2ENVIRONMENT'));

/* If the environment variable AUTOCONF is set, use it, otherwise assume AUTOCONF is a directory off of ROOT */
if value('AUTOCONF',,'OS2ENVIRONMENT') = '' THEN
DO
'SET AUTOCONF=%ROOT%\AUTOCONF'
END

/* If the environment variable EMX is set, use it, otherwise assume EMX is a directory off of ROOT */
if value('EMX',,'OS2ENVIRONMENT') = '' THEN
DO
'SET EMX=%ROOT%\EMX'
END
/* Create an environment variable EMX2 with forward slashes instead of backslashes */
'SET EMX2='backtoforward(value('EMX',,'OS2ENVIRONMENT'));

/* If the environment variable VACPP365 is set, use it, otherwise assume VACPP365 is a directory off of ROOT */
if value('VACPP365',,'OS2ENVIRONMENT') = '' THEN
DO
'SET VACPP365=%ROOT%\IBMCXXO'
END

/* If the environment variable MOZTOOLS is set, use it, otherwise assume MOZTOOLS is a directory off of ROOT */
if value('MOZTOOLS',,'OS2ENVIRONMENT') = '' THEN
DO
'SET MOZTOOLS=%ROOT%\MOZTOOLS'
END

/* If CVSROOT which is set in the environment contains mozilla.org, don't set it. Otherwise set it to */
/* anonymous */
cvsroot = value('CVSROOT',,'OS2ENVIRONMENT')
parse var cvsroot thefirst'mozilla.org'thelast
if (thelast = "") then
DO
'set CVSROOT=:pserver:anonymous@cvs-mirror.mozilla.org:/cvsroot'
END

/* If a HOME environment variable is not set, set it */
if value('HOME',,'OS2ENVIRONMENT') = '' THEN
DO
'set HOME=%ROOT%\HOME'
END

'SET BEGINLIBPATH=%GLIB%\bin;%LIBIDL%\bin;%MOZTOOLS%;%EMX%\dll;%BEGINLIBPATH%'
'SET PATH=%AUTOCONF%\bin;%MOZTOOLS%;%EMX%\bin;%PATH%;'

/* REM *** PERL settings */
'set PERLLIB_PREFIX=f:/perllib/lib;%PERLLOC%\LIB'
'set PERL_SH_DIR=%PERLLOC%\BIN'
'set USE_PERL_FLOCK=0'

/* REM *** BASH settings **** */
'SET CONFIG_SHELL=gbash.exe'
'SET MAKESHELL=gbash.exe'
'SET MAKESHELL=gbash.exe'
'SET EMXOPT=-c -n -h256'


/* REM *** AUTOCONF settings **** */
'SET AC_PREFIX=%AUTOCONF%/bin'
'SET AC_MACRODIR=%AUTOCONF%/share/autoconf'

/* REM *** EMX settings **** */
if buildtype = 'gcc' then /* GCC */
DO
'SET PATH=%EMX%\bin;%GLIB%\emx\bin;%LIBIDL%\emx\bin;%PATH%'
'SET BEGINLIBPATH=%GLIB%\emx\bin;%LIBIDL%\emx\bin;%MOZTOOLS%;%BEGINLIBPATH%'
'SET BEGINLIBPATH=%EMX%\bin;%BEGINLIBPATH%' 

'set INCLUDE=%EMX%\include\cpp;%EMX%\include;%INCLUDE%'
'SET C_INCLUDE_PATH=%EMX2%/include;'
'SET LIBRARY_PATH=%EMX2%/lib'
'SET CPLUS_INCLUDE_PATH=%EMX2%/include/cpp;%EMX2%/include;'
'SET PROTODIR=%EMX2%/emx/include/cpp/gen'
'SET OBJC_INCLUDE_PATH=%EMX2%/include'

'SET gccload=5'
'SET GCCOPT=-pipe'

'SET TERMCAP=%EMX2%/etc/termcap.dat'
'rem SET TERM=ansi-color-3'
'SET TERM=os2'

'SET INFOPATH=%EMX2%/info'

'SET EMXBOOK=emxdev.inf+emxlib.inf+emxgnu.inf+emxbsd.inf'
'SET HELPNDX=EPMKWHLP.NDX+CPP.NDX+CPPBRS.NDX+emxbook.ndx'

'set CC=gcc'
'set CXX=gcc'

'SET MOZ_OS2_TOOLS=EMX'
'set GLIB_CONFIG=%GLIB%\emx\bin\glib-config'
'set LIBIDL_CONFIG=%LIBIDL%\emx\bin\libIDL-config'
END
ELSE /* VACPP */
DO
'CALL %VACPP365%\bin\setenv'
'set CC=icc'
'set CXX=icc'
'set LD=-ilink'
'set VACPP=yes'
'SET MOZ_OS2_TOOLS=VACPP'
'set GLIB_CONFIG=%GLIB%\vacpp\bin\glib-config'
'set LIBIDL_CONFIG=%LIBIDL%\vacpp\bin\libIDL-config'
'SET PATH=%GLIB%\vacpp\bin;%LIBIDL%\vacpp\bin;%PATH%'

'SET BEGINLIBPATH=%GLIB%\vacpp\bin;%LIBIDL%\vacpp\bin;%MOZTOOLS%;%BEGINLIBPATH%'
END

/* rem *** MOZILLA BUILD **** */
'SET TMPDIR=%TMP%'
'set MAKE=make.exe'
'set RANLIB=echo'
'set AWK=awk'
'set SHELL=gbash.exe'
'set RUN_AUTOCONF_LOCALLY=1'

/* REM *** Set user debug info here *** */
'set LOGNAME=%hostname%'
'set USER=%hostname%'
'set SYSTEMNAME=%hostname%'
exit

backtoforward: procedure
  arg pathname
  parse var pathname pathname'\'rest
  do while (rest <> "")
    pathname = pathname'/'rest
    parse var pathname pathname'\'rest
  end
  return pathname
