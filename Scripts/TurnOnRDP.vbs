Const PER_SESSION = 0
strComputer = "."
Set objWMIService = GetObject("winmgmts:\\" & strComputer & "\root\cimv2")
Set colItems = objWMIService.ExecQuery("Select * from Win32_TerminalServiceSetting")
For Each objItem in colItems
    errResult = objItem.ChangeMode(PER_SESSION)
Next
