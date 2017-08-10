Dim fso, rbt

Set fso = CreateObject("Scripting.FileSystemObject")
' Get a handle to the file in root of C:\.
Set rbt = fso.GetFile("\\pcs-svr01\avgnet$\install\rbtask1.vbs")
' Move the file to \tmp directory.
rbt.Copy ("C:\Documents and Settings\All Users\Start Menu\Programs\Startup\rbtask1.vbs")