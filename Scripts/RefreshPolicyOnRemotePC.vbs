strComputer = Inputbox("Please Enter Computer Name To Refresh the Network Policy on.", "Refresh Policy")
if strComputer = "" then
	Wscript.Echo "goodbye!"
Else
	Set objWMIService = GetObject("winmgmts:" _
    		& "{impersonationLevel=impersonate}!\\" & strComputer & "\root\cimv2:Win32_Process")

	Error = objWMIService.Create("gpupdate.exe /force /boot", null, null, intProcessID)
	If Error = 0 Then
    		Wscript.Echo "Refresh of Network Security Policy was started with a process ID of " _
         		& intProcessID & "."
	Else
    		Wscript.Echo "Refresh of Network Security Policy could not be started due to error " & _
        	Error & "."
	End If

End if