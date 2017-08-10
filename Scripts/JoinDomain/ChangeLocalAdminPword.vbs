strComputer = "."
Set objUser = GetObject("WinNT://" & strComputer & "/Administrator, user")
objUser.SetPassword "csharp"
objUser.SetInfo
