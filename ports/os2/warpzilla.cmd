@echo off
SET PATH=X:\Warpzilla\tools;X:\Warpzilla\mozilla\dist\OS24.0_EMX_DBG.OBJ\bin;%PATH%
SET BEGINLIBPATH=X:\Warpzilla\tools;%BEGINLIBPATH%
SET HOME=X:\Warpzilla\tools\home
SET TERM=os2
SET TERMCAP=X:\Warpzilla\tools\termcap.dat
SET BASH_STARTUP=X:\Warpzilla\tools\home\.bashos2
SET AC_MACRODIR=X:/Warpzilla/tools/autocnf2.12
SET USER=root
REM Set the following to =VACPP if
REM you're not using gcc.
SET MOZ_OS2_TOOLS=EMX
SET NO_DEFAULT_EXT=1
SET MOZ_BITS=32
SET MOZ_DEBUG=1
SET MOZ_GOLD=1
SET MOZ_MEDIUM=1
SET MOZ_SRC=X:\Warpzilla
SET NO_SECURITY=1
SET NSPR20=1
