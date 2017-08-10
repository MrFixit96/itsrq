'Description
'Deletes all print jobs larger than 1 megabyte. Requires Windows XP or Windows Server 2003. 

'Script Code 

strComputer = "."
Set objWMIService = GetObject("winmgmts:" _
& "{impersonationLevel=impersonate}!\\" & strComputer & "\root\cimv2")
Set colPrintJobs = objWMIService.ExecQuery _
("Select * from Win32_PrintJob Where Size > 1000000")
For Each objPrintJob in colPrintJobs 
objPrintJob.Delete_
Next
