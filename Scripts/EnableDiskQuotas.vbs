'Description
'Turns on disk quotas for drive C. Requires Windows XP or Windows Server 2003. 

Script Code 

Const ENFORCE_QUOTAS = 1
StrComputer = "."
Set objWMIService = GetObject("winmgmts:" _
& "{impersonationLevel=impersonate}!\\" & strComputer & "\root\cimv2")
Set colDisks = objWMIService.ExecQuery _
("Select * from Win32_QuotaSetting Where VolumePath = 'C:\\'")
For Each objDisk in colDisks
objDisk.State = ENFORCE_QUOTAS
objDisk.Put_
Next
