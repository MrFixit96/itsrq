Set objUser = GetObject _
	 ("LDAP://CN=myerken,OU=management,DC=Fabrikam,DC=com")
objUser.Put "pwdLastSet", -1
objUser.SetInfo