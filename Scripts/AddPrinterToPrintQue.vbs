strComputer = "."
Set objWMIService = GetObject("winmgmts:" _
    & "{impersonationLevel=impersonate}!\\" & strComputer & "\root\cimv2")
Set objPrinter = objWMIService.Get("Win32_Printer").SpawnInstance_
objPrinter.DriverName = "HP LaserJet 4000 Series PS"
objPrinter.PortName   = "IP_169.254.110.160"
objPrinter.DeviceID   = "ScriptedPrinter"
objPrinter.Location = "USA/Redmond/Building 37/Room 114"
objPrinter.Network = True
objPrinter.Shared = True
objPrinter.ShareName = "ScriptedPrinter"
objPrinter.Put_