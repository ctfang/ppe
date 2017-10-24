@ECHO OFF

SET MOON_PATH=%~dp0

SET PATH=%PATH%%MOON_PATH%

reg add "HKLM\SYSTEM\CurrentControlSet\Control\Session Manager\Environment" /v "Path" /t REG_EXPAND_SZ /d "%PATH%
pause