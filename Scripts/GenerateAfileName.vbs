'Description
'Demonstration script that uses the FileSystemObject's GetTempName method to generate random file names. Script must be run 'on the local computer. 

'Script Code 

Set objFSO = CreateObject("Scripting.FileSystemObject")
For i = 1 to 10
strTempFile = objFSO.GetTempName
Wscript.Echo strTempFile
Next
