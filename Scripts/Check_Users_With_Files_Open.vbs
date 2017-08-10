'James Garfield
'Get a list of who has a file open, given the name of the server that the file is on and 
'a portion of the file name
On Error Resume Next
Dim fso
Dim FindPos, strFileToFind
Dim RowNumber, ColumnNumber, XL
Dim strServerName
ColumnNumber=1
RowNumber=1

strServername = Inputbox _
    ("Enter the name of the server the file is on", "Open File Finder v2.0")
strFileToFind = InputBox("Enter any part of Filename","Case Insensitive")

Set XL = CreateObject("Excel.Application")
XL.workbooks.add
XL.Visible = TRUE

XL.Cells(RowNumber, ColumnNumber).Value = "User"
XL.Cells(RowNumber, ColumnNumber+1).Value = "Path"
RowNumber=RowNumber+1

'  Bind to a file service operations object on "servername" in the local domain.

Set fso = GetObject("WinNT://" & strServerName & "/LanmanServer")

' Enumerate resources
If (IsEmpty(fso) = False) Then
For Each resource In fso.resources

If (Not resource.User = "") And (Not Right(resource.User,1) = "$") Then
	
FindPos = Instr(1, resource.path, strFileToFind ,1)

If (FindPos <> 0) Then
XL.Cells(RowNumber, ColumnNumber).Value = resource.user
XL.Cells(RowNumber, ColumnNumber+1).Value = resource.Path
RowNumber=RowNumber+1
End if
End If

Next
End If
XL.Cells.EntireColumn.Autofit
Set XL=nothing
MsgBox "Done"

