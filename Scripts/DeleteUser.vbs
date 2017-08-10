Set objOU = GetObject("LDAP://ou=management,dc=fabrikam,dc=com")
objOU.Delete "User", "cn=myerken"
