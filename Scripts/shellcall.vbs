Dim oShell
dim strlines

strlines="THis is a line" & vbcrlf & "this is a line" & vbcrlf & "This is a line"


Set oShell = CreateObject ("WSCript.shell")

oShell.run  (COPY %USERPROFILE% %USERPROFILE%.BAK, 2)

Set oShell = Nothing
