strComputer = "jcaaTP"
Set objGroup = GetObject("WinNT://" & strComputer & "/Administrators,group")
Set objUser = GetObject("WinNT://" & strComputer & "/jcar,user")
objGroup.Add(objUser.ADsPath)
