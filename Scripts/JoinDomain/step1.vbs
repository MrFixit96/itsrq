'DATE:    7-11-03
'AUTHOR:  James Anderton
'PURPOSE: joining PCS.LOCAL domain and to copy users Documents and Settings profile back into their "New Profile"
'EVENTS:  users will need to logon to their computer with adminlocal and password gohome
'	  this script will rename the docs and settings folder %username% to pcslocal.its
'	  (this will later be copied into their new docs and settings folder)
'  	  then the script will join the computer to the new pcs.local domain and reboot the computer

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
Set uprof = fso.GetFile("C:\Documents and Settings\" & strUser)
' Move the file to the new folder
uprof.copy ("C:\Documents and Settings\PCSlocal.ITS)

' ##################################################################################
' #			Join Domain
' ##################################################################################
Const JOIN_DOMAIN             = 1
Const ACCT_CREATE             = 2
Const ACCT_DELETE             = 4
Const WIN9X_UPGRADE           = 16
Const DOMAIN_JOIN_IF_JOINED   = 32
Const JOIN_UNSECURE           = 64
Const MACHINE_PASSWORD_PASSED = 128
Const DEFERRED_SPN_SET        = 256
Const INSTALL_INVOCATION      = 262144

strDomain   = "pcs"
strPassword = "neaddsixtwo"
strUser     = "administrator"

Set objNetwork = CreateObject("WScript.Network")
strComputer = objNetwork.ComputerName

Set objComputer = GetObject("winmgmts:{impersonationLevel=Impersonate}!\\" & _
                   strComputer & "\root\cimv2:Win32_ComputerSystem.Name='" & _
                   strComputer & "'")

ReturnValue = objComputer.JoinDomainOrWorkGroup(strDomain, _
                                                strPassword, _
                                                strDomain & "\" & strUser, _
                                                NULL, _
                                                JOIN_DOMAIN + ACCT_CREATE)
if ReturnValue = 0 then
	msgbox("Welcome to the PCS.Local Domain." & vbcrlf & "Your Computer will Now Reboot.")
' ##################################################################################
' #			Join Domain
' ##################################################################################

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

else
	msgbox("Error" & ReturnValue & "Please see IT Services for help.")
end if

