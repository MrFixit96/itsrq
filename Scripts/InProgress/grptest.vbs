strComputer = "pcs27004"
Set objWMIService = GetObject("winmgmts:" _
    & "{impersonationLevel=impersonate}!\\" & strComputer & "\root\cimv2:Win32_Process")

Error = objWMIService.Create("\\172.16.2.1\JoinDomain\hslab3.vbs", null, null, intProcessID)
If Error = 0 Then
    Wscript.Echo "Notepad was started with a process ID of " _
         & intProcessID & "."
Else
    Wscript.Echo "Notepad could not be started due to error " & _
        Error & "."
End If
