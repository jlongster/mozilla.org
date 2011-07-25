/* SETMOZENV.CMD - A utility for setting up the build environment for Warpzilla */
/* V 1.1  - mkaply   - proper support for GLIB and LIBIDL */
/* V 1.2  - mkaply   - use EMX2, not emx_string */
/* V 1.3  - mkaply   - Support for a better PERL */
/* V 1.4  - mkaply   - Support for an even better PERL */
/* V 1.5  - mkaply   - Support for changing FLOCK and perl shell */
/* V 1.6  - mkaply   - Make VACPP the default */
/* V 1.7  - mkaply   - GCC 3.2.1 support */
/* V 1.8  - pedemont - GCC 3.2.2 Beta 1 support */
/* V 1.9  - pedemont - remove VACPP support */
/* V 1.10 - pedemont - replace bash.exe with ash.exe */
/* V 1.11 - pedemont - add INCLUDE env variable */

/* be quiet */
'@ECHO OFF'

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

/* If the environment variable PERLLOC is set, use it, otherwise assume PERLLIB is a directory off of ROOT */
if value('PERLLOC',,'OS2ENVIRONMENT') = '' THEN
DO
'SET PERLLOC=%ROOT%\PERL'
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

/* If the environment variable GCCDIR is set, use it, otherwise assume GCCDIR is a directory off of ROOT */
if value('GCCDIR',,'OS2ENVIRONMENT') = '' THEN
DO
'SET GCCDIR=%ROOT%\gcc322'
END
/* Create an environment variable GCCDIR2 with forward slashes instead of backslashes */
'SET GCCDIR2='backtoforward(value('GCCDIR',,'OS2ENVIRONMENT'));

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

/* If the environment variable TOOLKIT is set, use it, otherwise assume TOOLKIT is a directory off of ROOT */
if value('TOOLKIT',,'OS2ENVIRONMENT') = '' THEN
DO
'SET TOOLKIT=%ROOT%\os2tk45'
END
/* Create an environment variable GLIB2 with forward slashes instead of backslashes */
'SET TOOLKIT2='backtoforward(value('TOOLKIT',,'OS2ENVIRONMENT'));

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

'SET BEGINLIBPATH=%PERLLOC%\lib;%MOZTOOLS%;%EMX%\dll;%BEGINLIBPATH%'
'SET PATH=%PERLLOC%\bin\5.8.0;%AUTOCONF%\bin;%MOZTOOLS%;%EMX%\bin;%PATH%;'
'SET DPATH=%MOZTOOLS%;%TOOLKIT%\msg;%DPATH%;'

/* REM *** PERL settings */
'set PERLLIB_PREFIX=L:/Perl/lib;%PERLLOC%\lib'
'set PERL_SH_DIR=%PERLLOC%\BIN\5.8.0'
'set USE_PERL_FLOCK=0'

/* REM *** shell settings **** */
'set SHELL=ash.exe'
'SET CONFIG_SHELL=ash.exe'
'SET MAKESHELL=ash.exe'

/* REM *** AUTOCONF settings **** */
'SET AC_PREFIX=%AUTOCONF%/bin'
'SET AC_MACRODIR=%AUTOCONF%/share/autoconf'

/* REM *** Compiler settings **** */
'set CC=gcc'
'set CXX=g++'

'SET PATH=%GCCDIR%\bin;%GLIB%\gcc\bin;%LIBIDL%\gcc\bin;%PATH%'
'SET BEGINLIBPATH=%GCCDIR%\lib;%GLIB%\gcc\bin;%LIBIDL%\gcc\bin;%BEGINLIBPATH%'

'SET C_INCLUDE_PATH=%GCCDIR2%/lib/gcc-lib/i386-pc-os2-emx/3.2.2/include;%GCCDIR2%/include;%TOOLKIT2%/H/ARPA;%TOOLKIT2%/H/NET;%TOOLKIT2%/H/NETINET;%TOOLKIT2%/H/NETNB;%TOOLKIT2%/H'
'SET CPLUS_INCLUDE_PATH=%GCCDIR2%/include/c++/3.2.2;%GCCDIR2%/include/c++/3.2.2/i386-pc-os2-emx;%GCCDIR2%/lib/gcc-lib/i386-pc-os2-emx/3.2.2/include'
'SET CPLUS_INCLUDE_PATH=%CPLUS_INCLUDE_PATH%;%GCCDIR2%/include/c++/3.2.2/backward;%GCCDIR2%/include;%TOOLKIT2%/H/ARPA;%TOOLKIT2%/H/NET;%TOOLKIT2%/H/NETINET;%TOOLKIT2%/H/NETNB;%TOOLKIT2%/H'
'SET INCLUDE=%TOOLKIT%\h;%INCLUDE%'
'SET LIBRARY_PATH=%GCCDIR2%/lib/tcpipv4;%GCCDIR2%/lib;%TOOLKIT2%/lib;'

'SET GCCLOAD=5'
'SET GCCOPT=-pipe'
'SET EMXOPT=-c -n -h256'

'SET TERMCAP=%EMX2%/etc/termcap.dat'
'rem SET TERM=ansi-color-3'
'SET TERM=os2'

'SET INFOPATH=%EMX2%/info'
'SET EMXBOOK=emxdev.inf+emxlib.inf+emxgnu.inf+emxbsd.inf'
'SET HELPNDX=EPMKWHLP.NDX+CPP.NDX+CPPBRS.NDX+emxbook.ndx'

'set GLIB_CONFIG=%GLIB%\gcc\bin\glib-config'
'set LIBIDL_CONFIG=%LIBIDL%\gcc\bin\libIDL-config'

/* rem *** ASH SHELL STUFF */
/*   for some reason, ash.exe ignores the first entry in my PATH when called  */
/*   from make; create a dummy path at the beginning in order to make it work */
'SET PATH=%ROOT%\foo;%PATH%'

/* rem *** MOZILLA BUILD **** */
'SET TEMP=%TMP%'
'SET TMPDIR=%TMP%'
'set MAKE=make.exe'
'set RANLIB=echo'
'set AWK=awk'
'set RUN_AUTOCONF_LOCALLY=1'
'SET MOZ_OS2_TOOLS=EMX'

/* REM *** Set user debug info here *** */
'set LOGNAME=%hostname%'
'set USER=%hostname%'
'set SYSTEMNAME=%hostname%'

/* REM *** disable assertion dialog *** */
/* 'set XPCOM_DEBUG_BREAK=warn' */
/* REM *** Enable build number in window title bar *** */
/* 'SET BUILD_OFFICIAL=1' */
exit

backtoforward: procedure
  arg pathname
  return Translate(pathname, '/', '\')
