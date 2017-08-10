Dim strComputer

strComputer = Inputbox("What Computer are you logged into?" & _
		"The computer name is located on the barcode sticker on the side or front of your computer.", "Computer Name") 

Set objWMIService = GetObject("winmgmts:" _
    & "{impersonationLevel=impersonate}!\\" & strComputer & "\root\cimv2")

Set colInstalledPrinters =  objWMIService.ExecQuery ("Select * from Win32_Printer")
For Each objPrinter in colInstalledPrinters
    objPrinter.CancelAllJobs()
Next
