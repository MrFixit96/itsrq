Const ENABLE = 1
strComputer = "."
Set objWMIService = GetObject("winmgmts:\\" & strComputer & "\root\cimv2")
Set colItems = objWMIService.ExecQuery("Select * from Win32_Terminal 
		Where TerminalName = 'Accounting'")
For Each objItem in colItems
    errResult = objItem.Enable(ENABLE)
Next
