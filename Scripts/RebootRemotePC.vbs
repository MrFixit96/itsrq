strComputer = Inputbox("Please Enter Computer Name To Reboot.", "Reboot Computer")
if strComputer = "" then
	Wscript.Echo "goodbye!"
Else

	Set objWMIService = GetObject("winmgmts:{impersonationLevel=impersonate}!\\" & strComputer & "\root\cimv2:Win32_Process")

	Error = objWMIService.Create("shutdown -r -t 01 -f", null, null, intProcessID)
	If Error = 0 Then
   		Wscript.Echo "Shutdown -r -t 01 -f was started with a process ID of " _
         	& intProcessID & "."
	Else
    		Wscript.Echo "Shutdown -r -t 01 -f could not be started due to error " & _
        	Error & "."
	End If
END IF
