'Description
'Creates a custom event log named Scripts. 

Script Code 

Const NO_VALUE = Empty
Set WshShell = WScript.CreateObject("WScript.Shell")
WshShell.RegWrite "HKLM\System\CurrentControlSet\Services\EventLog\Scripts\", _
NO_VALUE