strComputer = "."
Set objUser = GetObject("WinNT://" & strComputer & "/Adminlocal, user")
objUser.SetPassword "gohome"
objUser.SetInfo
Wscript.echo "password set"