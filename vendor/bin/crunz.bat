@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../lavary/crunz/crunz
php "%BIN_TARGET%" %*
