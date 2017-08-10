strComputer = "."
Set objUser = GetObject("WinNT://" & strComputer & "/Adminlocal, user")
objUser.SetPassword "gohome"
objUser.SetInfo


strComputer = "pcs27062"
Set objUser = GetObject("WinNT://" & strComputer & "/Adminlocal, user")
objUser.SetPassword "gohome"
objUser.SetInfo


strComputer = "guidance-dt1"
Set objUser = GetObject("WinNT://" & strComputer & "/Adminlocal, user")
objUser.SetPassword "gohome"
objUser.SetInfo


strComputer = "pcs27063"
Set objUser = GetObject("WinNT://" & strComputer & "/Adminlocal, user")
objUser.SetPassword "gohome"
objUser.SetInfo


strComputer = "busoff-recp"
Set objUser = GetObject("WinNT://" & strComputer & "/Adminlocal, user")
objUser.SetPassword "gohome"
objUser.SetInfo


strComputer = "pcs27058"
Set objUser = GetObject("WinNT://" & strComputer & "/Adminlocal, user")
objUser.SetPassword "gohome"
objUser.SetInfo


strComputer = "pcs27001"
Set objUser = GetObject("WinNT://" & strComputer & "/Adminlocal, user")
objUser.SetPassword "gohome"
objUser.SetInfo


strComputer = "shutondt"
Set objUser = GetObject("WinNT://" & strComputer & "/Adminlocal, user")
objUser.SetPassword "gohome"
objUser.SetInfo


'strComputer = "pcs27067"
'Set objUser = GetObject("WinNT://" & strComputer & "/Adminlocal, user")
'objUser.SetPassword "gohome"
'objUser.SetInfo

strComputer = "pcs27060"
Set objUser = GetObject("WinNT://" & strComputer & "/Adminlocal, user")
objUser.SetPassword "gohome"
objUser.SetInfo

strComputer = "pcs27064"
Set objUser = GetObject("WinNT://" & strComputer & "/Adminlocal, user")
objUser.SetPassword "gohome"
objUser.SetInfo

Wscript.echo "password set"











