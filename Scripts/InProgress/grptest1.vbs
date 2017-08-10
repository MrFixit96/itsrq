strComputer = "PCS27003"
Set objWMIService = GetObject("winmgmts:" _
    & "{impersonationLevel=impersonate}!\\" & strComputer & "\root\cimv2:Win32_Process")
'Date:7-11-03
'Author: James Anderton
'Purpose: To add the proper pcs domain groups to the local groups
Const strGroup1  	= "pcsLocalAdmins"
Const strGroup2 	= "pcsPowerUsers"
Const strGroup3 = "pcsLocalAdminsStudentWSs"
Const strGroup4 = "pcsPowerUsersStudentWSs"
Const strDomainLG 	= "pcs" 
'
' ##################################################################################
' #			Check Local Groups
' ##################################################################################
'
'-------------------
'Make sure user is part of Local Administrators group
'
'------------!!!!---NEXT SECTION ONLY ON STUDENT COMPUTERS!!!-------------
'Add standard pcs.local groups to Student computer's local groups
'
strCommand5 = "net localgroup administrators " & strDomainLG & "\" & strGroup3 & " /add"
errResults5 = objWMIService.Create(strCommand5, null, null, intProcessID)
errResults5 = 0
strCommand6 = "net localgroup ""Power Users"" " & strDomainLG & "\" & strGroup4 & " /add"
errResults6 = objWMIService.Create(strCommand6, null, null, intProcessID)
errResults6 = 0
'----------------
'Rename adminlocal's password
'
strCommand9 ="net user AdminLocal takenap" 
errResults9 = objWMIService.Create(strCommand9, null, null, intProcessID)

if errResults5 = 0 AND errResults6 = 0 and errResults9 = 0 then
	Wscript.echo "All Done"
else
	Wscript.echo "Could not run script due to an error"
end if