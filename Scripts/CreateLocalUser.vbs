strComputer = "MyComputer"
Set colAccounts = GetObject("WinNT://" & strComputer & ",computer")
Set objUser = colAccounts.Create("user", "Admin2")
objUser.SetPassword "sA2xpWh"
objUser.SetInfo
