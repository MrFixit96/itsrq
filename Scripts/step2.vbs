'Date:7-11-03
'Author: James Anderton
'Purpose: To copy users Documents and Settings profile back into their "New Profile" after joining a different domain
'Events: users will need to logon to their computer with adminlocal and password gohome
'	this script will copy files back into the docs and settings folder %username% from pcslocal.its
'	then the script will reboot the computer one last time.


' ##################################################################################
' #			Prompt For UserName
' ##################################################################################
strUser = inputbox("Please Enter your Username")

' ##################################################################################
' #			Rename Docs and Settings Folder
' ##################################################################################
Dim fso, uprof
Set fso = CreateObject("Scripting.FileSystemObject")
' Get Handle to the file
Set uprof = fso.GetFile("C:\Documents and Settings\PCSlocal.ITS")
' Move the file to the new folder
uprof.copy ("C:\Documents and Settings\" & strUser) , &H100&

' ##################################################################################
' #			Reboot Computer
' ##################################################################################

	msgbox("Your files have been transferred and your computer will now reboot.")

'Pause script so they can read msgbox.
	Wscript.sleep 30000
	
'Reboot computer
	strComputer = "."
	Set objWMIService = GetObject("winmgmts:" _
    		& "{impersonationLevel=impersonate,(Shutdown)}!\\" & strComputer & "\root\cimv2")
	Set colOperatingSystems = objWMIService.ExecQuery _
    		("Select * from Win32_OperatingSystem")
	For Each objOperatingSystem in colOperatingSystems
    		ObjOperatingSystem.Reboot()
	Next

