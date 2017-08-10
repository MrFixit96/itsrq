Set objUser = GetObject _
  ("LDAP://cn=myerken,ou=management,dc=fabrikam,dc=com")
objUser.IsAccountLocked = False
objUser.SetInfo