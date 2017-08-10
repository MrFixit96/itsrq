strMachines = "pcs-svr01;pcs-svr02;207.179.200.2;192.168.1.254"
aMachines = split(strMachines, ";")

For Each machine in aMachines
    Set objPing = GetObject("winmgmts:{impersonationLevel=impersonate}")._
        ExecQuery("select * from Win32_PingStatus where address = '"_
            & machine & "'")
    For Each objStatus in objPing
        If IsNull(objStatus.StatusCode) or objStatus.StatusCode<>0 Then 
            WScript.Echo("machine " & machine & " is not reachable")   
        End If
        If not IsNull(objStatus.StatusCode) or objStatus.StatusCode<>0 Then 
            WScript.Echo("machine " & machine & " is reachable")   
        End If
    Next
Next

