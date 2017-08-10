On Error Resume Next
strComputer = "."
Set objWMIService = GetObject("winmgmts:\\" & strComputer & "\root\cimv2")
Set colItems = objWMIService.ExecQuery("Select * from Win32_Proxy",,48)
For Each objItem in colItems
    Set objItem.Description = "New Proxy Settings"
    Caption = "Caption: " & objItem.Caption
    Description = "Description: " & objItem.Description
    ProxyPortNumber = "ProxyPortNumber: " & objItem.ProxyPortNumber
    ProxyServer = "ProxyServer: " & objItem.ProxyServer
    ServerName = "ServerName: " & objItem.ServerName
    SettingID = "SettingID: " & objItem.SettingID
Next

msgbox("Your Proxy Server is  set to" & vbcrlf & Caption & vbcrlf & Description & vbcrlf & ProxyPortNumber _
	& vbcrlf & ProxyServer & vbcrlf & ServerName & vbcrlf & SettingID)