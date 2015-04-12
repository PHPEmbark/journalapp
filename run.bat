@ECHO OFF

REM Set this to the location of your php.exe
SET PHP_BIN=%~dp0\..\php\php.exe

REM Set this to the location of your code directory
SET CODE_LOCATION=%~dp0public

"%PHP_BIN%" -S 0.0.0.0:8080 -t "%CODE_LOCATION%"

pause