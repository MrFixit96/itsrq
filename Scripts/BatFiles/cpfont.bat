ECHO OFF

Echo This Program will copy the fonts you need to a floppy disk

IF %ComSpec%==C:\Windows\system\command.com GOTO WIN98
IF %ComSpec%==%windir%\system32\cmd.exe GOTO WIN2k
GOTO ERR

:WIN98
ECHO You have Windows 98... Copying %1
copy c:\windows\fonts\old*english*.* c:\
goto DONE

:WIN2k
ECHO You have Windows 2000... Copying %1
copy %windir%\fonts\old*english*.* c:\
goto DONE


:ERR
echo Your operating system is not windows98 or Windows2000
echo if your operating system is windows XP look in c:\windows\fonts
echo otherwise ask your administrator for help
pause

:DONE
pause