'Description
'Sets the default printer on a computer. Requires Windows XP or Windows Server 2003. 

'Script Code 

strComputer = "."
Set objWMIService = GetObject("winmgmts:" _
& "{impersonationLevel=impersonate}!\\" & strComputer & "\root\cimv2")
Set colInstalledPrinters = objWMIService.ExecQuery _
("Select * from Win32_Printer Where Name = 'ScriptedPrinter'")
For Each objPrinter in colInstalledPrinters
objPrinter.SetDefaultPrinter()
Next
