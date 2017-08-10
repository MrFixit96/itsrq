'Description
'Lists all the shared folders on a computer. 
'Script Code

strComputer = "."
Set objWMIService = GetObject("winmgmts:" _
& "{impersonationLevel=impersonate}!\\" & strComputer & "\root\cimv2")
Set colShares = objWMIService.ExecQuery("Select * from Win32_Share")
For each objShare in colShares
Wscript.Echo "AllowMaximum: " & vbTab & objShare.AllowMaximum 
Wscript.Echo "Caption: " & vbTab & objShare.Caption 
Wscript.Echo "MaximumAllowed: " & vbTab & objShare.MaximumAllowed
Wscript.Echo "Name: " & vbTab & objShare.Name 
Wscript.Echo "Path: " & vbTab & objShare.Path 
Wscript.Echo "Type: " & vbTab & objShare.Type 
Next
 
