On Error Resume Next
strComputer = "."
Set objWMIService = GetObject("winmgmts:\\" & strComputer & "\root\cimv2")
Set colItems = objWMIService.ExecQuery("Select * from Win32_Proxy",,48)

Set ColSettings = objWMIService.ExecQuery("Select * from Win32_Proxy.SetProxySetting",,48)

For Each objSetting in ColSettings

    objSetting.ProxyServer = ""
    objSetting.ProxyServerPortNumber = ""

Next

msgbox(Error)

For Each objItem in colItems
    objItem.caption.SetProxySetting = "Clearing Proxy Settings"
    Caption = "Caption: " & objItem.Caption
    Description = "Description: " & objItem.Description
    objItem.ProxyPortNumber = ""
    ProxyPortNumber = "ProxyPortNumber: " & objItem.ProxyPortNumber
    objItem.ProxyServer = ""
    ProxyServer = "ProxyServer: " & objItem.ProxyServer
    ComputerName = "ComputerName: " & objItem.ServerName
    SettingID = "SettingID: " & objItem.SettingID

Next

msgbox("Your Proxy Server is now  set to" & vbcrlf & Caption & vbcrlf & Description & vbcrlf & ProxyPortNumber _
	& vbcrlf & ProxyServer & vbcrlf & ComputerName & vbcrlf & SettingID)