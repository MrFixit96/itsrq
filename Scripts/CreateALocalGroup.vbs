strComputer = "MyComputer"
Set objComputer = GetObject("WinNT://" & strComputer & ",computer")
Set objGroup = objComputer.Create("group", "FinanceUsers")
objGroup.SetInfo
