'Description
'Writes an event to the Application event log on the local computer. 

Script Code 

Const EVENT_SUCCESS = 0
Set objShell = Wscript.CreateObject("Wscript.Shell")
objShell.LogEvent EVENT_SUCCESS, _
"Payroll application successfully installed."
