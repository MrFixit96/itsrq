Set objOU = GetObject("LDAP://OU=Management,dc=fabrikam,dc=com")
Set objGroup = objOU.Create("Group", "cn=atl-users")
objGroup.Put "sAMAccountName", "atl-users"
objGroup.SetInfo