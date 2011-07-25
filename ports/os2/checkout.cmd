@echo off
SET CVSROOT=:pserver:anonymous@cvs1.mozilla.org:/cvsroot
SET HOME=X:/Warpzilla
cvs login
cvs -z3 checkout -r OS2_BRANCH mozilla
