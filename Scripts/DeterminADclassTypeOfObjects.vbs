strClassName = "cn=organizational-person"

Set objSchemaClass = GetObject _
("LDAP://" & strClassName & _
",cn=schema,cn=configuration,dc=fabrikam,dc=com")

intClassCategory = objSchemaClass.Get("objectClassCategory")

WScript.StdOut.Write strClassName & " is categorized as "
Select Case intClassCategory
Case 0
WScript.Echo "88"
Case 1
WScript.Echo "structural"
Case 2
WScript.Echo "abstract"
Case 3
WScript.Echo "auxiliary"
End Select