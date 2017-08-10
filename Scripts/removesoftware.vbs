strComputer = "."
Set objWMIService = GetObject("winmgmts:" _
& "{impersonationLevel=impersonate}!\\" & strComputer & "\root\cimv2")
Set colSoftware = objWMIService.ExecQuery _
("Select * from Win32_Product Where Name = 'Theme Generator V2'")
For Each objSoftware in colSoftware
objSoftware.Uninstall()
Next
wscript.echo "Done"