'Description
'Returns total number of jobs, total number of pages, and largest job for all print queues on a computer. Requires Windows XP or Windows Server 2003. 

Script Code 

strComputer = "."
Set objWMIService = GetObject("winmgmts:" _
& "{impersonationLevel=impersonate}!\\" & strComputer & "\root\cimv2")
Set colPrintJobs = objWMIService.ExecQuery _
("Select * from Win32_PrintJob")
For Each objPrintJob in colPrintJobs 
intTotalJobs = intTotalJobs + 1
intTotalPages = intTotalPages + objPrintJob.TotalPages
If objPrintJob.TotalPages > intMaxPrintJob Then
intMaxPrintJob = objPrintJob.TotalPages
End If
Next
Wscript.Echo "Total print jobs in queue: " & intTotalJobs 
Wscript.Echo "Total pages in queue: " & intTotalPages
Wscript.Echo "Largest print job in queue: " & intMaxPrintJob

