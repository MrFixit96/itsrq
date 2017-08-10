Dim fso, rbt, strcomputer, objWMIService, colOperatingSystems

Set fso = CreateObject("Scripting.FileSystemObject")
strComputer = "."


msgbox("Your Remote Install of Grisoft Anti-Virus has Finished, and your system will now reboot.")


Set objWMIService = GetObject("winmgmts:" _
    & "{impersonationLevel=impersonate}!\\" & strComputer & "\root\cimv2:Win32_Process")
Error = objWMIService.Create("net use b: /d", null, null, intProcessID)


Set objWMIService = GetObject("winmgmts:" _
    & "{impersonationLevel=impersonate,(Shutdown)}!\\" & strComputer & "\root\cimv2")
Set colOperatingSystems = objWMIService.ExecQuery _
    ("Select * from Win32_OperatingSystem")
For Each objOperatingSystem in colOperatingSystems
    ObjOperatingSystem.Reboot()
Next

Set rbt = fso.GetFile("C:\Documents and Settings\All Users\Start Menu\Programs\Startup\rbtask1.vbs")
rbt.Delete