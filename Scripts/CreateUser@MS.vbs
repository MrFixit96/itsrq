Set objOU = GetObject("LDAP://OU=Teachers,OU=pcsUsers,dc=ms,dc=peoriachristian,dc=org")
Set objUser = objOU.Create("User", "cn=UserName")
objUser.Put "sAMAccountName", "UserName"
objUser.SetInfo