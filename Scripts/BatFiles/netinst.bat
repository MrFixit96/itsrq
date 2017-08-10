@echo off

rem for AVG6RI_FORCED and AVG6RI_INJECT anything starting with '0', 'n', 'N'
rem means NO
rem AVG6RI_DESTINATION can't have backslash at the end
rem AVG6RI_SOURCE must have backslash at the end

rem if set PreInstall can run more than once. Be carefull, this
rem setting is only for solving probems with install
rem If used on running AVG instalation it will destroy it !!!
rem better don't alter this setting
set AVG6RI_FORCED=No

rem destination path on destination computer
set AVG6RI_DESTINATION=C:\AVG

rem path with AvgDevice.sys, AvgService.exe files (.\ means current dir)
set AVG6RI_SOURCE=.\

rem inject setup to run on next logon?
set AVG6RI_INJECT=Yes

rem what to run on next logon (enabled by AVG6RI_INJECT)
rem this is typically real setup of AVG
rem it's common to use install script (avg_net.cfg) prepared by AvgAdmin
set AVG6RI_SETUP=\\pcs-svr01\AVGNet$\INSTALL\setup.exe /LOG /LOG /HIDE /@\\pcs-svr01\AVGNet$\INSTALL\avg_net.cfg 

REM presetupnt \\COMPUTER0
rem presetupnt \\COMPUTER1
presetup2k \\%COMPUTERNAME%

Echo Your Virus Protection Software has been installed or updated and needs to restart your computer.
pause
shutdown -r -t 01 -f