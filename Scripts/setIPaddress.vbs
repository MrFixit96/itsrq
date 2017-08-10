strComputer = "."
Set objWMIService = GetObject("winmgmts:\\" & strComputer & "\root\cimv2")
Set colNetAdapters = objWMIService.ExecQuery _
    ("Select * from Win32_NetworkAdapterConfiguration where IPEnabled=TRUE")

strGatewayMetric = Array(1)
For Each objNetAdapter in colNetAdapters
	i=4
	strIPAddress = Array("192.168.1." & i)
	strSubnetMask = Array("255.255.255.0")
	strGateway = Array("192.168.1.254")

    errEnable = objNetAdapter.EnableStatic(strIPAddress, strSubnetMask)
    errGateways = objNetAdapter.SetGateways(strGateway, strGatewaymetric)
    If errEnable = 0 Then
        WScript.Echo "The IP address has been changed."
    Else
        WScript.Echo "The IP address could not be changed."
    End If
	i=i+1
Next