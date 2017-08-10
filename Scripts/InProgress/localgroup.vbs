'-- Examples of adding groups and users to
'-- the local Administrators group.
'=========================================


'-- Declare variables
'====================
Dim fso
Dim outfile
Dim infile
Dim Shell
Dim str
Dim SvrArray
Dim Group
Dim Domain
Dim oDomain

On Error Resume Next

'-- Assign values to variables
'=============================
Set fso = CreateObject("Scripting.FileSystemObject")
Set outfile = fso.OpenTextFile _
    ("C:\WindowsScripts\AddDomainUsers.txt", 2, True)
Set infile = fso.OpenTextFile _
    ("C:\WindowsScripts\hslab.txt")
Set Shell = CreateObject("Wscript.Shell")

outfile.writeline " "
outfile.writeline "Addition of MYCOMPANY accounts" _
    & "account to Local Administrators "
outfile.writeline "group started at " & Now()
outfile.writeline " "

'-- Initialize and populate array
'================================
str = infile.ReadAll()
SvrArray = Split(str, vbCrLf)

oDomain = "PCS"
Set Domain = GetObject("WinNT://" & oDomain)

'-- Control Loop
'===============
For Each Server In SvrArray

'commandline = "C:\WINNT\System32\NET LOCALGROUP " _
'    &  "Administrators PCS\pcsLocalAdmins /add"
'Shell.Run commandline, 1, True

commandline = "C:\WINNT\System32\NET LOCALGROUP " _
    & "Administrators PCS\pcsLocalAdminsStudntWSs /add"
Shell.Run commandline, 1, True

commandline = "C:\WINNT\System32\NET LOCALGROUP " _
    & "Administrators PCS\Domain Admins /add"
Shell.Run commandline, 1, True

  Set User = GetObject _
    ("WinNT://" & Server.Name & "/Administrators")
  'If User.IsMember("WinNT://PCS/pcslocaladmins") Then
  '  outfile.writeline "   PCS\pcslocaladmins already exists on " _
  '  & Server & " or computer is not reachable."
  ' Else
  If User.IsMember("WinNT://PCS/pcsLocalAdminsStudntWSs") Then
    outfile.writeline "   PCS\pcsLocalAdminsStudntWSs already exists on " _
    & Server & " or computer is not reachable."
  Else
    outfile.writeline "   Adding accounts to Local Adminstrators on " & Server
    User.Add("WinNT://PCS/pcsLocalAdminsStudentWSs,group")
  'End If
  End IF
  outfile.writeline " "
Next

outfile.writeline "Script completed at " & Now()
MsgBox "Add_DomainUsers script has completed."

