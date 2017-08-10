'Description
'Returns the amount of free space for each hard disk installed on a computer. 

Script Code 

Const HARD_DISK = 3
strComputer = "."
Set objWMIService = GetObject("winmgmts:" _
& "{impersonationLevel=impersonate}!\\" & strComputer & "\root\cimv2")
Set colDisks = objWMIService.ExecQuery _
("Select * from Win32_LogicalDisk Where DriveType = " & HARD_DISK & "")
For Each objDisk in colDisks
Wscript.Echo "DeviceID: "& vbTab & objDisk.DeviceID 
Wscript.Echo "Free Disk Space: "& vbTab & objDisk.FreeSpace
Next
